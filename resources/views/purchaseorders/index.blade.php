
@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Purchase Orders') }}</h5>
                            @can('order-create')
                                <a href="{{ route('purchaseorder.create') }}" class="btn btn-sm btn-primary ms-auto">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create PO') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="purchaseOrderTable" class="table table-bordered  w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('PO Number') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Welfare') }}</th>
                                        <th>{{ __('Items') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Approval Level') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="rejectModalLabel">{{ __('Reject Purchase Order') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- ✅ Include DataTables JS -->
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#purchaseOrderTable', {
        ajax: '{{ route('purchase-orders.ajax') }}',
        processing: true,
        serverSide: false,
        columns: [
            { data: 'po_number', name: 'po_number' },
            { data: 'date', name: 'date' },
            { data: 'welfare_name', name: 'welfare_name' },
            { data: 'items_count', name: 'items_count' },
            { data: 'status', name: 'status' },
            { data: 'approval_text', name: 'approval_text' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
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
        }
    });
    
    // Handle reject button clicks
    $(document).on('click', '[data-bs-target^="#rejectModal"]', function() {
        var poId = $(this).data('bs-target').replace('#rejectModal', '');
        var rejectUrl = '{{ route("purchase-orders.reject", ":id") }}'.replace(':id', poId);
        $('#rejectForm').attr('action', rejectUrl);
        $('#rejectModal').modal('show');
    });
});
</script>
@endsection
