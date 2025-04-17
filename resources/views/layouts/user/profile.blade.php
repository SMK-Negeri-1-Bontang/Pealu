@extends('welcome')

@section('content')
<section style="background-color: #f8f9fa;">
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body text-center">
                        @if(Auth::user()->image)
                            <a href="{{ url('/profile') }}">
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="avatar"
                                    class="rounded-circle" width="150" height="150" style="object-fit: cover;">
                            </a>
                        @else
                            <a href="{{ url('/profile') }}">
                                <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" alt="avatar"
                                    class="rounded-circle" width="150" height="150" style="object-fit: cover;">
                            </a>
                        @endif
                        <h5 class="my-2 mb-3">{{ $user->name }}</h5>
                        <p class="text-muted mb-1">{{ $user->email }}</p>
                        <p class="text-muted mb-1">{{ $user->role }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3"><p class="mb-0 fw-bold">Username</p></div>
                            <div class="col-sm-9"><p class="text-muted mb-0">{{ $user->name }}</p></div>
                        </div><hr>

                        <div class="row">
                            <div class="col-sm-3"><p class="mb-0 fw-bold">Nama Lengkap</p></div>
                            <div class="col-sm-9"><p class="text-muted mb-0">{{ $user->nama_lengkap ?? '-' }}</p></div>
                        </div><hr>

                        <div class="row">
                            <div class="col-sm-3"><p class="mb-0 fw-bold">Nomor HP</p></div>
                            <div class="col-sm-9"><p class="text-muted mb-0">{{ $user->hp ?? '-' }}</p></div>
                        </div><hr>

                        <div class="row">
                            <div class="col-sm-3"><p class="mb-0 fw-bold">Email</p></div>
                            <div class="col-sm-9"><p class="text-muted mb-0">{{ $user->email }}</p></div>
                        </div><hr>

                        <div class="row">
                            <div class="col-sm-3"><p class="mb-0 fw-bold">Role</p></div>
                            <div class="col-sm-9"><p class="text-muted mb-0">{{ ucfirst($user->role) }}</p></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-center pt-5">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                    <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="hp" class="form-label">Nomor HP</label>
                                <input type="tel" class="form-control" id="hp" name="hp" value="{{ old('hp', $user->hp) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    <option value="" disabled>Pilih Level</option>
                                    @if (Auth::check() && Auth::user()->isAdmin())
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                    @endif
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gambar -->
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @if($user->image)
                                    <small class="d-block mt-1">Gambar sekarang: <img src="{{ asset('storage/' . $user->image) }}" width="80"></small>
                                @endif
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
