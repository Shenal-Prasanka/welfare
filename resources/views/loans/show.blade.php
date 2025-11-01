@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="m-0 font-weight-bold text-white">{{ __('Loan Application Details') }}</h5>
                    </div>
                    <div class="card-body">
                        {{-- Application Status --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6><strong>{{ __('Application ID') }}:</strong> {{ $loan->application_id }}</h6>
                            </div>
                            <div class="col-md-6 text-end">
                                <h6><strong>{{ __('Status') }}:</strong>
                                    @if($loan->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif($loan->status == 'approved')
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @endif
                                </h6>
                            </div>
                        </div>

                        @if($loan->status == 'rejected' && $loan->rejection_reason)
                            <div class="alert alert-warning">
                                <h6><i class="bi bi-exclamation-triangle"></i> {{ __('Rejection Reason') }}:</h6>
                                <p class="mb-0">{{ $loan->rejection_reason }}</p>
                                <small class="text-muted">{{ __('Rejected by') }}: {{ $loan->rejecter ? $loan->rejecter->name : 'N/A' }} {{ __('on') }} {{ $loan->rejected_at ? $loan->rejected_at->format('Y-m-d H:i') : '' }}</small>
                            </div>
                        @endif

                        {{-- Member Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">{{ __('Member Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Loan Type') }}:</strong><br>
                                        <span class="badge {{ $loan->loan_type == '100000' ? 'bg-info' : 'bg-primary' }}">
                                            Rs. {{ number_format($loan->loan_type) }}
                                        </span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted No') }}:</strong><br>
                                        {{ $loan->enlisted_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Regiment No') }}:</strong><br>
                                        {{ $loan->regiment_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $loan->rank }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $loan->name }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $loan->nic }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $loan->army_id }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $loan->office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Previous Unit') }}:</strong><br>
                                        {{ $loan->previous_unit ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership') }}:</strong><br>
                                        <span class="badge {{ $loan->welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">{{ $loan->welfare_membership }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership Date') }}:</strong><br>
                                        {{ $loan->welfare_membership_date ? $loan->welfare_membership_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Bill No') }}:</strong><br>
                                        {{ $loan->bill_no ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Bill Date') }}:</strong><br>
                                        {{ $loan->bill_date ? $loan->bill_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted Date') }}:</strong><br>
                                        {{ $loan->enlisted_date->format('Y-m-d') }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Retire Date') }}:</strong><br>
                                        {{ $loan->retire_date ? $loan->retire_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Paying Installments') }}:</strong><br>
                                        <span class="badge {{ $loan->paying_installments == 'Yes' ? 'bg-warning' : 'bg-success' }}">{{ $loan->paying_installments }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Bank Name') }}:</strong><br>
                                        {{ $loan->bank_name }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Branch') }}:</strong><br>
                                        {{ $loan->branch }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Account No') }}:</strong><br>
                                        {{ $loan->account_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Mobile No') }}:</strong><br>
                                        {{ $loan->mobile_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Land No') }}:</strong><br>
                                        {{ $loan->land_no ?? 'N/A' }}
                                    </div>
                                    @if($loan->soldier_statement)
                                        <div class="col-md-4 mb-3">
                                            <strong>{{ __('Soldier Statement') }}:</strong><br>
                                            <a href="{{ route('loan.statement', basename($loan->soldier_statement)) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="bi bi-file-earmark-pdf"></i> {{ __('View Document') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Guarantor 1 Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">{{ __('Guarantor 1 Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted No') }}:</strong><br>
                                        {{ $loan->guarantor1_enlisted_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Regiment No') }}:</strong><br>
                                        {{ $loan->guarantor1_regiment_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $loan->guarantor1_rank }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $loan->guarantor1_name }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $loan->guarantor1_nic }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $loan->guarantor1_army_id }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $loan->guarantor1_office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Previous Unit') }}:</strong><br>
                                        {{ $loan->guarantor1_previous_unit ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership') }}:</strong><br>
                                        <span class="badge {{ $loan->guarantor1_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">{{ $loan->guarantor1_welfare_membership }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted Date') }}:</strong><br>
                                        {{ $loan->guarantor1_enlisted_date->format('Y-m-d') }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Retire Date') }}:</strong><br>
                                        {{ $loan->guarantor1_retire_date ? $loan->guarantor1_retire_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Guarantor 2 Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">{{ __('Guarantor 2 Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted No') }}:</strong><br>
                                        {{ $loan->guarantor2_enlisted_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Regiment No') }}:</strong><br>
                                        {{ $loan->guarantor2_regiment_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $loan->guarantor2_rank }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $loan->guarantor2_name }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $loan->guarantor2_nic }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $loan->guarantor2_army_id }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $loan->guarantor2_office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Previous Unit') }}:</strong><br>
                                        {{ $loan->guarantor2_previous_unit ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership') }}:</strong><br>
                                        <span class="badge {{ $loan->guarantor2_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">{{ $loan->guarantor2_welfare_membership }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted Date') }}:</strong><br>
                                        {{ $loan->guarantor2_enlisted_date->format('Y-m-d') }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Retire Date') }}:</strong><br>
                                        {{ $loan->guarantor2_retire_date ? $loan->guarantor2_retire_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Application Information Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                                <h6 class="mb-0">{{ __('Application Information') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Submitted By') }}:</strong><br>
                                        {{ $loan->creator ? $loan->creator->name : 'N/A' }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Submitted Date') }}:</strong><br>
                                        {{ $loan->created_at->format('Y-m-d H:i') }}
                                    </div>
                                    @if($loan->status == 'approved')
                                        <div class="col-md-6 mb-3">
                                            <strong>{{ __('Approved By') }}:</strong><br>
                                            {{ $loan->approver ? $loan->approver->name : 'N/A' }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>{{ __('Approved Date') }}:</strong><br>
                                            {{ $loan->approved_at ? $loan->approved_at->format('Y-m-d H:i') : 'N/A' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('loans.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
                                <a href="{{ route('loans.check', $loan->id) }}" class="btn btn-primary">
                                    <i class="bi bi-search"></i> {{ __('Check Loan') }}
                                </a>
                            </div>
                            
                            <div>
                                @role('Loan Clerk')
                                    @if($loan->status == 'rejected')
                                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-info">
                                            <i class="bi bi-pencil"></i> {{ __('Edit & Resubmit') }}
                                        </a>
                                    @endif
                                @endrole
                                
                                @role('Loan OC')
                                    @if($loan->status == 'pending')
                                        <form action="{{ route('loans.approve', $loan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-circle"></i> {{ __('Approve') }}
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                            <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                        </button>
                                    @endif
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Reject Modal --}}
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="rejectModalLabel">{{ __('Reject Application') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('loans.reject', $loan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4" required></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be sent back to Loan Clerk for revision.') }}
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
