<!-- Item Create Modal -->
<div class="modal fade" id="ModalItemCreate" tabindex="-1" aria-labelledby="ModalItemTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="ModalItemTitle">{{ __('Add New Item') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Product -->
                    <div class="mb-3">
                        <label for="product_id" class="form-label">{{ __('Product') }}</label>
                        <select name="product_id" id="product_id"
                                class="form-select @error('product_id') is-invalid @enderror">
                            <option value="">{{ __('Select Product...') }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->product }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Welfare -->
                    <div class="mb-3">
                        <label for="welfare_id" class="form-label">{{ __('Welfare') }}</label>
                        <select name="welfare_id" id="welfare_id"
                                class="form-select @error('welfare_id') is-invalid @enderror">
                            <option value="">{{ __('Select Welfare...') }}</option>
                            @foreach ($welfares as $welfare)
                                <option value="{{ $welfare->id }}" {{ old('welfare_id') == $welfare->id ? 'selected' : '' }}>
                                    {{ $welfare->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('welfare_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Serial Number -->
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">{{ __('Serial Number') }}</label>
                        <input type="text" name="serial_number" id="serial_number"
                               class="form-control @error('serial_number') is-invalid @enderror"
                               value="{{ old('serial_number') }}"
                               placeholder="{{ __('Enter Serial Number') }}">
                        @error('serial_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Added Date -->
                    <div class="mb-3">
                        <label for="added_date" class="form-label">{{ __('Added Date') }}</label>
                        <input type="date" name="added_date" id="added_date"
                               class="form-control @error('added_date') is-invalid @enderror"
                               value="{{ old('added_date') }}">
                        @error('added_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Issued Date -->
                    <div class="mb-3">
                        <label for="issued_date" class="form-label">{{ __('Issued Date') }}</label>
                        <input type="date" name="issued_date" id="issued_date"
                               class="form-control @error('issued_date') is-invalid @enderror"
                               value="{{ old('issued_date') }}">
                        @error('issued_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="active" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="active"
                                class="form-select @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                        </select>
                        @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Item') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Back') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Auto Open Item Modal if Validation Errors Exist -->
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var itemModal = new bootstrap.Modal(document.getElementById('ModalItemCreate'));
            itemModal.show();
        });
    </script>
@endif
