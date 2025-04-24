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
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                name="company_name" value="{{ old('company_name') }}" required>
                            @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Posisi</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                name="position" value="{{ old('position') }}" required>
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe</label>
                            <select class="form-select @error('employment_type') is-invalid @enderror" name="employment_type" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Full time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Remote" {{ old('employment_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                            @error('employment_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan</label>
                            <select class="form-select @error('education') is-invalid @enderror" name="education">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SMA/SMK" {{ old('education') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ old('education') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('education') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('education') == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                            @error('education')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Lokasi - takes up half (6 columns) -->
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                name="location" value="{{ old('location') }}" required>
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gaji Minimum - takes up 1/4 (3 columns) -->
                        <div class="col-md-3">
                            <label for="salary_min" class="form-label">Gaji Minimum</label>
                            <input type="number" class="form-control @error('salary_min') is-invalid @enderror"
                                id="salary_min" name="salary_min" value="{{ old('salary_min') }}"
                                required>
                            @error('salary_min')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gaji Maksimum - takes up 1/4 (3 columns) -->
                        <div class="col-md-3">
                            <label for="salary_max" class="form-label">Gaji Maksimum</label>
                            <input type="number" class="form-control @error('salary_max') is-invalid @enderror"
                                id="salary_max" name="salary_max" value="{{ old('salary_max') }}"
                                required>
                            @error('salary_max')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input class="form-control @error('category') is-invalid @enderror"
                            name="category" value="{{ old('category') }}" required>
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">pengalaman</label>
                        <textarea class="form-control @error('experience') is-invalid @enderror"
                            name="experience" rows="3">{{ old('experience') }}</textarea>
                        @error('experience')
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