@extends('welcome')

@section('content')
<div class="container-fluid">
    <!-- Notifications -->
    <div class="row mb-4">
        @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 fs-4"></i>
                    <div>
                        <strong class="d-block">Sukses!</strong>
                        {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        </div>
        @endif
        
        @if ($message = Session::get('delete'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                    <div>
                        <strong class="d-block">Dihapus!</strong>
                        {{ $message }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Main Card -->
    <div class="card shadow-lg border-0">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary-to-secondary p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 text-white">
                        <i class="fas fa-users-cog me-2"></i> Manajemen Pengguna
                    </h3>
                    <p class="text-white-50 mb-0">Kelola semua data pengguna sistem</p>
                </div>
                <a href="{{ route('user.create') }}" class="btn btn-light rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i> Tambah User
                </a>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('user.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small text-uppercase fw-bold text-muted">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                                <input type="text" name="name" class="form-control border-start-0 ps-0" 
                                    placeholder="Cari nama..." value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small text-uppercase fw-bold text-muted">Email</label>
                            <input type="text" name="email" class="form-control" 
                                placeholder="Cari email..." value="{{ request('email') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small text-uppercase fw-bold text-muted">Role</label>
                            <select name="role" class="form-select w-100">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                                <i class="fas fa-search me-2"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Data Table -->
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th class="text-center" style="width: 80px;">Foto</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th class="text-center" style="width: 120px;">Role</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td class="text-center text-muted">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td class="text-center">
                                <div class="avatar avatar-md position-relative">
                                    @if($user->image)
                                        @if(Str::startsWith($user->image, ['http://', 'https://']))
                                            <img src="{{ $user->image }}" class="rounded-circle" width="50" height="50">
                                        @else
                                            <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle" width="50" height="50">
                                        @endif
                                    @else
                                        <div class="avatar-placeholder rounded-circle bg-light text-muted d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'petugas' ? 'info' : 'success') }} bg-opacity-10 text-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'petugas' ? 'info' : 'success') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-icon btn-outline-secondary me-2 rounded-circle" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}" class="btn btn-sm btn-icon btn-outline-danger rounded-circle" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-users fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Data Pengguna Tidak Ditemukan</h5>
                                    <p class="text-muted">Tidak ada pengguna yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <b>{{ $users->firstItem() }}</b> sampai <b>{{ $users->lastItem() }}</b> dari <b>{{ $users->total() }}</b> entri
                </div>
                <div>
                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modals -->
@foreach ($users as $user)
<div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-user-slash text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $user->name }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('styles')
<style>
    /* Consistent with alumni and teacher views */
    :root {
        --primary-color: #4e54c8;
        --secondary-color: #8f94fb;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }

    /* Gaya Alert */
    .alert {
        border: none;
        border-left: 4px solid;
    }
    
    .alert-success {
        border-left-color: var(--bs-success);
    }
    
    .alert-danger {
        border-left-color: var(--bs-danger);
    }
    
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header.bg-gradient-primary-to-secondary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }
    
    .table {
        --bs-table-bg: transparent;
        --bs-table-striped-bg: rgba(0, 0, 0, 0.02);
    }
    
    .table th {
        letter-spacing: 0.5px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #6c757d;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .avatar {
        width: 50px;
        height: 50px;
    }
    
    .avatar-placeholder {
        background-color: #f8f9fa;
        color: #adb5bd;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    
    .btn-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    
    .btn-icon i {
        font-size: 0.9rem;
    }
    
    /* Additional specific styles */
    .fa-user-slash {
        color: var(--bs-danger);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 84, 200, 0.25);
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        border-radius: 50rem !important;
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        color: #6c757d;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #4e54c8;
        border-color: #4e54c8;
        color: #fff;
        font-weight: 600;
    }

    .pagination .page-link:hover {
        background-color: #f0f2ff;
        border-color: #bfc3ff;
        color: #4e54c8;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #f8f9fa;
        color: #adb5bd;
        border-color: #dee2e6;
    }
</style>
@endpush
@endsection

@foreach($users as $user)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $user->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $user->name }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@php
    use Illuminate\Support\Str;
@endphp