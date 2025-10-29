<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="createUserModalLabel">Add New User</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" novalidate>
          @csrf
          <div class="row">
            <!-- LEFT COLUMN -->
            <div class="col-md-6">

              <!-- Name Field -->
              <div class="form-group ml-3">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Enter full name" required>
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Email Field -->
              <div class="form-group ml-3">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="Enter email address" required>
                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Password -->
              <div class="form-group ml-3">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Enter password" required>
                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Role -->
              <div class="form-group ml-3">
                <label for="roles[]">{{ __('Role') }}</label>
                <select name="roles[]" id="roles[]"
                        class="form-select @error('roles[]') is-invalid @enderror" required>
                  @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                  @endforeach
                </select>
                @error('role[]') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Mobile -->
              <div class="form-group ml-3">
                <label for="mobile">{{ __('Mobile') }}</label>
                <input type="text" name="mobile" id="mobile"
                       class="form-control @error('mobile') is-invalid @enderror"
                       value="{{ old('mobile') }}" placeholder="Enter mobile number" required>
                @error('mobile') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Address -->
             <div class="form-group ml-3">
                <label for="address">{{ __('Address') }}</label>
                <input type="text" name="address" id="address"
                       class="form-control @error('address') is-invalid @enderror"
                       value="{{ old('address') }}" placeholder="Enter address" required>
                @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- NIC -->
              <div class="form-group ml-3">
                <label for="nic">{{ __('NIC') }}</label>
                <input type="text" name="nic" class="form-control @error('nic') is-invalid @enderror"
                       value="{{ old('nic')}}" placeholder="Enter NIC number" required>
                @error('nic') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Army ID -->
             <div class="form-group ml-3">
                <label for="armyId">{{ __('ArmyId') }}</label>
                <input type="text" name="armyId" class="form-control @error('armyId') is-invalid @enderror"
                       value="{{ old('armyId') }}" placeholder="Enter Army ID" required>
                @error('armyId') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-md-6">

              <!-- Employee No -->
             <div class="form-group ml-3">
                <label for="employee_no">{{ __('Enlisted NO') }}</label>
                <input type="text" name="employee_no" id="employee_no"
                       class="form-control @error('employee_no') is-invalid @enderror"
                       value="{{ old('employee_no') }}" placeholder="Enter enlisted number" required>
                @error('employee_no') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Regement No -->
             <div class="form-group ml-3">
                <label for="regement_no">{{ __('Regement No') }}</label>
                <input type="text" name="regement_no" id="regement_no"
                       class="form-control @error('regement_no') is-invalid @enderror"
                       value="{{ old('regement_no') }}" placeholder="Enter regement number" required>
                @error('regement_no') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Regement -->
              <div class="form-group ml-3">
                <label for="regement_id">{{ __('Regement') }}</label>
                <select name="regement_id" id="regement_id"
                        class="form-select @error('regement_id') is-invalid @enderror" required>
                  <option value="" disabled selected>Select Regement</option>
                  @foreach ($regements as $regement)
                    <option value="{{ $regement->id }}" {{ old('regement_id') == $regement->id ? 'selected' : '' }}>
                      {{ $regement->regement }}
                    </option>
                  @endforeach
                </select>
                @error('regement_id') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Unit -->
              <div class="form-group ml-3">
                <label for="unit_id">{{ __('Unit') }}</label>
                <select name="unit_id" id="unit_id"
                        class="form-select @error('unit_id') is-invalid @enderror" required>
                  <option value="" disabled selected>Select Unit</option>
                  @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                      {{ $unit->unit }}
                    </option>
                  @endforeach
                </select>
                @error('unit_id') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Rank -->
             <div class="form-group ml-3">
                <label for="rank_id">{{ __('Rank') }}</label>
                <select name="rank_id" id="rank_id"
                        class="form-select @error('rank_id') is-invalid @enderror" required>
                  <option value="" disabled selected>Select Rank</option>
                  @foreach ($ranks as $rank)
                    <option value="{{ $rank->id }}" {{ old('rank_id') == $rank->id ? 'selected' : '' }}>
                      {{ $rank->rank }}
                    </option>
                  @endforeach
                </select>
                @error('rank_id') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>
              <!-- Office Address -->
              <div class="form-group ml-3">
                <label for="officeAddress">{{ __('Office Address') }}</label>
                <input type="text" name="officeAddress" class="form-control"
                       value="{{ old('officeAddress')}}" placeholder="Enter office Address" required>
                @error('officeAddress') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Enlisted Date -->
              <div class="form-group ml-3">
                <label for="enlistedDate">{{ __('Enlisted Date') }}</label>
                <input type="date" name="enlistedDate" class="form-control"
                       value="{{ old('enlistedDate') }}" required>
                @error('enlistedDate') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

              <!-- Retire Date -->
              <div class="form-group ml-3">
                <label for="retireDate">{{ __('Retire Date') }}</label>
                <input type="date" name="retireDate" class="form-control">
                @error('retireDate') <span class="text-danger small">{{ $message }}</span> @enderror
              </div>

            </div>
          </div>

          <div class="form-group mt-3 text-right">
            <button type="submit" class="btn-lg btn-primary">{{ __('Add User') }}</button>
            <button type="button" class="btn-lg btn-warning" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
