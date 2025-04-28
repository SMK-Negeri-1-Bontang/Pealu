@extends('welcome')

@section('content')
<div class="">
    <div class="">
            
                        {{-- Flash message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>{{ session('success') }}</strong>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('update'))
                        <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>{{ session('update') }}</strong>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>{{ session('delete') }}</strong>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary bg-gradient text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">
                                    <i class="fas fa-newspaper me-2"></i> Manajemen Berita
                                </h4>
                                <div class="d-flex gap-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambahBerita" 
                                    class="btn btn-light btn-sm rounded-pill">
                                        <i class="fa-solid fa-plus me-1"></i> Tambah Berita
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Search Form -->
                            <div class="mb-4">
                                <form action="{{ route('tmbberita.index') }}" method="GET" class="row g-3 align-items-end">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                            <input id="search-focus" type="search" name="search" 
                                                class="form-control border-start-0 ps-0 shadow-none" 
                                                placeholder="Cari judul atau deskripsi berita..." 
                                                value="{{ request('search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary rounded-pill w-100">
                                            <i class="fas fa-search me-1"></i> Cari
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 60px;">No</th>
                                            <th>Judul</th>
                                            <th class="text-center" style="width: 120px;">Gambar</th>
                                            <th>Deskripsi</th>
                                            <th class="text-center" style="width: 150px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tmbberita as $no => $b)
                                        <tr class="hover-shadow">
                                            <th scope="row" class="text-center">{{ ($tmbberita->currentPage() - 1) * $tmbberita->perPage() + $no + 1 }}</th>
                                            <td>
                                                <div class="fw-semibold">{{ $b->title }}</div>
                                                <small class="text-muted">Terakhir diupdate: {{ $b->updated_at->format('d M Y') }}</small>
                                            </td>
                                            <td class="text-center">
                                                @if($b->image)
                                                    <img src="{{ asset('storage/' . $b->image) }}" 
                                                        class="rounded border" 
                                                        width="80" height="60" 
                                                        style="object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                        style="width: 80px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 300px;">
                                                    {{ $b->content }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalLihat{{$b->id}}"
                                                        class="btn btn-outline-info rounded-start-pill" title="Lihat">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit{{$b->id}}"
                                                        class="btn btn-outline-primary" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus{{$b->id}}"
                                                        class="btn btn-outline-danger rounded-end-pill" title="Hapus">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="alert alert-info d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-info-circle me-3 fa-2x"></i>
                                                    <div>
                                                        <h5 class="alert-heading mb-1">Data Berita Kosong</h5>
                                                        <p class="mb-0">Belum ada berita yang tersedia. Silakan tambah berita baru.</p>
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
                                    Menampilkan <b>{{ $tmbberita->firstItem() }}</b> sampai <b>{{ $tmbberita->lastItem() }}</b> dari <b>{{ $tmbberita->total() }}</b> berita
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        @if ($tmbberita->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link rounded-pill">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link rounded-pill" href="{{ $tmbberita->previousPageUrl() }}" rel="prev">&laquo;</a>
                                            </li>
                                        @endif

                                        @foreach ($tmbberita->links()->elements[0] as $page => $url)
                                            <li class="page-item {{ $tmbberita->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link rounded-circle" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($tmbberita->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link rounded-pill" href="{{ $tmbberita->nextPageUrl() }}" rel="next">&raquo;</a>
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

                    {{-- Modals Lihat, Edit, Hapus --}}
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

                </div>
            </div>
    </div>
</div>
@endsection
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
    
    .btn-group .btn {
        border-radius: 0;
    }
</style>
@endpush