@extends('welcome')

@section('content')
<div class="container-fluid">
    <!-- Notifikasi -->
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
        @if(session('error'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                    <div>
                        <strong class="d-block">Gagal!</strong>
                        {{ session('error') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        </div>
        @endif

        @if ($message = Session::get('update'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 fs-4"></i>
                    <div>
                        <strong class="d-block">Diperbarui!</strong>
                        {{ $message }}
                    </div>
                </div>
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
        <div class="card-header bg-gradient-primary-to-secondary p-4 text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">
                        <i class="fas fa-newspaper me-2"></i> Manajemen Berita
                    </h3>
                    <p class="text-white-50 mb-0">Kelola semua berita dan informasi</p>
                </div>
                <button data-bs-toggle="modal" data-bs-target="#modalTambahBerita" class="btn btn-light rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Berita
                </button>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('tmbberita.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-8">
                            <label class="form-label small text-uppercase fw-bold text-muted">Pencarian</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                                <input type="search" name="search" class="form-control border-start-0 ps-0" 
                                       placeholder="Cari judul atau deskripsi berita..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
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
                            <th>Judul</th>
                            <th class="text-center" style="width: 80px;">Gambar</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tmbberita as $no => $b)
                        <tr>
                            <td class="text-center text-muted">{{ ($tmbberita->currentPage() - 1) * $tmbberita->perPage() + $no + 1 }}</td>
                            <td>
                                <div class="fw-semibold">{{ $b->title }}</div>
                                <small class="text-muted">Diupdate: {{ $b->updated_at->format('d M Y') }}</small>
                            </td>
                            <td class="text-center">
                                <div class="avatar avatar-md position-relative">
                                    @if($b->image)
                                        <img src="{{ asset('storage/' . $b->image) }}" class="rounded-circle" width="50" height="50">
                                    @else
                                        <div class="avatar-placeholder rounded-circle bg-light text-muted d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;">
                                    {{ $b->content }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button data-bs-toggle="modal" data-bs-target="#modalLihat{{$b->id}}" 
                                            class="btn btn-sm btn-icon btn-outline-info me-2 rounded-circle" title="Lihat">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#modalEdit{{$b->id}}" 
                                            class="btn btn-sm btn-icon btn-outline-secondary me-2 rounded-circle" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#modalHapus{{$b->id}}" 
                                            class="btn btn-sm btn-icon btn-outline-danger rounded-circle" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-newspaper fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Data Berita Tidak Ditemukan</h5>
                                    <p class="text-muted">Tidak ada berita yang tersedia.</p>
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
                    Menampilkan <b>{{ $tmbberita->firstItem() }}</b> sampai <b>{{ $tmbberita->lastItem() }}</b> dari <b>{{ $tmbberita->total() }}</b> berita
                </div>
                <div>
                    {{ $tmbberita->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tmbberita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Deskripsi Berita</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat/Edit/Hapus (Tidak Diubah) -->
@foreach($tmbberita as $b)
    {{-- Modal Lihat --}}
    <div class="modal fade" id="modalLihat{{ $b->id }}" tabindex="-1" aria-labelledby="modalLihatLabel{{ $b->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background:rgb(240, 240, 240);">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLihatLabel{{ $b->id }}">Detail Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    {{-- Judul --}}
                    <h2 class="fw-bold mb-5">{{ $b->title }}</h2>

                    {{-- Gambar --}}
                    @if($b->image)
                        <div class="col-left">
                            <img src="{{ asset('storage/' . $b->image) }}" style="max-height: 400px; width: 100%; object-fit: cover;" class="mb-4 rounded" alt="gambar">
                        </div>
                    @endif

                    {{-- Deskripsi / Konten --}}
                    <div class="berita-content">
                        @foreach(explode("\n", $b->content) as $paragraph)
                            @if(trim($paragraph) !== '')
                                <p class="mb-3" style="text-indent: 30px; line-height: 1.7;">{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEdit{{ $b->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $b->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background:rgb(240, 240, 240);">
                <form action="{{ route('tmbberita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $b->id }}">Edit Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ $b->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar (opsional)</label>
                            <input type="file" name="image" class="form-control">
                            @if($b->image)
                                <small class="d-block mt-1">Gambar sekarang: <img src="{{ asset('storage/' . $b->image) }}" width="80"></small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="content" class="form-control" rows="3" required>{{ $b->content }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapus{{ $b->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $b->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $b->id }}">
                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                    <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                    <h5 class="fw-bold text-uppercase mt-2">{{ $b->title }}</h5>
                    <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <form action="{{ route('tmbberita.destroy', $b->id) }}" method="POST">
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
    :root {
        --primary-color: #4e54c8;
        --secondary-color: #8f94fb;
    }
    
    /* Gaya Kartu */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }
    
    .avatar {
        width: 50px;
        height: 50px;
    }
    
    .avatar-placeholder {
        background-color: #f8f9fa;
        color: #adb5bd;
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
    
    .table th {
        letter-spacing: 0.5px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #6c757d;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.02);
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