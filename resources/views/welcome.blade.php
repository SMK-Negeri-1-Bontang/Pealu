<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Alumni</title>
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">
    <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Lottie Animations -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    @stack('styles')

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --secondary-color: #3a0ca3;
            --accent-color: #4cc9f0;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 300px;
            --transition-speed: 0.4s;
            --border-radius: 16px;
            --card-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --sidebar-shadow: 8px 0 30px rgba(67, 97, 238, 0.15);
            --gradient-primary: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --gradient-accent: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
        }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: var(--border-radius);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar - Modern Design */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--gradient-primary);
            color: white;
            position: fixed;
            left: calc(-1 * var(--sidebar-width));
            top: 0;
            bottom: 0;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            z-index: 1050;
            box-shadow: var(--sidebar-shadow);
            opacity: 0;
            transform: translateX(-20px);
        }

        .sidebar.show {
            left: 0;
            opacity: 1;
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        .sidebar img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 1;
        }

        .sidebar img:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 0;
            color: white;
            font-size: 1.3rem;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .sidebar-menu {
            padding: 15px 0;
            position: relative;
            z-index: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            padding: 14px 25px;
            margin: 8px 15px;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .menu-item:hover i {
            transform: scale(1.2);
            color: var(--accent-color);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            height: 100%;
            width: 4px;
            background: var(--accent-color);
            border-radius: 0 3px 3px 0;
        }

        .menu-item .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Main Content */
        .content {
            flex-grow: 1;
            padding: 30px;
            margin-left: 0;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            background-color: #f5f7ff;
        }

        .content.shift {
            margin-left: var(--sidebar-width);
        }

        /* Top Bar - Modern Design */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: all var(--transition-speed) ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.4rem;
            cursor: pointer;
            color: var(--dark-color);
            transition: all 0.3s ease;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            background: rgba(67, 97, 238, 0.1);
        }

        .toggle-btn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: var(--primary-light);
            border-radius: 12px;
            transform: scale(0);
            transition: transform 0.3s ease;
            z-index: -1;
        }

        .toggle-btn:hover {
            color: var(--primary-color);
            transform: rotate(90deg);
        }

        .toggle-btn:hover::after {
            transform: scale(1);
        }

        .user-role {
            font-weight: 600;
            color: var(--primary-color);
            background: var(--primary-light);
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(67, 97, 238, 0.1);
            border: 1px solid rgba(67, 97, 238, 0.1);
        }

        .user-role:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(67, 97, 238, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--primary-light);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .user-avatar:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
            border-color: var(--accent-color);
        }

       /* Dropdown Menu Enhancements */
        .dropdown-menu {
            border-radius: 12px;
            padding: 8px 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transform-origin: top right;
            animation: dropdownFadeIn 0.2s ease-out forwards;
            z-index: 1100;
        }

        .dropdown-item {
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 2px 8px;
        }

        .dropdown-item:hover {
            background: rgba(67, 97, 238, 0.08);
            transform: translateX(3px);
        }

        .dropdown-divider {
            opacity: 0.1;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Navigation Links */
        .nav-link {
            color: var(--dark-color);
            font-weight: 500;
            transition: all 0.2s ease;
            padding: 8px 12px;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 12px;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: calc(100% - 24px);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.show {
                left: 0;
            }
            .content.shift {
                margin-left: 0;
                position: relative;
                z-index: 1;
            }
            
            .top-bar {
                padding: 15px 20px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidebar.show .menu-item {
            animation: fadeInLeft 0.5s ease forwards;
            opacity: 0;
        }

        .sidebar.show .menu-item:nth-child(1) { animation-delay: 0.1s; }
        .sidebar.show .menu-item:nth-child(2) { animation-delay: 0.15s; }
        .sidebar.show .menu-item:nth-child(3) { animation-delay: 0.2s; }
        .sidebar.show .menu-item:nth-child(4) { animation-delay: 0.25s; }
        .sidebar.show .menu-item:nth-child(5) { animation-delay: 0.3s; }
        .sidebar.show .menu-item:nth-child(6) { animation-delay: 0.35s; }
        .sidebar.show .menu-item:nth-child(7) { animation-delay: 0.4s; }
        .sidebar.show .menu-item:nth-child(8) { animation-delay: 0.45s; }
        .sidebar.show .menu-item:nth-child(9) { animation-delay: 0.5s; }
        .sidebar.show .menu-item:nth-child(10) { animation-delay: 0.55s; }

        /* Floating animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .floating {
            animation: float 5s ease-in-out infinite;
        }

        /* Ripple effect */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }

        .btn-ripple .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(67, 97, 238, 0.6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Background elements */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(67, 97, 238, 0.05);
            filter: blur(60px);
        }

        .bg-circle:nth-child(1) {
            width: 500px;
            height: 500px;
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .bg-circle:nth-child(2) {
            width: 300px;
            height: 300px;
            bottom: -50px;
            left: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }

        /* Custom buttons */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }

        .btn-outline-primary {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            border-width: 2px;
        }

        .btn-outline-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }


        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Loading animation */
        .loading-animation {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        }

        .loading-dot {
            width: 12px;
            height: 12px;
            margin: 0 5px;
            background: var(--primary-color);
            border-radius: 50%;
            animation: loading 1.2s infinite ease-in-out;
        }

        .loading-dot:nth-child(1) {
            animation-delay: 0s;
        }
        .loading-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        .loading-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes loading {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        /* Card hover effect */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px) rotate(1deg);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Background elements -->
    <div class="bg-elements">
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
    </div>

    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <nav class="sidebar" id="sidebarMenu">
            <div class="sidebar-header">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2SyMhZwBzUn-Uze93_uGz7JgA9agT_Rwz9w&s" alt="Logo Sekolah" class="floating">
                <h4>Portal Alumni</h4>
                <small class="text-white-50">SMKN 1 Bontang</small>
            </div>
            <div class="sidebar-menu">
                <a href="{{ url('/') }}" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i> 
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/alumni') }}" class="menu-item">
                    <i class="fas fa-users"></i> 
                    <span>Data Alumni</span>
                </a>
                <a href="{{ url('https://smkn1bontang.sch.id/') }}" class="menu-item">
                    <i class="fas fa-school"></i> 
                    <span>SMKN 1 Bontang</span>
                </a>
                <a href="{{ url('/home') }}" class="menu-item">
                    <i class="fas fa-user-circle"></i> 
                    <span>Status Login</span>
                </a>
                <a href="{{ url('/pengajar-tampilan') }}" class="menu-item">
                    <i class="fa-solid fa-chalkboard-user"></i> 
                    <span>Pengajar</span>
                </a>
                <a href="{{ url('/berita-tampilan') }}" class="menu-item">
                    <i class="fas fa-newspaper"></i> 
                    <span>Berita</span>
                </a>
                <a href="{{ url('/lowongan-tampilan') }}" class="menu-item">
                    <i class="fas fa-briefcase"></i> 
                    <span>Lowongan Kerja</span>
                </a>
                
                @auth
                    @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                        <div class="sidebar-divider my-3 mx-3 border-top border-light opacity-25"></div>
                        <h6 class="text-uppercase text-white small fw-bold ps-4 mb-2 mt-3">Admin Panel</h6>
                        
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('user.index') }}" class="menu-item">
                                <i class="fas fa-user-cog"></i> 
                                <span>Manajemen User</span>
                            </a>
                        @endif
                        
                        <a href="{{ route('pengajar.index') }}" class="menu-item">
                            <i class="fas fa-plus-circle"></i> 
                            <span>Tambah Pengajar</span>
                        </a>
                        <a href="{{ route('tmbberita.index') }}" class="menu-item">
                            <i class="fas fa-plus-circle"></i> 
                            <span>Tambah Berita</span>
                        </a>
                        <a href="{{ route('lowongan.index') }}" class="menu-item">
                            <i class="fas fa-plus-circle"></i> 
                            <span>Tambah Lowongan</span>
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Sidebar footer -->
            <div class="sidebar-footer mt-auto p-4 text-center text-white-50 small">
                <div class="mb-2">
                </div>
                <p>Portal Alumni v1.0</p>
                <p>&copy; 2025 SMKN 1 Bontang</p>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content" id="mainContent">
            @if (!isset($showUserUI) || $showUserUI)
            <div class="top-bar glass-card" data-aos="fade-down">
                <div class="d-flex align-items-center">
                    <button class="toggle-btn me-3" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <span class="user-role">
                        @auth
                            @if (Auth::user()->isAdmin())
                                <i class="fas fa-shield-alt"></i> Administrator
                            @elseif (Auth::user()->isPetugas())
                                <i class="fas fa-user-tie"></i> Staff
                            @elseif (Auth::user()->isUser())
                                <i class="fas fa-user-graduate"></i> Alumni
                            @endif
                        @else
                            <i class="fas fa-user"></i> Pengunjung
                        @endauth
                    </span>
                </div>
                
                <div class="user-info">
                    @guest
                        <div class="d-flex gap-3">
                            @if (Route::has('login'))
                                <a class="btn btn-outline-primary btn-sm btn-ripple" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            @endif
                            
                            @if (Route::has('register'))
                                <a class="btn btn-primary btn-sm btn-ripple" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i> Daftar
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-md-inline me-2 fw-medium">Halo, {{ Auth::user()->name }}</span>
                                @php
                                    $userImage = Auth::user()->image;
                                @endphp
                                
                                @if($userImage)
                                    @if(\Illuminate\Support\Str::startsWith($userImage, ['http://', 'https://']))
                                        <img src="{{ $userImage }}" alt="avatar" class="user-avatar">
                                    @else
                                        <img src="{{ asset('storage/' . $userImage) }}" alt="avatar" class="user-avatar">
                                    @endif
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4361ee&color=fff" alt="avatar" class="user-avatar">
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="min-width: 220px; border: none; overflow: visible;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="{{ url('/profile') }}">
                                        <i class="fas fa-user-circle me-3 text-primary"></i> 
                                        <div>
                                            <div class="fw-medium">Profil Saya</div>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2 px-3 text-danger" 
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-3"></i> 
                                        <div>
                                            <div class="fw-medium">Logout</div>
                                        </div>
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
            @endif
            
            <main class="py-4">
                @yield('content')
                @stack('modal')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- GSAP for advanced animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out-quad',
                once: true,
                offset: 50
            });
            
            const sidebar = document.getElementById("sidebarMenu");
            const content = document.getElementById("mainContent");
            const toggleBtn = document.getElementById("toggleSidebar");

            // Check local storage for sidebar state
            if (localStorage.getItem("sidebarOpen") === "true") {
                sidebar.classList.add("show");
                content.classList.add("shift");
            }

            // Toggle sidebar with GSAP animation
            toggleBtn.addEventListener("click", function() {
                if (sidebar.classList.contains("show")) {
                    gsap.to(sidebar, {
                        x: -sidebar.offsetWidth,
                        opacity: 0,
                        duration: 0.4,
                        ease: "power2.inOut",
                        onComplete: () => sidebar.classList.remove("show")
                    });
                    content.classList.remove("shift");
                } else {
                    sidebar.classList.add("show");
                    gsap.fromTo(sidebar, 
                        { x: -sidebar.offsetWidth, opacity: 0 },
                        { x: 0, opacity: 1, duration: 0.4, ease: "power2.inOut" }
                    );
                    content.classList.add("shift");
                }
                localStorage.setItem("sidebarOpen", sidebar.classList.contains("show"));
            });

            // Add ripple effect to menu items
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.btn-ripple').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Mark active menu item
            document.querySelectorAll(".menu-item").forEach(item => {
                try {
                    const itemUrl = new URL(item.href);
                    const currentUrl = new URL(window.location.href);
                    
                    if (itemUrl.host !== currentUrl.host) {
                        return;
                    }
                    
                    const currentPath = currentUrl.pathname;
                    const itemPath = itemUrl.pathname;
                    
                    if (itemPath === '/' && currentPath === '/') {
                        item.classList.add("active");
                    }
                    else if (itemPath !== '/' && currentPath.startsWith(itemPath)) {
                        item.classList.add("active");
                    }
                } catch (e) {
                    console.error("Error processing menu item:", e);
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggleBtn = toggleBtn.contains(event.target);
                
                if (window.innerWidth <= 992 && !isClickInsideSidebar && !isClickOnToggleBtn && sidebar.classList.contains('show')) {
                    gsap.to(sidebar, {
                        x: -sidebar.offsetWidth,
                        opacity: 0,
                        duration: 0.3,
                        ease: "power2.inOut",
                        onComplete: () => sidebar.classList.remove("show")
                    });
                    content.classList.remove("shift");
                    localStorage.setItem("sidebarOpen", false);
                }
            });

            // Background animation
            const circles = document.querySelectorAll('.bg-circle');
            circles.forEach((circle, index) => {
                gsap.to(circle, {
                    duration: 10 + (index * 5),
                    x: index % 2 === 0 ? 50 : -50,
                    y: index % 2 === 0 ? -50 : 50,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                });
            });
        });
    </script>
</body>

</html>