<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Welfare Shop Clerk and Welfare Shop OC see only their own welfare's stock
        if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
            $stocks = Stock::with(['purchaseOrder', 'purchaseOrderItem', 'product', 'welfare'])
                ->where('welfare_id', $user->welfare_id)
                ->latest()
                ->get();
        } else {
            // Admin, Shop Coord Clerk, Shop Coord OC see all stock
            $stocks = Stock::with(['purchaseOrder', 'purchaseOrderItem', 'product', 'welfare'])
                ->latest()
                ->get();
        }
        
        return view('stocks.index', compact('stocks'));
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        
        $query = Stock::with(['purchaseOrder', 'purchaseOrderItem', 'product', 'welfare']);
        
        // Welfare Shop Clerk and Welfare Shop OC see only their own welfare's stock
        if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
            $query->where('welfare_id', $user->welfare_id);
        }
        
        $stocks = $query->latest()->get();
        
        return response()->json([
            'data' => $stocks->map(function($stock) {
                return [
                    'item_code' => $stock->item_code ? '<span class="badge bg-info">' . $stock->item_code . '</span>' : '<span class="text-muted">N/A</span>',
                    'item_name' => $stock->item_name,
                    'item_model' => $stock->item_model ?? 'N/A',
                    'serial_number' => '<strong>' . $stock->serial_number . '</strong>',
                    'item_category' => $stock->item_category ?? 'N/A',
                    'purchase_order' => $stock->purchaseOrder 
                        ? '<a href="' . route('purchaseorder.show', $stock->purchaseOrder->id) . '" class="text-decoration-none">' . $stock->purchaseOrder->po_number . '</a>'
                        : '<span class="text-muted">N/A</span>',
                    'item_normal_price' => number_format($stock->item_normal_price, 2),
                    'item_welfare_price' => number_format($stock->item_welfare_price, 2),
                    'welfare' => $stock->welfare ? $stock->welfare->name : '<span class="text-muted">N/A</span>',
                    'status' => $this->getStatusBadge($stock->status),
                    'actions' => $this->getActionButtons($stock),
                ];
            })
        ]);
    }

    private function getStatusBadge($status)
    {
        $badges = [
            'available' => '<span class="badge bg-success">Available</span>',
            'sold' => '<span class="badge bg-warning">Sold</span>',
            'damaged' => '<span class="badge bg-danger">Damaged</span>',
        ];
        
        return $badges[$status] ?? '<span class="badge bg-secondary">' . $status . '</span>';
    }

    private function getActionButtons($stock)
    {
        $buttons = '<div class="d-flex justify-content-between align-items-center" style="gap: 5px;">';
        $buttons .= '<a href="' . route('stocks.show', $stock->id) . '" class="btn btn-sm btn-warning" title="View"><i class="bi bi-eye"></i></a>';
        
        if ($stock->status == 'available') {
            $buttons .= '<button type="button" class="btn btn-sm btn-primary">Issue</button>';
        }
        
        $buttons .= '</div>';
        
        return $buttons;
    }

    public function checkSerial(Request $request)
    {
        $serialNumber = $request->input('serial_number');
        $exists = Stock::where('serial_number', $serialNumber)->exists();
        
        return response()->json(['exists' => $exists]);
    }

    public function show($id)
    {
        $stock = Stock::with(['purchaseOrder', 'purchaseOrderItem', 'product', 'welfare'])->findOrFail($id);
        
        // Check if user can view this stock
        $user = Auth::user();
        if (($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) && $stock->welfare_id != $user->welfare_id) {
            return redirect()->route('stocks.index')->with('error', 'You can only view stock from your own welfare.');
        }
        
        return view('stocks.show', compact('stock'));
    }
}
