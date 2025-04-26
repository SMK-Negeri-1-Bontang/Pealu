@extends('welcome')

@section('content')
<div class="welcome-container" style="
    position: relative; 
    min-height: 100vh;
    background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpV8xwdKialAEeS2izS-PKVs-NXLahZXI8Dg&s') center/cover no-repeat fixed;
    z-index: 0;
">
    <!-- Blur Overlay -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(8px);
        background-color: rgba(255,255,255,0.3);
        z-index: 1;
    "></div>

    <!-- Content Card -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100" style="position: relative; z-index: 2;">
        <div class="card text-center shadow-lg p-4 animate__animated animate__fadeIn" 
             style="width: 500px; border-radius: 20px; border: none; overflow: hidden;
                    background: rgba(255, 255, 255, 0.85);">
            
            <!-- Gradient Border Effect -->
            <div class="position-absolute top-0 start-0 end-0" style="height: 5px; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);"></div>
            
            <div class="card-body py-4">
                <!-- Animated Welcome Text -->
                <h2 class="fw-bold mb-4" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
                                          -webkit-background-clip: text;
                                          -webkit-text-fill-color: transparent;
                                          font-size: 2rem;">
                    Selamat Datang, {{ Auth::user()->name }} <span class="animate__animated animate__tada animate__infinite" style="display: inline-block;">🎉</span>
                </h2>
                
                <!-- Profile Avatar -->
                <div class="my-4 d-flex justify-content-center">
                    @if(Auth::user()->image)
                        @if(Str::startsWith(Auth::user()->image, ['http://', 'https://']))
                            <img src="{{ Auth::user()->image }}" 
                                 alt="avatar" 
                                 class="rounded-circle shadow border border-4 border-white"
                                 width="140" 
                                 height="140" 
                                 style="object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" 
                                 alt="avatar" 
                                 class="rounded-circle shadow border border-4 border-white"
                                 width="140" 
                                 height="140" 
                                 style="object-fit: cover;">
                        @endif
                    @else
                        <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" 
                             alt="avatar" 
                             class="rounded-circle shadow border border-4 border-white"
                             width="140" 
                             height="140" 
                             style="object-fit: cover;">
                    @endif
                </div>

                <!-- Role Badge -->
                <div class="mb-4">
                    <p class="fs-5 text-dark mb-1">Anda login sebagai</p>
                    <span class="badge rounded-pill px-3 py-2" 
                          style="font-size: 1rem; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); color: white;">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="mt-5 d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-lg btn-primary px-4 fw-bold shadow-sm"
                       style="border-radius: 50px; border: none;
                              background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
                              transition: all 0.3s ease;">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                    
                    <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-danger px-4 fw-bold shadow-sm"
                       style="border-radius: 50px; border-width: 2px;
                              transition: all 0.3s ease;" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="card-footer bg-transparent border-0 text-dark mt-3">
                <small>Sistem Informasi Alumni • {{ date('Y') }}</small>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Pastikan browser mendukung backdrop-filter */
    @supports (backdrop-filter: blur(10px)) {
        .welcome-container::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(10px);
            z-index: 1;
        }
    }
    
    /* Fallback untuk browser yang tidak mendukung */
    @supports not (backdrop-filter: blur(10px)) {
        .welcome-container::before {
            background-color: rgba(255,255,255,0.7);
        }
    }
    
    .animate__animated {
        animation-duration: 1s;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }
    
    .btn-outline-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(220, 53, 69, 0.2);
        background-color: #dc3545;
        color: white !important;
    }
    
    /* Avatar styling */
    .rounded-circle.shadow {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Improved text contrast */
    .text-dark {
        color: #343a40 !important;
    }
    
    /* Background container */
    .welcome-container {
        background-color: #f8f9fa;
    }
</style>
@endpush

@endsection