<!-- Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="createRoleModalLabel">Create New Role</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createRoleForm" action="{{ route('roles.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <!-- Name Field -->
                    <div class="form-group ml-2">
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required>
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @else
                                Please provide a valid role.
                            @enderror
                        </div>
                    </div>

                    <!-- Permissions Field -->
                    <div class="form-group ml-4">
                        <label for="permissions">{{ __('Permissions') }}</label>
                        <div class="row">
                            @php
                                $half = ceil($permissions->count() / 2);
                                $leftPermissions = $permissions->slice(0, $half);
                                $rightPermissions = $permissions->slice($half);
                            @endphp
                            <div class="col-md-6">
                                @foreach ($leftPermissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="permissions[{{ $permission->name }}]" value="{{ $permission->name }}"
                                            id="perm{{ $permission->id }}">
                                        <label class="form-check-label" for="perm{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                @foreach ($rightPermissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="permissions[{{ $permission->name }}]" value="{{ $permission->name }}"
                                            id="perm{{ $permission->id }}">
                                        <label class="form-check-label" for="perm{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Role</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Auto Open Modal if Errors Exist -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('createRoleModal'));
                modal.show();
            });
        </script>
    @endif
