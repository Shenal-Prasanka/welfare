<div class="modal fade" id="ModalMembershipEdit" tabindex="-1" role="dialog" aria-labelledby="editMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white font-weight-bold" id="editMembershipModalLabel">{{ __('Edit Membership') }}</h5>
                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editMembershipForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="membership_id" id="editMembershipId">
                    
                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label for="editName" class="form-label">{{ __('Name') }}</label>
                            <input type="text" name="name" id="editName" class="form-control">
                            <div class="invalid-feedback d-block" id="editNameError"></div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="editEmail" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" id="editEmail" class="form-control">
                            <div class="invalid-feedback d-block" id="editEmailError"></div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="editMobile" class="form-label">{{ __('Mobile') }}</label>
                            <input type="text" name="mobile" id="editMobile" class="form-control">
                            <div class="invalid-feedback d-block" id="editMobileError"></div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="editArmyId" class="form-label">{{ __('Army ID') }}</label>
                            <input type="text" name="army_id" id="editArmyId" class="form-control">
                            <div class="invalid-feedback d-block" id="editArmyIdError"></div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="editRegimentNo" class="form-label">{{ __('Regiment No') }}</label>
                            <input type="text" name="regiment_no" id="editRegimentNo" class="form-control">
                            <div class="invalid-feedback d-block" id="editRegimentNoError"></div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="editNic" class="form-label">{{ __('NIC') }}</label>
                            <input type="text" name="nic" id="editNic" class="form-control">
                            <div class="invalid-feedback d-block" id="editNicError"></div>
                        </div>
                        
                        {{-- FIX: Added missing Status dropdown --}}
                        <div class="col-md-4 mt-3">
                            <label for="editActive" class="form-label">{{ __('Status') }}</label>
                            <select name="active" id="editActive" class="form-control" required>
                                <option value="1">{{ __('Pending/Active') }}</option>
                                <option value="0">{{ __('Approved') }}</option>
                            </select>
                            <div class="invalid-feedback d-block" id="editActiveError"></div>
                        </div>
                        
                        <div class="col-md-9 mt-3">
                            <label for="editAddress" class="form-label">{{ __('Address') }}</label>
                            <textarea name="address" id="editAddress" class="form-control" rows="2"></textarea>
                            <div class="invalid-feedback d-block" id="editAddressError"></div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update Membership') }}</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Back') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // We use a jQuery listener here for simplicity if you are using jQuery for Bootstrap modals
    // Ensure you are using the correct class/ID defined in your index view: .btn-edit-membership
    $(document).on('click', '.btn-edit-membership', function() {
        // Retrieve all data attributes from the button clicked in the index table
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const mobile = $(this).data('mobile');
        const address = $(this).data('address');
        const army_id = $(this).data('army_id');
        const regiment_no = $(this).data('regiment_no');
        const nic = $(this).data('nic');
        const active = $(this).data('active');
        const action = $(this).data('action');

        // 1. Populate the form fields
        $('#editMembershipId').val(id);
        $('#editName').val(name);
        $('#editEmail').val(email);
        $('#editMobile').val(mobile);
        $('#editAddress').val(address);
        
        // Populate new fields
        $('#editArmyId').val(army_id);
        $('#editRegimentNo').val(regiment_no);
        $('#editNic').val(nic);
        
        // 2. Set the 'active' status dropdown
        $('#editActive').val(active);
        
        // 3. Set the form action URL (e.g., /memberships/1)
        $('#editMembershipForm').attr('action', action);

        // 4. Clear any previous validation errors
        $('.invalid-feedback.d-block').text(''); 
        $('.form-control').removeClass('is-invalid');

        // 5. Show the modal
        $('#ModalMembershipEdit').modal('show');
    });
});
</script>