<!-- Modal -->
<div class="modal fade" id="categoryModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="m-0 font-weight-bold">{{ __('Add New Category') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('categorys.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- category Field -->
                    <div class="col-md-12">
                        <label for="category">{{ __('Category') }}</label>
                        <input type="text" name="category" id="category"
                            class="form-control @error('category') is-invalid @enderror"
                            placeholder="{{ __('Enter Category') }}">
                        @error('category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Active Field -->
                    <div class="col-md-12 mt-3">
                        <label for="active" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                            <option disabled {{ old('active') === null ? 'selected' : '' }}>{{ __('Choose Status...') }}
                            </option>
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Active') }}
                            </option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Deactive') }}
                            </option>
                        </select>
                        @error('active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                        @enderror
                    </div>
                    <!-- Description Field -->
                    <div class="col-md-12 mt-3">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                            rows="3" placeholder="Add your Description"></textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Category') }}</button>
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
                const modal = new bootstrap.Modal(document.getElementById('categoryModalCreate'));
                modal.show();
            });
        </script>
    @endif
