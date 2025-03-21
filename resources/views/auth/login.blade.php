@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="card shadow-lg" style="width: 400px; border-radius: 10px;">
        <div class="card-body text-center">
            <a href="{{ url('/') }}"><button class="btn-close position-absolute end-0 m-2"></button></a>
            <h3 class="fw-bold mb-4">Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control border-0 border-bottom border-success" placeholder="Masukan Email" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control border-0 border-bottom border-success" placeholder="Masukan Password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
