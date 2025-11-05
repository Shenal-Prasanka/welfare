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
                                <h5 class="m-0 font-weight-bold">{{ __('Check Membership') }} - {{ $loan->application_id }}</h5>
                                <small>{{ __('Status') }}: 
                                    @if($loan->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif($loan->status == 'approved')
                                        <span class="badge bg-light text-dark">{{ __('Approved') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @endif
                                </small>
                            </div>
                            <a href="{{ route('loans.check', $loan->id) }}" class="btn btn-sm btn-light">
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
                                                    <td><strong>{{ $loan->enlisted_no }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Enlisted Date') }}</th>
                                                    <td>{{ $loan->enlisted_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <td>{{ $loan->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Regiment No') }}</th>
                                                    <td>{{ $loan->regiment_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <td>{{ $loan->army_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Previous Unit') }}</th>
                                                    <td>{{ $loan->previous_unit ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $loan->welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $loan->welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Membership Date') }}</th>
                                                    <td>{{ $loan->welfare_membership_date ? $loan->welfare_membership_date->format('Y-m-d') : 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Guarantor 1 Column --}}
                            <div class="col-md-4">
                                <div class="card h-100 border-info">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0"><i class="bi bi-person-check-fill"></i> {{ __('Guarantor 1') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="50%">{{ __('Enlisted No') }}</th>
                                                    <td><strong>{{ $loan->guarantor1_enlisted_no }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Enlisted Date') }}</th>
                                                    <td>{{ $loan->guarantor1_enlisted_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <td>{{ $loan->guarantor1_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Regiment No') }}</th>
                                                    <td>{{ $loan->guarantor1_regiment_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <td>{{ $loan->guarantor1_army_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Previous Unit') }}</th>
                                                    <td>{{ $loan->guarantor1_previous_unit ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $loan->guarantor1_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $loan->guarantor1_welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Membership Date') }}</th>
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
                                                    <td><strong>{{ $loan->guarantor2_enlisted_no }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Enlisted Date') }}</th>
                                                    <td>{{ $loan->guarantor2_enlisted_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <td>{{ $loan->guarantor2_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Regiment No') }}</th>
                                                    <td>{{ $loan->guarantor2_regiment_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Army ID') }}</th>
                                                    <td>{{ $loan->guarantor2_army_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Previous Unit') }}</th>
                                                    <td>{{ $loan->guarantor2_previous_unit ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $loan->guarantor2_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $loan->guarantor2_welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Membership Date') }}</th>
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
                                <h6 class="mb-0"><i class="bi bi-card-checklist"></i> {{ __('Membership Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- Member Membership --}}
                                    <div class="col-md-4">
                                        <h6 class="text-primary"><strong>{{ __('Member') }}</strong></h6>
                                        @php
                                            $memberMembership = \App\Models\Membership::where('army_id', $loan->army_id)->first();
                                        @endphp
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
                                        @php
                                            $guarantor1Membership = \App\Models\Membership::where('army_id', $loan->guarantor1_army_id)->first();
                                        @endphp
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
                                        @php
                                            $guarantor2Membership = \App\Models\Membership::where('army_id', $loan->guarantor2_army_id)->first();
                                        @endphp
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
                        <div class="mt-4">
                            @role('Loan OC')
                                @if($loan->status == 'pending')
                                    <form action="{{ route('loans.approve', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success me-2">
                                            <i class="bi bi-check-circle"></i> {{ __('Approve') }}
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                        <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                    </button>
                                @endif
                            @endrole
                            @role('Staff Officer')
                                @if($loan->status == 'pending')
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
