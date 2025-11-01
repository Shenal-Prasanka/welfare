@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="m-0 font-weight-bold">{{ __('Check Loan Eligibility') }} - {{ $loan->application_id }}</h5>
                                <small>{{ __('Status') }}: 
                                    @if($loan->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif($loan->status == 'approved')
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @endif
                                </small>
                            </div>
                            <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-left"></i> {{ __('Back to Application') }}
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
                                                    <th>{{ __('Welfare Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $loan->welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $loan->welfare_membership }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Welfare Membership Date') }}</th>
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
                                    <div class="card-header bg-info text-white">
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
                                                    <th>{{ __('Welfare Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $loan->guarantor1_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $loan->guarantor1_welfare_membership }}
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
                                                    <th>{{ __('Welfare Membership') }}</th>
                                                    <td>
                                                        <span class="badge {{ $loan->guarantor2_welfare_membership == 'Yes' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $loan->guarantor2_welfare_membership }}
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

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <button type="button" class="btn btn-info">
                                    <i class="bi bi-person-check"></i> {{ __('Check Membership') }}
                                </button>
                            </div>
                            
                            <div>
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
