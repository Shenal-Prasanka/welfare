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

                    <!-- Product Field -->
                     <div class="col-md-12">
                        <label for="editProduct" class="form-label">{{ __('Product') }}</label>
                        <input type="text" name="product" id="editProduct" class="form-control">
                        <div class="invalid-feedback d-block" id="editProductError"></div>
                    </div>

                    <!-- Category Field -->
                     <div class="col-md-12 mt-3">
                        <label for="editCategory" class="form-label">{{ __('Category') }}</label>
                        <select name="category_id" id="editCategory" class="form-select">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback d-block" id="editCategoryError"></div>
                    </div>

                    <!-- Active Field -->
                     <div class="col-md-12 mt-3">
                        <label for="editActive" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="editActive" class="form-select">
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
    document.querySelectorAll('.btn-edit-product').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const product = this.dataset.product;
            const categoryId = this.dataset.category;
            const active = this.dataset.active;
            const action = this.dataset.action;

            document.getElementById('editProductId').value = id;
            document.getElementById('editProduct').value = product;
            document.getElementById('editCategory').value = categoryId;
            document.getElementById('editActive').value = active;
            document.getElementById('editProductForm').action = action;

            // Clear old validation messages
            document.getElementById('editProductError').textContent = '';
            document.getElementById('editCategoryError').textContent = '';
            document.getElementById('editActiveError').textContent = '';

            // Show modal
            const editModal = new bootstrap.Modal(document.getElementById('ModalProductEdit'));
            editModal.show();
        });
    });
});
</script>
