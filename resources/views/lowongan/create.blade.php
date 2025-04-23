@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h3>Buat Lowongan Kerja Baru</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('lowongan.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                   name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required>
                            @error('nama_perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Posisi</label>
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror" 
                                   name="posisi" value="{{ old('posisi') }}" required>
                            @error('posisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe</label>
                            <select class="form-select @error('tipe') is-invalid @enderror" name="tipe" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Full-time" {{ old('tipe') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('tipe') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Kontrak" {{ old('tipe') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                <option value="Freelance" {{ old('tipe') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                            @error('tipe')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan</label>
                            <select class="form-select @error('pendidikan') is-invalid @enderror" name="pendidikan">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SMA/SMK" {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                            @error('pendidikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   name="lokasi" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gaji</label>
                            <input type="text" class="form-control @error('gaji') is-invalid @enderror" 
                                   name="gaji" value="{{ old('gaji') }}" placeholder="Contoh: Rp 5.000.000 - Rp 7.000.000" required>
                            @error('gaji')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Pekerjaan</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kualifikasi</label>
                        <textarea class="form-control @error('kualifikasi') is-invalid @enderror" 
                                  name="kualifikasi" rows="3">{{ old('kualifikasi') }}</textarea>
                        @error('kualifikasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                               name="kontak" value="{{ old('kontak') }}" required>
                        @error('kontak')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Simpan Lowongan</button>
                        <a href="{{ route('lowongan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection