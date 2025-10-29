@extends('dashboard')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row ml-5">
                <!-- Left Column: Profile Edit Form -->
                <div class="col-lg-3 mt-4">
                    <div class="card border-2" style="width: 350px;">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <!-- Profile Image Upload -->
                                <div class="text-center mb-3">
                                    <div class="profile-image-container mx-auto mb-2">
                                        @if (auth()->user()->profile_image)
                                            <img id="profileImagePreview"
                                                src="{{ route('image.show', auth()->user()->profile_image) }}"
                                                class="profile-image" alt="Profile Image">
                                        @else
                                            <div id="profileImagePreview" class="profile-image-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <h4 class="mt-3 mb-1">{{ auth()->user()->name }}</h4>
                                <p class="text-muted">{{ auth()->user()->email }}</p>
                            </div>

                            <div class="profile-info ml-4">
                                <div class="info-item">
                                    <i class="fas fa-phone text-success mr-2"></i>
                                    <span class="info-label">Mobile:</span>
                                    <span class="info-value">{{ auth()->user()->mobile ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt text-success mr-2"></i>
                                    <span class="info-label">Address:</span>
                                    <span class="info-value">{{ auth()->user()->address ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-star text-success mr-2"></i>
                                    <span class="info-label">Rank:</span>
                                    <span class="info-value">{{ auth()->user()->rank->rank ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-building text-success mr-2"></i>
                                    <span class="info-label">Regiment:</span>
                                    <span
                                        class="info-value">{{ auth()->user()->regement->regement ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-users text-success mr-2"></i>
                                    <span class="info-label">Unit:</span>
                                    <span class="info-value">{{ auth()->user()->unit->unit ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-id-card text-success mr-2"></i>
                                    <span class="info-label">Regiment No:</span>
                                    <span class="info-value">{{ auth()->user()->regement_no ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-briefcase text-success mr-2"></i>
                                    <span class="info-label">Employee No:</span>
                                    <span class="info-value">{{ auth()->user()->employee_no ?: 'Not provided' }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-user-tag text-success mr-2"></i>
                                    <span class="info-label">Job Role:</span>
                                    <span class="info-value">{{ auth()->user()->role ?: 'Not provided' }}</span>
                                </div>
                                @if (auth()->user()->welfare)
                                    <div class="info-item">
                                        <i class="fas fa-store text-success mr-2"></i>
                                        <span class="info-label">Welfareshop:</span>
                                        <span class="info-value">{{ auth()->user()->welfare->name }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Edit Form Card -->
                <div class="col-lg-8 mt-4 mx-auto">
                    <div class="card  border-2">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h5>{{ __('Edit Profile') }}</h5>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Left Column: Name, Email, Mobile, Address -->
                                    <div class="col-md-5 ml-5">
                                        <!-- Name -->
                                        <label>{{ __('Name') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                                value="{{ old('name', auth()->user()->name) }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            @error('name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <label>{{ __('Email') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email', auth()->user()->email) }}"
                                                required>
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span
                                                        class="fas fa-envelope"></span></div>
                                            </div>
                                            @error('email')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Mobile -->
                                        <label>{{ __('Mobile') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="mobile"
                                                class="form-control @error('mobile') is-invalid @enderror"
                                                placeholder="Mobile" value="{{ old('mobile', auth()->user()->mobile) }}"
                                                required>
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span class="fas fa-phone"></span>
                                                </div>
                                            </div>
                                            @error('mobile')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Address -->
                                        <label>{{ __('Address') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Address"
                                                value="{{ old('address', auth()->user()->address) }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span
                                                        class="fas fa-map-marker-alt"></span></div>
                                            </div>
                                            @error('address')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Right Column: Profile Image, Password, Confirm Password -->
                                    <div class="col-md-5 ml-5">
                                        <!-- Profile Image -->
                                        <label>{{ __('Profile Image') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="profile_image" accept="image/*"
                                                class="form-control @error('profile_image') is-invalid @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span class="fas fa-image"></span>
                                                </div>
                                            </div>
                                            @error('profile_image')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <label>{{ __('New Password') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="New password">
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <label>{{ __('Confirm Password') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Confirm password">
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- Submit Button (Full Width) -->
                                <div class="input-group mb-3 mt-5">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">{{ __('Submit') }}</button>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const preview = document.getElementById('profileImagePreview');

                reader.onload = function(e) {
                    if (preview.classList.contains('profile-image-placeholder')) {
                        preview.outerHTML = '<img id="profileImagePreview" src="' + e.target.result +
                            '" class="profile-image" alt="Profile Image">';
                    } else {
                        preview.src = e.target.result;
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
