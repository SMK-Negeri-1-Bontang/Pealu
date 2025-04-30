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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
            --sidebar-width: 280px;
            --transition-speed: 0.4s;
            --border-radius: 12px;
            --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
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
            transition: all var(--transition-speed) cubic-bezier(0.68, -0.55, 0.265, 1.55);
            overflow-y: auto;
            z-index: 1050;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.15);
            transform: translateX(-20px);
            opacity: 0;
        }

        .sidebar.show {
            left: 0;
            transform: translateX(0);
            opacity: 1;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
            z-index: 0;
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar img:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .sidebar h4 {
            font-weight: 600;
            margin-bottom: 0;
            color: white;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            padding: 14px 20px;
            margin: 8px 15px;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-weight: 500;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.05);
        }

        .menu-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: white;
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.3s ease;
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .menu-item:hover i {
            transform: scale(1.2);
        }

        .menu-item:hover::after {
            transform: scaleY(1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .menu-item.active::after {
            transform: scaleY(1);
        }

        .sidebar-divider {
            border-top: 1px dashed rgba(255, 255, 255, 0.2);
            margin: 20px 25px;
        }

        .admin-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            padding: 0 25px;
            margin-bottom: 10px;
            display: block;
        }

        /* Main Content */
        .content {
            flex-grow: 1;
            padding: 25px;
            margin-left: 0;
            transition: margin-left var(--transition-speed) ease, padding var(--transition-speed) ease;
            min-height: 100vh;
        }

        .content.shift {
            margin-left: var(--sidebar-width);
            padding-left: 35px;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 30px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            transition: all var(--transition-speed) ease;
            position: relative;
            z-index: 10;
        }

        .top-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
            color: var(--dark-color);
            transition: all 0.3s ease;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: relative;
        }

        .toggle-btn:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
            transform: rotate(90deg);
        }

        .toggle-btn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
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
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .user-role:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(67, 97, 238, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            padding: 10px 0;
            border-top: 3px solid var(--primary-color);
            animation: fadeInDown 0.3s ease;
        }

        .dropdown-item {
            padding: 10px 20px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .dropdown-divider {
            margin: 8px 0;
            border-top: 1px dashed rgba(0, 0, 0, 0.1);
        }

        /* Main content animations */
        main {
            animation: fadeIn 0.6s ease;
        }

        /* Button styles */
        .btn {
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 18px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }

        /* Card styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 15px 20px;
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

        /* Custom animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Animation for sidebar items */
        .sidebar.show .menu-item {
            animation: fadeInLeft 0.4s ease forwards;
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
        
        /* Floating notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
            animation: pulse 1.5s infinite;
        }
        
        /* Hover effects for cards */
        .hover-effect {
            transition: all 0.3s ease;
        }
        
        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <nav class="sidebar" id="sidebarMenu">
            <div class="sidebar-header">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2SyMhZwBzUn-Uze93_uGz7JgA9agT_Rwz9w&s" alt="Logo Sekolah" class="animate__animated animate__fadeIn">
                <h4 class="animate__animated animate__fadeIn">Portal Alumni</h4>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ url('/') }}" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="{{ url('/alumni') }}" class="menu-item"><i class="fas fa-users"></i> Data Alumni</a>
                <a href="{{ url('https://smkn1bontang.sch.id/') }}" class="menu-item"><i class="fas fa-school"></i> SMKN 1 Bontang</a>
                <a href="{{ url('/home') }}" class="menu-item"><i class="fas fa-user-circle"></i> Status Login</a>
                <a href="{{ url('/pengajar-tampilan') }}" class="menu-item"><i class="fa-solid fa-chalkboard-user"></i> Pengajar</a>
                <a href="{{ url('/berita-tampilan') }}" class="menu-item"><i class="fas fa-newspaper"></i> Berita</a>
                <a href="{{ url('/lowongan-tampilan') }}" class="menu-item"><i class="fas fa-briefcase"></i> Lowongan Kerja</a>
                
                @auth
                    @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                        <div class="sidebar-divider"></div>
                        <span class="admin-label animate__animated animate__fadeIn">Admin Panel</span>
                        
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('user.index') }}" class="menu-item"><i class="fas fa-user-cog"></i> Manajemen User</a>
                        @endif
                        
                        <a href="{{ route('pengajar.index') }}" class="menu-item"><i class="fas fa-plus-circle"></i> Tambah Pengajar</a>
                        <a href="{{ route('tmbberita.index') }}" class="menu-item"><i class="fas fa-plus-circle"></i> Tambah Berita</a>
                        <a href="{{ route('lowongan.index') }}" class="menu-item"><i class="fas fa-plus-circle"></i> Tambah Lowongan</a>
                    @endif
                @endauth
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content" id="mainContent">
            @if (!isset($showUserUI) || $showUserUI)
            <div class="top-bar animate__animated animate__fadeInDown">
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
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            @endif
                            
                            @if (Route::has('register'))
                                <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
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
    

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        <i class="fas fa-user-circle me-2"></i> Profil Saya
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
                
                // Add animation class when toggling
                if (sidebar.classList.contains("show")) {
                    document.querySelectorAll('.sidebar-menu .menu-item').forEach((item, index) => {
                        item.style.animationDelay = `${0.1 + (index * 0.05)}s`;
                        item.classList.add('animate__animated', 'animate__fadeInLeft');
                    });
                }
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
            
            // Add hover effects to all cards
            document.querySelectorAll('.card').forEach(card => {
                card.classList.add('hover-effect');
            });
            
            // Add animation to main content
            document.querySelector('main').classList.add('animate__animated', 'animate__fadeIn');
        });
    </script>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- GSAP for advanced animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    
    <script>
        // Advanced animations with GSAP
        document.addEventListener("DOMContentLoaded", function() {
            // Animate the logo on load
            gsap.from(".sidebar img", {
                duration: 1,
                y: -30,
                opacity: 0,
                ease: "back.out(1.7)",
                delay: 0.3
            });
            
            // Animate the sidebar title
            gsap.from(".sidebar h4", {
                duration: 0.8,
                y: 20,
                opacity: 0,
                ease: "power2.out",
                delay: 0.5
            });
            
            
        });
    </script>
</body>

</html>