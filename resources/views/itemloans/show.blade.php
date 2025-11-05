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
                                    @elseif($itemLoan->status == 'shop_coord_clerk_approved')
                                        <span class="badge bg-primary">{{ __('Coord Clerk Approved') }}</span>
                                    @elseif($itemLoan->status == 'shop_coord_oc_approved')
                                        <span class="badge bg-primary">{{ __('Shop Coord OC Approved') }}</span>
                                    @elseif($itemLoan->status == 'approved')
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                    @elseif($itemLoan->status == 'shop_coord_rejected')
                                        <span class="badge bg-danger">{{ __('Shop Coord Rejected') }}</span>
                                    @elseif($itemLoan->status == 'shop_coord_oc_rejected')
                                        <span class="badge bg-danger">{{ __('Shop Coord OC Rejected') }}</span>
                                    @else
                                    @endif
                                </h6>
                            </div>
                        </div>

                        @if(($itemLoan->status == 'rejected' || $itemLoan->status == 'shop_coord_rejected' || $itemLoan->status == 'shop_coord_oc_rejected') && $itemLoan->rejection_reason)
                            <div class="alert alert-warning">
                                <h6><i class="bi bi-exclamation-triangle"></i> {{ __('Rejection Reason') }}:</h6>
                                <p class="mb-0">{{ $itemLoan->rejection_reason }}</p>
                                <small class="text-muted">
                                    <strong>{{ __('Rejected by') }}:</strong> {{ $itemLoan->rejecter ? $itemLoan->rejecter->name : 'N/A' }}
                                    @if($itemLoan->rejecter)
                                        ({{ $itemLoan->rejecter->getRoleNames()->first() }})
                                    @endif
                                    <br>
                                    <strong>{{ __('Rejected on') }}:</strong> {{ $itemLoan->rejected_at ? $itemLoan->rejected_at->format('Y-m-d H:i A') : 'N/A' }}
                                </small>
                            </div>
                        @endif

                        {{-- Member Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="bi bi-person-fill"></i> {{ __('Member Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <th width="20%">{{ __('Enlisted No') }}</th>
                                            <td width="30%">{{ $itemLoan->enlisted_no }}</td>
                                            <th width="20%">{{ __('Regiment No') }}</th>
                                            <td width="30%">{{ $itemLoan->regiment_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <td>{{ $itemLoan->name }}</td>
                                            <th>{{ __('Rank') }}</th>
                                            <td>{{ $itemLoan->rank }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('NIC') }}</th>
                                            <td>{{ $itemLoan->nic }}</td>
                                            <th>{{ __('Army ID') }}</th>
                                            <td>{{ $itemLoan->army_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Office Address') }}</th>
                                            <td>{{ $itemLoan->office_address }}</td>
                                            <th>{{ __('Previous Unit') }}</th>
                                            <td>{{ $itemLoan->previous_unit ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Enlisted Date') }}</th>
                                            <td>{{ $itemLoan->enlisted_date->format('Y-m-d') }}</td>
                                            <th>{{ __('Retire Date') }}</th>
                                            <td>{{ $itemLoan->retire_date ? $itemLoan->retire_date->format('Y-m-d') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Welfare Membership') }}</th>
                                            <td>
                                                <span class="badge {{ $itemLoan->welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $itemLoan->welfare_membership }}
                                                </span>
                                            </td>
                                            <th>{{ __('Welfare Membership Date') }}</th>
                                            <td>{{ $itemLoan->welfare_membership_date ? $itemLoan->welfare_membership_date->format('Y-m-d') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Mobile No') }}</th>
                                            <td>{{ $itemLoan->mobile_no }}</td>
                                            <th>{{ __('Land No') }}</th>
                                            <td>{{ $itemLoan->land_no ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Paying Installments') }}</th>
                                            <td>
                                                <span class="badge {{ $itemLoan->paying_installments == 'Yes' ? 'bg-warning' : 'bg-success' }}">
                                                    {{ $itemLoan->paying_installments }}
                                                </span>
                                            </td>
                                            @if($itemLoan->soldier_statement)
                                                <th>{{ __('Soldier Statement') }}</th>
                                                <td>
                                                    <a href="{{ route('soldier.statement', basename($itemLoan->soldier_statement)) }}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="bi bi-file-earmark-pdf"></i> {{ __('View Document') }}
                                                    </a>
                                                </td>
                                            @else
                                                <th>{{ __('Soldier Statement') }}</th>
                                                <td>N/A</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>{{ __('Bill No') }}</th>
                                            <td>{{ $itemLoan->bill_no ?? 'N/A' }}</td>
                                            <th>{{ __('Bill Date') }}</th>
                                            <td>{{ $itemLoan->bill_date ? $itemLoan->bill_date->format('Y-m-d') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Welfare Shop Name') }}</th>
                                            <td>{{ $itemLoan->welfare ? $itemLoan->welfare->name : 'N/A' }}</td>
                                            <th>{{ __('Required Welfare Item Category') }}</th>
                                            <td>{{ $itemLoan->required_welfare_item_category ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Item Name') }}</th>
                                            <td>{{ $itemLoan->item_name ?? 'N/A' }}</td>
                                            <th>{{ __('Item Type') }}</th>
                                            <td>{{ $itemLoan->item_type ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Model No') }}</th>
                                            <td colspan="3">{{ $itemLoan->model_no ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Guarantor 1 Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0"><i class="bi bi-person-check-fill"></i> {{ __('Guarantor 1 Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <th width="20%">{{ __('Enlisted No') }}</th>
                                            <td width="30%">{{ $itemLoan->guarantor1_enlisted_no }}</td>
                                            <th width="20%">{{ __('Regiment No') }}</th>
                                            <td width="30%">{{ $itemLoan->guarantor1_regiment_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <td>{{ $itemLoan->guarantor1_name }}</td>
                                            <th>{{ __('Rank') }}</th>
                                            <td>{{ $itemLoan->guarantor1_rank }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('NIC') }}</th>
                                            <td>{{ $itemLoan->guarantor1_nic }}</td>
                                            <th>{{ __('Army ID') }}</th>
                                            <td>{{ $itemLoan->guarantor1_army_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Office Address') }}</th>
                                            <td>{{ $itemLoan->guarantor1_office_address }}</td>
                                            <th>{{ __('Previous Unit') }}</th>
                                            <td>{{ $itemLoan->guarantor1_previous_unit ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Enlisted Date') }}</th>
                                            <td>{{ $itemLoan->guarantor1_enlisted_date->format('Y-m-d') }}</td>
                                            <th>{{ __('Retire Date') }}</th>
                                            <td>{{ $itemLoan->guarantor1_retire_date ? $itemLoan->guarantor1_retire_date->format('Y-m-d') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Welfare Membership') }}</th>
                                            <td colspan="3">
                                                <span class="badge {{ $itemLoan->guarantor1_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $itemLoan->guarantor1_welfare_membership }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Guarantor 2 Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0"><i class="bi bi-person-check-fill"></i> {{ __('Guarantor 2 Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <th width="20%">{{ __('Enlisted No') }}</th>
                                            <td width="30%">{{ $itemLoan->guarantor2_enlisted_no }}</td>
                                            <th width="20%">{{ __('Regiment No') }}</th>
                                            <td width="30%">{{ $itemLoan->guarantor2_regiment_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <td>{{ $itemLoan->guarantor2_name }}</td>
                                            <th>{{ __('Rank') }}</th>
                                            <td>{{ $itemLoan->guarantor2_rank }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('NIC') }}</th>
                                            <td>{{ $itemLoan->guarantor2_nic }}</td>
                                            <th>{{ __('Army ID') }}</th>
                                            <td>{{ $itemLoan->guarantor2_army_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Office Address') }}</th>
                                            <td>{{ $itemLoan->guarantor2_office_address }}</td>
                                            <th>{{ __('Previous Unit') }}</th>
                                            <td>{{ $itemLoan->guarantor2_previous_unit ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Enlisted Date') }}</th>
                                            <td>{{ $itemLoan->guarantor2_enlisted_date->format('Y-m-d') }}</td>
                                            <th>{{ __('Retire Date') }}</th>
                                            <td>{{ $itemLoan->guarantor2_retire_date ? $itemLoan->guarantor2_retire_date->format('Y-m-d') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Welfare Membership') }}</th>
                                            <td colspan="3">
                                                <span class="badge {{ $itemLoan->guarantor2_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $itemLoan->guarantor2_welfare_membership }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                                   
                            <div>
                                @role('Unit Clerk')
                                    @if($itemLoan->status == 'rejected' || $itemLoan->status == 'shop_coord_oc_rejected')
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
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#shopCoordRejectModal">
                                            <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                        </button>
                                    @endif
                                @endrole
                                
                                @role('Shop Coord OC')
                                    @if($itemLoan->status == 'shop_coord_clerk_approved')
                                        <form action="{{ route('itemloans.shopCoordOCApprove', $itemLoan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-circle"></i> {{ __('Approve') }}
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#shopCoordOCRejectModal">
                                            <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                        </button>
                                    @endif
                                @endrole
                            </div>
                        </div>

                        {{-- Item Selection Form for Welfare Shop Clerk --}}
                        @role('Welfare Shop Clerk')
                            @if($itemLoan->status == 'shop_coord_oc_approved')
                                <div class="card mt-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="m-0">{{ __('Select Item to Issue') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('itemloans.processIssue', $itemLoan->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label"><strong>{{ __('Available Stock Items') }}</strong></label>
                                                <p class="text-muted small">{{ __('Showing items matching: ') }} <strong>{{ $itemLoan->item_name }}</strong></p>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th width="50">{{ __('Select') }}</th>
                                                                <th>{{ __('Item Code') }}</th>
                                                                <th>{{ __('Item Name') }}</th>
                                                                <th>{{ __('Model') }}</th>
                                                                <th>{{ __('Serial Number') }}</th>
                                                                <th>{{ __('Category') }}</th>
                                                                <th>{{ __('Welfare Price') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $availableStocks = \App\Models\Stock::where('status', 'available')
                                                                    ->where('item_name', 'LIKE', '%' . $itemLoan->item_name . '%')
                                                                    ->get();
                                                            @endphp
                                                            
                                                            @forelse($availableStocks as $stock)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <input type="radio" name="stock_id" value="{{ $stock->id }}" required>
                                                                    </td>
                                                                    <td>{{ $stock->item_code }}</td>
                                                                    <td>{{ $stock->item_name }}</td>
                                                                    <td>{{ $stock->item_model ?? 'N/A' }}</td>
                                                                    <td><strong>{{ $stock->serial_number }}</strong></td>
                                                                    <td>{{ $stock->item_category ?? 'N/A' }}</td>
                                                                    <td>Rs. {{ number_format($stock->item_welfare_price, 2) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="7" class="text-center text-danger">
                                                                        {{ __('No available stock items found matching this request.') }}
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- Action Buttons - Hidden by default, shown when item selected --}}
                                            @if($availableStocks->count() > 0)
                                                <div id="issueActionButtons" class="d-flex justify-content-between gap-2 mt-3" style="display: none !important;">
                                                    <button type="button" class="btn btn-primary" id="invoiceBtn" onclick="generateInvoice()">
                                                        <i class="bi bi-file-earmark-text"></i> {{ __('Generate Invoice') }}
                                                    </button>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('itemloans.index') }}" class="btn btn-secondary">
                                                            <i class="bi bi-arrow-left"></i> {{ __('Back to List') }}
                                                        </a>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="bi bi-check-circle"></i> {{ __('Approve') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endrole

                        <div class="mt-3">
                            <div class="d-flex justify-content-start gap-2">
                                
                                @role('Staff Officer')
                                    @if($itemLoan->status == 'shop_coord_rejected')
                                        <form action="{{ route('itemloans.staffOfficerReject', $itemLoan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this item loan application? This will store the rejection in the Rejected Loans table.')">
                                                <i class="bi bi-x-circle"></i> {{ __('Reject Loan') }}
                                            </button>
                                        </form>
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

{{-- Shop Coord Clerk Reject Modal --}}
<div class="modal fade" id="shopCoordRejectModal" tabindex="-1" aria-labelledby="shopCoordRejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="shopCoordRejectModalLabel">{{ __('Reject Item Loan Application') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('itemloans.shopCoordReject', $itemLoan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="shop_rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="shop_rejection_reason" name="rejection_reason" rows="4" required placeholder="{{ __('Please provide a detailed reason for rejection...') }}"></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be rejected and sent back to Unit Clerk for revision.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> {{ __('Confirm Rejection') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Shop Coord OC Reject Modal --}}
<div class="modal fade" id="shopCoordOCRejectModal" tabindex="-1" aria-labelledby="shopCoordOCRejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="shopCoordOCRejectModalLabel">{{ __('Reject Item Loan Application') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('itemloans.shopCoordOCReject', $itemLoan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="shop_oc_rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="shop_oc_rejection_reason" name="rejection_reason" rows="4" required placeholder="{{ __('Please provide a detailed reason for rejection...') }}"></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be rejected and sent back to Unit Clerk for revision.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> {{ __('Confirm Rejection') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Show/hide action buttons when stock item is selected
    document.addEventListener('DOMContentLoaded', function() {
        const stockRadios = document.querySelectorAll('input[name="stock_id"]');
        const actionButtons = document.getElementById('issueActionButtons');
        
        if (stockRadios.length > 0 && actionButtons) {
            stockRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        actionButtons.style.display = 'flex';
                    }
                });
            });
        }
    });
    
    // Generate Invoice function
    function generateInvoice() {
        const selectedStock = document.querySelector('input[name="stock_id"]:checked');
        if (!selectedStock) {
            alert('Please select an item first');
            return;
        }
        
        const stockId = selectedStock.value;
        const invoiceUrl = "{{ route('itemloans.invoice', $itemLoan->id) }}" + "?stock_id=" + stockId;
        
        // Open invoice in new window
        window.open(invoiceUrl, '_blank');
    }
</script>
@endsection
