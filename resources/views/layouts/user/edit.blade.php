@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="card shadow-lg" style="width: 500px; border-radius: 10px;">
        <div class="card-body">
            <a href="{{ route('user.index') }}"><button class="btn-close position-absolute end-0 m-2"></button></a>
            <h3 class="fw-bold text-center mb-4">Edit User</h3>

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

            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap"
                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hp" class="form-label">No. HP</label>
                    <input type="text" id="hp" name="hp" class="form-control @error('hp') is-invalid @enderror"
                        value="{{ old('hp', $user->hp) }}" required>
                    @error('hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Level</label>
                    <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="" disabled>Pilih Level</option>
                        @if (Auth::check() && Auth::user()->isAdmin())
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        @endif
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('user.index') }}" class="text-decoration-none text-muted">Kembali ke daftar user</a>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
