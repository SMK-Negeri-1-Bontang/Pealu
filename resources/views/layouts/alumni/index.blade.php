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
        
    </div>
    
    <!-- Kartu Utama -->
    <div class="card shadow-lg border-0">
        <!-- Header Kartu -->
        <div class="card-header bg-gradient-primary-to-secondary p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 text-white">
                        <i class="fas fa-user-graduate me-2"></i> Data Alumni
                    </h3>
                    <p class="text-white-50 mb-0">Kelola semua data alumni</p>
                </div>
                @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isPetugas()))
                <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-light rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Baru
                </button>
                @endif
            </div>
        </div>
        
        <!-- Isi Kartu -->
        <div class="card-body p-4">
            <!-- Form Pencarian -->
            <div class="mb-4">
                <form action="{{ route('alumni.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small text-uppercase fw-bold text-muted">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                                <input type="text" name="nama" class="form-control border-start-0 ps-0" 
                                    placeholder="Cari berdasarkan nama..." value="{{ request('nama') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-uppercase fw-bold text-muted">NIS</label>
                            <input type="text" name="nis" class="form-control" 
                                placeholder="Cari NIS..." value="{{ request('nis') }}">
                        </div>
                        <div class="col-md-3 flex-grow-1">
                            <label class="form-label small text-uppercase fw-bold text-muted">Jurusan</label>
                            <select name="jurusan" class="form-select w-100">
                                <option value="">Semua Jurusan</option>
                                @foreach($jurusanList as $jurusan)
                                    <option value="{{ $jurusan }}" {{ request('jurusan') == $jurusan ? 'selected' : '' }}>
                                        {{ $jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 flex-grow-1">
                            <label class="form-label small text-uppercase fw-bold text-muted">Tahun Lulus</label>
                            <select name="tahun_lulus" class="form-select w-100">
                                <option value="">Semua Tahun</option>
                                @foreach($tahunList as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun_lulus') == $tahun ? 'selected' : '' }}>
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
            
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th class="text-center" style="width: 100px;">Foto</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th class="text-center">Tahun Lulus</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumni as $no => $a)
                        <tr>
                            <td class="text-center text-muted">{{ ($alumni->currentPage() - 1) * $alumni->perPage() + $no + 1 }}</td>
                            <td class="text-center">
                                <div class="avatar avatar-md position-relative">
                                    @if($a->image)
                                        <img src="{{ asset('storage/' . $a->image) }}" class="rounded-circle" width="50" height="50">
                                    @else
                                        <div class="avatar-placeholder rounded-circle bg-light text-muted d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="fw-semibold">{{ $a->nis }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $a->nama_lengk }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $a->jur_sekolah }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info bg-opacity-10 text-info">{{ $a->tahun_lulus }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    @auth
                                        @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                                            <button data-bs-toggle="modal" data-bs-target="#edit{{$a->id}}" class="btn btn-sm btn-icon btn-outline-secondary me-2 rounded-circle" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button data-bs-toggle="modal" data-bs-target="#delete{{$a->id}}" class="btn btn-sm btn-icon btn-outline-danger me-2 rounded-circle" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
                                    @endauth
                                    
                                    <button data-bs-toggle="modal" data-bs-target="#lihat{{$a->id}}" class="btn btn-sm btn-icon btn-outline-info me-2 rounded-circle" title="Lihat">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <a href="{{ route('alumni.invoice', ['id' => $a->id]) }}" class="btn btn-sm btn-icon btn-outline-success rounded-circle" title="Unduh">
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-user-graduate fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Data Alumni Tidak Ditemukan</h5>
                                    <p class="text-muted">Tidak ada data alumni yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginasi -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing <b>{{ $alumni->firstItem() }}</b> to <b>{{ $alumni->lastItem() }}</b> of <b>{{ $alumni->total() }}</b> entries
                </div>
                <div>
                    {{ $alumni->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

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

@push('modal')
<!-- Modal Tambah Data Siswa -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h4 class="mb-0 text-white p-2" id="tambahModalLabel">
                    <i class="fas fa-user-graduate me-2"></i> Tambah Data Alumni
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <!-- Nama Lengkap & NIS -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nama_lengk') is-invalid @enderror" 
                                       id="nama_lengk" name="nama_lengk" placeholder="Nama Lengkap" required>
                                <label for="nama_lengk" class="text-muted">
                                    <i class="fas fa-user me-1"></i> Nama Lengkap
                                </label>
                                @error('nama_lengk')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" 
                                       id="nis" name="nis" placeholder="NIS" required>
                                <label for="nis" class="text-muted">
                                    <i class="fas fa-id-card me-1"></i> NIS
                                </label>
                                @error('nis')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nomor Telpon & Jurusan -->
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
                                <select class="form-select @error('jur_sekolah') is-invalid @enderror" 
                                        id="jur_sekolah" name="jur_sekolah" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                    <option value="Kimia Industri">Kimia Industri</option>
                                    <option value="Kimia Analis">Kimia Analis</option>
                                    <option value="Tehnik Instalasi Listrik">Tehnik Instalasi Listrik</option>
                                    <option value="Tehnik Permesinan">Tehnik Permesinan</option>
                                    <option value="Tehnik Pendinginan">Tehnik Pendinginan</option>
                                    <option value="Tehnik Pengelasan">Tehnik Pengelasan</option>
                                </select>
                                <label for="jur_sekolah" class="text-muted">
                                    <i class="fas fa-graduation-cap me-1"></i> Jurusan
                                </label>
                                @error('jur_sekolah')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Tahun Lulus & Wirausaha -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                       id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Lulus" required>
                                <label for="tahun_lulus" class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> Tahun Lulus (2022-2025)
                                </label>
                                @error('tahun_lulus')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('wirausaha') is-invalid @enderror" 
                                       id="wirausaha" name="wirausaha" placeholder="Wirausaha">
                                <label for="wirausaha" class="text-muted">
                                    <i class="fas fa-briefcase me-1"></i> Wirausaha (jika ada)
                                </label>
                                <small class="text-muted ms-2">* Kosongkan jika tidak ada</small>
                                @error('wirausaha')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Foto Profil -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="image" class="form-label text-muted">
                                    <i class="fas fa-image me-1"></i> Foto Profil
                                </label>
                                <input class="form-control @error('foto') is-invalid @enderror" 
                                       type="file" id="image" name="image" accept="image/*">
                                @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Alamat Rumah -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('alamat_rum') is-invalid @enderror" 
                                          id="alamat_rum" name="alamat_rum" placeholder="Alamat Rumah" style="height: 100px"></textarea>
                                <label for="alamat_rum" class="text-muted">
                                    <i class="fas fa-home me-1"></i> Alamat Rumah
                                </label>
                                @error('alamat_rum')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required onchange="toggleSections(this.closest('.modal'), false)">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1">Bekerja</option>
                                    <option value="2">Kuliah</option>
                                    <option value="3">Tidak Ada Kabar</option>
                                </select>
                                <label for="status" class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i> Status Saat Ini
                                </label>
                                @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Section Bekerja -->
                        <div id="bekerja-section" class="bg-light p-3 rounded-3 mt-3" style="display: none;">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-briefcase me-2"></i> Informasi Pekerjaan
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_per') is-invalid @enderror" 
                                               id="nama_per" name="nama_per" placeholder="Nama Perusahaan">
                                        <label for="nama_per" class="text-muted">Nama Perusahaan</label>
                                        @error('nama_per')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_tok') is-invalid @enderror" 
                                               id="nama_tok" name="nama_tok" placeholder="Nama Tokoh">
                                        <label for="nama_tok" class="text-muted">Nama Tokoh</label>
                                        @error('nama_tok')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('lok_bekerja') is-invalid @enderror" 
                                               id="lok_bekerja" name="lok_bekerja" placeholder="Lokasi Bekerja">
                                        <label for="lok_bekerja" class="text-muted">Lokasi Bekerja</label>
                                        @error('lok_bekerja')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section Kuliah -->
                        <div id="kuliah-section" class="bg-light p-3 rounded-3 mt-3" style="display: none;">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-university me-2"></i> Informasi Pendidikan Lanjut
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select @error('jalur') is-invalid @enderror" 
                                                id="jalur" name="jalur">
                                            <option value="" disabled selected>Pilih Jalur</option>
                                            <option value="1">PTN</option>
                                            <option value="2">PTS</option>
                                            <option value="3">DINAS</option>
                                        </select>
                                        <label for="jalur" class="text-muted">Jalur Masuk</label>
                                        @error('jalur')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_perti') is-invalid @enderror" 
                                               id="nama_perti" name="nama_perti" placeholder="Nama Perguruan Tinggi">
                                        <label for="nama_perti" class="text-muted">Nama Perguruan Tinggi</label>
                                        @error('nama_perti')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('jur_prodi') is-invalid @enderror" 
                                               id="jur_prodi" name="jur_prodi" placeholder="Jurusan/Prodi">
                                        <label for="jur_prodi" class="text-muted">Jurusan/Prodi</label>
                                        @error('jur_prodi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('lok_kuliah') is-invalid @enderror" 
                                               id="lok_kuliah" name="lok_kuliah" placeholder="Lokasi Kuliah">
                                        <label for="lok_kuliah" class="text-muted">Lokasi Kuliah</label>
                                        @error('lok_kuliah')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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

@foreach($alumni as $a)
<!-- Modal Edit Data Siswa -->
<div class="modal fade" id="edit{{$a->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$a->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h4 class="mb-0 text-white p-2" id="editModalLabel{{$a->id}}">
                    <i class="fas fa-user-edit me-2"></i> Edit Data Alumni
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('alumni.update', $a->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- Nama Lengkap & NIS -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nama_lengk') is-invalid @enderror" 
                                       id="edit_nama_lengk{{$a->id}}" name="nama_lengk" 
                                       value="{{ old('nama_lengk', $a->nama_lengk) }}" placeholder="Nama Lengkap" required>
                                <label for="edit_nama_lengk{{$a->id}}" class="text-muted">
                                    <i class="fas fa-user me-1"></i> Nama Lengkap
                                </label>
                                @error('nama_lengk')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" 
                                       id="edit_nis{{$a->id}}" name="nis" 
                                       value="{{ old('nis', $a->nis) }}" placeholder="NIS" required>
                                <label for="edit_nis{{$a->id}}" class="text-muted">
                                    <i class="fas fa-id-card me-1"></i> NIS
                                </label>
                                @error('nis')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nomor Telpon & Jurusan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control @error('nomor_telp') is-invalid @enderror" 
                                       id="edit_nomor_telp{{$a->id}}" name="nomor_telp" 
                                       value="{{ old('nomor_telp', $a->nomor_telp) }}" placeholder="Nomor Telepon">
                                <label for="edit_nomor_telp{{$a->id}}" class="text-muted">
                                    <i class="fas fa-phone me-1"></i> Nomor Telepon
                                </label>
                                @error('nomor_telp')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('jur_sekolah') is-invalid @enderror" 
                                        id="edit_jur_sekolah{{$a->id}}" name="jur_sekolah" required>
                                    <option value="" disabled>Pilih Jurusan</option>
                                    <option value="Rekayasa Perangkat Lunak" {{ old('jur_sekolah', $a->jur_sekolah) == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                    <option value="Kimia Industri" {{ old('jur_sekolah', $a->jur_sekolah) == 'Kimia Industri' ? 'selected' : '' }}>Kimia Industri</option>
                                    <option value="Kimia Analis" {{ old('jur_sekolah', $a->jur_sekolah) == 'Kimia Analis' ? 'selected' : '' }}>Kimia Analis</option>
                                    <option value="Tehnik Instalasi Listrik" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Instalasi Listrik' ? 'selected' : '' }}>Tehnik Instalasi Listrik</option>
                                    <option value="Tehnik Permesinan" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Permesinan' ? 'selected' : '' }}>Tehnik Permesinan</option>
                                    <option value="Tehnik Pendinginan" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Pendinginan' ? 'selected' : '' }}>Tehnik Pendinginan</option>
                                    <option value="Tehnik Pengelasan" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Pengelasan' ? 'selected' : '' }}>Tehnik Pengelasan</option>
                                </select>
                                <label for="edit_jur_sekolah{{$a->id}}" class="text-muted">
                                    <i class="fas fa-graduation-cap me-1"></i> Jurusan
                                </label>
                                @error('jur_sekolah')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Tahun Lulus & Wirausaha -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                       id="edit_tahun_lulus{{$a->id}}" name="tahun_lulus" 
                                       value="{{ old('tahun_lulus', $a->tahun_lulus) }}" placeholder="Tahun Lulus" required>
                                <label for="edit_tahun_lulus{{$a->id}}" class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> Tahun Lulus (2022-2025)
                                </label>
                                @error('tahun_lulus')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('wirausaha') is-invalid @enderror" 
                                       id="edit_wirausaha{{$a->id}}" name="wirausaha" 
                                       value="{{ old('wirausaha', $a->wirausaha) }}" placeholder="Wirausaha">
                                <label for="edit_wirausaha{{$a->id}}" class="text-muted">
                                    <i class="fas fa-briefcase me-1"></i> Wirausaha (jika ada)
                                </label>
                                <small class="text-muted ms-2">* Kosongkan jika tidak ada</small>
                                @error('wirausaha')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Foto Profil -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="edit_image{{$a->id}}" class="form-label text-muted">
                                    <i class="fas fa-image me-1"></i> Foto Profil
                                </label>
                                <input class="form-control @error('foto') is-invalid @enderror" 
                                       type="file" id="edit_image{{$a->id}}" name="image" accept="image/*">
                                @if($a->image)
                                    <div class="mt-2 d-flex align-items-center">
                                        <span class="me-2">Foto saat ini:</span>
                                        <img src="{{ asset('storage/' . $a->image) }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    </div>
                                @endif
                                @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Alamat Rumah -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('alamat_rum') is-invalid @enderror" 
                                          id="edit_alamat_rum{{$a->id}}" name="alamat_rum" 
                                          placeholder="Alamat Rumah" style="height: 100px">{{ old('alamat_rum', $a->alamat_rum) }}</textarea>
                                <label for="edit_alamat_rum{{$a->id}}" class="text-muted">
                                    <i class="fas fa-home me-1"></i> Alamat Rumah
                                </label>
                                @error('alamat_rum')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="edit_status{{$a->id}}" name="status" required 
                                        onchange="toggleSections(this.closest('.modal'), true, '{{$a->id}}')">
                                    <option value="" disabled>Pilih Status</option>
                                    <option value="1" {{ old('status', $a->status) == '1' ? 'selected' : '' }}>Bekerja</option>
                                    <option value="2" {{ old('status', $a->status) == '2' ? 'selected' : '' }}>Kuliah</option>
                                    <option value="3" {{ old('status', $a->status) == '3' ? 'selected' : '' }}>Tidak Ada Kabar</option>
                                </select>
                                <label for="edit_status{{$a->id}}" class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i> Status Saat Ini
                                </label>
                                @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Section Bekerja -->
                        <div id="edit-bekerja-section{{$a->id}}" class="bg-light p-3 rounded-3 mt-3" 
                             style="display: old('status', a-status) = '1' 'block' 'none'">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-briefcase me-2"></i> Informasi Pekerjaan
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_per') is-invalid @enderror" 
                                               id="edit_nama_per{{$a->id}}" name="nama_per" 
                                               value="{{ old('nama_per', $a->nama_per) }}" placeholder="Nama Perusahaan">
                                        <label for="edit_nama_per{{$a->id}}" class="text-muted">Nama Perusahaan</label>
                                        @error('nama_per')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_tok') is-invalid @enderror" 
                                               id="edit_nama_tok{{$a->id}}" name="nama_tok" 
                                               value="{{ old('nama_tok', $a->nama_tok) }}" placeholder="Nama Tokoh">
                                        <label for="edit_nama_tok{{$a->id}}" class="text-muted">Nama Tokoh</label>
                                        @error('nama_tok')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('lok_bekerja') is-invalid @enderror" 
                                               id="edit_lok_bekerja{{$a->id}}" name="lok_bekerja" 
                                               value="{{ old('lok_bekerja', $a->lok_bekerja) }}" placeholder="Lokasi Bekerja">
                                        <label for="edit_lok_bekerja{{$a->id}}" class="text-muted">Lokasi Bekerja</label>
                                        @error('lok_bekerja')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section Kuliah -->
                        <div id="edit-kuliah-section{{$a->id}}" class="bg-light p-3 rounded-3 mt-3" 
                             style="display: old('status', a-status) = '2' 'block' 'none'">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-university me-2"></i> Informasi Pendidikan Lanjut
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select @error('jalur') is-invalid @enderror" 
                                                id="edit_jalur{{$a->id}}" name="jalur">
                                            <option value="" disabled>Pilih Jalur</option>
                                            <option value="1" {{ old('jalur', $a->jalur) == '1' ? 'selected' : '' }}>PTN</option>
                                            <option value="2" {{ old('jalur', $a->jalur) == '2' ? 'selected' : '' }}>PTS</option>
                                            <option value="3" {{ old('jalur', $a->jalur) == '3' ? 'selected' : '' }}>DINAS</option>
                                        </select>
                                        <label for="edit_jalur{{$a->id}}" class="text-muted">Jalur Masuk</label>
                                        @error('jalur')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_perti') is-invalid @enderror" 
                                               id="edit_nama_perti{{$a->id}}" name="nama_perti" 
                                               value="{{ old('nama_perti', $a->nama_perti) }}" placeholder="Nama Perguruan Tinggi">
                                        <label for="edit_nama_perti{{$a->id}}" class="text-muted">Nama Perguruan Tinggi</label>
                                        @error('nama_perti')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('jur_prodi') is-invalid @enderror" 
                                               id="edit_jur_prodi{{$a->id}}" name="jur_prodi" 
                                               value="{{ old('jur_prodi', $a->jur_prodi) }}" placeholder="Jurusan/Prodi">
                                        <label for="edit_jur_prodi{{$a->id}}" class="text-muted">Jurusan/Prodi</label>
                                        @error('jur_prodi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('lok_kuliah') is-invalid @enderror" 
                                               id="edit_lok_kuliah{{$a->id}}" name="lok_kuliah" 
                                               value="{{ old('lok_kuliah', $a->lok_kuliah) }}" placeholder="Lokasi Kuliah">
                                        <label for="edit_lok_kuliah{{$a->id}}" class="text-muted">Lokasi Kuliah</label>
                                        @error('lok_kuliah')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
@endforeach

<script>
    // Fungsi untuk toggle section dengan parameter ID untuk edit modal
    function toggleSections(context, isEdit = false, id = '') {
        const prefix = isEdit ? 'edit-' : '';
        const suffix = isEdit ? id : '';
        const statusSelect = context.querySelector(`select[name='status']`);
        
        if (!statusSelect) return;
        
        const bekerjaSection = context.querySelector(`#${prefix}bekerja-section${suffix}`);
        const kuliahSection = context.querySelector(`#${prefix}kuliah-section${suffix}`);
        
        if (!bekerjaSection || !kuliahSection) return;

        const status = statusSelect.value;
        
        if (status === "1") {
            bekerjaSection.style.display = "block";
            kuliahSection.style.display = "none";
        } else if (status === "2") {
            bekerjaSection.style.display = "none";
            kuliahSection.style.display = "block";
        } else {
            bekerjaSection.style.display = "none";
            kuliahSection.style.display = "none";
        }
    }

    // Inisialisasi untuk modal tambah
    document.addEventListener("DOMContentLoaded", function() {
        // Event listener untuk modal tambah
        const tambahModal = document.getElementById('tambah');
        if (tambahModal) {
            tambahModal.addEventListener('shown.bs.modal', function() {
                const statusSelect = this.querySelector("select[name='status']");
                if (statusSelect) {
                    statusSelect.addEventListener('change', function() {
                        toggleSections(this.closest('.modal'), false);
                    });
                    // Trigger perubahan awal
                    toggleSections(this, false);
                }
            });
        }
        
        // Event listener untuk modal edit
        document.addEventListener('shown.bs.modal', function(e) {
            if (e.target.id.startsWith('edit')) {
                const modal = e.target;
                const id = modal.id.replace('edit', '');
                const statusSelect = modal.querySelector("select[name='status']");
                if (statusSelect) {
                    statusSelect.addEventListener('change', function() {
                        toggleSections(modal, true, id);
                    });
                    // Trigger perubahan awal berdasarkan nilai yang sudah ada
                    toggleSections(modal, true, id);
                }
            }
        });
        
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
        })()
    });
</script>

@foreach($alumni as $a)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $a->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $a->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <!-- Modal Header with Gradient Background -->
            <div class="modal-header py-4" style="background: linear-gradient(135deg, #ff4444, #d32f2f);">
                <h5 class="modal-title text-white fw-bold" id="deleteModalLabel{{ $a->id }}">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body with Animation -->
            <div class="modal-body text-center py-4">
                <div class="animate__animated animate__pulse mb-3">
                    <div class="icon-circle bg-danger bg-opacity-10 p-3 d-inline-block rounded-circle">
                        <i class="fas fa-trash-alt text-danger fa-3x"></i>
                    </div>
                </div>
                
                <h4 class="fw-bold mb-3">Hapus Data Alumni?</h4>
                <p class="mb-2">Anda akan menghapus data:</p>
                <div class="alert alert-light border-danger border-1 rounded-3 py-2 px-3 d-inline-block">
                    <h5 class="fw-bold text-danger mb-0">{{ $a->nama_lengk }}</h5>
                </div>
                <p class="text-muted mt-3">
                    <i class="fas fa-info-circle me-1"></i> Data yang dihapus tidak dapat dikembalikan!
                </p>
            </div>
            
            <!-- Modal Footer with Buttons -->
            <div class="modal-footer border-0 d-flex justify-content-center py-3" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Batalkan
                </button>
                <form action="{{ route('alumni.destroy', $a->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 rounded-pill shadow-sm">
                        <i class="fas fa-trash-alt me-2"></i> Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endforeach

@php
    // Mapping untuk status
    $status_map = [1 => 'Bekerja', 2 => 'Kuliah', 3 => 'Tidak Ada Kabar'];

    // Mapping untuk jalur (hanya untuk status 2 - Kuliah)
    $jalur_map = [1 => 'PTN', 2 => 'PTS', 3 => 'DINAS'];
@endphp
@foreach($alumni as $a)
<!-- Modal Tampil -->
<div class="modal fade" id="lihat{{$a->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Alumni</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                <h2 class="text-center mb-4 mt-2">BIODATA DIRI {{ strtoupper($a->nama_lengk ?? '-') }}</h2>

                <div class="row justify-content-center align-items-start mt-5 mb-2">
                    {{-- Kolom Data --}}
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td>NIS</td><td>: {{ $a->nis ?? '-' }}</td></tr>
                            <tr><td>Nama Lengkap</td><td>: {{ $a->nama_lengk ?? '-' }}</td></tr>
                            <tr><td>Jurusan</td><td>: {{ $a->jur_sekolah ?? '-' }}</td></tr>
                            <tr><td>Nomor Telpon</td><td>: {{ $a->nomor_telp ?? '-' }}</td></tr>
                            <tr><td>Alamat</td><td>: {{ $a->alamat_rum ?? '-' }}</td></tr>
                            <tr><td>Wirausaha</td><td>: {{ $a->wirausaha ?? '-' }}</td></tr>
                            <tr><td>Status</td><td>: {{ $status_map[$a->status] ?? '-' }}</td></tr>
                        </table>

                        @if($a->status == 1)
                            <h5 class="mt-4"><strong>BEKERJA</strong></h5>
                            <table class="table table-borderless">
                                <tr><td>Nama Perusahaan</td><td>: {{ $a->nama_per ?? '-' }}</td></tr>
                                <tr><td>Nama Tokoh</td><td>: {{ $a->nama_tok ?? '-' }}</td></tr>
                                <tr><td>Lokasi Bekerja</td><td>: {{ $a->lok_bekerja ?? '-' }}</td></tr>
                            </table>
                        @elseif($a->status == 2)
                            <h5 class="mt-4"><strong>KULIAH</strong></h5>
                            <table class="table table-borderless">
                                <tr><td>Jalur</td><td>: {{ $jalur_map[$a->jalur] ?? '-' }}</td></tr>
                                <tr><td>Nama Perguruan Tinggi</td><td>: {{ $a->nama_perti ?? '-' }}</td></tr>
                                <tr><td>Jurusan Prodi</td><td>: {{ $a->jur_prodi ?? '-' }}</td></tr>
                                <tr><td>Lokasi Kuliah</td><td>: {{ $a->lok_kuliah ?? '-' }}</td></tr>
                            </table>
                        @endif
                    </div>

                    {{-- Kolom Gambar --}}
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('storage/' . ($a->image ?? 'default.jpg')) }}" class="img-thumbnail mb-3" style="width: 180px; height: auto;" alt="Foto Alumni">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
