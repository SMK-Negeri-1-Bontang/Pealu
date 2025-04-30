@extends('welcome')

@section('content')
<div class="">
    <!-- Main Content -->
    <div class="">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <strong>{{ $message }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($message = Session::get('update'))
        <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-2"></i>
                <strong>{{ $message }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($message = Session::get('delete'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>{{ $message }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary bg-gradient text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-briefcase me-2"></i> Manajemen Lowongan Kerja
                    </h4>
                    <div class="d-flex gap-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambahLowongan" 
                        class="btn btn-light btn-sm rounded-pill">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Lowongan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Search Form -->
                <div class="mb-4">
                    <form action="{{ route('lowongan.index') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input id="search-focus" type="search" name="search" 
                                    class="form-control border-start-0 ps-0 shadow-none" 
                                    placeholder="Cari posisi atau perusahaan..." 
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
                                <th>Posisi</th>
                                <th>Perusahaan</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">Gaji</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowongan as $no => $l)
                            <tr class="hover-shadow">
                                <th scope="row" class="text-center">{{ ($lowongan->currentPage() - 1) * $lowongan->perPage() + $no + 1 }}</th>
                                <td>
                                    <div class="fw-semibold">{{ $l->position }}</div>
                                    <small class="text-muted">Terakhir diupdate: {{ $l->updated_at->format('d M Y') }}</small>
                                </td>
                                <td>{{ $l->company_name }}</td>
                                <td class="text-center">{{ $l->location }}</td>
                                <td class="text-center">Rp{{ number_format($l->salary_min, 0, ',', '.') }} - Rp{{ number_format($l->salary_max, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $l->employment_type }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLihat{{$l->id}}"
                                            class="btn btn-outline-info rounded-start-pill" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit{{$l->id}}"
                                            class="btn btn-outline-primary" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus{{$l->id}}"
                                            class="btn btn-outline-danger rounded-end-pill" title="Hapus">
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
                                            <h5 class="alert-heading mb-1">Data Lowongan Kosong</h5>
                                            <p class="mb-0">Belum ada lowongan yang tersedia. Silakan tambah lowongan baru.</p>
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
                        Menampilkan <b>{{ $lowongan->firstItem() }}</b> sampai <b>{{ $lowongan->lastItem() }}</b> dari <b>{{ $lowongan->total() }}</b> lowongan
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            @if ($lowongan->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link rounded-pill">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link rounded-pill" href="{{ $lowongan->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            @foreach ($lowongan->links()->elements[0] as $page => $url)
                                <li class="page-item {{ $lowongan->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link rounded-circle" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($lowongan->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link rounded-pill" href="{{ $lowongan->nextPageUrl() }}" rel="next">&raquo;</a>
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

<!-- Modal Tambah Lowongan -->
<div class="modal fade" id="modalTambahLowongan" tabindex="-1" aria-labelledby="modalTambahLowonganLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLowonganLabel">Tambah Lowongan Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('lowongan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="company_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Posisi</label>
                            <input type="text" class="form-control" name="position" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe</label>
                            <select class="form-select" name="employment_type" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Full time">Full-time</option>
                                <option value="Part time">Part-time</option>
                                <option value="Remote">Remote</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan</label>
                            <select class="form-select" name="education">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="col-md-3">
                            <label for="salary_min" class="form-label">Gaji Minimum</label>
                            <input type="number" class="form-control" id="salary_min" name="salary_min" required>
                        </div>
                        <div class="col-md-3">
                            <label for="salary_max" class="form-label">Gaji Maksimum</label>
                            <input type="number" class="form-control" id="salary_max" name="salary_max" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input class="form-control" name="category" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pengalaman</label>
                        <textarea class="form-control" name="experience" rows="3"></textarea>
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


<!-- Modals Lihat, Edit, Hapus -->
@foreach($lowongan as $l)

<!-- Modal Lihat -->
<div class="modal fade" id="modalLihat{{ $l->id }}" tabindex="-1" aria-labelledby="modalLihatLabel{{ $l->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLihatLabel{{ $l->id }}">Detail Lowongan Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h3 class="fw-bold">{{ $l->position }}</h3>
                        <h5 class="text-primary">{{ $l->company_name }}</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-success bg-opacity-10 text-success fs-6">
                            <i class="fas fa-star me-1"></i>4.2
                        </span>
                    </div>
                </div>
                
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                        <span>{{ $l->location }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-money-bill-wave me-2 text-muted"></i>
                        <span>Rp{{ number_format($l->salary_min, 0, ',', '.') }} - Rp{{ number_format($l->salary_max, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-briefcase me-2 text-muted"></i>
                        <span>{{ $l->employment_type }}</span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2">Deskripsi Pekerjaan</h5>
                    <div class="ps-3">
                        @foreach(explode("\n", $l->description) as $paragraph)
                            @if(trim($paragraph) !== '')
                                <p class="mb-2">{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                <div class="text-muted small">
                    <i class="far fa-clock me-1"></i>Diposting {{ $l->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-primary">Lamar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit{{ $l->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $l->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <form action="{{ route('lowongan.update', $l->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel{{ $l->id }}">Edit Lowongan Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Nama Pekerjaan</label>
                            <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror"
                                value="{{ old('position', $l->position) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                                value="{{ old('company_name', $l->company_name) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $l->location) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="employment_type" class="form-label">Jenis Pekerjaan</label>
                            <select id="employment_type" name="employment_type" class="form-select @error('employment_type') is-invalid @enderror"
                                style="background-color: #e9ecef; border: none; height: 40px;" required>
                                <option value="Full-time" {{ old('employment_type', $l->employment_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('employment_type', $l->employment_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Kontrak" {{ old('employment_type', $l->employment_type) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                <option value="Freelance" {{ old('employment_type', $l->employment_type) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                            @error('employment_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="salary_min" class="form-label">Gaji Minimum</label>
                            <input type="number" id="salary_min" name="salary_min" class="form-control @error('salary_min') is-invalid @enderror"
                                value="{{ old('salary_min', $l->salary_min) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                            @error('salary_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="salary_max" class="form-label">Gaji Maksimum</label>
                            <input type="number" id="salary_max" name="salary_max" class="form-control @error('salary_max') is-invalid @enderror"
                                value="{{ old('salary_max', $l->salary_max) }}" style="background-color: #e9ecef; border: none; height: 40px;" required>
                            @error('salary_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Pekerjaan</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="5" style="background-color: #e9ecef; border: none;" required>{{ old('description', $l->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus{{ $l->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $l->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $l->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus lowongan:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $l->position }}</h5>
                <p class="text-muted">Dari {{ $l->company_name }}</p>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('lowongan.destroy', $l->id) }}" method="POST">
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

@endsection