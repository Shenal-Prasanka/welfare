@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark text-dark">
                        <h3 class="m-0 font-weight-bold">{{ __('Edit Loan Interest') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('loaninterests.update', $loaninterest->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="months" class="form-label">{{ __('Months') }} <span class="text-danger">*</span></label>
                                        <select class="form-control @error('months') is-invalid @enderror" id="months" name="months" required>
                                            <option value="">{{ __('Select Months') }}</option>
                                            <option value="4" {{ old('months', $loaninterest->months) == '4' ? 'selected' : '' }}>4 Months</option>
                                            <option value="8" {{ old('months', $loaninterest->months) == '8' ? 'selected' : '' }}>8 Months</option>
                                            <option value="12" {{ old('months', $loaninterest->months) == '12' ? 'selected' : '' }}>12 Months</option>
                                            <option value="24" {{ old('months', $loaninterest->months) == '24' ? 'selected' : '' }}>24 Months</option>
                                            <option value="36" {{ old('months', $loaninterest->months) == '36' ? 'selected' : '' }}>36 Months</option>
                                        </select>
                                        @error('months')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="interest" class="form-label">{{ __('Interest (%)') }} <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control @error('interest') is-invalid @enderror" 
                                               id="interest" name="interest" value="{{ old('interest', $loaninterest->interest) }}" 
                                               placeholder="e.g., 5.8" required>
                                        @error('interest')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> {{ __('Update') }}
                                </button>
                                <a href="{{ route('loaninterests.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
