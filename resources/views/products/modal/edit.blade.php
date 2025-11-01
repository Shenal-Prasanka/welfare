<!-- Edit Product Modal -->
<div class="modal fade" id="ModalProductEdit" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white font-weight-bold" id="editProductModalLabel">{{ __('Edit Product') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Edit Form -->
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="editProductId">

                    <!-- Product Field (read-only) -->
                     <div class="col-md-12">
                        <label for="editProduct" class="form-label">{{ __('Product') }}</label>
                        <input type="text" name="product" id="editProduct" class="form-control" readonly>
                        <div class="invalid-feedback d-block" id="editProductError"></div>
                    </div>

                    <!-- Category Field (disabled) -->
                     <div class="col-md-12 mt-3">
                        <label for="editCategory" class="form-label">{{ __('Category') }}</label>
                        <select name="category_id" id="editCategory" class="form-select" disabled>
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback d-block" id="editCategoryError"></div>
                    </div>

                    <!-- VAT Field (editable) -->
                     <div class="col-md-12 mt-3">
                        <label for="editVat" class="form-label">{{ __('VAT') }}</label>
                        <input type="number" step="0.01" name="vat" id="editVat" class="form-control" placeholder="0.00">
                        <div class="invalid-feedback d-block" id="editVatError"></div>
                    </div>

                    <!-- Tax Field (editable) -->
                     <div class="col-md-12 mt-3">
                        <label for="editTax" class="form-label">{{ __('Tax') }}</label>
                        <input type="number" step="0.01" name="tax" id="editTax" class="form-control" placeholder="0.00">
                        <div class="invalid-feedback d-block" id="editTaxError"></div>
                    </div>

                    <!-- Normal Price (readonly) -->
                    <div class="col-md-12 mt-3">
                        <label for="editNormalPrice" class="form-label">{{ __('Normal Price') }}</label>
                        <input type="number" step="0.01" name="normal_price" id="editNormalPrice" class="form-control" readonly>
                        <div class="invalid-feedback d-block" id="editNormalPriceError"></div>
                    </div>

                    <!-- Welfare Price Field (readonly, auto-calculated) -->
                     <div class="col-md-12 mt-3">
                        <label for="editWelfarePrice" class="form-label">{{ __('Welfare Price') }}</label>
                        <input type="number" step="0.01" name="welfare_price" id="editWelfarePrice" class="form-control" readonly>
                        <div class="invalid-feedback d-block" id="editWelfarePriceError"></div>
                    </div>

                    <!-- Active Field (disabled) -->
                     <div class="col-md-12 mt-3">
                        <label for="editActive" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="editActive" class="form-select" disabled>
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Deactive') }}</option>
                        </select>
                        <div class="invalid-feedback d-block" id="editActiveError"></div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Back') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Fill Modal with Data -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to recalculate welfare price dynamically
    function recalculateWelfarePrice() {
        const normalField = document.getElementById('editNormalPrice');
        const vatField = document.getElementById('editVat');
        const taxField = document.getElementById('editTax');
        const welfareField = document.getElementById('editWelfarePrice');

        if (!normalField || !vatField || !taxField || !welfareField) return;

        let n = parseFloat(normalField.value) || 0;
        let v = parseFloat(vatField.value) || 0;
        let t = parseFloat(taxField.value) || 0;

        // Calculate welfare price = normal + (normal * vat%) + (normal * tax%)
        let wp = n + (n * v / 100.0) + (n * t / 100.0);
        welfareField.value = wp.toFixed(2);
    }

    // Attach input listeners for VAT and Tax fields
    ['editVat', 'editTax'].forEach(id => {
        let el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', recalculateWelfarePrice);
        }
    });

    // When clicking the edit button, populate fields
    document.querySelectorAll('.btn-edit-product').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const product = this.dataset.product;
            const categoryId = this.dataset.category;
            const active = this.dataset.active;
            const vat = this.dataset.vat;
            const tax = this.dataset.tax;
            const normalPrice = this.dataset.normalPrice;
            const action = this.dataset.action;

            // Fill modal fields
            document.getElementById('editProductId').value = id;
            document.getElementById('editProduct').value = product;
            document.getElementById('editCategory').value = categoryId;
            document.getElementById('editActive').value = active;
            document.getElementById('editNormalPrice').value = normalPrice;
            document.getElementById('editVat').value = vat;
            document.getElementById('editTax').value = tax;
            document.getElementById('editProductForm').action = action;

            // Calculate welfare price immediately
            recalculateWelfarePrice();

            // Show modal
            const editModal = new bootstrap.Modal(document.getElementById('ModalProductEdit'));
            editModal.show();
        });
    });
});
</script>

