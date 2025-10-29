<!-- Edit Supply Modal -->
<div class="modal fade" id="ModalSupplyEdit" tabindex="-1" role="dialog" aria-labelledby="editSupplyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white font-weight-bold" id="editSupplyModalLabel">{{ __('Edit Supply') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editSupplyForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="supply_id" id="editSupplyId">

                    <!-- Supplier Field -->
                     <div class="col-md-12">
                        <label for="editName" class="form-label">{{ __('Supplier') }}</label>
                        <input type="text" name="supply" id="editName" class="form-control">
                        <div class="invalid-feedback d-block" id="editNameError"></div>
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

                    <!-- Description Field -->
                     <div class="col-md-12 mt-3">
                        <label for="editDescription" class="form-label">{{ __('Description') }}</label>
                        <textarea name="description" id="editDescription" class="form-control" rows="3"></textarea>
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

<!-- JavaScript to fill modal with data -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // When clicking an edit button in your supply table
    document.querySelectorAll('.btn-edit-supply').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const active = this.dataset.active;
            const description = this.dataset.description;
            const action = this.dataset.action;

            document.getElementById('editSupplyId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editActive').value = active;
            document.getElementById('editDescription').value = description;
            document.getElementById('editSupplyForm').action = action;

            // Reset validation errors
            document.getElementById('editNameError').textContent = '';
            document.getElementById('editActiveError').textContent = '';
            document.getElementById('editDescriptionError').textContent = '';

            // Show modal (Bootstrap 5)
            const editModal = new bootstrap.Modal(document.getElementById('ModalSupplyEdit'));
            editModal.show();
        });
    });
});
</script>
