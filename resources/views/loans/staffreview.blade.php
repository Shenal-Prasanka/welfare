@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('Staff Officer Review') }} - {{ $loan->application_id }}</h5>
                            <span class="badge {{ $loan->status == 'pending' ? 'bg-warning' : ($loan->status == 'rejected' ? 'bg-danger' : 'bg-success') }}">
                                {{ strtoupper($loan->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        {{-- Loan Details Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">{{ __('Loan Details') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <strong>{{ __('Loan Method') }}:</strong><br>
                                        <span class="badge bg-info">Cash</span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>{{ __('Loan Type') }}:</strong><br>
                                        <span class="badge {{ $loan->loan_type == '100000' ? 'bg-info' : 'bg-primary' }}">
                                            Rs. {{ number_format($loan->loan_type) }}
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>{{ __('Deduct Time Period') }}:</strong><br>
                                        <span class="badge bg-success">
                                            {{ $loan->deduct_time_period }} Months
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>{{ __('Application Date') }}:</strong><br>
                                        {{ $loan->created_at->format('Y-m-d') }}
                                    </div>
                                </div>
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
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $loan->name }}
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
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $loan->guarantor1_name }}
                                    </div>
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
                                        <strong>{{ __('Name') }}:</strong><br>
                                        {{ $loan->guarantor2_name }}
                                    </div>
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

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> {{ __('Back to List') }}
                                </a>
                            </div>
                            <div>
                                @role('Staff Officer')
                                    @if($loan->status == 'rejected')
                                        <form action="{{ route('loans.reject', $loan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to store this rejected loan in the Rejected Loans table?');">
                                            @csrf
                                            <input type="hidden" name="rejection_reason" value="Rejected by Staff Officer">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-x-circle"></i> {{ __('Reject Application') }}
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
@endsection
