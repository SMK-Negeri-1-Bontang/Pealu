@extends('welcome', ['showUserUI' => false])

@section('content')
<div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <div class="text-center">

        <img src="https://us-tuna-sounds-images.voicemod.net/13e358e4-8406-4d0a-a724-b89c38e64a0a-1701486070717.jpg">

        <h1 class="display-1 text-danger fw-bold">404</h1>
        <h3 class="mb-3">Oops! Mau ke mana broo?</h3>
        <p class="text-muted mb-4">Sepertinya halaman yang Anda cari tidak tersedia atau sudah dipindahkan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection