@extends('dashboard')

@section('content')
<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px 15px 0 0;
        color: white;
    }
    
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        object-fit: cover;
    }
    
    .profile-avatar-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: #6c757d;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .info-card {
        transition: transform 0.2s;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .info-item {
        padding: 12px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
        min-width: 130px;
    }
    
    .info-value {
        color: #6c757d;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-update {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 40px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .edit-section {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Profile View Card -->
            <div class="col-lg-4">
                <div class="card shadow-sm info-card">
                    <div class="profile-header text-center">
                        @if (auth()->user()->profile_image)
                            <img id="profileImageDisplay"
                                src="{{ route('image.show', auth()->user()->profile_image) }}"
                                class="profile-avatar" alt="Profile">
                        @else
                            <div id="profileImageDisplay" class="profile-avatar-placeholder mx-auto">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <h3 class="mt-3 mb-1">{{ auth()->user()->name }}</h3>
                        <p class="mb-0"><i class="fas fa-envelope mr-2"></i>{{ auth()->user()->email }}</p>
                        @if(auth()->user()->getRoleNames()->first())
                            <span class="badge badge-light mt-2 px-3 py-2">
                                <i class="fas fa-user-shield mr-1"></i>
                                {{ auth()->user()->getRoleNames()->first() }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="info-item">
                            <i class="fas fa-phone text-primary mr-3" style="width: 20px;"></i>
                            <span class="info-label">Mobile:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->mobile ?: 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt text-danger mr-3" style="width: 20px;"></i>
                            <span class="info-label">Address:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->address ?: 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-star text-warning mr-3" style="width: 20px;"></i>
                            <span class="info-label">Rank:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->rank->rank ?? 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-building text-info mr-3" style="width: 20px;"></i>
                            <span class="info-label">Regiment:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->regement->regement ?? 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users text-success mr-3" style="width: 20px;"></i>
                            <span class="info-label">Unit:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->unit->unit ?? 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-id-card text-secondary mr-3" style="width: 20px;"></i>
                            <span class="info-label">Regiment No:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->regement_no ?: 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-briefcase text-primary mr-3" style="width: 20px;"></i>
                            <span class="info-label">Employee No:</span>
                            <span class="info-value ml-auto">{{ auth()->user()->employee_no ?: 'Not provided' }}</span>
                        </div>
                        @if (auth()->user()->welfare)
                            <div class="info-item">
                                <i class="fas fa-store text-success mr-3" style="width: 20px;"></i>
                                <span class="info-label">Welfare Shop:</span>
                                <span class="info-value ml-auto">{{ auth()->user()->welfare->name }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Edit Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-edit mr-2"></i>{{ __('Edit Profile') }}</h4>
                    </div>
                    <div class="card-body edit-section">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-user mr-2"></i>{{ __('Name') }}</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter your name"
                                        value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-envelope mr-2"></i>{{ __('Email') }}</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter your email"
                                        value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mobile -->
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-phone mr-2"></i>{{ __('Mobile') }}</label>
                                    <input type="text" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        placeholder="Enter mobile number"
                                        value="{{ old('mobile', auth()->user()->mobile) }}" required>
                                    @error('mobile')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-map-marker-alt mr-2"></i>{{ __('Address') }}</label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Enter your address"
                                        value="{{ old('address', auth()->user()->address) }}" required>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Profile Image -->
                                <div class="col-md-12 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-image mr-2"></i>{{ __('Profile Image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" accept="image/*"
                                            class="custom-file-input @error('profile_image') is-invalid @enderror"
                                            id="profileImageInput" onchange="previewImage(this)">
                                        <label class="custom-file-label" for="profileImageInput">Choose file</label>
                                        @error('profile_image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>
                                </div>

                                <div class="col-12"><hr></div>

                                <!-- Password -->
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-lock mr-2"></i>{{ __('New Password') }}</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Leave blank to keep current">
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted">Leave blank if you don't want to change password</small>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold"><i class="fas fa-lock mr-2"></i>{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm new password">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-update">
                                    <i class="fas fa-save mr-2"></i>{{ __('Update Profile') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const preview = document.getElementById('profileImageDisplay');
            const label = input.nextElementSibling;
            
            // Update file input label
            label.textContent = input.files[0].name;

            reader.onload = function(e) {
                if (preview.classList.contains('profile-avatar-placeholder')) {
                    preview.outerHTML = '<img id="profileImageDisplay" src="' + e.target.result +
                        '" class="profile-avatar" alt="Profile">';
                } else {
                    preview.src = e.target.result;
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
