@extends('welcome')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section style="background-color: #f0f2f5; min-height: 100vh;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Profile Anda</h2>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <a href="{{ url('/profile') }}">
                            @if(Auth::user()->image)
                                @if(Str::startsWith(Auth::user()->image, ['http://', 'https://']))
                                    <img src="{{ Auth::user()->image }}" alt="avatar" class="rounded-circle shadow" width="140" height="140" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="avatar" class="rounded-circle shadow" width="140" height="140" style="object-fit: cover;">
                                @endif
                            @else
                                <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" alt="avatar" class="rounded-circle shadow" width="140" height="140" style="object-fit: cover;">
                            @endif
                        </a>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small">{{ $user->email }}</p>
                    <p class="badge bg-primary">{{ ucfirst($user->role) }}</p>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm p-4">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Username</div>
                        <div class="col-sm-8">{{ $user->name }}</div>
                    </div><hr>

                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Lengkap</div>
                        <div class="col-sm-8">{{ $user->nama_lengkap ?? '-' }}</div>
                    </div><hr>

                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nomor HP</div>
                        <div class="col-sm-8">{{ $user->hp ?? '-' }}</div>
                    </div><hr>

                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email</div>
                        <div class="col-sm-8">{{ $user->email }}</div>
                    </div><hr>

                    <div class="row">
                        <div class="col-sm-4 text-muted">Role</div>
                        <div class="col-sm-8">{{ ucfirst($user->role) }}</div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="button" class="btn btn-outline-primary px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: #ffffff;">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="hp" class="form-label">Nomor HP</label>
                                <input type="tel" class="form-control" id="hp" name="hp" value="{{ old('hp', $user->hp) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role" id="role">
                                    <option value="" disabled>Pilih Level</option>
                                    @if (Auth::check())
                                        @if (Auth::user()->isAdmin())
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                        @elseif (Auth::user()->isPetugas())
                                            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                        @endif
                                    @endif
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin ubah)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @if($user->image)
                                    <small class="d-block mt-2">
                                        Gambar sekarang:
                                        <img src="{{ Str::startsWith($user->image, 'http') ? $user->image : asset('storage/' . $user->image) }}" width="80" class="rounded mt-1">
                                    </small>
                                @endif
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
