@extends('welcome')

@section('content')

    @foreach ($pengajar as $p)
    <div class="pengajar-container d-flex mb-4">

        <img src="{{ asset('storage/' . $p->foto) }}" class="foto" width="120">
        <div class="ms-3">
        <p><strong>NAMA</strong>: {{ $p->nama_lengkap }}</p>
        <p><strong>JABATAN</strong>: {{ $p->jabatan }}</p>
        <p><strong>MAPEL</strong>: {{ $p->mata_pelajaran }}</p>
        </div>

    </div>
    @endforeach

@endsection
