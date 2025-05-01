<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --secondary-color: #3a0ca3;
            --accent-color: #4cc9f0;
            --success-color: #4ade80;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --gray-color: #94a3b8;
            --sidebar-width: 280px;
            --transition-speed: 0.4s;
            --sidebar-shadow: 8px 0 30px rgba(67, 97, 238, 0.15);
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark-color);
            transition: all var(--transition-speed) ease;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 16px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(255,255,255,0) 100%);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .glass-card:hover::before {
            opacity: 1;
        }

        /* Sidebar - Modern Glass Design */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(160deg, rgba(67, 97, 238, 0.9), rgba(58, 12, 163, 0.9));
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.show {
            left: 0;
            opacity: 1;
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        }

        .sidebar-header::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 70%);
        }

        .sidebar-logo {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: rgba(255,255,255,0.1);
        }

        .sidebar-logo:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .sidebar-title {
            font-weight: 600;
            margin-bottom: 0;
            color: white;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            font-size: 1.4rem;
        }

        .sidebar-menu {
            padding: 20px 0;
            position: relative;
            z-index: 2;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            padding: 14px 25px;
            margin: 6px 15px;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-weight: 500;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            background: rgba(255, 255, 255, 0.05);
        }

        .menu-item i {
            width: 22px;
            text-align: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .menu-item:hover::before {
            left: 100%;
        }

        .menu-item:hover i {
            transform: scale(1.2);
            color: var(--accent-color);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .menu-item.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 4px;
            background: var(--accent-color);
            border-radius: 4px 0 0 4px;
            animation: pulse 2s infinite;
        }

        .sidebar-divider {
            border-top: 1px dashed rgba(255, 255, 255, 0.15);
            margin: 20px 25px;
        }

        .sidebar-section-title {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0 25px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Main Content */
        .content {
            flex-grow: 1;
            padding: 30px;
            margin-left: 0;
            transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        .content.shift {
            margin-left: var(--sidebar-width);
        }

        /* Top Bar - Modern Glass Design */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 30px;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--glass-border);
        }

        .top-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
            color: var(--dark-color);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            position: relative;
            background: rgba(67, 97, 238, 0.1);
        }

        .toggle-btn:hover {
            background: rgba(67, 97, 238, 0.2);
            color: var(--primary-color);
            transform: rotate(90deg);
        }

        .toggle-btn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover::after {
            opacity: 0.3;
            transform: scale(1.2);
        }

        .user-role {
            font-weight: 600;
            color: var(--primary-color);
            background: var(--primary-light);
            padding: 8px 18px;
            border-radius: 12px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 6px rgba(67, 97, 238, 0.1);
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
            width: 46px;
            height: 46px;
            border-radius: 14px;
            object-fit: cover;
            border: 2px solid var(--primary-color);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .user-avatar:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            border-color: var(--accent-color);
        }

        /* Enhanced Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 14px;
            padding: 8px 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.9);
            overflow: hidden;
            animation: fadeInUp 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            min-width: 240px;
        }

        .dropdown-item {
            padding: 12px 20px;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--dark-color);
            position: relative;
            overflow: hidden;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(67, 97, 238, 0.1), transparent);
            transition: all 0.6s ease;
        }

        .dropdown-item:hover {
            background: rgba(67, 97, 238, 0.05);
            color: var(--primary-color);
            padding-left: 25px;
        }

        .dropdown-item:hover::before {
            left: 100%;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover i {
            transform: scale(1.2);
            color: var(--primary-color);
        }

        .dropdown-divider {
            margin: 8px 0;
            border-color: rgba(0, 0, 0, 0.05);
        }

        .text-danger-hover:hover {
            color: var(--danger-color) !important;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            font-weight: 500;
            padding: 10px 22px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.2);
            border-radius: 12px;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 12px;
            padding: 10px 22px;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.6; }
            100% { opacity: 1; }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .sidebar.show .menu-item {
            animation: fadeIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
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
            
            .user-role {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(67, 97, 238, 0.5);
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Page transitions */
        .page-enter-active, .page-leave-active {
            transition: all 0.3s ease;
        }
        .page-enter-from, .page-leave-to {
            opacity: 0;
            transform: translateY(10px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <nav class="sidebar" id="sidebarMenu">
            <div class="sidebar-header">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2SyMhZwBzUn-Uze93_uGz7JgA9agT_Rwz9w&s" alt="Logo Sekolah" class="sidebar-logo floating">
                <h4 class="sidebar-title mt-3">Portal Alumni</h4>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ url('/') }}" class="menu-item" data-aos="fade-right" data-aos-delay="100">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ url('/alumni') }}" class="menu-item" data-aos="fade-right" data-aos-delay="150">
                    <i class="fas fa-users"></i> Data Alumni
                </a>
                <a href="{{ url('https://smkn1bontang.sch.id/') }}" class="menu-item" data-aos="fade-right" data-aos-delay="200">
                    <i class="fas fa-school"></i> SMKN 1 Bontang
                </a>
                <a href="{{ url('/home') }}" class="menu-item" data-aos="fade-right" data-aos-delay="250">
                    <i class="fas fa-user-circle"></i> Status Login
                </a>
                <a href="{{ url('/pengajar-tampilan') }}" class="menu-item" data-aos="fade-right" data-aos-delay="300">
                    <i class="fa-solid fa-chalkboard-user"></i> Pengajar
                </a>
                <a href="{{ url('/berita-tampilan') }}" class="menu-item" data-aos="fade-right" data-aos-delay="350">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
                <a href="{{ url('/lowongan-tampilan') }}" class="menu-item" data-aos="fade-right" data-aos-delay="400">
                    <i class="fas fa-briefcase"></i> Lowongan Kerja
                </a>
                
                @auth
                    @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                        <div class="sidebar-divider"></div>
                        <div class="sidebar-section-title" data-aos="fade-right" data-aos-delay="450">Admin Panel</div>
                        
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('user.index') }}" class="menu-item" data-aos="fade-right" data-aos-delay="500">
                                <i class="fas fa-user-cog"></i> Manajemen User
                            </a>
                        @endif
                        
                        <a href="{{ route('pengajar.index') }}" class="menu-item" data-aos="fade-right" data-aos-delay="550">
                            <i class="fas fa-chalkboard-teacher"></i> Tambah Pengajar
                        </a>
                        <a href="{{ route('tmbberita.index') }}" class="menu-item" data-aos="fade-right" data-aos-delay="600">
                            <i class="fas fa-edit"></i> Tambah Berita
                        </a>
                        <a href="{{ route('lowongan.index') }}" class="menu-item" data-aos="fade-right" data-aos-delay="650">
                            <i class="fas fa-plus-circle"></i> Tambah Lowongan
                        </a>
                    @endif
                @endauth
            </div>
            
            <div class="position-absolute bottom-0 start-0 end-0 p-4 text-center" style="color: rgba(255,255,255,0.7); font-size: 0.8rem;">
                &copy; {{ date('Y') }} SMKN 1 Bontang
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content" id="mainContent">
            @if (!isset($showUserUI) || $showUserUI)
            <div class="top-bar animate__animated animate__fadeIn" data-aos="fade-down">
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
                                <a class="btn btn-outline-primary btn-sm animate__animated animate__fadeInRight" href="{{ route('login') }}" data-aos="zoom-in" data-aos-delay="100">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            @endif
                            
                            @if (Route::has('register'))
                                <a class="btn btn-primary btn-sm animate__animated animate__fadeInRight" href="{{ route('register') }}" data-aos="zoom-in" data-aos-delay="150">
                                    <i class="fas fa-user-plus me-1"></i> Daftar
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center animate__animated animate__fadeIn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-aos="zoom-in">
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

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/profile') }}" data-aos="fade-up" data-aos-delay="50">
                                        <i class="fas fa-user-circle me-2"></i> Profil Saya
                                        <small class="d-block text-muted mt-1">Kelola akun Anda</small>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item text-danger-hover" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        data-aos="fade-up" data-aos-delay="100">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        <small class="d-block text-muted mt-1">Keluar dari sistem</small>
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
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 600,
            easing: 'ease-out-quad',
            once: true,
            offset: 50
        });

        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebarMenu");
            const content = document.getElementById("mainContent");
            const toggleBtn = document.getElementById("toggleSidebar");

            // Check local storage for sidebar state
            if (localStorage.getItem("sidebarOpen") === "true") {
                sidebar.classList.add("show");
                content.classList.add("shift");
            }

            // Toggle sidebar with animation
            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("show");
                content.classList.toggle("shift");
                localStorage.setItem("sidebarOpen", sidebar.classList.contains("show"));
                
                // Refresh AOS after sidebar toggle
                setTimeout(() => {
                    AOS.refresh();
                }, 400);
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
                    sidebar.classList.remove('show');
                    content.classList.remove('shift');
                    localStorage.setItem("sidebarOpen", false);
                }
            });
            
            // Add animation to elements when they come into view
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.glass-card, .btn, .menu-item');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;
                    
                    if (elementPosition < screenPosition) {
                        element.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            };
            
            window.addEventListener('scroll', animateOnScroll);
            // Initial check in case elements are already in view
            animateOnScroll();
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>