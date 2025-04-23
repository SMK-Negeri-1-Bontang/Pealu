@extends('welcome', ['showUserUI' => false])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<div class="container-fluid h-100 d-flex justify-content-center align-items-center bg-overlay">
    <div class="text-center animate__animated animate__fadeIn"
         style="backdrop-filter: brightness(0.9) blur(2px); padding: 2rem; border-radius: 20px;">

        {{-- Audio lucu --}}
        <audio id="funny-audio" autoplay hidden>
            <source src="https://archive.org/download/cartoon-wah-wah-sad-trombone/sadtrombone.mp3" type="audio/mpeg">
        </audio>

        {{-- Gambar karakter --}}
        <img src="https://play-lh.googleusercontent.com/uwy2dwbUcOM7o8eFLVgIxlGd0j-1npAALDGyCwnwyU6gRgRwQFzDt3V7Q4gb0dNeMNLY=w240-h480-rw"
             class="img-fluid mb-4 animate__animated animate__bounce"
             style="max-width: 200px;" alt="404 Illustration">

        {{-- Judul & Deskripsi --}}
        <h1 class="display-1 text-danger fw-bold">404</h1>
        <h3 class="mb-3 text-white">Oops! Mau ke mana broo?</h3>
        <p class="text-light mb-4">Sepertinya halaman yang Anda cari tidak tersedia atau sudah dipindahkan.</p>

        {{-- Teks berjalan --}}
        <div class="marquee mb-4">
            <p class="text-white fw-semibold">⚠️ Kamu nyasar nih... ayo balik ke beranda sebelum tersesat lebih jauh! ⚠️</p>
        </div>

        {{-- Tombol --}}
        <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2 shadow rounded-pill transition">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>

<style>
    .bg-overlay {
        background: url('https://smkn1bontang.sch.id/storage/01-cms-website/smkn1bontang.sch.id/slide/rm4mn1634561490.png') no-repeat center center;
        background-size: cover;
        height: 100vh;
        width: 100%;
        position: relative;
    }

    .transition {
        transition: all 0.3s ease-in-out;
    }

    .transition:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .marquee {
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .marquee p {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 10s linear infinite;
        font-size: 1.1rem;
    }

    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }

    body, html {
        height: 100%;
        margin: 0;
    }
</style>
@endsection
