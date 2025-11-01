@extends('layouts.app')

@section('styles')
    <!-- ✅ DataTables v2 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
@endsection

@section('content')
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold text-white">{{ __('Stock Management') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <!-- ✅ Correct ID -->
                                <table id="stockTable" style="border: 2px solid gray;" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Item Code') }}</th>
                                            <th class="text-center">{{ __('Item Name') }}</th>
                                            <th class="text-center">{{ __('Item Model') }}</th>
                                            <th class="text-center">{{ __('Serial Number') }}</th>
                                            <th class="text-center">{{ __('Category') }}</th>
                                            <th class="text-center">{{ __('Purchase Order') }}</th>
                                            <th class="text-center">{{ __('Normal Price') }}</th>
                                            <th class="text-center">{{ __('Welfare Price') }}</th>
                                            <th class="text-center">{{ __('Welfare') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($stocks as $stock)
                                            <tr>
                                                <td class="text-center">
                                                    @if($stock->item_code)
                                                        <span class="badge bg-info">{{ $stock->item_code }}</span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $stock->item_name }}</td>
                                                <td class="text-center">{{ $stock->item_model ?? 'N/A' }}</td>
                                                <td class="text-center"><strong>{{ $stock->serial_number }}</strong></td>
                                                <td class="text-center">{{ $stock->item_category ?? 'N/A' }}</td>
                                                <td class="text-center">
                                                    @if($stock->purchaseOrder)
                                                        <a href="{{ route('purchaseorder.show', $stock->purchaseOrder->id) }}" class="text-decoration-none">
                                                            {{ $stock->purchaseOrder->po_number }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ number_format($stock->item_normal_price, 2) }}</td>
                                                <td class="text-center">{{ number_format($stock->item_welfare_price, 2) }}</td>
                                                <td class="text-center">
                                                    @if($stock->welfare)
                                                        {{ $stock->welfare->name }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($stock->status == 'available')
                                                        <span class="badge bg-success">{{ __('Available') }}</span>
                                                    @elseif($stock->status == 'sold')
                                                        <span class="badge bg-warning">{{ __('Sold') }}</span>
                                                    @elseif($stock->status == 'damaged')
                                                        <span class="badge bg-danger">{{ __('Damaged') }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $stock->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-sm btn-warning" title="{{ __('View') }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    @if($stock->status == 'available')
                                                        <button type="button" class="btn btn-sm btn-primary">
                                                            {{ __('Issue') }}
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">{{ __('No stock items found.') }}</td>
                                            </tr>
                                        @endforelse
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
    <!-- ✅ DataTables v2 JS -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#stockTable', {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                lengthMenu: [8, 25, 50, 100],
                pageLength: 8,
                language: {
                    search: "SEARCH:_INPUT_",
                    lengthMenu: "SHOW _MENU_ ENTRIES ",
                    info: "Showing _TOTAL_ Entries",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: [5, 10] }
                ]
            });
        });
    </script>
@endsection
