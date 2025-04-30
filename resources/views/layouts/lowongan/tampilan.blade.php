@extends('welcome') {{-- Ganti jika layout utamamu berbeda --}}

@section('content')
<div class="container-fluid px-0">

    <!-- Hero Section -->
    <div class="bg-primary py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="text-white fw-bold mb-3">Temukan Pekerjaan Impianmu</h1>
                    <p class="text-white-50 mb-4">Cari lowongan kerja terbaik di seluruh Indonesia</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="#" class="btn btn-light me-2">Pasang Loker</a>
                    <a href="#" class="btn btn-outline-light">Tips Loker</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="bg-light py-4 border-bottom">
        <div class="container">
            <form action="{{ route('lowongan.index') }}" method="GET" class="bg-white p-3 rounded shadow-sm">
                <div class="row g-2">
                    <div class="col-md-5">
                        <input type="text" name="nama_pekerjaan" class="form-control"
                            placeholder="Masukkan kata kunci" value="{{ request('nama_pekerjaan') }}">
                    </div>
                    <div class="col-md-5">
                        <select name="lokasi" class="form-select">
                            <option value="">Semua Lokasi</option>
                            <option value="Jakarta" {{ request('lokasi') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="Bandung" {{ request('lokasi') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="Surabaya" {{ request('lokasi') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="Remote" {{ request('lokasi') == 'Remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-danger w-100">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header bg-white fw-bold">
                        Paling Sering Dicari
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none">Administrasi</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Guru</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Driver</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">IT Support</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Accounting Finance</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Content Creator</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Fresh Graduate</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Penjualan</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Konstruksi Bangunan</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Digital Marketing</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Desain Grafis</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Komunikasi Pemasaran</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white fw-bold">
                        Filter Tambahan
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Pekerjaan</label>
                            <select class="form-select">
                                <option selected>Semua Jenis</option>
                                <option>Full-time</option>
                                <option>Part-time</option>
                                <option>Remote</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pendidikan</label>
                            <select class="form-select">
                                <option selected>Semua Pendidikan</option>
                                <option>SMA/SMK</option>
                                <option>D3</option>
                                <option>S1</option>
                                <option>S2</option>
                            </select>
                        </div>
                        <button class="btn btn-outline-primary w-100">Terapkan Filter</button>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0">Lowongan Kerja Terbaru</h4>
                    <div class="text-muted">{{ $lowongan->total() }} lowongan ditemukan</div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @forelse($lowongan as $l)
                <div class="card mb-3 shadow-sm hover-effect">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="https://via.placeholder.com/80?text=LOGO" alt="Company Logo" class="rounded" width="80">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="fw-bold mb-1">{{ $l->position }}</h5>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-muted me-2">{{ $l->company_name }}</span>
                                            <span class="badge bg-success bg-opacity-10 text-success small">
                                                <i class="fas fa-star me-1"></i>4.2
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-danger bg-opacity-10 text-danger">Segera</span>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $l->location }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-money-bill-wave me-1"></i>Rp{{ number_format($l->salary_min, 0, ',', '.') }}-{{ number_format($l->salary_max, 0, ',', '.') }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-briefcase me-1"></i>{{ $l->employment_type }}
                                    </span>
                                </div>

                                <p class="card-text">{{ Str::limit($l->description, 200) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>Diposting {{ $l->created_at->diffForHumans() }}
                                    </small>
                                    <div>
                                        <a href="#" class="btn btn-sm btn-danger">Lamar Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada lowongan ditemukan</h4>
                        <p class="text-muted">Coba sesuaikan pencarian atau filter Anda</p>
                    </div>
                </div>
                @endforelse

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $lowongan->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-effect:hover {
        transform: translateY(-3px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .badge {
        font-weight: normal;
        padding: 0.35em 0.65em;
    }

    .bg-primary {
        background-color: #2557a7 !important;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
@endpush
