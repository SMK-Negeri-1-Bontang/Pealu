@extends('welcome', ['showUserUI' => false])

@section('content')
<div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <div class="text-center">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFVKBEx3dem0ChuZ8F3rKMDay2rrFzySgL2g&s">

        <h1 class="display-1 text-danger fw-bold">404</h1>
        <h3 class="mb-3">Oops! Mau ke mana broo?</h3>
        <p class="text-muted mb-4">Sepertinya halaman yang Anda cari tidak tersedia atau sudah dipindahkan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection