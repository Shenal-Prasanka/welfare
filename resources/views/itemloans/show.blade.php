@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="m-0 font-weight-bold text-white">{{ __('Item Loan Application Details') }}</h5>
                        <a href="{{ route('itemloans.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                    </div>
                    <div class="card-body">
                        {{-- Application Status --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6><strong>{{ __('Application ID') }}:</strong> {{ $itemLoan->application_id }}</h6>
                            </div>
                            <div class="col-md-6 text-end">
                                <h6><strong>{{ __('Status') }}:</strong>
                                    @if($itemLoan->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif($itemLoan->status == 'oc_approved')
                                        <span class="badge bg-info">{{ __('OC Approved') }}</span>
                                    @elseif($itemLoan->status == 'approved')
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @endif
                                </h6>
                            </div>
                        </div>

                        @if($itemLoan->status == 'rejected' && $itemLoan->rejection_reason)
                            <div class="alert alert-warning">
                                <h6><i class="bi bi-exclamation-triangle"></i> {{ __('Rejection Reason') }}:</h6>
                                <p class="mb-0">{{ $itemLoan->rejection_reason }}</p>
                                <small class="text-muted">{{ __('Rejected by') }}: {{ $itemLoan->rejecter ? $itemLoan->rejecter->name : 'N/A' }} {{ __('on') }} {{ $itemLoan->rejected_at ? $itemLoan->rejected_at->format('Y-m-d H:i') : '' }}</small>
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
                                        <strong>{{ __('Enlisted No') }}:</strong><br>
                                        {{ $itemLoan->enlisted_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Regiment No') }}:</strong><br>
                                        {{ $itemLoan->regiment_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $itemLoan->rank }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $itemLoan->name }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $itemLoan->nic }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $itemLoan->army_id }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $itemLoan->office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Previous Unit') }}:</strong><br>
                                        {{ $itemLoan->previous_unit ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership') }}:</strong><br>
                                        <span class="badge {{ $itemLoan->welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">{{ $itemLoan->welfare_membership }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership Date') }}:</strong><br>
                                        {{ $itemLoan->welfare_membership_date ? $itemLoan->welfare_membership_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Bill No') }}:</strong><br>
                                        {{ $itemLoan->bill_no ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Bill Date') }}:</strong><br>
                                        {{ $itemLoan->bill_date ? $itemLoan->bill_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted Date') }}:</strong><br>
                                        {{ $itemLoan->enlisted_date->format('Y-m-d') }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Retire Date') }}:</strong><br>
                                        {{ $itemLoan->retire_date ? $itemLoan->retire_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Required Welfare Item Category') }}:</strong><br>
                                        {{ $itemLoan->required_welfare_item_category ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Shop Name') }}:</strong><br>
                                        {{ $itemLoan->welfare ? $itemLoan->welfare->name : 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Item Name') }}:</strong><br>
                                        {{ $itemLoan->item_name ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Item Type') }}:</strong><br>
                                        {{ $itemLoan->item_type ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Model No') }}:</strong><br>
                                        {{ $itemLoan->model_no ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Mobile No') }}:</strong><br>
                                        {{ $itemLoan->mobile_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Land No') }}:</strong><br>
                                        {{ $itemLoan->land_no ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Paying Installments') }}:</strong><br>
                                        <span class="badge {{ $itemLoan->paying_installments == 'Yes' ? 'bg-warning' : 'bg-success' }}">{{ $itemLoan->paying_installments }}</span>
                                    </div>
                                    @if($itemLoan->soldier_statement)
                                        <div class="col-md-4 mb-3">
                                            <strong>{{ __('Soldier Statement') }}:</strong><br>
                                            <a href="{{ route('soldier.statement', basename($itemLoan->soldier_statement)) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="bi bi-file-earmark-pdf"></i> {{ __('View Document') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Guarantor 1 Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">{{ __('Guarantor 1 Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted No') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_enlisted_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Regiment No') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_regiment_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_rank }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_name }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_nic }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_army_id }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Previous Unit') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_previous_unit ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership') }}:</strong><br>
                                        <span class="badge {{ $itemLoan->guarantor1_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">{{ $itemLoan->guarantor1_welfare_membership }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted Date') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_enlisted_date->format('Y-m-d') }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Retire Date') }}:</strong><br>
                                        {{ $itemLoan->guarantor1_retire_date ? $itemLoan->guarantor1_retire_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Guarantor 2 Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">{{ __('Guarantor 2 Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted No') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_enlisted_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Regiment No') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_regiment_no }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_rank }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_name }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_nic }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_army_id }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Previous Unit') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_previous_unit ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Welfare Membership') }}:</strong><br>
                                        <span class="badge {{ $itemLoan->guarantor2_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">{{ $itemLoan->guarantor2_welfare_membership }}</span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Enlisted Date') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_enlisted_date->format('Y-m-d') }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Retire Date') }}:</strong><br>
                                        {{ $itemLoan->guarantor2_retire_date ? $itemLoan->guarantor2_retire_date->format('Y-m-d') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Approval Information --}}
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">{{ __('Application Information') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Submitted By') }}:</strong><br>
                                        {{ $itemLoan->creator ? $itemLoan->creator->name : 'N/A' }}
                                        @if($itemLoan->creator)
                                            <br><small class="text-muted">{{ $itemLoan->creator->getRoleNames()->first() }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>{{ __('Submitted Date') }}:</strong><br>
                                        {{ $itemLoan->created_at->format('Y-m-d H:i') }}
                                    </div>
                                    @if($itemLoan->status == 'approved')
                                        <div class="col-md-6 mb-3">
                                            <strong>{{ __('Approved By') }}:</strong><br>
                                            {{ $itemLoan->approver ? $itemLoan->approver->name : 'N/A' }}
                                            @if($itemLoan->approver)
                                                <br><small class="text-muted">{{ $itemLoan->approver->getRoleNames()->first() }}</small>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>{{ __('Approved Date') }}:</strong><br>
                                            {{ $itemLoan->approved_at ? $itemLoan->approved_at->format('Y-m-d H:i') : 'N/A' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('itemloans.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
                            
                            <div>
                                @role('Unit Clerk')
                                    @if($itemLoan->status == 'rejected')
                                        <a href="{{ route('itemloans.edit', $itemLoan->id) }}" class="btn btn-info">
                                            <i class="bi bi-pencil"></i> {{ __('Edit & Resubmit') }}
                                        </a>
                                    @endif
                                @endrole
                                
                                @role('Unit OC')
                                    @if($itemLoan->status == 'pending')
                                        <form action="{{ route('itemloans.approve', $itemLoan->id) }}" method="POST" style="display:inline;">
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
                                
                                @role('Shop Coord Clerk')
                                    @if($itemLoan->status == 'oc_approved')
                                        <a href="{{ route('itemloans.checkLoan', $itemLoan->id) }}" class="btn btn-warning">
                                            <i class="bi bi-check-square"></i> {{ __('Check Loan') }}
                                        </a>
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

{{-- Unit OC Reject Modal --}}
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="rejectModalLabel">{{ __('Reject Application') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('itemloans.reject', $itemLoan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4" required></textarea>
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
@endsection
