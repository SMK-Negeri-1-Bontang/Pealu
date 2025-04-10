@extends('welcome')

@section('content')
<div class="container my-4">
    <h3 class="mb-4 text-center">Daftar Pengajar</h3>

    <div class="row">
        @foreach ($pengajar as $p)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex">
                    <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-circle me-3" width="80" height="80" style="object-fit: cover;" alt="Foto Pengajar">
                    <div class="w-100">
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Nama</div>
                            <div class="col-8">{{ $p->nama_lengkap }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Jabatan</div>
                            <div class="col-8">{{ $p->jabatan }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 fw-bold">Mapel</div>
                            <div class="col-8">{{ $p->mata_pelajaran }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
