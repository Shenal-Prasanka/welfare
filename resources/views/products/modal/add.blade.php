<!-- Product Create Modal -->
<div class="modal fade" id="ModalProductCreate" tabindex="-1" aria-labelledby="ModalProductTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="ModalProductTitle">{{ __('Add New Product') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('products.store') }}" novalidate>
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="product" class="form-label">{{ __('Product') }}</label>
                        <input type="text" name="product" id="product"
                               class="form-control @error('product') is-invalid @enderror"
                               value="{{ old('product') }}" placeholder="{{ __('Enter Product Name') }}">
                        @error('product')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">{{ __('Category') }}</label>
                        <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">{{ __('Select Category...') }}</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="active" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="active"
                                class="form-select @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Deactive') }}</option>
                        </select>
                        @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Normal Price -->
                    <div class="mb-3">
                        <label for="normal_price" class="form-label">{{ __('Normal Price') }}</label>
                        <input type="number" step="0.01" name="normal_price" id="normal_price"
                               class="form-control @error('normal_price') is-invalid @enderror"
                               value="{{ old('normal_price') }}"placeholder="{{ __('10000') }}">
                        @error('normal_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- VAT -->
                    <div class="mb-3">
                        <label for="vat" class="form-label">{{ __('VAT (%)') }}</label>
                        <input type="number" step="0.01" name="vat" id="vat"
                               class="form-control @error('vat') is-invalid @enderror"
                               value="{{ old('vat') }}" placeholder="{{ __('5') }}">
                        @error('vat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tax -->
                    <div class="mb-3">
                        <label for="tax" class="form-label">{{ __('Tax (%)') }}</label>
                        <input type="number" step="0.01" name="tax" id="tax"
                               class="form-control @error('tax') is-invalid @enderror"
                               value="{{ old('tax') }}"placeholder="{{ __('5') }}">
                        @error('tax')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Product') }}</button>
                        <button type="button" class="btn btn-secondary" data--dismiss="modal">{{ __('Back') }}</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- Auto Open Product Modal if Validation Errors Exist -->
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var productModal = new bootstrap.Modal(document.getElementById('ModalProductCreate'));
            productModal.show();
        });
    </script>
@endif
