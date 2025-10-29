<!-- Supply Modal -->
<div class="modal fade" id="ModalSupplyCreate" tabindex="-1" role="dialog" aria-labelledby="ModalSupplyTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="m-0 font-weight-bold">{{ __('Add New Supply') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('supplys.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- Supplier Field -->
                    <div class="col-md-12">
                        <label for="supply">{{ __('Supplier') }}</label>
                        <input 
                            type="text" 
                            name="supply" 
                            id="supply" 
                            class="form-control @error('supply') is-invalid @enderror" 
                            value="{{ old('supply') }}"
                            placeholder="{{ __('Enter Supplier Name') }}"
                        >
                        @error('supply')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Active Field -->
                    <div class="col-md-12 mt-3">
                        <label for="active" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Deactive') }}</option>
                        </select>
                        @error('active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="col-md-12 mt-3">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="form-control @error('description') is-invalid @enderror" 
                            rows="3" 
                            placeholder="{{ __('Add Your Description') }}"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('Add Supply') }}</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Back') }}</button>
            </div>
                </form>
        </div>
    </div>
</div>

<!-- Auto Open Supply Modal if Errors Exist -->
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('ModalSupplyCreate'));
            modal.show();
        });
    </script>
@endif
