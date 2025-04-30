@extends('welcome')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="profile-section" style="background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%); min-height: 100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="profile-header mb-5 text-center">
                    <h2 class="fw-bold text-gradient">Profile Settings</h2>
                    <p class="text-muted">Manage your personal information and account settings</p>
                </div>
                
                <div class="profile-card rounded-4 shadow-sm overflow-hidden">
                    <div class="row g-0">
                        <!-- Left Side - Profile Picture -->
                        <div class="col-md-4 bg-white p-4 d-flex flex-column align-items-center">
                            <div class="profile-avatar-wrapper mb-3 position-relative">
                                <div class="avatar-edit">
                                    <button class="btn btn-sm btn-icon-only btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                                @if(Auth::user()->image)
                                    @if(Str::startsWith(Auth::user()->image, ['http://', 'https://']))
                                        <img src="{{ Auth::user()->image }}" alt="avatar" class="rounded-circle shadow profile-avatar">
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="avatar" class="rounded-circle shadow profile-avatar">
                                    @endif
                                @else
                                    <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg" alt="avatar" class="rounded-circle shadow profile-avatar">
                                @endif
                            </div>
                            
                            <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                            <p class="text-muted small mb-3">{{ $user->email }}</p>
                            <span class="badge bg-primary-gradient rounded-pill px-3 py-2">{{ ucfirst($user->role) }}</span>
                            
                            <button type="button" class="btn btn-primary-gradient rounded-pill px-4 mt-4 w-100" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </button>
                        </div>
                        
                        <!-- Right Side - Profile Details -->
                        <div class="col-md-8 bg-light">
                            <div class="p-4">
                                <h5 class="fw-bold mb-4 border-bottom pb-3">Personal Information</h5>
                                
                                <div class="profile-detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        <span>Username</span>
                                    </div>
                                    <div class="detail-value">{{ $user->name }}</div>
                                </div>
                                
                                <div class="profile-detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-id-card me-2 text-primary"></i>
                                        <span>Full Name</span>
                                    </div>
                                    <div class="detail-value">{{ $user->nama_lengkap ?? '-' }}</div>
                                </div>
                                
                                <div class="profile-detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-phone me-2 text-primary"></i>
                                        <span>Phone Number</span>
                                    </div>
                                    <div class="detail-value">{{ $user->hp ?? '-' }}</div>
                                </div>
                                
                                <div class="profile-detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        <span>Email</span>
                                    </div>
                                    <div class="detail-value">{{ $user->email }}</div>
                                </div>
                                
                                <div class="profile-detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-user-tag me-2 text-primary"></i>
                                        <span>Account Role</span>
                                    </div>
                                    <div class="detail-value">{{ ucfirst($user->role) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary-gradient text-white border-0 rounded-top">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="hp" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" id="hp" name="hp" value="{{ old('hp', $user->hp) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <select class="form-select" name="role" id="role">
                                        <option value="" disabled>Select Role</option>
                                        @if (Auth::check())
                                            @if (Auth::user()->isAdmin())
                                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Staff</option>
                                            @elseif (Auth::user()->isPetugas())
                                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Regular User</option>
                                            @endif
                                        @endif
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Profile Image</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                </div>
                                @if($user->image)
                                    <div class="mt-3 d-flex align-items-center">
                                        <span class="me-2">Current Image:</span>
                                        <img src="{{ Str::startsWith($user->image, 'http') ? $user->image : asset('storage/' . $user->image) }}" width="60" class="rounded-circle border">
                                    </div>
                                @endif
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 bg-light rounded-bottom">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-gradient rounded-pill px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .profile-section {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .text-gradient {
        background: linear-gradient(45deg, #3a7bd5, #00d2ff);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline-block;
    }
    
    .profile-card {
        background: white;
        transition: all 0.3s ease;
    }
    
    .profile-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .profile-avatar {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .avatar-edit {
        position: absolute;
        bottom: 10px;
        right: 10px;
        z-index: 2;
    }
    
    .profile-detail-item {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .detail-label {
        flex: 0 0 40%;
        font-weight: 500;
        color: #6c757d;
    }
    
    .detail-value {
        flex: 1;
        font-weight: 400;
    }
    
    .bg-primary-gradient {
        background: linear-gradient(45deg, #3a7bd5, #00d2ff);
        border: none;
    }
    
    .btn-primary-gradient {
        background: linear-gradient(45deg, #3a7bd5, #00d2ff);
        border: none;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(58, 123, 213, 0.4);
    }
    
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    @media (max-width: 768px) {
        .profile-detail-item {
            flex-direction: column;
        }
        
        .detail-label {
            margin-bottom: 5px;
        }
    }
</style>
@endsection