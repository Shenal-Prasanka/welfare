@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Item Loan Applications') }}</h5>
                            @role('Unit Clerk')
                                <a href="{{ route('itemloans.create') }}" class="btn btn-sm btn-primary ms-auto">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Application') }}
                                </a>
                            @endrole
                        </div>
                    </div>
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <table id="itemLoansTable" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('Application ID') }}</th>
                                        <th>{{ __('Member Name') }}</th>
                                        <th>{{ __('Enlisted No') }}</th>
                                        <th>{{ __('Item Name') }}</th>
                                        <th>{{ __('Welfare Shop') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Submitted By') }}</th>
                                        <th>{{ __('Submitted Date') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($itemLoans as $loan)
                                        <tr>
                                            <td><strong>{{ $loan->application_id }}</strong></td>
                                            <td>{{ $loan->name }}</td>
                                            <td>{{ $loan->enlisted_no }}</td>
                                            <td>{{ $loan->item_name ?? 'N/A' }}</td>
                                            <td>{{ $loan->welfare ? $loan->welfare->name : 'N/A' }}</td>
                                            <td>
                                                @if($loan->status == 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif($loan->status == 'oc_approved')
                                                    <span class="badge bg-info">{{ __('OC Approved') }}</span>
                                                @elseif($loan->status == 'approved')
                                                    <span class="badge bg-success">{{ __('Approved') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($loan->creator)
                                                    <strong>{{ $loan->creator->name }}</strong><br>
                                                    <small class="text-muted">{{ $loan->creator->getRoleNames()->first() }}</small>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                                                    <a href="{{ route('itemloans.show', $loan->id) }}" class="btn btn-sm btn-warning" title="{{ __('View') }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                            
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Reject Modal for each loan -->
                                        <div class="modal fade" id="rejectModal{{ $loan->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $loan->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-dark text-white">
                                                        <h5 class="modal-title" id="rejectModalLabel{{ $loan->id }}">{{ __('Reject Application') }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('itemloans.reject', $loan->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="rejection_reason{{ $loan->id }}" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" id="rejection_reason{{ $loan->id }}" name="rejection_reason" rows="4" required></textarea>
                                                            </div>
                                                            <div class="alert alert-warning">
                                                                <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be sent back to Unit Clerk for revision.') }}
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
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">{{ __('No item loan applications found.') }}</td>
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
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#itemLoansTable').DataTable({
            order: [[0, 'desc']],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            columnDefs: [
                { orderable: false, targets: [8] } // Actions column
            ]
        });
    });

    // Auto-hide alerts after 5 seconds
    @if(session('success') || session('error'))
        setTimeout(function() {
            $('.alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000);
    @endif
</script>
@endsection
