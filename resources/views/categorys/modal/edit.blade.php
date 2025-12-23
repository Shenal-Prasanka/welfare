<div class="modal fade" id="categoryModalEdit" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white font-weight-bold" id="editCategoryModalLabel">{{ __('Edit Category') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="category_id" id="editCategoryId">

                    <!-- Category Field -->
                   <div class="col-md-12">
                        <label for="editCategoryName" class="form-label">{{ __('Category') }}</label>
                        <input type="text" name="category" id="editCategoryName" class="form-control" placeholder="{{ __('Enter Category') }}">
                        <div class="invalid-feedback d-block" id="editCategoryError"></div>
                    </div>

                    <!-- Description Field -->
                    <div class="col-md-12 mt-3">
                        <label for="editCategoryDescription" class="form-label">{{ __('Description') }}</label>
                        <textarea name="description" id="editCategoryDescription" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback d-block" id="editDescriptionError"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Back') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModalElement = document.getElementById('categoryModalEdit');
    const editModal = new bootstrap.Modal(editModalElement);

    document.querySelectorAll('.btn-edit-category').forEach(button => {
        button.addEventListener('click', function () {
            // Get data from button
            document.getElementById('editCategoryId').value = this.dataset.id;
            document.getElementById('editCategoryName').value = this.dataset.category;
            document.getElementById('editCategoryDescription').value = this.dataset.description;
            document.getElementById('editCategoryForm').action = this.dataset.action;

            // Clear any old errors
            document.getElementById('editCategoryError').textContent = '';
            document.getElementById('editDescriptionError').textContent = '';

            // Show modal
            editModal.show();
        });
    });
});
</script>
