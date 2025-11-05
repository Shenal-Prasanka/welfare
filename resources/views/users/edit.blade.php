<!-- Modal -->
@if(isset($user))
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                @endsession
                <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Left side fields -->
                            <!-- Name -->
                            <div class="form-group ml-3">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group ml-3">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group ml-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="form-group ml-3">
                                <label for="roles[]">{{ __('Role') }}</label>
                                <select name="roles[]" id="roles[]"
                                    class="form-control @error('roles[]') is-invalid @enderror" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles[]')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile -->
                            <div class="form-group ml-3">
                                <label for="mobile">{{ __('Mobile') }}</label>
                                <input type="text" name="mobile" id="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    value="{{ old('mobile', $user->mobile) }}" required>
                                @error('mobile')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="form-group ml-3">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" name="address" id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address', $user->address) }}" required>
                                @error('address')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- NIC -->
                            <div class="form-group ml-3">
                                <label for="nic">{{ __('NIC') }}</label>
                                <input type="text" name="nic" id="nic"
                                    class="form-control @error('nic') is-invalid @enderror"
                                    value="{{ old('nic', $user->nic) }}" required>
                                @error('nic')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Army ID -->
                            <div class="form-group ml-3">
                                <label for="armyId">{{ __('Army ID') }}</label>
                                <input type="text" name="armyId" id="armyId"
                                    class="form-control @error('armyId') is-invalid @enderror"
                                    value="{{ old('armyId', $user->armyId) }}" required>
                                @error('armyId')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Right side fields -->
                            <!-- Employee No -->
                            <div class="form-group ml-3">
                                <label for="employee_no">{{ __('Employee No') }}</label>
                                <input type="text" name="employee_no" id="employee_no"
                                    class="form-control @error('employee_no') is-invalid @enderror"
                                    value="{{ old('employee_no', $user->employee_no) }}" required>
                                @error('employee_no')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Regement No -->
                            <div class="form-group ml-3">
                                <label for="regement_no">{{ __('Regement No') }}</label>
                                <input type="text" name="regement_no" id="regement_no"
                                    class="form-control @error('regement_no') is-invalid @enderror"
                                    value="{{ old('regement_no', $user->regement_no) }}" required>
                                @error('regement_no')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Regement -->
                            <div class="form-group ml-3">
                                <label for="regement_id">{{ __('Regement') }}</label>
                                <select name="regement_id" id="regement_id"
                                    class="form-control @error('regement_id') is-invalid @enderror" required>
                                    <option value="" disabled>Select Regement</option>
                                    @foreach ($regements as $regement)
                                        <option value="{{ $regement->id }}"
                                            {{ old('regement_id', $user->regement_id) == $regement->id ? 'selected' : '' }}>
                                            {{ $regement->regement }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('regement_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Unit -->
                            <div class="form-group ml-3">
                                <label for="unit_id">{{ __('Unit') }}</label>
                                <select name="unit_id" id="unit_id"
                                    class="form-control @error('unit_id') is-invalid @enderror" required>
                                    <option value="" disabled>Select Unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ old('unit_id', $user->unit_id) == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->unit }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Rank -->
                            <div class="form-group ml-3">
                                <label for="rank_id">{{ __('Rank') }}</label>
                                <select name="rank_id" id="rank_id"
                                    class="form-control @error('rank_id') is-invalid @enderror" required>
                                    <option value="" disabled>Select Rank</option>
                                    @foreach ($ranks as $rank)
                                        <option value="{{ $rank->id }}"
                                            {{ old('rank_id', $user->rank_id) == $rank->id ? 'selected' : '' }}>
                                            {{ $rank->rank }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rank_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Office Address -->
                            <div class="form-group ml-3">
                                <label for="officeAddress">{{ __('Office Address') }}</label>
                                <input type="text" name="officeAddress" id="officeAddress"
                                    class="form-control @error('officeAddress') is-invalid @enderror"
                                    value="{{ old('officeAddress', $user->officeAddress) }}" required>
                                @error('officeAddress')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Enlisted Date -->
                            <div class="form-group ml-3">
                                <label for="enlistedDate">{{ __('Enlisted Date') }}</label>
                                <input type="date" name="enlistedDate" id="enlistedDate"
                                    class="form-control @error('enlistedDate') is-invalid @enderror"
                                    value="{{ old('enlistedDate', $user->enlistedDate) }}" required>
                                @error('enlistedDate')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>


                            <!-- Retire Date -->
                            <div class="form-group ml-3">
                                <label for="retireDate">{{ __('Retire Date') }}</label>
                                <input type="date" name="retireDate" id="retireDate"
                                    class="form-control @error('retireDate') is-invalid @enderror"
                                    value="{{ old('retireDate', $user->retireDate) }}">
                                @error('retireDate')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn-lg btn-primary mr-2">{{ __('Update') }}</button>
                        <button type="button" class="btn-lg btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#updateUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);

        // Set form action dynamically
        modal.find('form').attr('action', button.data('action'));

        // Populate fields
        modal.find('#name').val(button.data('name'));
        modal.find('#email').val(button.data('email'));
        modal.find('#mobile').val(button.data('mobile'));
        modal.find('#address').val(button.data('address'));
        modal.find('#nic').val(button.data('nic'));
        modal.find('#armyId').val(button.data('armyid'));
        modal.find('#employee_no').val(button.data('employee_no'));
        modal.find('#regement_no').val(button.data('regement_no'));
        modal.find('#regement_id').val(button.data('regement_id'));
        modal.find('#unit_id').val(button.data('unit_id'));
        modal.find('#rank_id').val(button.data('rank_id'));
        modal.find('#officeAddress').val(button.data('officeaddress'));
        modal.find('#enlistedDate').val(button.data('enlisteddate'));
        modal.find('#retireDate').val(button.data('retireDate'));

        // For roles (multi-select)
        var roles = button.data('roles').split(',');
        modal.find('#roles\\[\\]').val(roles);
    });
</script>
@endif
