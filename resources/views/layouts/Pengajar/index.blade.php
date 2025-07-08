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
        <div class="card-header bg-gradient-primary-to-secondary p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 text-white">
                        <i class="fas fa-chalkboard-teacher me-2"></i> Data Pengajar
                    </h3>
                    <p class="text-white-50 mb-0">Kelola semua data pengajar</p>
                </div>
                <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-light rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Baru
                </button>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('pengajar.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small text-uppercase fw-bold text-muted">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control border-start-0 ps-0" placeholder="Cari nama..." value="{{ request('nama_lengkap') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-uppercase fw-bold text-muted">NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="Cari NIP..." value="{{ request('nip') }}">
                        </div>
                        <div class="col-md-3 flex-grow-1">
                            <label class="form-label small text-uppercase fw-bold text-muted">Mata Pelajaran</label>
                            <select name="mata_pelajaran" class="form-select w-100">
                                <option value="">Semua Pelajaran</option>
                                @foreach($mataPelajaranList as $mapel)
                                    <option value="{{ $mapel }}" {{ request('mata_pelajaran') == $mapel ? 'selected' : '' }}>
                                        {{ $mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 flex-grow-1">
                            <label class="form-label small text-uppercase fw-bold text-muted">Tahun Bergabung</label>
                            <select name="tahun_bergabung" class="form-select w-100">
                                <option value="">Semua Tahun</option>
                                @foreach($tahunBergabungList as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun_bergabung') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
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
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-center">Tahun Bergabung</th>
                            <th class="text-center"Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajar as $no => $p)
                        <tr>
                            <td class="text-center text-muted">{{ ($pengajar->currentPage() - 1) * $pengajar->perPage() + $no + 1 }}</td>
                            <td class="text-center">
                                <div class="avatar avatar-md position-relative">
                                    @if($p->foto)
                                        <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-circle" width="50" height="50">
                                    @else
                                        <div class="avatar-placeholder rounded-circle bg-light text-muted d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="fw-semibold">{{ $p->nip }}</td>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $p->mata_pelajaran }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info bg-opacity-10 text-info">{{ $p->tahun_bergabung }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button data-bs-toggle="modal" data-bs-target="#lihat{{$p->id}}" class="btn btn-sm btn-icon btn-outline-info me-2 rounded-circle" title="Lihat">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#edit{{$p->id}}" class="btn btn-sm btn-icon btn-outline-secondary me-2 rounded-circle" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#delete{{$p->id}}" class="btn btn-sm btn-icon btn-outline-danger rounded-circle" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-chalkboard-teacher fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Data Pengajar Tidak Ditemukan</h5>
                                    <p class="text-muted">Tidak ada data pengajar yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 gap-2">
                <form method="GET" id="perPageForm" class="d-flex align-items-center gap-2 mb-0 flex-nowrap">
                    <label for="perPage" class="mb-0 fw-semibold text-secondary">Rows per page:</label>
                    <select name="per_page" id="perPage" class="form-select form-select-sm w-auto shadow-sm"
                        onchange="document.getElementById('perPageForm').submit()">
                        @foreach([10, 25, 50, 200] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                    @foreach(request()->except('per_page', 'page') as $key => $val)
                        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                    @endforeach
                </form>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small">
                        <b>{{ $pengajar->firstItem() }}</b> - <b>{{ $pengajar->lastItem() }}</b> of <b>{{ $pengajar->total() }}</b>
                    </span>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            {{-- Previous --}}
                            <li class="page-item {{ $pengajar->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $pengajar->previousPageUrl() }}{{ $pengajar->previousPageUrl() ? '&per_page='.request('per_page', 10) : '' }}" tabindex="-1">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            {{-- Page Numbers --}}
                            @foreach ($pengajar->getUrlRange(1, $pengajar->lastPage()) as $page => $url)
                                @if ($page == $pengajar->currentPage() || ($page <= 2 || $page > $pengajar->lastPage() - 2 || abs($page - $pengajar->currentPage()) <= 1))
                                    <li class="page-item {{ $pengajar->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}&per_page={{ request('per_page', 10) }}">{{ $page }}</a>
                                    </li>
                                @elseif ($page == 3 && $pengajar->currentPage() > 4)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @elseif ($page == $pengajar->lastPage() - 2 && $pengajar->currentPage() < $pengajar->lastPage() - 3)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endforeach
                            {{-- Next --}}
                            <li class="page-item {{ !$pengajar->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $pengajar->nextPageUrl() }}{{ $pengajar->nextPageUrl() ? '&per_page='.request('per_page', 10) : '' }}">
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
@endsection

@push('styles')
<style>
    /* Gaya yang sama persis dengan tampilan alumni */
    :root {
        --primary-color: #4e54c8;
        --secondary-color: #8f94fb;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header.bg-gradient-primary-to-secondary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
    
    .avatar {
        width: 50px;
        height: 50px;
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

@push('modal')
<!-- Modal Tambah Data Pengajar -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahPengajarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h4 class="mb-0 text-white p-2"" id="tambahPengajarModalLabel">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Tambah Data Pengajar
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('pengajar.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <!-- Nama Lengkap & NIP -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                       id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                                <label for="nama_lengkap" class="text-muted">
                                    <i class="fas fa-user me-1"></i> Nama Lengkap
                                </label>
                                @error('nama_lengkap')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('nip') is-invalid @enderror" 
                                       id="nip" name="nip" placeholder="NIP" required>
                                <label for="nip" class="text-muted">
                                    <i class="fas fa-id-card me-1"></i> NIP
                                </label>
                                @error('nip')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Mata Pelajaran & Tahun Bergabung -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" 
                                       id="mata_pelajaran" name="mata_pelajaran" placeholder="Mata Pelajaran" required>
                                <label for="mata_pelajaran" class="text-muted">
                                    <i class="fas fa-book me-1"></i> Mata Pelajaran
                                </label>
                                @error('mata_pelajaran')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('tahun_bergabung') is-invalid @enderror" 
                                       id="tahun_bergabung" name="tahun_bergabung" placeholder="Tahun Bergabung" required>
                                <label for="tahun_bergabung" class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> Tahun Bergabung
                                </label>
                                @error('tahun_bergabung')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nomor Telpon & Status -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control @error('nomor_telp') is-invalid @enderror" 
                                       id="nomor_telp" name="nomor_telp" placeholder="Nomor Telepon">
                                <label for="nomor_telp" class="text-muted">
                                    <i class="fas fa-phone me-1"></i> Nomor Telepon
                                </label>
                                @error('nomor_telp')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                    <option value="3">Pensiun</option>
                                </select>
                                <label for="status" class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i> Status
                                </label>
                                @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Pendidikan Terakhir & Jabatan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" 
                                       id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir">
                                <label for="pendidikan_terakhir" class="text-muted">
                                    <i class="fas fa-graduation-cap me-1"></i> Pendidikan Terakhir
                                </label>
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                       id="jabatan" name="jabatan" placeholder="Jabatan">
                                <label for="jabatan" class="text-muted">
                                    <i class="fas fa-briefcase me-1"></i> Jabatan
                                </label>
                                @error('jabatan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Alamat Rumah -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" placeholder="Alamat Rumah" style="height: 100px"></textarea>
                                <label for="alamat" class="text-muted">
                                    <i class="fas fa-home me-1"></i> Alamat Rumah
                                </label>
                                @error('alamat')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Foto Pengajar -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="foto" class="form-label text-muted">
                                    <i class="fas fa-image me-1"></i> Foto Pengajar
                                </label>
                                <input class="form-control @error('foto') is-invalid @enderror" 
                                       type="file" id="foto" name="foto" accept="image/*">
                                @error('foto')
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
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush

@foreach($pengajar as $p)
<!-- Modal Edit Data Pengajar -->
<div class="modal fade" id="edit{{$p->id}}" tabindex="-1" aria-labelledby="editPengajarModalLabel{{$p->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h4 class="mb-0 text-white p-2"" id="editPengajarModalLabel{{$p->id}}">
                    <i class="fas fa-user-edit me-2"></i> Edit Data Pengajar
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('pengajar.update', $p->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- Nama Lengkap & NIP -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                       id="edit_nama_lengkap{{$p->id}}" name="nama_lengkap" 
                                       value="{{ old('nama_lengkap', $p->nama_lengkap) }}" placeholder="Nama Lengkap" required>
                                <label for="edit_nama_lengkap{{$p->id}}" class="text-muted">
                                    <i class="fas fa-user me-1"></i> Nama Lengkap
                                </label>
                                @error('nama_lengkap')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('nip') is-invalid @enderror" 
                                       id="edit_nip{{$p->id}}" name="nip" 
                                       value="{{ old('nip', $p->nip) }}" placeholder="NIP" required>
                                <label for="edit_nip{{$p->id}}" class="text-muted">
                                    <i class="fas fa-id-card me-1"></i> NIP
                                </label>
                                @error('nip')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Mata Pelajaran & Tahun Bergabung -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" 
                                       id="edit_mata_pelajaran{{$p->id}}" name="mata_pelajaran" 
                                       value="{{ old('mata_pelajaran', $p->mata_pelajaran) }}" placeholder="Mata Pelajaran" required>
                                <label for="edit_mata_pelajaran{{$p->id}}" class="text-muted">
                                    <i class="fas fa-book me-1"></i> Mata Pelajaran
                                </label>
                                @error('mata_pelajaran')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('tahun_bergabung') is-invalid @enderror" 
                                       id="edit_tahun_bergabung{{$p->id}}" name="tahun_bergabung" 
                                       value="{{ old('tahun_bergabung', $p->tahun_bergabung) }}" placeholder="Tahun Bergabung" required>
                                <label for="edit_tahun_bergabung{{$p->id}}" class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> Tahun Bergabung
                                </label>
                                @error('tahun_bergabung')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nomor Telpon & Status -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control @error('nomor_telp') is-invalid @enderror" 
                                       id="edit_nomor_telp{{$p->id}}" name="nomor_telp" 
                                       value="{{ old('nomor_telp', $p->nomor_telp) }}" placeholder="Nomor Telepon">
                                <label for="edit_nomor_telp{{$p->id}}" class="text-muted">
                                    <i class="fas fa-phone me-1"></i> Nomor Telepon
                                </label>
                                @error('nomor_telp')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="edit_status{{$p->id}}" name="status" required>
                                    <option value="" disabled>Pilih Status</option>
                                    <option value="1" {{ old('status', $p->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="2" {{ old('status', $p->status) == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                                    <option value="3" {{ old('status', $p->status) == '3' ? 'selected' : '' }}>Pensiun</option>
                                </select>
                                <label for="edit_status{{$p->id}}" class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i> Status
                                </label>
                                @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Pendidikan Terakhir & Jabatan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" 
                                       id="edit_pendidikan_terakhir{{$p->id}}" name="pendidikan_terakhir" 
                                       value="{{ old('pendidikan_terakhir', $p->pendidikan_terakhir) }}" placeholder="Pendidikan Terakhir">
                                <label for="edit_pendidikan_terakhir{{$p->id}}" class="text-muted">
                                    <i class="fas fa-graduation-cap me-1"></i> Pendidikan Terakhir
                                </label>
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                       id="edit_jabatan{{$p->id}}" name="jabatan" 
                                       value="{{ old('jabatan', $p->jabatan) }}" placeholder="Jabatan">
                                <label for="edit_jabatan{{$p->id}}" class="text-muted">
                                    <i class="fas fa-briefcase me-1"></i> Jabatan
                                </label>
                                @error('jabatan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Alamat Rumah -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="edit_alamat{{$p->id}}" name="alamat" 
                                          placeholder="Alamat Rumah" style="height: 100px">{{ old('alamat', $p->alamat) }}</textarea>
                                <label for="edit_alamat{{$p->id}}" class="text-muted">
                                    <i class="fas fa-home me-1"></i> Alamat Rumah
                                </label>
                                @error('alamat')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Foto Pengajar -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="edit_foto{{$p->id}}" class="form-label text-muted">
                                    <i class="fas fa-image me-1"></i> Foto Pengajar
                                </label>
                                <input class="form-control @error('foto') is-invalid @enderror" 
                                       type="file" id="edit_foto{{$p->id}}" name="foto" accept="image/*">
                                <input type="hidden" name="foto_lama" value="{{ $p->foto }}">
                                @if($p->foto)
                                    <div class="mt-2 d-flex align-items-center">
                                        <span class="me-2">Foto saat ini:</span>
                                        <img src="{{ asset('storage/' . $p->foto) }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    </div>
                                @endif
                                @error('foto')
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

<!-- Modal Delete Data Pengajar -->
<div class="modal fade" id="delete{{$p->id}}" tabindex="-1" aria-labelledby="deletePengajarModalLabel{{$p->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white py-4" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <h5 class="modal-title fw-bold" id="deletePengajarModalLabel{{$p->id}}">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body text-center py-4">
                <div class="icon-circle bg-danger bg-opacity-10 p-3 d-inline-block rounded-circle mb-3">
                    <i class="fas fa-trash-alt text-danger fa-3x"></i>
                </div>
                <h4 class="fw-bold mb-2">Hapus Data Pengajar?</h4>
                <p class="mb-2">Anda akan menghapus data:</p>
                <div class="alert alert-light border-danger border-1 rounded-3 py-2 px-3 d-inline-block">
                    <h5 class="fw-bold text-danger mb-0">{{ $p->nama_lengkap }}</h5>
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
                <form action="{{ route('pengajar.destroy', $p->id) }}" method="POST">
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
@endforeach

@php
    // Mapping untuk status
    $status_map = [1 => 'Aktif', 2 => 'Tidak Aktif', 3 => 'Pensiun'];
@endphp

@foreach($pengajar as $p)
<!-- Modal Tampil -->
<div class="modal fade" id="lihat{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <h2 class="text-center mb-4 mt-2">BIODATA DIRI {{ strtoupper($p->nama_lengkap) }}</h2>

                <div class="row justify-content-center align-items-start mt-5 mb-2">
                    {{-- Kolom Data --}}
                    <div class="col-md-6">
                        <table class="table table-borderless text-capitalize">
                            <tr><td>NIP</td><td>: {{ $p->nip ?? '-' }}</td></tr>
                            <tr><td>Nama Lengkap</td><td>: {{ $p->nama_lengkap ?? '-' }}</td></tr>
                            <tr><td>Mata Pelajaran</td><td>: {{ $p->mata_pelajaran ?? '-' }}</td></tr>
                            <tr><td>Tahun Bergabung</td><td>: {{ $p->tahun_bergabung ?? '-' }}</td></tr>
                            <tr><td>Nomor Telpon</td><td>: {{ $p->nomor_telp ?? '-' }}</td></tr>
                            <tr><td>Alamat Rumah</td><td>: {{ $p->alamat ?? '-' }}</td></tr>
                            <tr><td>Status</td><td>: {{ $status_map[$p->status] ?? '-' }}</td></tr>
                            <tr><td>Pendidikan Terakhir</td><td>: {{ $p->pendidikan_terakhir ?? '-' }}</td></tr>
                            <tr><td>Jabatan</td><td>: {{ $p->jabatan ?? '-' }}</td></tr>
                        </table>
                    </div>

                    {{-- Kolom Gambar --}}
                    <div class="col-md-5 text-center">
                        <img src="{{ $p->foto ? asset('storage/' . $p->foto) : asset('img/default.jpg') }}" class="img-thumbnail mb-3" style="width: 180px; height: auto;" alt="Foto Pengajar">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endforeach