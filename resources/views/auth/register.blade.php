@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="card shadow-lg p-5" style="width: 500px; border-radius: 16px; border: none;">
        <!-- Close Button -->
        <a href="{{ url('/') }}" class="position-absolute top-0 end-0 m-3 text-secondary text-decoration-none">
            <i class="fas fa-times fs-5"></i>
        </a>

        <!-- Header -->
        <div class="text-center mb-4">
            <div class="mb-3">
                <i class="fas fa-user-plus fa-4x text-primary"></i>
            </div>
            <h2 class="fw-bold mb-2" style="color: #2c3e50;">Create Account</h2>
            <p class="text-muted">Join us today</p>
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

        <form method="POST" action="{{ route('user.store') }}" class="needs-validation" novalidate>
            @csrf

            <!-- Username Field -->
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-user-tag text-muted"></i></span>
                    <input type="text" id="name" name="name" class="form-control form-control-lg py-2" 
                        value="{{ old('name') }}" placeholder="Choose username" required>
                </div>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Full Name Field -->
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label fw-medium">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-lg py-2"
                        value="{{ old('nama_lengkap') }}" placeholder="Your full name" required>
                </div>
                @error('nama_lengkap')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div class="mb-3">
                <label for="hp" class="form-label fw-medium">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-mobile-alt text-muted"></i></span>
                    <input type="text" id="hp" name="hp" class="form-control form-control-lg py-2"
                        value="{{ old('hp') }}" placeholder="Your phone number" required>
                </div>
                @error('hp')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" id="email" name="email" class="form-control form-control-lg py-2"
                        value="{{ old('email') }}" placeholder="Your email address" required>
                </div>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label fw-medium">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" id="password" name="password" class="form-control form-control-lg py-2"
                        placeholder="Create password" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-text">Minimum 8 characters</div>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label for="role" class="form-label fw-medium">Account Type</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-user-shield text-muted"></i></span>
                    <select id="role" name="role" class="form-select form-select-lg py-2" required>
                        <option value="" disabled selected>Select account type</option>
                        @if (Auth::check())
                            @if (Auth::user()->isAdmin())
                            <option value="admin">Administrator</option>
                            <option value="petugas">Staff</option>
                            @elseif (Auth::user()->isPetugas())
                            <option value="petugas">Staff</option>
                            @endif
                        @endif
                        <option value="user">Regular User</option>
                    </select>
                </div>
                @error('role')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                    <i class="fas fa-user-plus me-2"></i> Create Account
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="small text-muted">Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary fw-medium text-decoration-none">Sign in</a>
                </p>
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
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .form-control, .form-select {
        border-left: 0;
        border-radius: 0 8px 8px 0 !important;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(41, 128, 185, 0.15);
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
        box-shadow: 0 4px 8px rgba(41, 128, 185, 0.2);
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }
    .alert {
        border-radius: 8px;
    }
</style>
@endsection