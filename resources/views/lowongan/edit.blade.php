@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4"
        style="width: 100%; border-radius: 12px; background-color: #f9f9f9; position: relative;">

        <a href="{{ route('lowongan.index') }}" class="position-absolute top-0 end-0 m-3 text-dark text-decoration-none">
            <i class="fas fa-times fs-5"></i>
        </a>

        <i class="fas fa-briefcase fa-4x text-muted mb-3 text-center mt-5"></i>

        <h2 class="fw-bold text-center mb-5">Buat Lowongan Kerja</h2>

        <!-- Menampilkan pesan sukses -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Menampilkan pesan error -->
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Menampilkan semua pesan error validasi -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('lowongan.update', $lowongan->id) }}">
            @csrf
            @method('PUT') <!-- Add this to indicate an update request -->

            <!-- Nama Pekerjaan -->
            <div class="mb-3">
                <label for="position" class="form-label">Nama Pekerjaan</label>
                <input type="text" id="position" name="position"
                    class="form-control @error('position') is-invalid @enderror"
                    value="{{ old('position', $lowongan->position) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                @error('position')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Perusahaan -->
            <div class="mb-3">
                <label for="company_name" class="form-label">Nama Perusahaan</label>
                <input type="text" id="company_name" name="company_name"
                    class="form-control @error('company_name') is-invalid @enderror"
                    value="{{ old('company_name', $lowongan->company_name) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                @error('company_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" id="location" name="location"
                    class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location', $lowongan->location) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Employment Type -->
            <div class="mb-3">
                <label for="employment_type" class="form-label">Jenis Pekerjaan</label>
                <select id="employment_type" name="employment_type"
                    class="form-select @error('employment_type') is-invalid @enderror"
                    style="background-color: #e9ecef; border: none; height: 40px;" required>
                    <option value="Full Time" {{ old('employment_type', $lowongan->employment_type) == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                    <option value="Part Time" {{ old('employment_type', $lowongan->employment_type) == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    <option value="Remote" {{ old('employment_type', $lowongan->employment_type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                </select>
                @error('employment_type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Education -->
            <div class="mb-3">
                <label for="education" class="form-label">Pendidikan</label>
                <input type="text" id="education" name="education"
                    class="form-control @error('education') is-invalid @enderror"
                    value="{{ old('education', $lowongan->education) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                @error('education')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Experience -->
            <div class="mb-3">
                <label for="experience" class="form-label">Pengalaman</label>
                <input type="text" id="experience" name="experience"
                    class="form-control @error('experience') is-invalid @enderror"
                    value="{{ old('experience', $lowongan->experience) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                @error('experience')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" id="category" name="category"
                    class="form-control @error('category') is-invalid @enderror"
                    value="{{ old('category', $lowongan->category) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Salary Min -->
            <div class="mb-3">
                <label for="salary_min" class="form-label">Gaji Minimum</label>
                <input type="number" id="salary_min" name="salary_min"
                    class="form-control @error('salary_min') is-invalid @enderror"
                    value="{{ old('salary_min', $lowongan->salary_min) }}" style="background-color: #e9ecef; border: none; height: 40px;">
                @error('salary_min')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Salary Max -->
            <div class="mb-5">
                <label for="salary_max" class="form-label">Gaji Maksimum</label>
                <input type="number" id="salary_max" name="salary_max"
                    class="form-control @error('salary_max') is-invalid @enderror"
                    value="{{ old('salary_max', $lowongan->salary_max) }}" style="background-color: #e9ecef; border: none; height: 40px;">
                @error('salary_max')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-grid gap-2">
                <a href="{{ route('lowongan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                <button type="submit" class="btn" style="background-color: #28a745; color: white;">Simpan Perubahan</button>
            </div>
        </form>


    </div>
</div>
@endsection