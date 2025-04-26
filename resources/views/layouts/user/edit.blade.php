@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 500px; border-radius: 16px; border: none;">
        <!-- Close Button -->
        <a href="{{ route('user.index') }}" class="position-absolute top-0 end-0 m-3 text-secondary text-decoration-none">
            <i class="fas fa-times fs-5"></i>
        </a>

        <!-- Header -->
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2" style="color: #2c3e50;">Edit User Profile</h2>
            <p class="text-muted">Update user information below</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('user.update', $user->id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-user-tag text-primary"></i></span>
                    <input type="text" id="name" name="name" class="form-control form-control-lg" 
                        value="{{ old('name', $user->name) }}" placeholder="Enter username" required>
                </div>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-user text-primary"></i></span>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-lg"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}" placeholder="Enter full name" required>
                </div>
                @error('nama_lengkap')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hp" class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-mobile-alt text-primary"></i></span>
                    <input type="text" id="hp" name="hp" class="form-control form-control-lg"
                        value="{{ old('hp', $user->hp) }}" placeholder="Enter phone number" required>
                </div>
                @error('hp')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-at text-primary"></i></span>
                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                        value="{{ old('email', $user->email) }}" placeholder="Enter email address" required>
                </div>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-key text-primary"></i></span>
                    <input type="password" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Leave blank to keep current password">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-text">Minimum 8 characters (only enter if changing)</div>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="form-label">User Role</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-user-cog text-primary"></i></span>
                    <select id="role" name="role" class="form-select form-select-lg" required>
                        <option value="" disabled>Select user role</option>
                        @if (Auth::check())
                            @if (Auth::user()->isAdmin())
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Staff</option>
                            @elseif (Auth::user()->isPetugas())
                            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Staff</option>
                            @endif
                        @endif
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Regular User</option>
                    </select>
                </div>
                @error('role')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                    <i class="fas fa-save me-2"></i> Update Profile
                </button>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-lg py-3">
                    <i class="fas fa-arrow-left me-2"></i> Back to List
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Password visibility toggle
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Form validation
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<style>
    .card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }
    .form-control, .form-select {
        border-left: 0;
        border-radius: 0 8px 8px 0 !important;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(41, 128, 185, 0.25);
        border-color: #2980b9;
    }
    .input-group-text {
        border-right: 0;
        border-radius: 8px 0 0 8px !important;
    }
    .btn-primary {
        background-color: #2980b9;
        border-color: #2980b9;
        transition: all 0.3s;
    }
    .btn-primary:hover {
        background-color: #3498db;
        border-color: #3498db;
        transform: translateY(-2px);
    }
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }
    .alert {
        border-radius: 8px;
    }
</style>
@endsection