@extends('welcome')

@section('content')
<div class="educator-directory">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content animate__animated animate__fadeIn">
                <h1 class="hero-title">Pengajar Profesional Kami</h1>
                <p class="hero-subtitle">Kenali tim pengajar berpengalaman dan berdedikasi</p>
                <div class="hero-actions">
                    <a href="#educator-grid" class="btn btn-primary btn-lg rounded-pill">
                        <i class="bi bi-people-fill me-2"></i>Lihat Pengajar
                    </a>
                    
                    @auth
                        @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                        <a href="{{ url('/pengajar') }}" class="btn btn-outline-light btn-lg rounded-pill">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Pengajar
                        </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.1s">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="stat-number">{{ $totalPengajar }}</h3>
                        <p class="stat-label">Total Pengajar</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.2s">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h3 class="stat-number">{{ $aktifCount }}</h3>
                        <p class="stat-label">Aktif</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.3s">
                        <div class="stat-icon">
                            <i class="bi bi-pause-circle"></i>
                        </div>
                        <h3 class="stat-number">{{ $nonAktifCount }}</h3>
                        <p class="stat-label">Tidak Aktif</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.4s">
                        <div class="stat-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <h3 class="stat-number">{{ $pengajar->count() }}</h3>
                        <p class="stat-label">Staf Pengajar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center animate__animated animate__fadeIn">
                <div class="col-lg-12">
                    <div class="filter-card p-4">
                        <form action="{{ route('pengajar.tampilan') }}" method="GET">
                            <div class="row g-4 align-items-end">
                                <div class="col-md-3 mb-2">
                                    <label class="form-label mb-2">Nama</label>
                                    <input type="text" name="nama_lengkap" class="form-control form-control-lg ps-3"
                                        placeholder="Cari berdasarkan nama..." value="{{ request('nama_lengkap') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label mb-2">NIP</label>
                                    <input type="text" name="nip" class="form-control form-control-lg ps-3" 
                                        placeholder="Cari NIP..." value="{{ request('nip') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label mb-2">Mata Pelajaran</label>
                                    <select name="mata_pelajaran" class="form-select form-select-lg ps-3">
                                        <option value="">Semua Mata Pelajaran</option>
                                        @foreach($mataPelajaranList as $mapel)
                                            <option value="{{ $mapel }}" {{ request('mata_pelajaran') == $mapel ? 'selected' : '' }}>
                                                {{ $mapel }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label mb-2">Tahun Bergabung</label>
                                    <select name="tahun_bergabung" class="form-select form-select-lg ps-3">
                                        <option value="">Semua Tahun</option>
                                        @foreach($tahunBergabungList as $tahun)
                                            <option value="{{ $tahun }}" {{ request('tahun_bergabung') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                                        <i class="bi bi-search me-2"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Educator Grid -->
    <section id="educator-grid" class="educator-grid-section py-5">
        <div class="container">
            <div class="section-header animate__animated animate__fadeIn">
                <h2 class="section-title">Staf Pengajar</h2>
                <p class="section-subtitle">Kenali para pengajar berdedikasi kami</p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($pengajar as $index => $p)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="educator-card animate__animated animate__fadeInUp" data-animation-delay="{{ ($index % 4) * 0.1 }}s">
                        <div class="educator-image-container">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" 
                                     class="educator-image" 
                                     alt="{{ $p->nama_lengkap }}"
                                     loading="lazy">
                            @else
                                <div class="educator-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                            <div class="educator-overlay"></div>
                            <div class="educator-badge">
                                <span>{{ $p->tahun_bergabung }}</span>
                            </div>
                        </div>
                        <div class="educator-content">
                            <h5 class="educator-name">{{ $p->nama_lengkap }}</h5>
                            <p class="educator-position">{{ $p->jabatan }}</p>
                            
                            <!-- Subject Badge -->
                            <span class="educator-subject">
                                <i class="bi bi-book me-1"></i> {{ $p->mata_pelajaran }}
                            </span>
                            
                            <!-- Status Badge -->
                            @if($p->status == 1)
                                <span class="educator-status active">
                                    <i class="bi bi-check-circle me-1"></i> Aktif
                                </span>
                            @elseif($p->status == 2)
                                <span class="educator-status inactive">
                                    <i class="bi bi-pause-circle me-1"></i> Tidak Aktif
                                </span>
                            @else
                                <span class="educator-status retired">
                                    <i class="bi bi-award me-1"></i> Purna Tugas
                                </span>
                            @endif
                        </div>
                        
                        <!-- Detail Button -->
                        <div class="educator-actions">
                            <button data-bs-toggle="modal" data-bs-target="#lihat{{$p->id}}" 
                                    class="btn btn-outline-primary">
                                <i class="bi bi-eye me-1"></i> Lihat Profil
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state animate__animated animate__fadeIn">
                        <i class="bi bi-people"></i>
                        <h5>Tidak Ada Pengajar Ditemukan</h5>
                        <p>Kami tidak menemukan pengajar sesuai kriteria Anda.</p>
                        <a href="{{ route('pengajar.tampilan') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Atur Ulang Filter
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($pengajar->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <nav class="pagination-wrapper animate__animated animate__fadeIn">
                        {{ $pengajar->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-6">
        <div class="container">
            <div class="cta-content animate__animated animate__fadeIn">
                @guest
                    <h2 class="cta-title">Bergabunglah dengan Jaringan Pengajar</h2>
                    <p class="cta-subtitle">Jadilah bagian dari tim pengajar berdedikasi kami</p>
                @else
                    <h2 class="cta-title">Selamat Datang Kembali, {{ Auth::user()->name }}</h2>
                    <p class="cta-subtitle">Lanjutkan perjalanan Anda dengan institusi kami</p>
                @endguest
                
                <div class="cta-actions">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-light">
                            <i class="bi bi-person-plus me-2"></i>Daftar
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </a>
                    @else
                        <a href="{{ url('/profile') }}" class="btn btn-light">
                            <i class="bi bi-person-circle me-2"></i>Profil Saya
                        </a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-light"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modern Modal Design -->
@foreach($pengajar as $p)
<div class="modal fade" id="lihat{{$p->id}}" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <div>
                    <h3 class="modal-title">{{ $p->nama_lengkap }}</h3>
                    <div class="modal-badges">
                        <span class="badge">{{ $p->jabatan }}</span>
                        <span class="badge">Bergabung {{ $p->tahun_bergabung }}</span>
                        @if($p->nip)
                        <span class="badge">NIP: {{ $p->nip }}</span>
                        @endif
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row g-0">
                    <div class="col-md-5 modal-profile-col">
                        <div class="modal-profile d-flex justify-content-center">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" 
                                     class="modal-profile-image" 
                                     alt="{{ $p->nama_lengkap }}">
                            @else
                                <div class="modal-profile-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7 modal-details-col">
                        <div class="modal-details">
                            <!-- Educator Information -->
                            <div class="modal-section">
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>Mata Pelajaran</h5>
                                        <p class="subject">{{ $p->mata_pelajaran }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Education Information -->
                            <div class="modal-section">
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>Pendidikan Terakhir</h5>
                                        <p class="education">{{ $p->pendidikan_terakhir }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Status Information -->
                            <div class="modal-section">
                                <div class="info-card">
                                    <div class="info-icon">
                                        @if($p->status == 1)
                                            <i class="bi bi-check-circle text-success"></i>
                                        @elseif($p->status == 2)
                                            <i class="bi bi-pause-circle text-warning"></i>
                                        @else
                                            <i class="bi bi-award text-secondary"></i>
                                        @endif
                                    </div>
                                    <div class="info-content">
                                        <h5>Status</h5>
                                        <p class="status">
                                            @if($p->status == 1)
                                                Aktif
                                            @elseif($p->status == 2)
                                                Tidak Aktif
                                            @else
                                                Purna Tugas
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="modal-section">
                                <h5 class="section-title">Informasi Kontak</h5>
                                <div class="contact-card custom-phone-card">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi bi-telephone me-2"></i>
                                        <span class="phone-label">Telepon</span>
                                    </div>
                                    <a href="tel:{{ $p->nomor_telp }}" class="phone-link">
                                        {{ $p->nomor_telp ?? 'Tidak tersedia' }}
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            @if($p->alamat)
                            <div class="modal-section">
                                <h5 class="section-title">Alamat</h5>
                                <div class="location-card full-width">
                                    <div class="location-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div class="location-info">
                                        <span>{{ $p->alamat }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Action Buttons -->
                            <div class="modal-actions">
                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Styles -->
<style>
    /* Base Styles */
    :root {
        --primary-color: #3a7bd5;
        --secondary-color: #00d2ff;
        --dark-color: #2c3e50;
        --light-color: #f8f9fa;
        --success-color: #28a745;
        --info-color: #17a2b8;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --gray-color: #6c757d;
        --white-color: #ffffff;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white-color);
        padding: 6rem 0 8rem;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==');
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .hero-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        color: var(--white-color);
    }

    .hero-wave svg {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Stats Section */
    .stats-section {
        background-color: var(--white-color);
        position: relative;
        z-index: 2;
        margin-top: -50px;
    }

    .stat-card {
        background: var(--white-color);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .stat-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .stat-label {
        color: var(--gray-color);
        margin-bottom: 0;
    }

    /* Filter Section */
    .filter-section {
        position: relative;
        padding: 2rem 0;
    }

    .filter-card {
        background: var(--white-color);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--card-shadow);
        margin: 0 1rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.75rem;
        display: block;
    }

    .input-group-text {
        background-color: transparent;
        border-right: none;
        padding: 0.75rem 1rem;
    }

    .form-control, .form-select {
        border-left: none;
        padding: 0.75rem 1rem !important;
        padding-left: 1rem !important;
    }

    /* Educator Grid */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0;
    }

    .section-subtitle {
        color: var(--gray-color);
        margin-bottom: 0;
    }

    .educator-card {
        background: var(--white-color);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .educator-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .educator-image-container {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .educator-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .educator-card:hover .educator-image {
        transform: scale(1.1);
    }

    .educator-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f5f7fa;
    }

    .educator-placeholder i {
        font-size: 4rem;
        color: #ced4da;
    }

    .educator-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 60%);
    }

    .educator-badge {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        z-index: 2;
    }

    .educator-badge span {
        background-color: rgba(0,0,0,0.7);
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .educator-content {
        padding: 1.5rem;
        text-align: center;
        flex-grow: 1;
    }

    .educator-name {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .educator-position {
        color: var(--gray-color);
        margin-bottom: 1rem;
    }

    .educator-subject {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1rem;
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info-color);
    }

    .educator-status {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .educator-status.active {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-color);
    }

    .educator-status.inactive {
        background-color: rgba(255, 193, 7, 0.1);
        color: var(--warning-color);
    }

    .educator-status.retired {
        background-color: rgba(108, 117, 125, 0.1);
        color: var(--gray-color);
    }

    .educator-actions {
        padding: 0 1.5rem 1.5rem;
        text-align: center;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: var(--white-color);
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--gray-color);
        margin-bottom: 1rem;
    }

    .empty-state h5 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .empty-state p {
        color: var(--gray-color);
        margin-bottom: 1.5rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white-color);
        padding: 5rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==');
    }

    .cta-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .cta-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }

    .modal-header {
        color: #ffffff !important;
        padding: 1.5rem !important;
        border-bottom: none !important;
    }

    .modal-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .modal-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .modal-badges .badge {
        background-color: rgba(255,255,255,0.2);
        color: var(--white-color);
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .btn-close {
        filter: invert(1);
    }

    .modal-body {
        padding: 0;
    }

    .modal-profile-col {
        background-color: #f8f9fa;
    }

    .modal-profile {
        height: 100%;
        padding: 2rem;
        display: flex;
        flex-direction: column;
    }

    .modal-profile-image {
        width: 100%;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .modal-profile-placeholder {
        width: 100%;
        height: 250px;
        background-color: #e9ecef;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .modal-profile-placeholder i {
        font-size: 4rem;
        color: #adb5bd;
    }

    .modal-details-col {
        padding: 2rem;
    }

    .modal-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--dark-color);
    }

    .info-card {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        border-radius: 12px;
        background-color: #f8f9fa;
    }

    .info-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .info-content h5 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .subject, .education, .status {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .contact-grid {
        display: block;
    }

    .contact-card.full-width {
        width: 100%;
        margin: 0;
    }

    .contact-grid {
        grid-template-columns: 1fr;
    }

    .contact-card {
        grid-column: 1 / -1;
    }

    .location-card {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        background-color: #f8f9fa;
    }

    .location-icon {
        font-size: 1.25rem;
        color: var(--primary-color);
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
    }

    /* Animations */
    .animate__animated {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .animate__fadeIn {
        animation-name: fadeIn;
    }

    .animate__fadeInUp {
        animation-name: fadeInUp;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .educator-image-container {
            height: 200px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 6rem;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-actions, .cta-actions {
            flex-direction: column;
            align-items: center;
        }
        
        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .modal-body .row {
            flex-direction: column;
        }
        
        .modal-profile-col {
            order: -1;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.75rem;
        }
        
        .hero-subtitle, .cta-subtitle {
            font-size: 1rem;
        }
        
        .stat-card {
            padding: 1.5rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
    }

    .phone-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
        word-break: break-all;
    }
    .phone-link:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }
    .custom-phone-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
    }
    .custom-phone-card .phone-label {
        font-weight: 500;
        color: #6c757d;
        font-size: 1rem;
    }
    .custom-phone-card .phone-link {
        display: block;
        margin-left: 2rem;
        margin-top: 0.25rem;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        word-break: break-all;
    }
    .custom-phone-card .phone-link:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- JavaScript for animations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements with data-animation-delay
        const animateElements = document.querySelectorAll('[data-animation-delay]');
        
        animateElements.forEach(element => {
            const delay = element.getAttribute('data-animation-delay');
            element.style.animationDelay = delay + 's';
        });
        
        // Add intersection observer for scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        const sections = document.querySelectorAll('.educator-card, .stat-card, .section-header');
        sections.forEach(section => {
            observer.observe(section);
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.querySelector('.filter-card form');
        
        // Cek jika form submit berasal dari pencarian (ada parameter GET)
        const urlParams = new URLSearchParams(window.location.search);
        const hasSearchParams = urlParams.has('nama_lengkap') || urlParams.has('nip') || 
                            urlParams.has('mata_pelajaran') || urlParams.has('tahun_bergabung');
        
        if (hasSearchParams) {
            // Scroll ke educator grid setelah halaman dimuat
            setTimeout(() => {
                const educatorGrid = document.getElementById('educator-grid');
                if (educatorGrid) {
                    educatorGrid.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300);
        }
        
        // Tangani submit form
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                sessionStorage.setItem('shouldScrollToEducator', 'true');
            });
        }
        
        // Cek setelah halaman dimuat ulang
        if (sessionStorage.getItem('shouldScrollToEducator') === 'true') {
            sessionStorage.removeItem('shouldScrollToEducator');
            setTimeout(() => {
                const educatorGrid = document.getElementById('educator-grid');
                if (educatorGrid) {
                    educatorGrid.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300);
        }
    });
</script>
@endsection