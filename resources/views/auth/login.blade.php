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
        <a href="{{ url('/') }}" class="close-btn">
            <i class="fas fa-times"></i>
        </a>

        <!-- Header Section -->
        <div class="login-header">
            <div class="avatar-wrapper">
                <div class="avatar-circle">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="avatar-ring"></div>
            </div>
            <h1>Welcome Back</h1>
            <p>Sign in to continue your journey</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            
            <!-- Email Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email address</label>
                </div>
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
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <span class="checkmark"></span>
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn">
                <span>Sign In</span>
                <i class="fas fa-arrow-right"></i>
            </button>

            <!-- Register Link -->
            <div class="register-link">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
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
        width: 450px;
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

    .input-wrapper input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .input-wrapper input:focus {
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

    .forgot-password {
        display: block;
        text-align: right;
        color: #6366f1;
        font-size: 0.875rem;
        text-decoration: none;
        margin-top: 0.5rem;
    }

    .remember-me {
        margin-bottom: 1.5rem;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        cursor: pointer;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .custom-checkbox input {
        display: none;
    }

    .checkmark {
        width: 18px;
        height: 18px;
        border: 2px solid #e5e7eb;
        border-radius: 4px;
        margin-right: 0.5rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .custom-checkbox input:checked + .checkmark {
        background: #6366f1;
        border-color: #6366f1;
    }

    .custom-checkbox input:checked + .checkmark::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 0.75rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
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
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .register-link {
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-top: 1.5rem;
    }

    .register-link a {
        color: #6366f1;
        text-decoration: none;
        font-weight: 500;
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
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        
        if (!email.value || !password.value) {
            e.preventDefault();
            if (!email.value) email.classList.add('error');
            if (!password.value) password.classList.add('error');
        }
    });

    // Remove error class on input
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
        });
    });
</script>
@endsection