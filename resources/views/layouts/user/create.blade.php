@extends('welcome')

@section('content')
<div class="login-container">
    <!-- Animated Background -->
    <div class="animated-background">
        <div class="gradient-sphere sphere-1"></div>
        <div class="gradient-sphere sphere-2"></div>
        <div class="gradient-sphere sphere-3"></div>
    </div>

    <div class="login-card">
        <!-- Close Button -->
        <a href="{{ route('user.index') }}" class="close-btn">
            <i class="fas fa-times"></i>
        </a>

        <!-- Header Section -->
        <div class="login-header">
            <div class="avatar-wrapper">
                <div class="avatar-circle">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="avatar-ring"></div>
            </div>
            <h1>Create New User</h1>
            <p>Fill in the details to create a new user account</p>
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

        <!-- Create Form -->
        <form method="POST" action="{{ route('user.store') }}" class="login-form">
            @csrf
            
            <!-- Username Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-user-tag"></i>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    <label for="name">Username</label>
                </div>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Full Name Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                    <label for="nama_lengkap">Full Name</label>
                </div>
                @error('nama_lengkap')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-mobile-alt"></i>
                    <input type="text" id="hp" name="hp" value="{{ old('hp') }}" required>
                    <label for="hp">Phone Number</label>
                </div>
                @error('hp')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    <label for="email">Email Address</label>
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                    <button type="button" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="password-hint">Minimum 8 characters</div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role Selection -->
            <div class="form-group">
                <div class="input-wrapper select-wrapper">
                    <i class="fas fa-user-shield"></i>
                    <select id="role" name="role" required>
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
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <button type="submit" class="login-btn">
                <span>Create User</span>
                <i class="fas fa-user-plus"></i>
            </button>

            <a href="{{ route('user.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Back to List</span>
            </a>
        </form>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        --secondary-gradient: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(255, 255, 255, 0.18);
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
        margin: 2rem 0;
    }

    .animated-background {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .gradient-sphere {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.5;
        animation: float 15s infinite;
    }

    .sphere-1 {
        width: 500px;
        height: 500px;
        background: var(--primary-gradient);
        top: -250px;
        left: -100px;
        animation-delay: 0s;
    }

    .sphere-2 {
        width: 400px;
        height: 400px;
        background: var(--secondary-gradient);
        bottom: -200px;
        right: -100px;
        animation-delay: -5s;
    }

    .sphere-3 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation-delay: -10s;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        25% { transform: translate(50px, 50px); }
        50% { transform: translate(0, 100px); }
        75% { transform: translate(-50px, 50px); }
    }

    .login-card {
        width: 500px;
        padding: 2.5rem;
        background: var(--glass-bg);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        position: relative;
        z-index: 2;
    }

    .close-btn {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 50%;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .close-btn:hover {
        background: rgba(0, 0, 0, 0.1);
        transform: rotate(90deg);
    }

    .login-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .avatar-wrapper {
        position: relative;
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
    }

    .avatar-circle {
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        position: relative;
        z-index: 2;
    }

    .avatar-ring {
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border-radius: 50%;
        background: var(--primary-gradient);
        z-index: 1;
        opacity: 0.5;
        animation: rotate 3s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .login-header h1 {
        font-size: 1.875rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .login-header p {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
    }

    .input-wrapper input,
    .input-wrapper select {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: white;
    }

    .input-wrapper input:focus,
    .input-wrapper select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    .input-wrapper label {
        position: absolute;
        left: 3rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .input-wrapper input:focus + label,
    .input-wrapper input:not(:placeholder-shown) + label {
        top: 0;
        left: 1rem;
        font-size: 0.75rem;
        background: white;
        padding: 0 0.25rem;
    }

    .select-wrapper label {
        display: none;
    }

    .select-wrapper select {
        color: var(--text-secondary);
    }

    .select-wrapper select:focus {
        color: var(--text-primary);
    }

    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
    }

    .password-hint {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-top: 0.5rem;
        padding-left: 1rem;
    }

    .error-message {
        font-size: 0.75rem;
        color: #ef4444;
        margin-top: 0.5rem;
        padding-left: 1rem;
    }

    .login-btn {
        width: 100%;
        padding: 1rem;
        background: var(--primary-gradient);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .back-btn {
        width: 100%;
        padding: 1rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        color: var(--text-secondary);
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .back-btn:hover {
        background: #f3f4f6;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: none;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }

    @media (max-width: 480px) {
        .login-card {
            width: 100%;
            margin: 1rem;
            padding: 1.5rem;
        }
    }
</style>

<script>
    // Password visibility toggle
    document.querySelector('.toggle-password').addEventListener('click', function() {
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
    document.querySelector('.login-form').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Remove error class on input
    document.querySelectorAll('input, select').forEach(field => {
        field.addEventListener('input', function() {
            this.classList.remove('error');
        });
    });
</script>
@endsection