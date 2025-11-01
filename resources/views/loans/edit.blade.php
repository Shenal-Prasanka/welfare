@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="m-0 font-weight-bold text-white">{{ __('Edit Loan Application') }}</h5>
                    </div>
                    <div class="card-body">
                        @if($loan->status == 'rejected' && $loan->rejection_reason)
                            <div class="alert alert-warning mb-4">
                                <h6><i class="bi bi-exclamation-triangle"></i> {{ __('Rejection Reason') }}:</h6>
                                <p class="mb-0">{{ $loan->rejection_reason }}</p>
                                <small class="text-muted">{{ __('Rejected by') }}: {{ $loan->rejecter ? $loan->rejecter->name : 'N/A' }} {{ __('on') }} {{ $loan->rejected_at ? $loan->rejected_at->format('Y-m-d H:i') : '' }}</small>
                            </div>
                        @endif

                        <form action="{{ route('loans.update', $loan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Member Details Section --}}
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">{{ __('Member Details') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Loan Type') }} <span class="text-danger">*</span></label>
                                            <select name="loan_type" class="form-select @error('loan_type') is-invalid @enderror" required>
                                                <option value="">{{ __('Select Loan Type') }}</option>
                                                <option value="100000" {{ old('loan_type', $loan->loan_type) == '100000' ? 'selected' : '' }}>Rs. 100,000</option>
                                                <option value="300000" {{ old('loan_type', $loan->loan_type) == '300000' ? 'selected' : '' }}>Rs. 300,000</option>
                                            </select>
                                            @error('loan_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Enlisted No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="enlisted_no" class="form-control @error('enlisted_no') is-invalid @enderror" value="{{ old('enlisted_no', $loan->enlisted_no) }}" required>
                                            @error('enlisted_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Regiment No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="regiment_no" class="form-control @error('regiment_no') is-invalid @enderror" value="{{ old('regiment_no', $loan->regiment_no) }}" required>
                                            @error('regiment_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Rank') }} <span class="text-danger">*</span></label>
                                            <select name="rank" class="form-select @error('rank') is-invalid @enderror" required>
                                                <option value="">{{ __('Select Rank') }} ({{ $ranks->count() }} available)</option>
                                                @foreach($ranks as $rankItem)
                                                    <option value="{{ $rankItem->rank }}" {{ old('rank', $loan->rank) == $rankItem->rank ? 'selected' : '' }}>{{ $rankItem->rank }}</option>
                                                @endforeach
                                            </select>
                                            @error('rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $loan->name) }}" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('NIC') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="nic" class="form-control @error('nic') is-invalid @enderror" value="{{ old('nic', $loan->nic) }}" required>
                                            @error('nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Army ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="army_id" class="form-control @error('army_id') is-invalid @enderror" value="{{ old('army_id', $loan->army_id) }}" required>
                                            @error('army_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Office Address') }} <span class="text-danger">*</span></label>
                                            <textarea name="office_address" class="form-control @error('office_address') is-invalid @enderror" rows="2" required>{{ old('office_address', $loan->office_address) }}</textarea>
                                            @error('office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Previous Unit') }}</label>
                                            <select name="previous_unit" class="form-select @error('previous_unit') is-invalid @enderror">
                                                <option value="">{{ __('Select Unit') }} ({{ $units->count() }} available)</option>
                                                @foreach($units as $unitItem)
                                                    <option value="{{ $unitItem->unit }}" {{ old('previous_unit', $loan->previous_unit) == $unitItem->unit ? 'selected' : '' }}>{{ $unitItem->unit }}</option>
                                                @endforeach
                                            </select>
                                            @error('previous_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership') }} <span class="text-danger">*</span></label>
                                            <select name="welfare_membership" class="form-select @error('welfare_membership') is-invalid @enderror" required>
                                                <option value="">{{ __('Select') }}</option>
                                                <option value="Yes" {{ old('welfare_membership', $loan->welfare_membership) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('welfare_membership', $loan->welfare_membership) == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('welfare_membership')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership Date') }}</label>
                                            <input type="date" name="welfare_membership_date" class="form-control @error('welfare_membership_date') is-invalid @enderror" value="{{ old('welfare_membership_date', $loan->welfare_membership_date ? $loan->welfare_membership_date->format('Y-m-d') : '') }}">
                                            @error('welfare_membership_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Bill No') }}</label>
                                            <input type="text" name="bill_no" class="form-control @error('bill_no') is-invalid @enderror" value="{{ old('bill_no', $loan->bill_no) }}">
                                            @error('bill_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Bill Date') }}</label>
                                            <input type="date" name="bill_date" class="form-control @error('bill_date') is-invalid @enderror" value="{{ old('bill_date', $loan->bill_date ? $loan->bill_date->format('Y-m-d') : '') }}">
                                            @error('bill_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Enlisted Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="enlisted_date" class="form-control @error('enlisted_date') is-invalid @enderror" value="{{ old('enlisted_date', $loan->enlisted_date->format('Y-m-d')) }}" required>
                                            @error('enlisted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Retire Date') }}</label>
                                            <input type="date" name="retire_date" class="form-control @error('retire_date') is-invalid @enderror" value="{{ old('retire_date', $loan->retire_date ? $loan->retire_date->format('Y-m-d') : '') }}">
                                            @error('retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Paying Installments') }} <span class="text-danger">*</span></label>
                                            <select name="paying_installments" class="form-select @error('paying_installments') is-invalid @enderror" required>
                                                <option value="">{{ __('Select') }}</option>
                                                <option value="Yes" {{ old('paying_installments', $loan->paying_installments) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('paying_installments', $loan->paying_installments) == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('paying_installments')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Bank Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name', $loan->bank_name) }}" required>
                                            @error('bank_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="branch" class="form-control @error('branch') is-invalid @enderror" value="{{ old('branch', $loan->branch) }}" required>
                                            @error('branch')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Account No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="account_no" class="form-control @error('account_no') is-invalid @enderror" value="{{ old('account_no', $loan->account_no) }}" required>
                                            @error('account_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Mobile No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no', $loan->mobile_no) }}" required>
                                            @error('mobile_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Land No') }}</label>
                                            <input type="text" name="land_no" class="form-control @error('land_no') is-invalid @enderror" value="{{ old('land_no', $loan->land_no) }}">
                                            @error('land_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Upload Soldier Statement') }} (PDF, JPG)</label>
                                            @if($loan->soldier_statement)
                                                <div class="mb-2">
                                                    <small class="text-muted">{{ __('Current file') }}: <a href="{{ route('loan.statement', basename($loan->soldier_statement)) }}" target="_blank">{{ __('View Document') }}</a></small>
                                                </div>
                                            @endif
                                            <input type="file" name="soldier_statement" class="form-control @error('soldier_statement') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                                            <small class="text-muted">{{ __('Leave empty to keep current file') }}</small>
                                            @error('soldier_statement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="consent_agreement" class="form-check-input @error('consent_agreement') is-invalid @enderror" id="consent_agreement" value="1" {{ old('consent_agreement', $loan->consent_agreement) ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="consent_agreement">
                                                    {{ __('I hereby give my full consent to have the monthly installments deducted from my salary and to pay all outstanding amounts at once and recover them from my salary if I have to leave the service before the installments are paid.') }}
                                                </label>
                                                @error('consent_agreement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
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
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Enlisted No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_enlisted_no" class="form-control @error('guarantor1_enlisted_no') is-invalid @enderror" value="{{ old('guarantor1_enlisted_no', $loan->guarantor1_enlisted_no) }}" required>
                                            @error('guarantor1_enlisted_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Regiment No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_regiment_no" class="form-control @error('guarantor1_regiment_no') is-invalid @enderror" value="{{ old('guarantor1_regiment_no', $loan->guarantor1_regiment_no) }}" required>
                                            @error('guarantor1_regiment_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Rank') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor1_rank" class="form-select @error('guarantor1_rank') is-invalid @enderror" required>
                                                <option value="">{{ __('Select Rank') }}</option>
                                                @foreach($ranks as $rankItem)
                                                    <option value="{{ $rankItem->rank }}" {{ old('guarantor1_rank', $loan->guarantor1_rank) == $rankItem->rank ? 'selected' : '' }}>{{ $rankItem->rank }}</option>
                                                @endforeach
                                            </select>
                                            @error('guarantor1_rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_name" class="form-control @error('guarantor1_name') is-invalid @enderror" value="{{ old('guarantor1_name', $loan->guarantor1_name) }}" required>
                                            @error('guarantor1_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('NIC') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_nic" class="form-control @error('guarantor1_nic') is-invalid @enderror" value="{{ old('guarantor1_nic', $loan->guarantor1_nic) }}" required>
                                            @error('guarantor1_nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Army ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_army_id" class="form-control @error('guarantor1_army_id') is-invalid @enderror" value="{{ old('guarantor1_army_id', $loan->guarantor1_army_id) }}" required>
                                            @error('guarantor1_army_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Office Address') }} <span class="text-danger">*</span></label>
                                            <textarea name="guarantor1_office_address" class="form-control @error('guarantor1_office_address') is-invalid @enderror" rows="2" required>{{ old('guarantor1_office_address', $loan->guarantor1_office_address) }}</textarea>
                                            @error('guarantor1_office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Previous Unit') }}</label>
                                            <select name="guarantor1_previous_unit" class="form-select @error('guarantor1_previous_unit') is-invalid @enderror">
                                                <option value="">{{ __('Select Unit') }}</option>
                                                @foreach($units as $unitItem)
                                                    <option value="{{ $unitItem->unit }}" {{ old('guarantor1_previous_unit', $loan->guarantor1_previous_unit) == $unitItem->unit ? 'selected' : '' }}>{{ $unitItem->unit }}</option>
                                                @endforeach
                                            </select>
                                            @error('guarantor1_previous_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor1_welfare_membership" class="form-select @error('guarantor1_welfare_membership') is-invalid @enderror" required>
                                                <option value="">{{ __('Select') }}</option>
                                                <option value="Yes" {{ old('guarantor1_welfare_membership', $loan->guarantor1_welfare_membership) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('guarantor1_welfare_membership', $loan->guarantor1_welfare_membership) == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('guarantor1_welfare_membership')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Enlisted Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="guarantor1_enlisted_date" class="form-control @error('guarantor1_enlisted_date') is-invalid @enderror" value="{{ old('guarantor1_enlisted_date', $loan->guarantor1_enlisted_date->format('Y-m-d')) }}" required>
                                            @error('guarantor1_enlisted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Retire Date') }}</label>
                                            <input type="date" name="guarantor1_retire_date" class="form-control @error('guarantor1_retire_date') is-invalid @enderror" value="{{ old('guarantor1_retire_date', $loan->guarantor1_retire_date ? $loan->guarantor1_retire_date->format('Y-m-d') : '') }}">
                                            @error('guarantor1_retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Enlisted No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_enlisted_no" class="form-control @error('guarantor2_enlisted_no') is-invalid @enderror" value="{{ old('guarantor2_enlisted_no', $loan->guarantor2_enlisted_no) }}" required>
                                            @error('guarantor2_enlisted_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Regiment No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_regiment_no" class="form-control @error('guarantor2_regiment_no') is-invalid @enderror" value="{{ old('guarantor2_regiment_no', $loan->guarantor2_regiment_no) }}" required>
                                            @error('guarantor2_regiment_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Rank') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor2_rank" class="form-select @error('guarantor2_rank') is-invalid @enderror" required>
                                                <option value="">{{ __('Select Rank') }}</option>
                                                @foreach($ranks as $rankItem)
                                                    <option value="{{ $rankItem->rank }}" {{ old('guarantor2_rank', $loan->guarantor2_rank) == $rankItem->rank ? 'selected' : '' }}>{{ $rankItem->rank }}</option>
                                                @endforeach
                                            </select>
                                            @error('guarantor2_rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_name" class="form-control @error('guarantor2_name') is-invalid @enderror" value="{{ old('guarantor2_name', $loan->guarantor2_name) }}" required>
                                            @error('guarantor2_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('NIC') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_nic" class="form-control @error('guarantor2_nic') is-invalid @enderror" value="{{ old('guarantor2_nic', $loan->guarantor2_nic) }}" required>
                                            @error('guarantor2_nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Army ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_army_id" class="form-control @error('guarantor2_army_id') is-invalid @enderror" value="{{ old('guarantor2_army_id', $loan->guarantor2_army_id) }}" required>
                                            @error('guarantor2_army_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Office Address') }} <span class="text-danger">*</span></label>
                                            <textarea name="guarantor2_office_address" class="form-control @error('guarantor2_office_address') is-invalid @enderror" rows="2" required>{{ old('guarantor2_office_address', $loan->guarantor2_office_address) }}</textarea>
                                            @error('guarantor2_office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Previous Unit') }}</label>
                                            <select name="guarantor2_previous_unit" class="form-select @error('guarantor2_previous_unit') is-invalid @enderror">
                                                <option value="">{{ __('Select Unit') }}</option>
                                                @foreach($units as $unitItem)
                                                    <option value="{{ $unitItem->unit }}" {{ old('guarantor2_previous_unit', $loan->guarantor2_previous_unit) == $unitItem->unit ? 'selected' : '' }}>{{ $unitItem->unit }}</option>
                                                @endforeach
                                            </select>
                                            @error('guarantor2_previous_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor2_welfare_membership" class="form-select @error('guarantor2_welfare_membership') is-invalid @enderror" required>
                                                <option value="">{{ __('Select') }}</option>
                                                <option value="Yes" {{ old('guarantor2_welfare_membership', $loan->guarantor2_welfare_membership) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('guarantor2_welfare_membership', $loan->guarantor2_welfare_membership) == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('guarantor2_welfare_membership')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Enlisted Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="guarantor2_enlisted_date" class="form-control @error('guarantor2_enlisted_date') is-invalid @enderror" value="{{ old('guarantor2_enlisted_date', $loan->guarantor2_enlisted_date->format('Y-m-d')) }}" required>
                                            @error('guarantor2_enlisted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Retire Date') }}</label>
                                            <input type="date" name="guarantor2_retire_date" class="form-control @error('guarantor2_retire_date') is-invalid @enderror" value="{{ old('guarantor2_retire_date', $loan->guarantor2_retire_date ? $loan->guarantor2_retire_date->format('Y-m-d') : '') }}">
                                            @error('guarantor2_retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('loans.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-success">{{ __('Update & Resubmit Application') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
