<!-- Edit Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="unitEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="unitEditModalLabel">{{ __('Edit Unit') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUnitForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="unit_id" id="editUnitId">

                    <div class="mb-3">
                        <label for="editUnitName" class="form-label">{{ __('Unit') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editUnitName" name="unit">
                        <div class="invalid-feedback d-block" id="editUnitNameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editRegementId" class="form-label">{{ __('Regement') }} <span class="text-danger">*</span></label>
                        <select class="form-select" id="editRegementId" name="regement_id">
                            <option value="">{{ __('Select Regement') }}</option>
                            @foreach ($regements as $regement)
                                <option value="{{ $regement->id }}">{{ $regement->regement }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback d-block" id="editRegementError"></div>
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



<!-- Script -->
<script>
$(document).ready(function() {
    $('.btn-edit').click(function() {
        const button = $(this);
        $('#editUnitId').val(button.data('id'));
        $('#editUnitName').val(button.data('unit'));
        $('#editRegementId').val(button.data('regement'));
        $('#editUnitForm').attr('action', button.data('action'));

        // Clear previous errors
        $('#editUnitNameError').text('');
        $('#editRegementError').text('');
    });
});
</script>
