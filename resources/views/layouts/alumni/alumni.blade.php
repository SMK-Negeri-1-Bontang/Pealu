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
                            <th class="text-center" style="width: 80px;">Foto</th>
                            <th style="width: 100px;">NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th class="text-center" style="width: 120px;">Tahun Lulus</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
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
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengk') is-invalid @enderror" name="nama_lengk" placeholder="Masukkan Nama Lengkap Siswa">
                                @error('nama_lengk')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">NIS</label>
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" placeholder="Masukkan NIS Dengan Benar">
                                @error('nis')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror" name="nomor_telp" placeholder="Masukkan Nomor Telpon">
                                @error('nomor_telp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jurusan</label>
                            <select class="form-select @error('jur_sekolah')
        is-invalid
        @enderror" name="jur_sekolah" aria-label="Pilih Jurusan">
                                <option disabled selected>Pilih</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Kimia Industri">Kimia Industri</option>
                                <option value="Kimia Analis">Kimia Analis</option>
                                <option value="Tehnik Instalasi Listrik">Tehnik Instalasi Listrik</option>
                                <option value="Tehnik Permesinan">Tehnik Permesinan</option>
                                <option value="zz">Tehnik Pendinginan</option>
                                <option value="7">Tehnik Pengelasan</option>
                            </select>
                            @error('jur_sekolah')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" placeholder="Contoh '2022-2025'">
                                @error('tahun_lulus')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Wirausaha</label>
                                <input type="text" class="form-control @error('wirausaha') is-invalid @enderror" name="wirausaha" placeholder="Masukkan Bidang Wirausaha">
                                <div class="opacity-75 fst-italic">*Kosongkan bila tidak melakukan wirausaha</div>
                                @error('wirausaha')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="image">
                        @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat_rum') is-invalid @enderror" name="alamat_rum" rows="3" placeholder="Alamat Lengkap"></textarea>
                        @error('alamat_rum')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status')
      is-invalid
      @enderror" name="status" aria-label="Pilih Status">
                            <option disabled selected>Pilih</option>
                            <option value="1">Bekerja</option>
                            <option value="2">Kuliah</option>
                            <option value="3">Tidak Ada Kabar</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Section Bekerja -->
                    <div id="bekerja-section" style="display: none;">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Bekerja</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_per') is-invalid @enderror" name="nama_per" placeholder="Nama Perusahaan">
                            @error('nama_per')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Tokoh</label>
                            <input type="text" class="form-control @error('nama_tok') is-invalid @enderror" name="nama_tok" placeholder="Nama Tokoh">
                            @error('nama_tok')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Bekerja</label>
                            <input type="text" class="form-control @error('lok_bekerja') is-invalid @enderror" name="lok_bekerja" placeholder="Lokasi Bekerja">
                            @error('lok_bekerja')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Section Kuliah -->
                    <div id="kuliah-section" style="display: none;">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Kuliah</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jalur</label>
                            <select class="form-select @error('jalur') is-invalid @enderror" name="jalur">
                                <option disabled selected>Pilih</option>
                                <option value="1">PTN</option>
                                <option value="2">PTS</option>
                                <option value="3">DINAS</option>
                            </select>
                            @error('jalur')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan Tinggi</label>
                            <input type="text" class="form-control @error('nama_perti') is-invalid @enderror" name="nama_perti" placeholder="Nama Perguruan Tinggi">
                            @error('nama_perti')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan Prodi</label>
                            <input type="text" class="form-control @error('jur_prodi') is-invalid @enderror" name="jur_prodi" placeholder="Jurusan Prodi">
                            @error('jur_prodi')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kuliah</label>
                            <input type="text" class="form-control @error('lok_kuliah') is-invalid @enderror" name="lok_kuliah" placeholder="Lokasi Kuliah">
                            @error('lok_kuliah')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
</div>
<script>
    // Fungsi untuk toggle section
    function toggleSections(context, isEdit = false) {
        const prefix = isEdit ? 'edit-' : '';
        const statusSelect = context.querySelector("select[name='status']");
        
        if (!statusSelect) return;
        
        const bekerjaSection = context.querySelector(`#${prefix}bekerja-section`);
        const kuliahSection = context.querySelector(`#${prefix}kuliah-section`);
        const jalurSelect = context.querySelector("select[name='jalur']");

        if (!bekerjaSection || !kuliahSection) return;

        const status = statusSelect.value;
        
        if (status === "1") {
            bekerjaSection.style.display = "block";
            kuliahSection.style.display = "none";
            if (jalurSelect) jalurSelect.value = '';
        } else if (status === "2") {
            bekerjaSection.style.display = "none";
            kuliahSection.style.display = "block";
        } else {
            bekerjaSection.style.display = "none";
            kuliahSection.style.display = "none";
            if (jalurSelect) jalurSelect.value = '';
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
        
        // Event delegation untuk modal edit
        document.addEventListener('shown.bs.modal', function(e) {
            if (e.target.id.startsWith('edit')) {
                const modal = e.target;
                const statusSelect = modal.querySelector("select[name='status']");
                if (statusSelect) {
                    statusSelect.addEventListener('change', function() {
                        toggleSections(modal, true);
                    });
                    // Trigger perubahan awal berdasarkan nilai yang sudah ada
                    toggleSections(modal, true);
                }
            }
        });
    });
</script>
@endpush

@foreach($alumni as $a)
<!-- Modal Edit Data Siswa -->
<div class="modal fade" id="edit{{$a->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$a->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel{{$a->id}}">Edit Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('alumni.update', $a->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengk') is-invalid @enderror" name="nama_lengk" value="{{ old('nama_lengk', $a->nama_lengk) }}" placeholder="Masukkan Nama Lengkap Siswa">
                                @error('nama_lengk')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">NIS</label>
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis', $a->nis) }}" placeholder="Masukkan NIS Dengan Benar">
                                @error('nis')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror" name="nomor_telp" value="{{ old('nomor_telp', $a->nomor_telp) }}" placeholder="Masukkan Nomor Telpon">
                                @error('nomor_telp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jurusan</label>
                            <select class="form-select @error('jur_sekolah')
        is-invalid
        @enderror" name="jur_sekolah" aria-label="Pilih Jurusan">
                                <option disabled selected>Pilih</option>
                                <option value="Rekayasa Perangkat Lunak" {{ old('jur_sekolah', $a->jur_sekolah) == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                <option value="Kimia Industri" {{ old('jur_sekolah', $a->jur_sekolah) == 'Kimia Industri' ? 'selected' : '' }}>Kimia Industri</option>
                                <option value="Kimia Analis" {{ old('jur_sekolah', $a->jur_sekolah) == 'Kimia Analis' ? 'selected' : '' }}>Kimia Analis</option>
                                <option value="Tehnik Instalasi Listrik" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Instalasi Listrik' ? 'selected' : '' }}>Tehnik Instalasi Listrik</option>
                                <option value="Tehnik Permesinan" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Permesinan' ? 'selected' : '' }}>Tehnik Permesinan</option>
                                <option value="Tehnik Pendinginan" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Pendinginan' ? 'selected' : '' }}>Tehnik Pendinginan</option>
                                <option value="Tehnik Pengelasan" {{ old('jur_sekolah', $a->jur_sekolah) == 'Tehnik Pengelasan' ? 'selected' : '' }}>Tehnik Pengelasan</option>
                            </select>
                            @error('jur_sekolah')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" value="{{ old('tahun_lulus', $a->tahun_lulus) }}" placeholder="Contoh '2022-2025'">
                                @error('tahun_lulus')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Wirausaha</label>
                                <input type="text" class="form-control @error('wirausaha') is-invalid @enderror" name="wirausaha" value="{{ old('wirausaha', $a->wirausaha) }}" placeholder="Masukkan Bidang Wirausaha">
                                <div class="opacity-75 fst-italic">*Kosongkan bila tidak melakukan wirausaha</div>
                                @error('wirausaha')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="image">
                                @if($a->image)
                                    <small class="d-block mt-1">Gambar sekarang: <img src="{{ asset('storage/' . $a->image) }}" width="80"></small>
                                @endif
                                @error('foto')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Rumah</label>
                                <textarea class="form-control @error('alamat_rum') is-invalid @enderror" name="alamat_rum" rows="3" placeholder="Alamat Lengkap">{{ old('alamat_rum', $a->alamat_rum) }}</textarea>
                                @error('alamat_rum')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status')
      is-invalid
      @enderror" name="status" aria-label="Pilih Status">
                                    <option disabled selected>Pilih</option>
                                    <option value="1" {{ old('status', $a->status) == '1' ? 'selected' : '' }}>Bekerja</option>
                                    <option value="2" {{ old('status', $a->status) == '2' ? 'selected' : '' }}>Kuliah</option>
                                    <option value="3" {{ old('status', $a->status) == '3' ? 'selected' : '' }}>Tidak Ada Kabar</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>

                    <!-- Section Bekerja -->
                    <div id="edit-bekerja-section" style="display: old('status', a-status) = '1' 'block' 'none';">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Bekerja</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_per') is-invalid @enderror" name="nama_per" value="{{ old('nama_per', $a->nama_per) }}" placeholder="Nama Perusahaan">
                            @error('nama_per')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Tokoh</label>
                            <input type="text" class="form-control @error('nama_tok') is-invalid @enderror" name="nama_tok" value="{{ old('nama_tok', $a->nama_tok) }}" placeholder="Nama Tokoh">
                            @error('nama_tok')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Bekerja</label>
                            <input type="text" class="form-control @error('lok_bekerja') is-invalid @enderror" name="lok_bekerja" value="{{ old('lok_bekerja', $a->lok_bekerja) }}" placeholder="Lokasi Bekerja">
                            @error('lok_bekerja')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Section Kuliah -->
                    <div id="edit-kuliah-section" style="display: old('status', a-status) = '2' 'block' 'none';">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Kuliah</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jalur</label>
                            <select class="form-select @error('jalur') is-invalid @enderror" name="jalur">
                                <option value="" disabled selected>Pilih</option>
                                <option value="1" {{ old('jalur', $a->jalur) == '1' ? 'selected' : '' }}>PTN</option>
                                <option value="2" {{ old('jalur', $a->jalur) == '2' ? 'selected' : '' }}>PTS</option>
                                <option value="3" {{ old('jalur', $a->jalur) == '3' ? 'selected' : '' }}>DINAS</option>
                            </select>
                            @error('jalur')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan Tinggi</label>
                            <input type="text" class="form-control @error('nama_perti') is-invalid @enderror" name="nama_perti" value="{{ old('nama_perti', $a->nama_perti) }}" placeholder="Nama Perguruan Tinggi">
                            @error('nama_perti')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan Prodi</label>
                            <input type="text" class="form-control @error('jur_prodi') is-invalid @enderror" name="jur_prodi" value="{{ old('jur_prodi', $a->jur_prodi) }}" placeholder="Jurusan Prodi">
                            @error('jur_prodi')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kuliah</label>
                            <input type="text" class="form-control @error('lok_kuliah') is-invalid @enderror" name="lok_kuliah" value="{{ old('lok_kuliah', $a->lok_kuliah) }}" placeholder="Lokasi Kuliah">
                            @error('lok_kuliah')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
</div>
@endforeach

@foreach($alumni as $a)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $a->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $a->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $a->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $a->nama_lengk }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('alumni.destroy', $a->id) }}" method="POST">
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
