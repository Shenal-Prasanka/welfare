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
                                        <strong>{{ __('NIC') }}:</strong><br>
                                        {{ $itemLoan->nic }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $itemLoan->name }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Office Address') }}:</strong><br>
                                        {{ $itemLoan->office_address }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Army ID') }}:</strong><br>
                                        {{ $itemLoan->army_id }}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ __('Rank') }}:</strong><br>
                                        {{ $itemLoan->rank }}
                                    </div>
                                    @if($itemLoan->soldier_statement)
                                        <div class="col-md-4 mb-3">
                                            <strong>{{ __('Soldier Statement') }}:</strong><br>
                                            <a href="{{ route('soldier.statement', basename($itemLoan->soldier_statement)) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="bi bi-file-earmark-pdf"></i> {{ __('View Document') }}
                                            </a>
                                        </div>
                                    @endif
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
                                </div>
                            </div>
                        </div>

                        {{-- Check Approved Loans Section --}}
                        <div class="card mt-4">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0"><i class="bi bi-search"></i> {{ __('Check Approved Loans') }}</h6>
                            </div>
                            <div class="card-body">
                                @php
                                    // Auto filter approved loans by army_id and enlisted_no
                                    $approvedLoans = \App\Models\ApprovedLoan::where(function($query) use ($itemLoan) {
                                        $query->where('member_army_id', $itemLoan->army_id)
                                              ->orWhere('member_enlisted_no', $itemLoan->enlisted_no);
                                    })->orderBy('created_at', 'desc')->get();
                                @endphp

                                @if($approvedLoans->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Loan Method') }}</th>
                                                    <th>{{ __('Loan Type') }}</th>
                                                    <th>{{ __('Deduct Period') }}</th>
                                                    <th>{{ __('Total Amount') }}</th>
                                                    <th>{{ __('Monthly Amount') }}</th>
                                                    <th>{{ __('Deduction Status') }}</th>
                                                    <th>{{ __('Member Name') }}</th>
                                                    <th>{{ __('Enlisted No') }}</th>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <th>{{ __('Approved Date') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($approvedLoans as $approvedLoan)
                                                    @php
                                                        // Calculate deduction status
                                                        $deductions = $approvedLoan->deductions ?? [];
                                                        $totalMonths = $approvedLoan->deduct_time_period;
                                                        $paidMonths = is_array($deductions) ? count(array_filter($deductions, function($d) {
                                                            return isset($d['status']) && $d['status'] == 'paid';
                                                        })) : 0;
                                                        $deductionStatus = "$paidMonths/$totalMonths";
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-info">{{ $approvedLoan->loan_method }}</span>
                                                        </td>
                                                        <td>Rs. {{ number_format($approvedLoan->loan_type) }}</td>
                                                        <td><span class="badge bg-info">{{ $approvedLoan->deduct_time_period }} Months</span></td>
                                                        <td><strong class="text-success">Rs. {{ number_format($approvedLoan->total_amount) }}</strong></td>
                                                        <td>Rs. {{ number_format($approvedLoan->monthly_amount) }}</td>
                                                        <td>
                                                            @if($paidMonths === $totalMonths)
                                                                <span class="badge bg-success">{{ $deductionStatus }} Paid</span>
                                                            @elseif($paidMonths > 0)
                                                                <span class="badge bg-warning">{{ $deductionStatus }} Paying</span>
                                                            @else
                                                                <span class="badge bg-danger">{{ $deductionStatus }} Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $approvedLoan->member_name }}</td>
                                                        <td>{{ $approvedLoan->member_enlisted_no }}</td>
                                                        <td>{{ $approvedLoan->member_army_id }}</td>
                                                        <td>{{ $approvedLoan->created_at->format('Y-m-d') }}</td>
                                                    </tr>

                                                    {{-- Deductions Modal --}}
                                                    @if(is_array($deductions) && count($deductions) > 0)
                                                        <div class="modal fade" id="deductionsModal{{ $approvedLoan->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title">{{ __('Deductions Details') }} - {{ $approvedLoan->member_name }}</h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-6">
                                                                                <strong>{{ __('Loan Type') }}:</strong> Rs. {{ number_format($approvedLoan->loan_type) }}
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <strong>{{ __('Total Amount') }}:</strong> Rs. {{ number_format($approvedLoan->total_amount) }}
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <strong>{{ __('Monthly Amount') }}:</strong> Rs. {{ number_format($approvedLoan->monthly_amount) }}
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <strong>{{ __('Deduct Period') }}:</strong> {{ $approvedLoan->deduct_time_period }} Months
                                                                            </div>
                                                                        </div>
                                                                        <table class="table table-sm table-bordered">
                                                                            <thead class="table-light">
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>{{ __('Month') }}</th>
                                                                                    <th>{{ __('Amount') }}</th>
                                                                                    <th>{{ __('Date') }}</th>
                                                                                    <th>{{ __('Status') }}</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($deductions as $index => $deduction)
                                                                                    <tr>
                                                                                        <td>{{ $index + 1 }}</td>
                                                                                        <td>{{ $deduction['month'] ?? 'N/A' }}</td>
                                                                                        <td>Rs. {{ number_format($deduction['amount'] ?? 0) }}</td>
                                                                                        <td>{{ $deduction['date'] ?? 'N/A' }}</td>
                                                                                        <td>
                                                                                            @if(isset($deduction['status']))
                                                                                                <span class="badge {{ $deduction['status'] == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                                                                                    {{ ucfirst($deduction['status']) }}
                                                                                                </span>
                                                                                            @else
                                                                                                <span class="badge bg-secondary">N/A</span>
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-success">
                                        <i class="bi bi-check-circle"></i> {{ __('No approved loans found for this member. Member is eligible for new loan.') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('itemloans.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
                            
                            <div>
                                <a href="{{ route('itemloans.checkMembership', $itemLoan->id) }}" class="btn btn-info">
                                    <i class="bi bi-check-square"></i> {{ __('Check Membership') }}
                                </a>
                                @role('Shop Coord')
                                    <form action="{{ route('itemloans.shopCoordApprove', $itemLoan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i> {{ __('Final Approve') }}
                                        </button>
                                    </form>
                                @endrole
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
                        <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be rejected and sent to Staff Officer for review.') }}
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
