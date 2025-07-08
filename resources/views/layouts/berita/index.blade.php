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
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 gap-2">
                <form method="GET" id="perPageForm" class="d-flex align-items-center gap-2 mb-0">
                    <div class="d-flex align-items-center gap-2">
                        <label for="perPage" class="mb-0 fw-semibold text-secondary" style="white-space: nowrap;">Rows per page:</label>
                        <select name="per_page" id="perPage" class="form-select form-select-sm w-auto shadow-sm"
                            onchange="document.getElementById('perPageForm').submit()">
                            @foreach([10, 25, 50, 200] as $size)
                                <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach(request()->except('per_page', 'page') as $key => $val)
                        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                    @endforeach
                </form>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small">
                        <b>{{ $tmbberita->firstItem() }}</b> - <b>{{ $tmbberita->lastItem() }}</b> of <b>{{ $tmbberita->total() }}</b>
                    </span>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            {{-- Previous --}}
                            <li class="page-item {{ $tmbberita->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $tmbberita->previousPageUrl() }}{{ $tmbberita->previousPageUrl() ? '&per_page='.request('per_page', 10) : '' }}" tabindex="-1">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            {{-- Page Numbers --}}
                            @foreach ($tmbberita->getUrlRange(1, $tmbberita->lastPage()) as $page => $url)
                                @if ($page == $tmbberita->currentPage() || ($page <= 2 || $page > $tmbberita->lastPage() - 2 || abs($page - $tmbberita->currentPage()) <= 1))
                                    <li class="page-item {{ $tmbberita->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}&per_page={{ request('per_page', 10) }}">{{ $page }}</a>
                                    </li>
                                @elseif ($page == 3 && $tmbberita->currentPage() > 4)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @elseif ($page == $tmbberita->lastPage() - 2 && $tmbberita->currentPage() < $tmbberita->lastPage() - 3)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endforeach
                            {{-- Next --}}
                            <li class="page-item {{ !$tmbberita->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $tmbberita->nextPageUrl() }}{{ $tmbberita->nextPageUrl() ? '&per_page='.request('per_page', 10) : '' }}">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@push('modal')
