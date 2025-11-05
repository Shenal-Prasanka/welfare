@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Loan Applications') }}</h5>
                            @role('Loan Clerk')
                                <a href="{{ route('loans.create') }}" class="btn btn-sm btn-primary ms-auto">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Application') }}
                                </a>
                            @endrole
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="loansTable" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('Application ID') }}</th>
                                        <th>{{ __('Loan Type') }}</th>
                                        <th>{{ __('Member Name') }}</th>
                                        <th>{{ __('Enlisted No') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Submitted By') }}</th>
                                        <th>{{ __('Submitted Date') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($loans as $loan)
                                        <tr>
                                            <td><strong>{{ $loan->application_id }}</strong></td>
                                            <td>
                                                <span class="badge {{ $loan->loan_type == '100000' ? 'bg-info' : 'bg-primary' }}">
                                                    Rs. {{ number_format($loan->loan_type) }}
                                                </span>
                                            </td>
                                            <td>{{ $loan->name }}</td>
                                            <td>{{ $loan->enlisted_no }}</td>
                                            <td>
                                                @if($loan->status == 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif($loan->status == 'oc_approved')
                                                    <span class="badge bg-info">{{ __('OC Approved') }}</span>
                                                @elseif($loan->status == 'approved')
                                                    <span class="badge bg-success">{{ __('Approved') }}</span>
                                                @else
                                                    <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $loan->rejection_reason }}">
                                                        {{ __('Rejected') }} <i class="bi bi-info-circle"></i>
                                                    </span>
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
                                                    @role('Staff Officer')
                                                        <a href="{{ route('loans.staffReview', $loan->id) }}" class="btn btn-sm btn-primary" title="{{ __('Staff Review') }}">
                                                            <i class="bi bi-clipboard-check"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-warning" title="{{ __('View') }}">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    @endrole
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">{{ __('No loan applications found.') }}</td>
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

<script>
    $(document).ready(function() {
        $('#loansTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[6, 'desc']], // Sort by submitted date
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            columnDefs: [
                { orderable: false, targets: [7] } // Actions column
            ]
        });
        
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
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
