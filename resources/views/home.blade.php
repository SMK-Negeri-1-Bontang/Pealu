@extends('welcome')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="card text-center shadow-lg p-4" style="width: 500px; border-radius: 12px; background: #ffffff;">
        <div class="card-body">
            <h2 class="fw-bold text-primary mb-3">Selamat Datang, {{ Auth::user()->name }} 🎉</h2>
            
            <div class="my-4">
                <i class="fas fa-user-circle text-primary" style="font-size: 90px;"></i>
            </div>

            <p class="fs-5 text-muted">
                @if (Auth::check())
                    Anda telah login sebagai  
                    <span class="fw-bold text-uppercase text-success">
                        {{ Auth::user()->role }}
                    </span>
                @else
                    Anda <span class="fw-bold text-danger">Belum Login</span>
                @endif
            </p>

            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="{{ url('/') }}" class="btn btn-outline-primary px-4 fw-bold"
                    style="transition: 0.3s;">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                
                <a href="{{ route('logout') }}" class="btn btn-danger px-4 fw-bold" 
                    style="transition: 0.3s;" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
