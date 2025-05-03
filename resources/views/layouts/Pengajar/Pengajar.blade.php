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
                        <div class="col-md-2">
                            <label class="form-label small text-uppercase fw-bold text-muted">NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="Cari NIP..." value="{{ request('nip') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small text-uppercase fw-bold text-muted">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control border-start-0 ps-0" placeholder="Cari nama..." value="{{ request('nama_lengkap') }}">
                            </div>
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
                            <th style="width: 120px;">NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-center" style="width: 120px;">Tahun Bergabung</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
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
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <b>{{ $pengajar->firstItem() }}</b> sampai <b>{{ $pengajar->lastItem() }}</b> dari <b>{{ $pengajar->total() }}</b> entri
                </div>
                <div>
                    {{ $pengajar->onEachSide(1)->links() }}
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

@push('modal')
<!-- Modal Tambah Data Pengajar -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('pengajar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Masukkan Nama Lengkap Pengajar">
                                @error('nama_lengkap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">NIP</label>
                                <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" placeholder="Masukkan NIP Dengan Benar">
                                @error('nip')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Mata Pelajaran</label>
                                <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" name="mata_pelajaran" placeholder="Contoh 'Matematika'">
                                @error('mata_pelajaran')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Bergabung</label>
                                <input type="text" class="form-control @error('tahun_bergabung') is-invalid @enderror" name="tahun_bergabung" placeholder="Contoh '2022'">
                                @error('tahun_bergabung')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror" name="nomor_telp" placeholder="Masukkan Nomor Telpon Dengan Benar">
                                @error('nomor_telp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option disabled selected>Pilih</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                    <option value="3">Pensiun</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" placeholder="Contoh 'S1 Pendidikan Matematika'">
                                @error('pendidikan_terakhir')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" placeholder="Contoh 'Guru Matematika'">
                                @error('jabatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" placeholder="Alamat Lengkap"></textarea>
                        @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Pengajar</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                        @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
@endpush

@foreach($pengajar as $p)
<!-- Modal Edit Data Pengajar -->
<div class="modal fade" id="edit{{$p->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$p->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel{{$p->id}}">Edit Data Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('pengajar.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap', $p->nama_lengkap) }}" placeholder="Masukkan Nama Lengkap Pengajar">
                            @error('nama_lengkap')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIP</label>
                            <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $p->nip) }}" placeholder="Masukkan NIP Dengan Benar">
                            @error('nip')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" name="mata_pelajaran" value="{{ old('mata_pelajaran', $p->mata_pelajaran) }}" placeholder="Contoh 'Matematika'">
                            @error('mata_pelajaran')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Bergabung</label>
                            <input type="text" class="form-control @error('tahun_bergabung') is-invalid @enderror" name="tahun_bergabung" value="{{ old('tahun_bergabung', $p->tahun_bergabung) }}" placeholder="Contoh '2022'">
                            @error('tahun_bergabung')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Telpon</label>
                            <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror" name="nomor_telp" value="{{ old('nomor_telp', $p->nomor_telp) }}" placeholder="Masukkan Nomor Telpon Dengan Benar">
                            @error('nomor_telp')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="" disabled selected>Pilih</option>
                                <option value="1" {{ old('status', $p->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ old('status', $p->status) == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="3" {{ old('status', $p->status) == '3' ? 'selected' : '' }}>Pensiun</option>
                            </select>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $p->pendidikan_terakhir) }}" placeholder="Contoh 'S1 Pendidikan Matematika'">
                            @error('pendidikan_terakhir')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan', $p->jabatan) }}" placeholder="Contoh 'Guru Matematika'">
                            @error('jabatan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" placeholder="Alamat Lengkap">{{ old('alamat', $p->alamat) }}</textarea>
                        @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Pengajar</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                        <input type="hidden" name="foto_lama" value="{{ $p->foto }}">
                        @if($p->foto)
                            <small class="d-block mt-1">Foto sekarang: <img src="{{ asset('storage/' . $p->foto) }}" width="80"></small>
                        @endif
                        @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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

@foreach($pengajar as $p)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $p->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $p->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus data pengajar:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $p->nama_lengkap }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('pengajar.destroy', $p->id) }}" method="POST">
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