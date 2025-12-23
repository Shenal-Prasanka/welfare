@extends('layouts.app')

@section('content')
<style>
    /* Custom styles to match the aesthetic */
    .profile-header {
        border-left: 5px solid #007bff;
        padding-left: 15px;
        margin-bottom: 20px;
    }
    .info-label {
        color: #6c757d;
        font-weight: 500;
    }
    .info-value {
        font-weight: 600;
        color: #343a40;
    }
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        border: none;
    }
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #dc3545 !important;
        color: #dc3545 !important;
        font-weight: 600;
        background-color: transparent !important;
        border-top: none;
        border-left: none;
        border-right: none;
        margin-bottom: -1px;
    }
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
    }
    .tab-content {
        padding-top: 20px;
    }
    .detail-row {
        margin-bottom: 10px;
    }
    .detail-row .col-6:first-child {
        color: #343a40;
        font-weight: 500;
    }
    .btn-purple {
        background-color: #9c27b0;
        border-color: #9c27b0;
        color: white;
        transition: background-color 0.2s;
    }
    .btn-purple:hover {
        background-color: #7b1fa2;
        border-color: #7b1fa2;
        color: white;
    }
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

<div class="container-fluid p-4 p-md-3">
    <!-- Breadcrumb Header -->
    <div class="d-flex align-items-center mb-3">
        <h2 class="profile-header text-primary font-weight-bold mb-0 mr-3">Profile</h2>
        <small class="text-muted">Dashboard / Profile</small>
    </div>

    <!-- Top Profile Card (Info Section) -->
    <div class="card mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center">
                <!-- Left Column: Image and Primary Info -->
                <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <!-- Avatar -->
                        @if (auth()->user()->profile_image)
                            <img src="{{ route('image.show', auth()->user()->profile_image) }}" 
                                 class="rounded-circle mr-4 profile-avatar" alt="{{ auth()->user()->name }}">
                        @else
                            <div class="rounded-circle mr-4 bg-secondary text-white d-flex align-items-center justify-center" 
                                 style="width: 80px; height: 80px; font-size: 32px;">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-weight-bold mb-0">{{ auth()->user()->name }}</h4>
                            <p class="text-muted mb-1">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</p>
                            <p class="text-info small font-weight-bold mb-1">Army Id:{{ auth()->user()->armyId ?? 'N/A' }}</p>
                            <p class="text-info small font-weight-bold mb-1">Employee ID: {{ auth()->user()->employee_no ?? 'N/A' }}</p>
                            <p class="text-info small font-weight-bold mb-0">Regiment No: {{ auth()->user()->regement_no ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Contact Details -->
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <!-- Phone -->
                        <div class="col-6 detail-row"><span class="info-label">Mobile:</span></div>
                        <div class="col-6 detail-row"><span class="info-value text-sm">{{ auth()->user()->mobile ?? 'Not provided' }}</span></div>

                        <!-- Email -->
                        <div class="col-6 detail-row"><span class="info-label">Email:</span></div>
                        <div class="col-6 detail-row"><span class="info-value text-sm">{{ auth()->user()->email }}</span></div>

                        <!-- Address -->
                        <div class="col-6 detail-row"><span class="info-label">Address:</span></div>
                        <div class="col-6 detail-row"><span class="info-value text-sm">{{ auth()->user()->address ?? 'Not provided' }}</span></div>

                        <!-- Rank -->
                        <div class="col-6 detail-row"><span class="info-label">Rank:</span></div>
                        <div class="col-6 detail-row"><span class="info-value text-sm">{{ auth()->user()->rank->rank ?? 'Not provided' }}</span></div>

                        <!-- Regiment -->
                        <div class="col-6 detail-row"><span class="info-label">Regiment:</span></div>
                        <div class="col-6 detail-row"><span class="info-value text-sm">{{ auth()->user()->regement->regement ?? 'Not provided' }}</span></div>

                        @if (auth()->user()->welfare)
                        <!-- Welfare Shop -->
                        <div class="col-6 detail-row"><span class="info-label">Welfare Shop:</span></div>
                        <div class="col-6 detail-row"><span class="info-value text-sm">{{ auth()->user()->welfare->name }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="false">Edit Profile</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="profileTabsContent">
        <!-- Active Profile Tab Content -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <!-- Personal Informations Card -->
                <div class="col-12 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-3">Personal Informations</h5>
                            <div class="container-fluid p-0"><br><br>
                                <div class="row detail-row">
                                    <div class="col-6">Name</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->name }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Email</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->email }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Mobile</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->mobile ?? 'Not provided' }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Address</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->address ?? 'Not provided' }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Rank</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->rank->rank ?? 'Not provided' }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Regiment</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->regement->regement ?? 'Not provided' }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Unit</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->unit->unit ?? 'Not provided' }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Regiment No</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->regement_no ?? 'Not provided' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role & Access Card -->
                <div class="col-12 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-3">Role & Access</h5>
                            <div class="container-fluid p-0"><br><br>
                                <div class="row detail-row">
                                    <div class="col-6">Role</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</div>
                                </div>
                                <div class="row detail-row">
                                    <div class="col-6">Employee No</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->employee_no ?? 'Not provided' }}</div>
                                </div>
                                @if (auth()->user()->welfare)
                                <div class="row detail-row">
                                    <div class="col-6">Welfare Shop</div>
                                    <div class="col-6 font-weight-bold text-sm">{{ auth()->user()->welfare->name }}</div>
                                </div>
                                @endif
                                <div class="row detail-row">
                                    <div class="col-6">Account Status</div>
                                    <div class="col-6 font-weight-bold text-sm">
                                        <span class="badge badge-success">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Tab Content -->
        <div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-user mr-2"></i>Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter your name"
                                    value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-envelope mr-2"></i>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your email"
                                    value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-phone mr-2"></i>Mobile</label>
                                <input type="text" name="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    placeholder="Enter mobile number"
                                    value="{{ old('mobile', auth()->user()->mobile) }}" required>
                                @error('mobile')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-map-marker-alt mr-2"></i>Address</label>
                                <input type="text" name="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter your address"
                                    value="{{ old('address', auth()->user()->address) }}" required>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Profile Image -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-image mr-2"></i>Profile Image</label>
                                <div class="custom-file">
                                    <input type="file" name="profile_image" accept="image/*"
                                        class="custom-file-input @error('profile_image') is-invalid @enderror"
                                        id="profileImageInput">
                                    <label class="custom-file-label" for="profileImageInput">Choose file</label>
                                    @error('profile_image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>
                            </div>

                            <div class="col-12"><hr></div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-lock mr-2"></i>New Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Leave blank to keep current">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">Leave blank if you don't want to change password</small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold"><i class="fas fa-lock mr-2"></i>Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save mr-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
