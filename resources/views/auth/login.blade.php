@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="card shadow-lg p-5" style="width: 450px; border-radius: 16px; border: none;">
        <!-- Close Button -->
        <a href="{{ url('/') }}" class="position-absolute top-0 end-0 m-3 text-secondary text-decoration-none">
            <i class="fas fa-times fs-5"></i>
        </a>

        <!-- Header -->
        <div class="text-center mb-4">
            <div class="mb-3">
                <i class="fas fa-user-circle fa-4x text-primary"></i>
            </div>
            <h2 class="fw-bold mb-2" style="color: #2c3e50;">Welcome Back</h2>
        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf
            
            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="form-label fw-medium">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" id="email" name="email" class="form-control form-control-lg py-2" 
                        placeholder="Enter your email" required
                        style="border-left: none;">
                </div>
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label for="password" class="form-label fw-medium">Password</label>
                    <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">Forgot password?</a>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" id="password" name="password" class="form-control form-control-lg py-2" 
                        placeholder="Enter your password" required
                        style="border-left: none;">
                    <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

          

            <!-- Login Button -->
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                    <i class="fas fa-sign-in-alt me-2"></i> login
                </button>
            </div>

           

            <!-- Register Link -->
            <div class="text-center">
                <p class="small text-muted">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary fw-medium text-decoration-none">Create one</a>
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
    .form-check-input:checked {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    .rounded-circle {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection