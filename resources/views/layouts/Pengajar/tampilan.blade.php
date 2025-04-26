@extends('welcome')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold" style="color: #343a40;">Daftar Pengajar</h2>

    <div class="row g-4">
        @foreach ($pengajar as $p)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4" style="transition: all 0.3s;">
                <div class="card-body text-center p-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="position-relative mb-3">
                            <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-circle shadow" width="100" height="100" style="object-fit: cover;" alt="Foto Pengajar">
                        </div>
                        <h5 class="fw-bold mb-1">{{ $p->nama_lengkap }}</h5>
                        <p class="text-muted mb-2">{{ $p->jabatan }}</p>
                        <span class="badge bg-primary">{{ $p->mata_pelajaran }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
</style>
@endsection
