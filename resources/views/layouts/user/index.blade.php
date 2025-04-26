@extends('welcome')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <!-- Notifikasi -->
        @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>{{ session('success') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        
        @if ($message = Session::get('delete'))
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>{{ $message }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        
        <!-- Card Utama -->
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary bg-gradient text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-users-cog me-2"></i> Manajemen Pengguna
                        </h4>
                        <a href="{{ route('user.create') }}" class="btn btn-light btn-sm rounded-pill">
                            <i class="fa fa-plus me-1"></i> Tambah User
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <div class="mb-4">
                        <form action="{{ route('user.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-primary">Nama</label>
                                    <input type="text" name="name" class="form-control border-2 border-primary rounded-pill shadow-sm" 
                                        placeholder="Cari nama..." value="{{ request('name') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-primary">Email</label>
                                    <input type="text" name="email" class="form-control border-2 border-primary rounded-pill shadow-sm" 
                                        placeholder="Cari email..." value="{{ request('email') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-primary">Nomor HP</label>
                                    <input type="text" name="hp" class="form-control border-2 border-primary rounded-pill shadow-sm" 
                                        placeholder="Cari nomor HP..." value="{{ request('hp') }}">
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary rounded-pill w-100 shadow-sm">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th class="text-center" style="width: 100px;">Foto</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th style="width: 120px;">Role</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr class="hover-shadow">
                                    <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td class="text-center">
                                        <div class="avatar avatar-md">
                                            @if($user->image)
                                                @if(Str::startsWith($user->image, ['http://', 'https://']))
                                                    <img src="{{ $user->image }}" class="rounded-circle border border-2 border-primary" width="60" height="60">
                                                @else
                                                    <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle border border-2 border-primary" width="60" height="60">
                                                @endif
                                            @else
                                                <div class="avatar-placeholder rounded-circle bg-light text-muted d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user fa-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nama_lengkap }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'success' }} bg-opacity-10 text-{{ $user->role == 'admin' ? 'primary' : 'success' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-primary rounded-start-pill" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}" class="btn btn-outline-danger rounded-end-pill" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="alert alert-info d-flex align-items-center justify-content-center">
                                            <i class="fas fa-info-circle me-3 fa-2x"></i>
                                            <div>
                                                <h5 class="alert-heading mb-1">Data Pengguna Kosong</h5>
                                                <p class="mb-0">Belum ada pengguna yang terdaftar.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Menampilkan <b>{{ $users->firstItem() }}</b> sampai <b>{{ $users->lastItem() }}</b> dari <b>{{ $users->total() }}</b> pengguna
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                @if ($users->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link rounded-pill">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link rounded-pill" href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                @foreach ($users->links()->elements[0] as $page => $url)
                                    <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link rounded-circle" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($users->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link rounded-pill" href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link rounded-pill">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card-header.bg-gradient-primary {
    background: linear-gradient(to right, #3a7bd5, #00d2ff) !important;
    /* Warna bisa disesuaikan */
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    
    .avatar-placeholder {
        border: 2px dashed #dee2e6;
    }
    
    .btn-outline-primary:hover, .btn-outline-danger:hover {
        color: white !important;
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
    
    .rounded-start-pill {
        border-top-left-radius: 50rem !important;
        border-bottom-left-radius: 50rem !important;
    }
    
    .rounded-end-pill {
        border-top-right-radius: 50rem !important;
        border-bottom-right-radius: 50rem !important;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
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