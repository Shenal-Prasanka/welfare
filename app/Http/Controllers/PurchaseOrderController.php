<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Welfare;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:order-list'])->only(['index', 'show']);
        $this->middleware(['permission:order-create'])->only(['create', 'store']);
        $this->middleware(['permission:order-edit'])->only(['edit', 'update']);
        // Removed permission check for approve/reject - will check role in method
    }

    public function index()
    {
        $user = Auth::user();
        
        // Welfare Shop Clerk and Welfare Shop OC see only their own welfare's orders
        if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
            $orders = PurchaseOrder::with('welfare')
                ->withCount('items')
                ->where('welfare_id', $user->welfare_id)
                ->latest()
                ->paginate(15);
        } else {
            // Shop Coord Clerk, Shop Coord OC, Admin see all orders
            $orders = PurchaseOrder::with('welfare')
                ->withCount('items')
                ->latest()
                ->paginate(15);
        }
        
        return view('purchaseorders.index', compact('orders'));
    }

    public function create()
    {
        $welfares = Welfare::where('delete', 0)
            ->orderBy('name')
            ->get();
        $userWelfareId = Auth::user()->welfare_id;
        $products = \App\Models\Product::where('active', 0)
            ->orderBy('product')
            ->get();
        return view('purchaseorders.create', compact('welfares', 'userWelfareId', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'welfare_id' => ['nullable', 'exists:welfares,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.model_no' => ['nullable', 'string', 'max:255'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.welfare_price' => ['required', 'numeric', 'min:0'],
            'items.*.welfare_net_value' => ['required', 'numeric', 'min:0'],
            'items.*.mrp' => ['required', 'numeric', 'min:0'],
            'items.*.mrp_net_value' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated) {
            $order = PurchaseOrder::create([
                'po_number' => $this->generatePoNumber(),
                'welfare_id' => $validated['welfare_id'] ?? null,
                'created_by' => Auth::id(),
                'status' => 'pending',
            ]);

            foreach ($validated['items'] as $item) {
                $order->items()->create([
                    'item_name' => $item['item_name'],
                    'model_no' => $item['model_no'] ?? null,
                    'qty' => $item['qty'],
                    'welfare_price' => $item['welfare_price'],
                    'welfare_net_value' => $item['welfare_net_value'],
                    'mrp' => $item['mrp'],
                    'mrp_net_value' => $item['mrp_net_value'],
                ]);
            }
        });

        return redirect()->route('purchaseorder.index')->with('success', 'Purchase Order created.');
    }

    public function show(PurchaseOrder $purchaseorder)
    {
        // Try to load items directly with query
        $items = PurchaseOrderItem::where('purchase_order_id', $purchaseorder->id)->get();
        \Log::info('Direct Query Items Count: ' . $items->count());
        
        $purchaseorder->load(['welfare']);
        
        return view('purchaseorders.show', compact('purchaseorder', 'items'));
    }

    public function edit(PurchaseOrder $purchaseorder)
    {
        // Only approved orders cannot be edited
        if ($purchaseorder->status === 'approved') {
            return redirect()->route('purchaseorder.index')->with('error', 'Cannot edit an approved PO.');
        }
        
        // Load items directly with query (workaround for relationship issue)
        $items = PurchaseOrderItem::where('purchase_order_id', $purchaseorder->id)->get();
        
        $welfares = Welfare::where('delete', 0)
            ->orderBy('name')
            ->get();
        $userWelfareId = Auth::user()->welfare_id;
        return view('purchaseorders.edit', compact('purchaseorder', 'welfares', 'userWelfareId', 'items'));
    }

    public function update(Request $request, PurchaseOrder $purchaseorder)
    {
        // Only approved orders cannot be updated
        if ($purchaseorder->status === 'approved') {
            return redirect()->route('purchaseorder.index')->with('error', 'Cannot edit an approved PO.');
        }

        $validated = $request->validate([
            'welfare_id' => ['nullable', 'exists:welfares,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable', 'integer'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.model_no' => ['nullable', 'string', 'max:255'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.welfare_price' => ['required', 'numeric', 'min:0'],
            'items.*.welfare_net_value' => ['required', 'numeric', 'min:0'],
            'items.*.mrp' => ['required', 'numeric', 'min:0'],
            'items.*.mrp_net_value' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($purchaseorder, $validated) {
            // Update welfare_id and reset status to pending if it was rejected
            $updateData = [
                'welfare_id' => $validated['welfare_id'] ?? null,
            ];
            
            if ($purchaseorder->status === 'rejected') {
                $updateData['status'] = 'pending';
                $updateData['rejection_reason'] = null;
                $updateData['rejected_by'] = null;
            }
            
            $purchaseorder->update($updateData);

            // Sync items: update existing or create new, remove missing
            $keepIds = [];
            foreach ($validated['items'] as $item) {
                if (!empty($item['id'])) {
                    $poItem = PurchaseOrderItem::where('purchase_order_id', $purchaseorder->id)
                        ->where('id', $item['id'])
                        ->first();
                    if ($poItem) {
                        $poItem->update([
                            'item_name' => $item['item_name'],
                            'model_no' => $item['model_no'] ?? null,
                            'qty' => $item['qty'],
                            'welfare_price' => $item['welfare_price'],
                            'welfare_net_value' => $item['welfare_net_value'],
                            'mrp' => $item['mrp'],
                            'mrp_net_value' => $item['mrp_net_value'],
                        ]);
                        $keepIds[] = $poItem->id;
                    }
                } else {
                    $new = $purchaseorder->items()->create([
                        'item_name' => $item['item_name'],
                        'model_no' => $item['model_no'] ?? null,
                        'qty' => $item['qty'],
                        'welfare_price' => $item['welfare_price'],
                        'welfare_net_value' => $item['welfare_net_value'],
                        'mrp' => $item['mrp'],
                        'mrp_net_value' => $item['mrp_net_value'],
                    ]);
                    $keepIds[] = $new->id;
                }
            }

            PurchaseOrderItem::where('purchase_order_id', $purchaseorder->id)
                ->whereNotIn('id', $keepIds)
                ->delete();
        });

        return redirect()->route('purchaseorder.index')->with('success', 'Purchase Order updated.');
    }

    public function destroy(PurchaseOrder $purchaseorder)
    {
        if (!in_array($purchaseorder->status, ['pending'])) {
            return back()->with('error', 'Only pending POs can be deleted.');
        }
        $purchaseorder->delete();
        return back()->with('success', 'Purchase Order deleted.');
    }

    public function approve($id)
    {
        $po = PurchaseOrder::findOrFail($id);
        $user = Auth::user();
        
        if ($po->status === 'rejected' || $po->status === 'approved') {
            return back()->with('error', 'PO already finalized.');
        }
        
        // Multi-level approval logic
        // Level 0: Welfare Shop Clerk approves (level 1)
        // Level 1: Welfare Shop OC approves (level 2)
        // Level 2: Shop Coord Clerk approves (level 3)
        // Level 3: Shop Coord OC approves (level 4 - final)
        
        if ($po->approval_level == 0 && $user->hasRole('Welfare Shop Clerk')) {
            $po->approval_level = 1;
            $po->status = 'pending'; // Still pending for next level
            $message = 'PO approved by Welfare Shop Clerk. Awaiting Welfare Shop OC approval.';
        } elseif ($po->approval_level == 1 && $user->hasRole('Welfare Shop OC')) {
            $po->approval_level = 2;
            $po->status = 'pending'; // Still pending for next level
            $message = 'PO approved by Welfare Shop OC. Awaiting Shop Coord Clerk approval.';
        } elseif ($po->approval_level == 2 && $user->hasRole('Shop Coord Clerk')) {
            $po->approval_level = 3;
            $po->status = 'pending'; // Still pending for next level
            $message = 'PO approved by Shop Coord Clerk. Awaiting Shop Coord OC approval.';
        } elseif ($po->approval_level == 3 && $user->hasRole('Shop Coord OC')) {
            $po->approval_level = 4;
            $po->status = 'approved'; // Final approval
            $po->approved_by = Auth::id();
            $po->date = now(); // Auto-update date to today
            $message = 'PO fully approved by Shop Coord OC.';
        } else {
            return back()->with('error', 'You do not have permission to approve at this level.');
        }
        
        $po->save();
        return back()->with('success', $message);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:1000'],
        ]);
        $po = PurchaseOrder::findOrFail($id);
        if ($po->status === 'approved') {
            return back()->with('error', 'Approved PO cannot be rejected.');
        }
        $po->status = 'rejected';
        $po->approval_level = 0; // Reset to level 0 when rejected
        $po->rejected_by = Auth::id();
        $po->rejection_reason = $request->input('rejection_reason');
        $po->save();
        return back()->with('success', 'PO rejected and sent back to Welfare Shop Clerk.');
    }

    public function addStock($id)
    {
        $po = PurchaseOrder::with('items')->findOrFail($id);
        
        // Check if user is Welfare Shop Clerk and PO is fully approved
        if (!Auth::user()->hasRole('Welfare Shop Clerk')) {
            return back()->with('error', 'Only Welfare Shop Clerk can add stock.');
        }
        
        if ($po->approval_level != 4 || $po->status != 'approved') {
            return back()->with('error', 'PO must be fully approved before adding stock.');
        }
        
        if ($po->welfare_id != Auth::user()->welfare_id) {
            return back()->with('error', 'You can only add stock for your own welfare.');
        }
        
        // Load items directly
        $items = PurchaseOrderItem::where('purchase_order_id', $po->id)->get();
        
        return view('purchaseorders.addstock', compact('po', 'items'));
    }
    
    public function storeStock(Request $request, $id)
    {
        $po = PurchaseOrder::findOrFail($id);
        
        $request->validate([
            'stocks' => ['required', 'array'],
            'stocks.*.item_id' => ['required', 'exists:purchase_order_items,id'],
            'stocks.*.serial_numbers' => ['required', 'array'],
            'stocks.*.serial_numbers.*' => ['required', 'string', 'unique:stocks,serial_number'],
            'stocks.*.product_id' => ['nullable', 'exists:products,id'],
        ]);
        
        DB::transaction(function () use ($request, $po) {
            foreach ($request->stocks as $stockData) {
                $poItem = PurchaseOrderItem::findOrFail($stockData['item_id']);
                $product = null;
                
                if (!empty($stockData['product_id'])) {
                    $product = Product::with('category')->findOrFail($stockData['product_id']);
                }
                
                // Create stock entries for each serial number
                foreach ($stockData['serial_numbers'] as $serialNumber) {
                    Stock::create([
                        'purchase_order_id' => $po->id,
                        'purchase_order_item_id' => $poItem->id,
                        'product_id' => $product ? $product->id : null,
                        'welfare_id' => $po->welfare_id,
                        'item_name' => $poItem->item_name,
                        'item_model' => $poItem->model_no,
                        'item_code' => $product ? $product->product_number : null,
                        'item_category' => $product && $product->category ? $product->category->category : null,
                        'item_normal_price' => $product ? $product->normal_price : 0,
                        'item_welfare_price' => $product ? $product->welfare_price : $poItem->welfare_price,
                        'serial_number' => $serialNumber,
                        'status' => 'available',
                    ]);
                }
            }
        });
        
        return redirect()->route('purchaseorder.index')->with('success', 'Stock added successfully.');
    }

    private function generatePoNumber(): string
    {
        $prefix = 'PO-'.date('Ymd').'-';
        $last = PurchaseOrder::where('po_number', 'like', $prefix.'%')
            ->orderByDesc('id')
            ->first();
        $seq = 1;
        if ($last) {
            $parts = explode('-', $last->po_number);
            $seq = isset($parts[2]) ? ((int)$parts[2]) + 1 : 1;
        }
        return $prefix.str_pad((string)$seq, 3, '0', STR_PAD_LEFT);
    }
    public function getData(Request $request)
{
    $user = auth()->user();
    
    $query = \App\Models\PurchaseOrder::with(['welfare'])
        ->select('id', 'po_number', 'date', 'welfare_id', 'status', 'approval_level')
        ->withCount('items');
    
    // Welfare Shop Clerk and Welfare Shop OC see only their own welfare's orders
    if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
        $query->where('welfare_id', $user->welfare_id);
    }
    
    $orders = $query->get();

    return datatables()->of($orders)
        ->addColumn('welfare_name', function ($row) {
            return $row->welfare ? $row->welfare->welfare_number . ' - ' . $row->welfare->name : 'N/A';
        })
        ->addColumn('status', function ($row) {
            return '<span class="badge bg-danger text-uppercase">' . $row->status . '</span>';
        })
        ->addColumn('approval_text', function ($row) {
            switch ($row->approval_level) {
                case 0: return '<span class="badge bg-secondary">Awaiting Welfare Shop Clerk</span>';
                case 1: return '<span class="badge bg-info">Awaiting Welfare Shop OC</span>';
                case 2: return '<span class="badge bg-primary">Awaiting Shop Coord Clerk</span>';
                case 3: return '<span class="badge bg-warning">Awaiting Shop Coord OC</span>';
                case 4: return '<span class="badge bg-success">Fully Approved</span>';
                default: return '<span class="badge bg-dark">Unknown</span>';
            }
        })
        ->addColumn('actions', function ($row) {
            $user = auth()->user();
            $buttons = '<div class="d-flex justify-content-center align-items-center" style="gap: 5px;">';
            $buttons .= '<a href="' . route('purchaseorder.show', $row->id) . '" class="btn btn-sm btn-warning">View</a>';

            // Welfare Shop Clerk: Edit rejected orders
            if ($user->hasRole('Welfare Shop Clerk') && $row->status === 'rejected') {
                $buttons .= '<a href="' . route('purchaseorder.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
            }

            // Welfare Shop Clerk: Approve at level 0
            if ($user->hasRole('Welfare Shop Clerk') && $row->approval_level == 0 && $row->status == 'pending') {
                $buttons .= '<form action="' . route('purchase-orders.approve', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal' . $row->id . '">Reject</button>';
            }

            // Welfare Shop OC: Approve/Reject at level 1
            if ($user->hasRole('Welfare Shop OC') && $row->approval_level == 1 && $row->status == 'pending') {
                $buttons .= '<form action="' . route('purchase-orders.approve', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal' . $row->id . '">Reject</button>';
            }

            // Shop Coord Clerk: Approve/Reject at level 2
            if ($user->hasRole('Shop Coord Clerk') && $row->approval_level == 2 && $row->status == 'pending') {
                $buttons .= '<form action="' . route('purchase-orders.approve', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal' . $row->id . '">Reject</button>';
            }

            // Shop Coord OC: Approve/Reject at level 3
            if ($user->hasRole('Shop Coord OC') && $row->approval_level == 3 && $row->status == 'pending') {
                $buttons .= '<form action="' . route('purchase-orders.approve', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal' . $row->id . '">Reject</button>';
            }

            // Check if stock has already been added for this PO
            $hasStock = \App\Models\Stock::where('purchase_order_id', $row->id)->exists();
            
            // Welfare Shop Clerk: Add Stock button after full approval
            if ($user->hasRole('Welfare Shop Clerk') && $row->approval_level == 4 && $row->status == 'approved' && !$hasStock) {
                $buttons .= '<a href="' . route('purchaseorder.addstock', $row->id) . '" class="btn btn-sm btn-primary">Add Stock</a>';
            }
            
            $buttons .= '</div>';

            return $buttons;
        })
        ->rawColumns(['status', 'approval_text', 'actions'])
        ->make(true);
}

}


