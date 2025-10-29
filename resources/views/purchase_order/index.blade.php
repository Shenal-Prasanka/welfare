@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">    
                                <h5 class="m-0 font-weight-bold">{{ __('Purchase Order') }}</h5>
                                @can('order-create')
                                    <a href="{{ route('purchaseorder.create') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus-circle"></i> {{ __('Add Purchase Order') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="perchaseorderTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th  class="text-center">Welfare</th>
                                            <th  class="text-center">Supplier</th>
                                            <th  class="text-center">Supplier Code</th>
                                            <th  class="text-center">Product</th>
                                            <th  class="text-center">Model</th>
                                            <th  class="text-center">Qty</th>
                                            <th  class="text-center">Statous</th>
                                            <th  class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchaseOrders as $purchaseOrder)
                                            <tr>
                                                <td  class="text-center">{{ $purchaseOrder->welfare }}</td>
                                                <td  class="text-center">{{ $purchaseOrder->supply->supply ?? '' }}</td>
                                                <td  class="text-center">{{ $purchaseOrder->supply->supply_number ?? '' }}</td>
                                                {{-- Join array values into one column with line breaks --}}
                                                <td  class="text-center">{!! implode('<br>', $purchaseOrder->items ?? []) !!}</td>
                                                <td  class="text-center">{!! implode('<br>', $purchaseOrder->models ?? []) !!}</td>
                                                <td  class="text-center">{!! implode('<br>', $purchaseOrder->quantities ?? []) !!}</td>
                                                <td  class="text-center">
                                                    <p class="mt-2">
                                                        @if($purchaseOrder->active == 1||$purchaseOrder->active == 2||$purchaseOrder->active == 3)
                                                            <span class="badge bg-primary">Pending</span>
                                                        @elseif($purchaseOrder->active == 0)
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @elseif($purchaseOrder->active == 4)
                                                            <span class="badge bg-success">Approved</span>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                   @can('order-edit')
                                                        @if($purchaseOrder->active == 0 && auth()->user()->hasRole('Welfare Shop Clerk'))
                                                            <a href="{{ route('purchaseorder.edit', $purchaseOrder->id) }}" 
                                                            class="btn btn-sm btn-success">Approve</a>

                                                        @elseif($purchaseOrder->active == 1 && auth()->user()->hasRole('Welfare Shop OC'))
                                                            <a href="{{ route('purchaseorder.edit', $purchaseOrder->id) }}" 
                                                            class="btn btn-sm btn-success">Approve</a>

                                                        @elseif($purchaseOrder->active == 2 && auth()->user()->hasRole('Shop Coord Clerk'))
                                                            <a href="{{ route('purchaseorder.edit', $purchaseOrder->id) }}" 
                                                            class="btn btn-sm btn-success">Approve</a>

                                                        @elseif($purchaseOrder->active == 3 && auth()->user()->hasRole('Shop Coord OC'))
                                                            <a href="{{ route('purchaseorder.edit', $purchaseOrder->id) }}" 
                                                            class="btn btn-sm btn-success">Approve</a>

                                                        @else
                                                            N/A
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#perchaseorderTable', {
                paging: true,
                ordering: true,
                responsive: true,
                lengthMenu: [8, 25, 50, 100],
                pageLength: 8,
                language: {                 
                    lengthMenu: "SHOW _MENU_ ENTRIES",
                    info: "Showing _TOTAL_ Entries",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });

        function calculateRow(el) {
            const row = el.closest('tr');
            const qty = parseFloat(row.querySelector('.qty').value) || 0;
            const welfarePrice = parseFloat(row.querySelector('.welfare-price').value) || 0;
            const mrp = parseFloat(row.querySelector('.mrp').value) || 0;

            row.querySelector('.welfare-total').value = (qty * welfarePrice).toFixed(2);
            row.querySelector('.mrp-total').value = (qty * mrp).toFixed(2);
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
        }
    </script>
@endsection
