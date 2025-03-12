<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link rel="stylesheet" href="{{ asset('sass/app.scss') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

        <!-- boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- icont -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        
        <style>
            header{
                background-color: #dffff0;
                font-family: 'Roboto Mono', sans-serif;
                overflow-x: hidden;
                box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.25); 
            }
            .nav-item a{
                text-decoration: none;
                color: currentColor;
            }
            .list-unstyled .nav-item a:hover{
                color: #fff;
                background-color: #274d8a;
                padding: 10px 15px;
                border-radius: 5px;
            }
            .carousel-item img {
                height: 400px;
                object-fit: cover;
            }
            .collapse-header{
                background-color: #effff0;
                font-family: 'Roboto Mono', sans-serif;
                overflow-x: hidden;
            }
            footer{
                background-color: #dffff0;
                font-family: 'Roboto Mono', sans-serif;
                bottom: 0;
                width: 100%;
                padding: 10px 0;
            }

        </style>
    </head>
    <body>
        <div id="app">
            <header class="">
                <nav class="navbar navbar-expand-lg" >
                    <div class="container">
                        <a class="navbar-brand me-2">
                            <img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2SyMhZwBzUn-Uze93_uGz7JgA9agT_Rwz9w&s"
                                height="70"
                                width="70"
                                alt="MDB Logo"
                                style="margin-top: -1px;" class="rounded-circle"/>
                        </a>
                        <!-- Collapsible wrapper -->
                        <div class="navbar-collapse" id="navbarButtonsExample">
                            <!-- Left links -->
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <a class="nav-link fs-4 ">SMK Negri 1 Bontang</a>
                                </li>
                            </ul>
                        
                        </div>
                        <div class="" id="">

                            <!-- Bagian atas: Login dan Register -->
                            <ul class="d-flex justify-content-end list-unstyled gap-4 pt-2">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="" href="{{ Route('user.create') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif  
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

                            <!-- Side Of Navbar -->
                            <ul class="d-flex justify-content-end list-unstyled gap-5">
                                    <li class="nav-item">
                                    <a href="{{ url('/') }}" class="fs-5 ">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{ url('/alumni') }}" class="fs-5 ">Alumni</a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{ url('https://smkn1bontang.sch.id/') }}" class="fs-5 ">SMKN 1</a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="#" class="fs-5 " data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <i class="fa-solid fa-bars"></i>
                                    </a>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
                <!-- Konten yang akan muncul di bawah -->
                <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="">
                    <div class="container">
                        <hr>
                        <ul class="d-flex justify-content-center list-unstyled gap-5">
                            <li class="nav-item">
                            <a href="" class="fs-5">+Lowongan</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('tmbberita.index') }}" class="fs-5">+Berita</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="fs-5">User</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ url('/home') }}" class="fs-5">Status</a>
                            </li>
                            <li class="nav-item">
                            <a href="" class="fs-5">Lowongan</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ url('/berita') }}" class="fs-5">Berita</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="py-4">
                @yield('content')
                @stack('modal')
            </main>
        </div>
         <!-- Footer -->
    <footer class="text-center">
        <!-- Copyright-->
        <div class="text-center p-3">
            © 2025 SMKN 1 Bontang. Created by PEALU Group Students.
        </div>
    </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <!-- Boostrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    
</html>
