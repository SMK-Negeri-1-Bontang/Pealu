@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4"
        style="width: 500px; border-radius: 12px; background-color: #f9f9f9; position: relative;">
        
        <!-- Tombol Close -->
        <a href="{{ url('/') }}" class="position-absolute top-0 end-0 m-3 text-dark text-decoration-none">
            <i class="fas fa-times fs-5"></i>
        </a>

        <!-- Judul Login -->
        <h2 class="fw-bold text-center mb-5">Login</h2>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" 
                    style="background-color: #e9ecef; border: none; height: 40px;" required>
            </div>

            <div class="mb-5">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" 
                    style="background-color: #e9ecef; border: none; height: 40px;" required>
            </div>

            <!-- Tombol Register & Login -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn" 
                    style="background-color: #28a745; color: white;">Login</button>
                <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
