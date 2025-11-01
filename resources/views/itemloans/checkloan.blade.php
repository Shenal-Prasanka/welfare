@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="m-0 font-weight-bold text-white">{{ __('Item Loan Application Details') }}</h5>
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
                                        <strong>{{ __('Welfare Shop') }}:</strong><br>
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

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('itemloans.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
                            
                            <div>
                                <form action="{{ route('itemloans.checkMembership', $itemLoan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info" {{ $itemLoan->membership_checked ? 'disabled' : '' }}>
                                        <i class="bi bi-check-square"></i> {{ $itemLoan->membership_checked ? __('Membership Checked') : __('Check Membership') }}
                                    </button>
                                </form>
                                <form action="{{ route('itemloans.shopCoordApprove', $itemLoan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i> {{ __('Final Approve') }}
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#shopCoordRejectModal">
                                    <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Shop Coord Clerk Reject Modal --}}
<div class="modal fade" id="shopCoordRejectModal" tabindex="-1" aria-labelledby="shopCoordRejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="shopCoordRejectModalLabel">{{ __('Reject Application') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('itemloans.shopCoordReject', $itemLoan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="shop_coord_rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="shop_coord_rejection_reason" name="rejection_reason" rows="4" required></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be rejected and sent back to Unit Clerk.') }}
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
