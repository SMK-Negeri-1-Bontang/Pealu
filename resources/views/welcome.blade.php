<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Alumni SMKN 1 Bontang</title>
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">
    <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-light: #e0e7ff;
            --secondary-color: #6366f1;
            --accent-color: #8b5cf6;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --muted-color: #64748b;
            --sidebar-width: 280px;
            --transition-speed: 0.3s;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark-color);
            transition: all var(--transition-speed) ease;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            color: white;
            position: fixed;
            left: calc(-1 * var(--sidebar-width));
            top: 0;
            bottom: 0;
            transition: all var(--transition-speed) ease;
            overflow-y: auto;
            z-index: 1050;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.05);
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .sidebar img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 0;
            color: white;
            letter-spacing: -0.5px;
            font-size: 1.25rem;
        }

        .sidebar-menu {
            padding: 20px 0;
            flex-grow: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            padding: 12px 25px;
            margin: 5px 15px;
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            font-weight: 500;
            position: relative;
            font-size: 0.95rem;
        }

        .menu-item i {
            width: 24px;
            text-align: center;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .menu-item:hover i {
            transform: scale(1.1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            height: 100%;
            width: 4px;
            background: white;
            border-radius: 0 3px 3px 0;
        }

        .sidebar-divider {
            margin: 15px 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-footer {
            padding: 15px;
            text-align: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Main Content */
        .content {
            flex-grow: 1;
            padding: 30px;
            margin-left: 0;
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
        }

        .content.shift {
            margin-left: var(--sidebar-width);
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: margin-left var(--transition-speed) ease;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: var(--dark-color);
            transition: all 0.2s ease;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--primary-light);
        }

        .toggle-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: rotate(90deg);
        }

        .user-role {
            font-weight: 600;
            color: var(--primary-color);
            background: var(--primary-light);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-light);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--card-shadow-hover);
            border-radius: var(--radius-md);
            padding: 10px 0;
            margin-top: 10px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dropdown-item {
            padding: 8px 16px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            transform: translateX(3px);
        }

        .dropdown-divider {
            margin: 5px 0;
            opacity: 0.2;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
        }

        /* Navigation Links */
        .nav-link {
            color: var(--dark-color);
            font-weight: 500;
            transition: all 0.2s ease;
            padding: 8px 12px;
        }

        .nav-link:hover {
            color: var(--primary-color);
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
                padding: 12px 20px;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }
            
            .user-role {
                font-size: 0.75rem;
                padding: 4px 10px;
            }
        }

        /* Animation for sidebar toggle */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .sidebar.show .menu-item {
            animation: fadeIn 0.3s ease forwards;
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

        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <nav class="sidebar" id="sidebarMenu">
            <div class="sidebar-header">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2SyMhZwBzUn-Uze93_uGz7JgA9agT_Rwz9w&s" alt="Logo SMKN 1 Bontang">
                <h4>Portal Alumni</h4>
                <small class="text-white-50">SMKN 1 Bontang</small>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ url('/') }}" class="menu-item"><i class="fas fa-home"></i> Beranda</a>
                <a href="{{ url('/alumni') }}" class="menu-item"><i class="fas fa-users"></i> Data Alumni</a>
                <a href="{{ url('https://smkn1bontang.sch.id/') }}" class="menu-item"><i class="fas fa-school"></i> SMKN 1 Bontang</a>
                <a href="{{ url('/home') }}" class="menu-item"><i class="fas fa-user-circle"></i> Profil Saya</a>
                <a href="{{ url('/pengajar-tampilan') }}" class="menu-item"><i class="fa-solid fa-chalkboard-user"></i> Pengajar</a>
                <a href="{{ url('/berita-tampilan') }}" class="menu-item"><i class="fas fa-newspaper"></i> Berita</a>
                <a href="{{ url('/lowongan') }}" class="menu-item"><i class="fas fa-briefcase"></i> Lowongan Kerja</a>
                
                @auth
                    @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                        <div class="sidebar-divider"></div>
                        <h6 class="text-uppercase text-white-50 small fw-bold ps-4 mb-2 mt-3">Admin Panel</h6>
                        
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('user.index') }}" class="menu-item"><i class="fas fa-user-cog"></i> Manajemen User</a>
                        @endif
                        
                        <a href="{{ route('pengajar.index') }}" class="menu-item"><i class="fas fa-plus-circle"></i> Tambah Pengajar</a>
                        <a href="{{ route('tmbberita.index') }}" class="menu-item"><i class="fas fa-plus-circle"></i> Tambah Berita</a>
                        <a href="{{ route('lowongan.create') }}" class="menu-item"><i class="fas fa-plus-circle"></i> Tambah Lowongan</a>
                    @endif
                @endauth
            </div>
            
            <div class="sidebar-footer">
                <small>© 2025 SMKN 1 Bontang</small>
            </div>
        </nav>

        <!-- Sidebar overlay for mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="content" id="mainContent">
            @if (!isset($showUserUI) || $showUserUI)
            <div class="top-bar">
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
                                <a class="btn btn-outline-primary btn-sm px-3" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            @endif
                            
                            @if (Route::has('register'))
                                <a class="btn btn-primary btn-sm px-3" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i> Daftar
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-md-inline me-2 fw-medium">{{ Auth::user()->name }}</span>
                                @php
                                    $userImage = Auth::user()->image;
                                @endphp
                                
                                @if($userImage)
                                    <div class="position-relative">
                                        @if(\Illuminate\Support\Str::startsWith($userImage, ['http://', 'https://']))
                                            <img src="{{ $userImage }}" alt="avatar" class="user-avatar">
                                        @else
                                            <img src="{{ asset('storage/' . $userImage) }}" alt="avatar" class="user-avatar">
                                        @endif
                                        <span class="notification-badge">3</span>
                                    </div>
                                @else
                                    <div class="position-relative">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="avatar" class="user-avatar">
                                        <span class="notification-badge">3</span>
                                    </div>
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        <i class="fas fa-user-circle me-2"></i> Profil Saya
                                    </a>
                                </li>
                                @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-bell me-2"></i> Notifikasi
                                        <span class="notification-badge" style="position: static; margin-left: auto;">3</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebarMenu");
            const content = document.getElementById("mainContent");
            const toggleBtn = document.getElementById("toggleSidebar");
            const overlay = document.getElementById("sidebarOverlay");

            // Check local storage for sidebar state
            if (localStorage.getItem("sidebarOpen") === "true") {
                sidebar.classList.add("show");
                content.classList.add("shift");
                if (window.innerWidth <= 992) {
                    overlay.classList.add("show");
                }
            }

            // Toggle sidebar
            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("show");
                content.classList.toggle("shift");
                overlay.classList.toggle("show");
                localStorage.setItem("sidebarOpen", sidebar.classList.contains("show"));
            });

            // Close sidebar when clicking overlay
            overlay.addEventListener("click", function() {
                sidebar.classList.remove("show");
                content.classList.remove("shift");
                overlay.classList.remove("show");
                localStorage.setItem("sidebarOpen", false);
            });

            // Mark active menu item
            document.querySelectorAll(".menu-item").forEach(item => {
                if (item.href === window.location.href || 
                    (window.location.href.includes(item.href) && item.href !== "{{ url('/') }}")) {
                    item.classList.add("active");
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggleBtn = toggleBtn.contains(event.target);
                
                if (window.innerWidth <= 992 && !isClickInsideSidebar && !isClickOnToggleBtn && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    content.classList.remove('shift');
                    overlay.classList.remove('show');
                    localStorage.setItem("sidebarOpen", false);
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    overlay.classList.remove('show');
                } else if (sidebar.classList.contains('show')) {
                    overlay.classList.add('show');
                }
            });
        });

        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>