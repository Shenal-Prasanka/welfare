@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="m-0 font-weight-bold text-white">{{ __('Create Item Loan Application') }}</h5>
                        <a href="{{ route('itemloans.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('itemloans.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Member Details Section --}}
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">{{ __('Member Details') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Enlisted No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="enlisted_no" class="form-control @error('enlisted_no') is-invalid @enderror" value="{{ old('enlisted_no') }}" required>
                                            @error('enlisted_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Regiment No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="regiment_no" class="form-control @error('regiment_no') is-invalid @enderror" value="{{ old('regiment_no') }}" required>
                                            @error('regiment_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Rank') }} <span class="text-danger">*</span></label>
                                            <select name="rank" class="form-control @error('rank') is-invalid @enderror" required>
                                                <option value="">-- Select Rank --</option>
                                                @foreach($ranks as $rank)
                                                    <option value="{{ $rank->rank }}" {{ old('rank') == $rank->rank ? 'selected' : '' }}>
                                                        {{ $rank->rank }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('NIC') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="nic" class="form-control @error('nic') is-invalid @enderror" value="{{ old('nic') }}" required>
                                            @error('nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Army ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="army_id" class="form-control @error('army_id') is-invalid @enderror" value="{{ old('army_id') }}" required>
                                            @error('army_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Office Address') }} <span class="text-danger">*</span></label>
                                            <textarea name="office_address" class="form-control @error('office_address') is-invalid @enderror" rows="2" required>{{ old('office_address') }}</textarea>
                                            @error('office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Previous Unit') }}</label>
                                            <input type="text" name="previous_unit" class="form-control @error('previous_unit') is-invalid @enderror" value="{{ old('previous_unit') }}">
                                            @error('previous_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership') }} <span class="text-danger">*</span></label>
                                            <select name="welfare_membership" class="form-control @error('welfare_membership') is-invalid @enderror" required>
                                                <option value="">-- Select --</option>
                                                <option value="Yes" {{ old('welfare_membership') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('welfare_membership') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('welfare_membership')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership Date') }}</label>
                                            <input type="date" name="welfare_membership_date" class="form-control @error('welfare_membership_date') is-invalid @enderror" value="{{ old('welfare_membership_date') }}">
                                            @error('welfare_membership_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Bill No') }}</label>
                                            <input type="text" name="bill_no" class="form-control @error('bill_no') is-invalid @enderror" value="{{ old('bill_no') }}">
                                            @error('bill_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Bill Date') }}</label>
                                            <input type="date" name="bill_date" class="form-control @error('bill_date') is-invalid @enderror" value="{{ old('bill_date') }}">
                                            @error('bill_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Enlisted Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="enlisted_date" class="form-control @error('enlisted_date') is-invalid @enderror" value="{{ old('enlisted_date') }}" required>
                                            @error('enlisted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Retire Date') }}</label>
                                            <input type="date" name="retire_date" class="form-control @error('retire_date') is-invalid @enderror" value="{{ old('retire_date') }}">
                                            @error('retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Required Welfare Item Category') }}</label>
                                            <select name="required_welfare_item_category" class="form-control @error('required_welfare_item_category') is-invalid @enderror">
                                                <option value="">-- Select Category --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->category }}" {{ old('required_welfare_item_category') == $category->category ? 'selected' : '' }}>
                                                        {{ $category->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('required_welfare_item_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Welfare Shop Name') }}</label>
                                            <select name="welfare_id" class="form-control @error('welfare_id') is-invalid @enderror">
                                                <option value="">-- Select Welfare Shop --</option>
                                                @foreach($welfares as $welfare)
                                                    <option value="{{ $welfare->id }}" {{ old('welfare_id') == $welfare->id ? 'selected' : '' }}>
                                                        {{ $welfare->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('welfare_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Item Name') }}</label>
                                            <input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}">
                                            @error('item_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Item Type') }}</label>
                                            <input type="text" name="item_type" class="form-control @error('item_type') is-invalid @enderror" value="{{ old('item_type') }}">
                                            @error('item_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Model No') }}</label>
                                            <input type="text" name="model_no" class="form-control @error('model_no') is-invalid @enderror" value="{{ old('model_no') }}">
                                            @error('model_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Mobile No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}" required>
                                            @error('mobile_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Land No') }}</label>
                                            <input type="text" name="land_no" class="form-control @error('land_no') is-invalid @enderror" value="{{ old('land_no') }}">
                                            @error('land_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Are you currently paying installments for a loan?') }} <span class="text-danger">*</span></label>
                                            <select name="paying_installments" class="form-control @error('paying_installments') is-invalid @enderror" required>
                                                <option value="">-- Select --</option>
                                                <option value="Yes" {{ old('paying_installments') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('paying_installments') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('paying_installments')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Upload Soldier Statement') }} (PDF, JPG)</label>
                                            <input type="file" name="soldier_statement" class="form-control @error('soldier_statement') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                                            @error('soldier_statement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="consent_agreement" class="form-check-input @error('consent_agreement') is-invalid @enderror" id="consent_agreement" value="1" {{ old('consent_agreement') ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="consent_agreement">
                                                    {{ __('I hereby give my full consent to have the monthly installments deducted from my salary and to pay all outstanding amounts at once and recover them from my salary if I have to leave the service before the installments are paid. If there is any change in the inter-unit, I will inform the Directorate of Welfare. I hereby certify that you have received the goods/loans provided by this Directorate and have fully repaid the amount.') }} <span class="text-danger">*</span>
                                                </label>
                                                @error('consent_agreement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
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
                                            <label class="form-label">{{ __('Enlisted No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_enlisted_no" class="form-control @error('guarantor1_enlisted_no') is-invalid @enderror" value="{{ old('guarantor1_enlisted_no') }}" required>
                                            @error('guarantor1_enlisted_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Regiment No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_regiment_no" class="form-control @error('guarantor1_regiment_no') is-invalid @enderror" value="{{ old('guarantor1_regiment_no') }}" required>
                                            @error('guarantor1_regiment_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Rank') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor1_rank" class="form-control @error('guarantor1_rank') is-invalid @enderror" required>
                                                <option value="">-- Select Rank --</option>
                                                @foreach($ranks as $rank)
                                                    <option value="{{ $rank->rank }}" {{ old('guarantor1_rank') == $rank->rank ? 'selected' : '' }}>
                                                        {{ $rank->rank }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('guarantor1_rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_name" class="form-control @error('guarantor1_name') is-invalid @enderror" value="{{ old('guarantor1_name') }}" required>
                                            @error('guarantor1_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('NIC') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_nic" class="form-control @error('guarantor1_nic') is-invalid @enderror" value="{{ old('guarantor1_nic') }}" required>
                                            @error('guarantor1_nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Army ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor1_army_id" class="form-control @error('guarantor1_army_id') is-invalid @enderror" value="{{ old('guarantor1_army_id') }}" required>
                                            @error('guarantor1_army_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Office Address') }} <span class="text-danger">*</span></label>
                                            <textarea name="guarantor1_office_address" class="form-control @error('guarantor1_office_address') is-invalid @enderror" rows="2" required>{{ old('guarantor1_office_address') }}</textarea>
                                            @error('guarantor1_office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Previous Unit') }}</label>
                                            <input type="text" name="guarantor1_previous_unit" class="form-control @error('guarantor1_previous_unit') is-invalid @enderror" value="{{ old('guarantor1_previous_unit') }}">
                                            @error('guarantor1_previous_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor1_welfare_membership" class="form-control @error('guarantor1_welfare_membership') is-invalid @enderror" required>
                                                <option value="">-- Select --</option>
                                                <option value="Yes" {{ old('guarantor1_welfare_membership') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('guarantor1_welfare_membership') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('guarantor1_welfare_membership')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Enlisted Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="guarantor1_enlisted_date" class="form-control @error('guarantor1_enlisted_date') is-invalid @enderror" value="{{ old('guarantor1_enlisted_date') }}" required>
                                            @error('guarantor1_enlisted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Retire Date') }}</label>
                                            <input type="date" name="guarantor1_retire_date" class="form-control @error('guarantor1_retire_date') is-invalid @enderror" value="{{ old('guarantor1_retire_date') }}">
                                            @error('guarantor1_retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                            <label class="form-label">{{ __('Enlisted No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_enlisted_no" class="form-control @error('guarantor2_enlisted_no') is-invalid @enderror" value="{{ old('guarantor2_enlisted_no') }}" required>
                                            @error('guarantor2_enlisted_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Regiment No') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_regiment_no" class="form-control @error('guarantor2_regiment_no') is-invalid @enderror" value="{{ old('guarantor2_regiment_no') }}" required>
                                            @error('guarantor2_regiment_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Rank') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor2_rank" class="form-control @error('guarantor2_rank') is-invalid @enderror" required>
                                                <option value="">-- Select Rank --</option>
                                                @foreach($ranks as $rank)
                                                    <option value="{{ $rank->rank }}" {{ old('guarantor2_rank') == $rank->rank ? 'selected' : '' }}>
                                                        {{ $rank->rank }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('guarantor2_rank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_name" class="form-control @error('guarantor2_name') is-invalid @enderror" value="{{ old('guarantor2_name') }}" required>
                                            @error('guarantor2_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('NIC') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_nic" class="form-control @error('guarantor2_nic') is-invalid @enderror" value="{{ old('guarantor2_nic') }}" required>
                                            @error('guarantor2_nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Army ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="guarantor2_army_id" class="form-control @error('guarantor2_army_id') is-invalid @enderror" value="{{ old('guarantor2_army_id') }}" required>
                                            @error('guarantor2_army_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Office Address') }} <span class="text-danger">*</span></label>
                                            <textarea name="guarantor2_office_address" class="form-control @error('guarantor2_office_address') is-invalid @enderror" rows="2" required>{{ old('guarantor2_office_address') }}</textarea>
                                            @error('guarantor2_office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Previous Unit') }}</label>
                                            <input type="text" name="guarantor2_previous_unit" class="form-control @error('guarantor2_previous_unit') is-invalid @enderror" value="{{ old('guarantor2_previous_unit') }}">
                                            @error('guarantor2_previous_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Welfare Membership') }} <span class="text-danger">*</span></label>
                                            <select name="guarantor2_welfare_membership" class="form-control @error('guarantor2_welfare_membership') is-invalid @enderror" required>
                                                <option value="">-- Select --</option>
                                                <option value="Yes" {{ old('guarantor2_welfare_membership') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('guarantor2_welfare_membership') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('guarantor2_welfare_membership')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Enlisted Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="guarantor2_enlisted_date" class="form-control @error('guarantor2_enlisted_date') is-invalid @enderror" value="{{ old('guarantor2_enlisted_date') }}" required>
                                            @error('guarantor2_enlisted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">{{ __('Retire Date') }}</label>
                                            <input type="date" name="guarantor2_retire_date" class="form-control @error('guarantor2_retire_date') is-invalid @enderror" value="{{ old('guarantor2_retire_date') }}">
                                            @error('guarantor2_retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('itemloans.index') }}" class="btn btn-secondary me-2">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-success">{{ __('Submit Application') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
