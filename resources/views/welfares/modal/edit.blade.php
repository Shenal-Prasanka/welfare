<!-- Edit Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title font-weight-bold" id="editModalLabel">{{ __('Edit Welfare') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editWelfareForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="welfare_id" id="editWelfareId">

                    <div class="form-group">
                        <label for="editName">{{ __('Welfare') }}</label>
                        <input type="text" name="name" id="editName" class="form-control">
                        <div class="invalid-feedback d-block" id="editNameError"></div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Last Updated At') }}</label>
                        <input type="text" class="form-control" id="editUpdatedAt" readonly>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Fill modal with existing data
        $('.btn-edit').on('click', function() {
            const button = $(this);
            $('#editWelfareId').val(button.data('id'));
            $('#editName').val(button.data('name'));
            $('#editActive').val(button.data('active'));
            $('#editUpdatedAt').val(button.data('updated'));
            $('#editWelfareForm').attr('action', button.data('action'));
            $('#editNameError').text('');
            $('#editActiveError').text('');
        });
    });
</script>