<!-- Modal Tambah Berita -->
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h4 class="mb-0 text-white p-2" id="tambahBeritaModalLabel">
                    <i class="fas fa-newspaper me-2"></i> Tambah Berita
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('tmbberita.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <!-- Judul Berita -->
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" placeholder="Judul Berita" required>
                                <label for="title" class="text-muted">
                                    <i class="fas fa-heading me-1"></i> Judul Berita
                                </label>
                                @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Gambar Berita -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="image" class="form-label text-muted">
                                    <i class="fas fa-image me-1"></i> Gambar Berita
                                </label>
                                <input class="form-control @error('image') is-invalid @enderror" 
                                       type="file" id="image" name="image" accept="image/*">
                                @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Konten Berita -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" placeholder="Isi Berita" 
                                          style="height: 200px" required></textarea>
                                <label for="content" class="text-muted">
                                    <i class="fas fa-align-left me-1"></i> Isi Berita
                                </label>
                                @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer border-0 pt-5">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush

@foreach($tmbberita as $b)
<!-- Modal Edit Berita -->
<div class="modal fade" id="modalEdit{{ $b->id }}" tabindex="-1" aria-labelledby="editBeritaModalLabel{{ $b->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h4 class="mb-0 text-white p-2" id="editBeritaModalLabel{{ $b->id }}">
                    <i class="fas fa-edit me-2"></i> Edit Berita
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('tmbberita.update', $b->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- Judul Berita -->
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="edit_title{{ $b->id }}" name="title" 
                                       value="{{ old('title', $b->title) }}" placeholder="Judul Berita" required>
                                <label for="edit_title{{ $b->id }}" class="text-muted">
                                    <i class="fas fa-heading me-1"></i> Judul Berita
                                </label>
                                @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Gambar Berita -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="edit_image{{ $b->id }}" class="form-label text-muted">
                                    <i class="fas fa-image me-1"></i> Gambar Berita
                                </label>
                                <input class="form-control @error('image') is-invalid @enderror" 
                                       type="file" id="edit_image{{ $b->id }}" name="image" accept="image/*">
                                <input type="hidden" name="image_lama" value="{{ $b->image }}">
                                @if($b->image)
                                    <div class="mt-2 d-flex align-items-center">
                                        <span class="me-2">Gambar saat ini:</span>
                                        <img src="{{ asset('storage/' . $b->image) }}" class="rounded" width="80" style="object-fit: cover;">
                                    </div>
                                @endif
                                @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Konten Berita -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="edit_content{{ $b->id }}" name="content" 
                                          placeholder="Isi Berita" style="height: 200px" required>{{ old('content', $b->content) }}</textarea>
                                <label for="edit_content{{ $b->id }}" class="text-muted">
                                    <i class="fas fa-align-left me-1"></i> Isi Berita
                                </label>
                                @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer border-0 pt-5">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Berita -->
<div class="modal fade" id="modalHapus{{ $b->id }}" tabindex="-1" aria-labelledby="deleteBeritaModalLabel{{ $b->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white py-4" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <h5 class="modal-title fw-bold" id="deleteBeritaModalLabel{{ $b->id }}">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body text-center py-4">
                <div class="icon-circle bg-danger bg-opacity-10 p-3 d-inline-block rounded-circle mb-3">
                    <i class="fas fa-trash-alt text-danger fa-3x"></i>
                </div>
                <h4 class="fw-bold mb-2">Hapus Berita?</h4>
                <p class="mb-2">Anda akan menghapus berita:</p>
                <div class="alert alert-light border-danger border-1 rounded-3 py-2 px-3 d-inline-block">
                    <h5 class="fw-bold text-danger mb-0">{{ $b->title }}</h5>
                </div>
                <p class="text-muted mt-3">
                    <i class="fas fa-info-circle me-1"></i> Data yang dihapus tidak dapat dikembalikan!
                </p>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer border-0 d-flex justify-content-center py-3" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Batal
                </button>
                <form action="{{ route('tmbberita.destroy', $b->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm">
                        <i class="fas fa-trash-alt me-2"></i> Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

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
@endforeach

<script>
    // Validasi form
    (function () {
        'use strict'
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })();
</script>

@push('styles')
<style>
    :root {
        --primary-color: #4e54c8;
        --secondary-color: #8f94fb;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    body {
        background-color: #f5f7fa;
    }
    
    /* Gaya Kartu */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    /* Gradient Header */
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }
    
    /* Gaya Tabel */
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
    
    /* Gaya Avatar */
    .avatar {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        color: #adb5bd;
    }
    
    /* Gaya Tombol */
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
    
    /* Gaya Badge */
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
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
    
    /* Gaya Form */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 84, 200, 0.25);
    }
    
    .input-group-text {
        background-color: transparent;
        border-right: none;
    }
    
    .input-group .form-control {
        border-left: none;
    }
    
    /* Dropdown yang menyesuaikan dengan isi */
    .form-select {
        width: auto;
        min-width: 100%;
    }
    
    /* Penyesuaian Responsif */
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .card-header button {
            margin-top: 1rem;
            width: 100%;
        }
        
        .table-responsive {
            border: none;
        }
    }

    /* Gaya Pagination */
    .pagination {
        margin: 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        border-radius: 50% !important;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4e54c8;
        border: none;
        margin: 0 2px;
        font-weight: 500;
        transition: background 0.2s;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #4e54c8, #8f94fb);
        color: #fff;
        box-shadow: 0 2px 8px rgba(78, 84, 200, 0.15);
    }

    .pagination .page-link:hover {
        background: #f0f2ff;
        color: #4e54c8;
    }

    .pagination .page-item.disabled .page-link {
        color: #adb5bd;
        background: #f8f9fa;
    }
</style>
@endpush
@endsection