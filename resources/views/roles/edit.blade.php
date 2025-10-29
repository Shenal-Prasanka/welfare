<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRoleForm" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <!-- Role Name Field -->
                    <div class="form-group ml-4">
                        <label for="name">Role</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <!-- Permissions Two-Column Layout -->
                    <div class="form-group mt-3 ml-4">
                        <label for="permissions" class="mb-2">Permissions</label>
                        <div class="row">
                            @php
                                $chunks = $permissions->chunk(ceil($permissions->count() / 2));
                            @endphp
                            @foreach ($chunks as $chunk)
                                <div class="col-md-6">
                                    @foreach ($chunk as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input permission-checkbox"
                                                name="permissions[{{ $permission->name }}]"
                                                value="{{ $permission->name }}"
                                                id="perm_{{ $permission->id }}">
                                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-primary">Update Permission</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.btn-edit').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var permissions = $(this).data('permissions'); // array of permission names
        var action = $(this).data('action');

        // Set form action
        $('#editRoleForm').attr('action', action);

        // Set role name
        $('#name').val(name);

        // Reset all checkboxes
        $('.permission-checkbox').prop('checked', false);

        // Check the permissions for this role
        permissions.forEach(function(p) {
            $('.permission-checkbox[value="' + p + '"]').prop('checked', true);
        });
    });
});
</script>

