<!-- Modal -->
<div class="modal fade" id="unitmodalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="m-0 font-weight-bold">{{ __('Add New Unit') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('units.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- Unit Field -->
                    <div class="col-md-12">
                        <label for="unit">{{ __('Unit') }}</label>
                        <input type="text" name="unit" id="unit"
                            class="form-control  @error('unit') is-invalid @enderror"
                            placeholder="{{ __('Enter Unit Name') }}" value="{{ old('unit') }}">
                        @error('unit')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- regement Field -->
                    <div class="col-md-12  mt-3">
                        <label for="regement_id">{{ __('Regement') }}</label>
                        <select name="regement_id" id="regement_id"
                            class="form-select @error('regement_id') is-invalid @enderror">
                            <option value="">{{ __('Select Regement....') }}</option>
                            @foreach ($regements as $regement)
                                <option value="{{ $regement->id }}"
                                    {{ old('regement_id') == $regement->id ? 'selected' : '' }}>
                                    {{ $regement->regement }}
                                </option>
                            @endforeach
                        </select>
                        @error('regement_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Active Field -->
                    <div class="col-md-12  mt-3">
                        <label for="active" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                            <option disabled {{ old('active') === null ? 'selected' : '' }}>
                                {{ __('Select status...') }}</option>
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Active') }}
                            </option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Deactive') }}
                            </option>
                        </select>
                        @error('active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Unit') }}</button>
                        <button type="button" class="btn btn-warning"
                            data-dismiss="modal">{{ __('Back') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Auto Open Modal if Errors Exist -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('unitmodalCreate'));
                modal.show();
            });
        </script>
    @endif
