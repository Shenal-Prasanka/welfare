@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="m-0 font-weight-bold">{{ __('Check Membership') }} - {{ $itemLoan->application_id }}</h5>
                                <small>{{ __('Status') }}: 
                                    @if($itemLoan->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif($itemLoan->status == 'approved')
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                    @else
                                        <span class="badge bg-info">{{ __('OC Approved') }}</span>
                                    @endif
                                </small>
                            </div>
                            <a href="{{ route('itemloans.checkLoan', $itemLoan->id) }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-left"></i> {{ __('Back to Check Loan') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Member Column --}}
                            <div class="col-md-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0"><i class="bi bi-person-fill"></i> {{ __('Member') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="50%">{{ __('Enlisted No') }}</th>
                                                    <td><strong>{{ $itemLoan->enlisted_no }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Enlisted Date') }}</th>
                                                    <td>{{ $itemLoan->enlisted_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <td>{{ $itemLoan->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Regiment No') }}</th>
                                                    <td>{{ $itemLoan->regiment_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <td>{{ $itemLoan->army_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Previous Unit') }}</th>
                                                    <td>{{ $itemLoan->previous_unit ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $itemLoan->welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $itemLoan->welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership Date') }}</th>
                                                    <td>{{ $itemLoan->welfare_membership_date ? $itemLoan->welfare_membership_date->format('Y-m-d') : 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Guarantor 1 Column --}}
                            <div class="col-md-4">
                                <div class="card h-100 border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0"><i class="bi bi-person-check-fill"></i> {{ __('Guarantor 1') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="50%">{{ __('Enlisted No') }}</th>
                                                    <td><strong>{{ $itemLoan->guarantor1_enlisted_no }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Enlisted Date') }}</th>
                                                    <td>{{ $itemLoan->guarantor1_enlisted_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <td>{{ $itemLoan->guarantor1_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Regiment No') }}</th>
                                                    <td>{{ $itemLoan->guarantor1_regiment_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <td>{{ $itemLoan->guarantor1_army_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Previous Unit') }}</th>
                                                    <td>{{ $itemLoan->guarantor1_previous_unit ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $itemLoan->guarantor1_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $itemLoan->guarantor1_welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership Date') }}</th>
                                                    <td>N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Guarantor 2 Column --}}
                            <div class="col-md-4">
                                <div class="card h-100 border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0"><i class="bi bi-person-check-fill"></i> {{ __('Guarantor 2') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="50%">{{ __('Enlisted No') }}</th>
                                                    <td><strong>{{ $itemLoan->guarantor2_enlisted_no }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Enlisted Date') }}</th>
                                                    <td>{{ $itemLoan->guarantor2_enlisted_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <td>{{ $itemLoan->guarantor2_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Regiment No') }}</th>
                                                    <td>{{ $itemLoan->guarantor2_regiment_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <td>{{ $itemLoan->guarantor2_army_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Previous Unit') }}</th>
                                                    <td>{{ $itemLoan->guarantor2_previous_unit ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $itemLoan->guarantor2_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $itemLoan->guarantor2_welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership Date') }}</th>
                                                    <td>N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Membership Details Section --}}
                        <div class="card mt-4">
                            <div class="card-header bg-info text-dark">
                                <h6 class="mb-0"><i class="bi bi-card-checklist"></i> {{ __('Membership Verification') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- Member Membership --}}
                                    <div class="col-md-4">
                                        <h6 class="text-primary"><strong>{{ __('Member') }}</strong></h6>
                                        @if($memberMembership)
                                            <div class="alert alert-success">
                                                <strong><i class="bi bi-check-circle"></i> {{ __('Active Membership') }}</strong>
                                                <hr>
                                                <p class="mb-1"><strong>{{ __('Name') }}:</strong> {{ $memberMembership->name }}</p>
                                                <p class="mb-1"><strong>{{ __('Membership Date') }}:</strong> {{ $memberMembership->membership_date ? $memberMembership->membership_date->format('Y-m-d') : 'N/A' }}</p>
                                                <p class="mb-1"><strong>{{ __('Army ID') }}:</strong> {{ $memberMembership->army_id }}</p>
                                                <p class="mb-1"><strong>{{ __('Regiment No') }}:</strong> {{ $memberMembership->regiment_no }}</p>
                                                <p class="mb-1"><strong>{{ __('NIC') }}:</strong> {{ $memberMembership->nic }}</p>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                <i class="bi bi-x-circle"></i> {{ __('No Membership Found') }}
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Guarantor 1 Membership --}}
                                    <div class="col-md-4">
                                        <h6 class="text-info"><strong>{{ __('Guarantor 1') }}</strong></h6>
                                        @if($guarantor1Membership)
                                            <div class="alert alert-success">
                                                <strong><i class="bi bi-check-circle"></i> {{ __('Active Membership') }}</strong>
                                                <hr>
                                                <p class="mb-1"><strong>{{ __('Name') }}:</strong> {{ $guarantor1Membership->name }}</p>
                                                <p class="mb-1"><strong>{{ __('Membership Date') }}:</strong> {{ $guarantor1Membership->membership_date ? $guarantor1Membership->membership_date->format('Y-m-d') : 'N/A' }}</p>
                                                <p class="mb-1"><strong>{{ __('Army ID') }}:</strong> {{ $guarantor1Membership->army_id }}</p>
                                                <p class="mb-1"><strong>{{ __('Regiment No') }}:</strong> {{ $guarantor1Membership->regiment_no }}</p>
                                                <p class="mb-1"><strong>{{ __('NIC') }}:</strong> {{ $guarantor1Membership->nic }}</p>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                <i class="bi bi-x-circle"></i> {{ __('No Membership Found') }}
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Guarantor 2 Membership --}}
                                    <div class="col-md-4">
                                        <h6 class="text-secondary"><strong>{{ __('Guarantor 2') }}</strong></h6>
                                        @if($guarantor2Membership)
                                            <div class="alert alert-success">
                                                <strong><i class="bi bi-check-circle"></i> {{ __('Active Membership') }}</strong>
                                                <hr>
                                                <p class="mb-1"><strong>{{ __('Name') }}:</strong> {{ $guarantor2Membership->name }}</p>
                                                <p class="mb-1"><strong>{{ __('Membership Date') }}:</strong> {{ $guarantor2Membership->membership_date ? $guarantor2Membership->membership_date->format('Y-m-d') : 'N/A' }}</p>
                                                <p class="mb-1"><strong>{{ __('Army ID') }}:</strong> {{ $guarantor2Membership->army_id }}</p>
                                                <p class="mb-1"><strong>{{ __('Regiment No') }}:</strong> {{ $guarantor2Membership->regiment_no }}</p>
                                                <p class="mb-1"><strong>{{ __('NIC') }}:</strong> {{ $guarantor2Membership->nic }}</p>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                <i class="bi bi-x-circle"></i> {{ __('No Membership Found') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('itemloans.checkLoan', $itemLoan->id) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> {{ __('Back to Check Loan') }}
                                </a>
                            </div>
                            <div>
                                @php
                                    $allVerified = $memberMembership && $memberMembership->active 
                                                && $guarantor1Membership && $guarantor1Membership->active 
                                                && $guarantor2Membership && $guarantor2Membership->active;
                                @endphp
                                
                                <form action="{{ route('itemloans.shopCoordApprove', $itemLoan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i> {{ __('Approve') }}
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

{{-- Shop Coord Reject Modal --}}
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
                        <label for="rejection_reason" class="form-label">{{ __('Rejection Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4" required placeholder="{{ __('Please provide a detailed reason for rejection...') }}"></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> {{ __('This application will be rejected and sent to Staff Officer for review.') }}
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
