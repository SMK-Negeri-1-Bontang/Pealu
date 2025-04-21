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
    
    <style>
        body {
            transition: all 0.3s ease;
            background: #D9D9D9;
        }
        /* Sidebar */
        .sidebar {
            width: 350px;
            background: #2E2E2E;
            color: white;
            padding: 20px;
            position: fixed;
            left: -350px;
            top: 0;
            bottom: 0;
            transition: all 0.3s ease;
            overflow-y: auto;
            max-height: 100vh;
        }  
        .sidebar.show {
            left: 0;
        }
        .sidebar img {
            width: 100px;
            display: block;
            margin: 0 auto 15px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #979797;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a i {
            width: 20px;
            text-align: center;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #979797;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 25px;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }
        .content.shift {
            margin-left: 350px;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: margin-left 0.3s ease;
        }
        .toggle-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #212529;
        }
        .toggle-btn:hover {
            color: #979797;
        }
    </style>
</head>
<body>
    <nav>
        <div class="sidebar" id="sidebarMenu">
            <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2SyMhZwBzUn-Uze93_uGz7JgA9agT_Rwz9w&s" alt="Logo Sekolah">
            <h4 class="text-center pb-4">Penelusuran Alumni</h4>
            <a href="{{ url('/') }}" class="menu-item"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ url('/alumni') }}" class="menu-item"><i class="fas fa-users"></i> Alumni</a>
            <a href="{{ url('https://smkn1bontang.sch.id/') }}" class="menu-item"><i class="fas fa-school"></i> SMKN 1 Bontang</a>
            <a href="{{ url('/home') }}" class="menu-item"><i class="fas fa-sign-in-alt"></i> Status Login</a>
            <a href="{{ url('/pengajar-tampilan') }}" class="menu-item"><i class="fa-solid fa-person-chalkboard"></i>Data Pengajar</a>
            <a href="{{ url('/berita-tampilan') }}" class="menu-item"><i class="fas fa-newspaper"></i> Berita</a>
            <a href="#" class="menu-item"><i class="fas fa-briefcase"></i> Lowongan</a>
            @auth

                @if (Auth::user()->isAdmin())
                <a href="{{ route('user.index') }}" class="menu-item"><i class="fas fa-user"></i> Table User</a>
                <a href="{{ route('pengajar.index') }}" class="menu-item"><i class="fas fa-plus"></i>Tambah Pengajar</a>
                <a href="{{ route('tmbberita.index') }}" class="menu-item"><i class="fas fa-plus"></i> Tambah Berita</a>
                <a href="{{ route('lowongan.index') }}" class="menu-item"><i class="fas fa-plus"></i> Tambah Lowongan</a>
                @elseif (Auth::user()->isPetugas())
                <a href="{{ route('user.index') }}" class="menu-item"><i class="fas fa-user"></i> Table User</a>
                <a href="{{ route('pengajar.index') }}" class="menu-item"><i class="fas fa-plus"></i>Tambah Pengajar</a>
                <a href="{{ route('tmbberita.index') }}" class="menu-item"><i class="fas fa-plus"></i> Tambah Berita</a>
                <a href="{{ route('lowongan.index') }}" class="menu-item"><i class="fas fa-plus"></i> Tambah Lowongan</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <header class="">
        <div class="content" id="mainContent">
            <div class="top-bar">
                <div class="d-flex align-items-center">
                    <!-- Tombol untuk menampilkan sidebar -->
                    <button class="toggle-btn" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4 class="ms-3 mt-1">
                        @auth
                            @if (Auth::user()->isAdmin())
                                Role Admin
                            @elseif (Auth::user()->isUser())
                                Role User
                            @elseif (Auth::user()->isPetugas())
                                Role Petugas
                            @else
                                Role Tidak Ada
                            @endif
                        @else
                            Belum Login
                        @endauth
                    </h4>
                </div>
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <ul class="d-flex justify-content-end list-unstyled gap-3 mt-2">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="text-decoration-none text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="text-decoration-none text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif  
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Halo {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        {{ __('Profil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                    @auth
                        <div class="">
                        @auth
                            @php
                                $userImage = Auth::user()->image;
                            @endphp

                            <a href="{{ url('/profile') }}">
                                @if($userImage)
                                    @if(\Illuminate\Support\Str::startsWith($userImage, ['http://', 'https://']))
                                        <img src="{{ $userImage }}" alt="avatar"
                                            class="rounded-circle" width="48" height="48" style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('storage/' . $userImage) }}" alt="avatar"
                                            class="rounded-circle" width="48" height="48" style="object-fit: cover;">
                                    @endif
                                @else
                                    <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" alt="avatar"
                                        class="rounded-circle" width="48" height="48" style="object-fit: cover;">
                                @endif
                            </a>
                        @endauth


                        </div>
                    @endauth
                </div>
            </div>
            <main class="py-4">
                @yield('content')
                @stack('modal')
            </main>
        </div>
    </header>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebarMenu");
            const content = document.getElementById("mainContent");
            const toggleBtn = document.getElementById("toggleSidebar");

            // Cek apakah sidebar sebelumnya terbuka atau tidak
            if (localStorage.getItem("sidebarOpen") === "true") {
                sidebar.classList.add("show");
                content.classList.add("shift");
            }

            // Event klik tombol toggle sidebar
            toggleBtn.addEventListener("click", function () {
                sidebar.classList.toggle("show");
                content.classList.toggle("shift");

                // Simpan status sidebar ke localStorage
                localStorage.setItem("sidebarOpen", sidebar.classList.contains("show"));
            });

            // Menandai menu aktif berdasarkan URL
            document.querySelectorAll(".menu-item").forEach(item => {
                if (item.href === window.location.href) {
                    item.classList.add("active");
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
