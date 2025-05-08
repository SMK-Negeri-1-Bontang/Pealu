@extends('welcome')

@section('content')
<div class="alumni-directory">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content animate__animated animate__fadeIn">
                <h1 class="hero-title">Our Distinguished Alumni Network</h1>
                <p class="hero-subtitle">Connecting successful graduates across generations and industries</p>
                <div class="hero-actions">
                    <a href="#alumni-grid" class="btn btn-primary btn-lg rounded-pill">
                        <i class="bi bi-people-fill me-2"></i>Explore Alumni
                    </a>
                    
                    @auth
                        @if (Auth::user()->isAdmin() || Auth::user()->isPetugas())
                        <a href="{{ url('/alumni') }}" class="btn btn-outline-light btn-lg rounded-pill" data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="bi bi-plus-circle me-2"></i>Add Alumni
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
                        <h3 class="stat-number">{{ $totalAlumni }}</h3>
                        <p class="stat-label">Total Alumni</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.2s">
                        <div class="stat-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h3 class="stat-number">{{ $workingCount }}</h3>
                        <p class="stat-label">Working Professionals</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.3s">
                        <div class="stat-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3 class="stat-number">{{ $studyingCount }}</h3>
                        <p class="stat-label">Currently Studying</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" data-animation-delay="0.4s">
                        <div class="stat-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h3 class="stat-number">{{ $entrepreneurCount }}</h3>
                        <p class="stat-label">Entrepreneurs</p>
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
                    <div class="filter-card p-4">  <!-- Added p-4 for inner padding -->
                        <form action="{{ route('alumni.dashboard') }}" method="GET">
                            <div class="row g-4 align-items-end">  <!-- Changed g-3 to g-4 for more gap -->
                                <div class="col-md-3 mb-2">  <!-- Added mb-2 for bottom margin -->
                                    <label class="form-label mb-2">Nama</label>  <!-- Added mb-2 -->
                                    <input type="text" name="nama" class="form-control form-control-lg ps-3"
                                        placeholder="Cari berdasarkan nama..." value="{{ request('nama') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label mb-2">NIS</label>
                                    <input type="text" name="nis" class="form-control form-control-lg ps-3" 
                                        placeholder="Cari NIS..." value="{{ request('nis') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label mb-2">Jurusan</label>
                                    <select name="jurusan" class="form-select form-select-lg ps-3">
                                        <option value="">Semua Jurusan</option>
                                        @foreach($jurusanList as $jurusan)
                                            <option value="{{ $jurusan }}" {{ request('jurusan') == $jurusan ? 'selected' : '' }}>
                                                {{ $jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label mb-2">Tahun Lulus</label>
                                    <select name="tahun_lulus" class="form-select form-select-lg ps-3">
                                        <option value="">Semua Tahun</option>
                                        @foreach($tahunList as $tahun)
                                            <option value="{{ $tahun }}" {{ request('tahun_lulus') == $tahun ? 'selected' : '' }}>
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

    <!-- Alumni Grid -->
    <section id="alumni-grid" class="alumni-grid-section py-5">
        <div class="container">
            <div class="section-header animate__animated animate__fadeIn">
                <h2 class="section-title">Featured Alumni</h2>
                <p class="section-subtitle">Discover our accomplished graduates</p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($alumni as $index => $a)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="alumni-card animate__animated animate__fadeInUp" data-animation-delay="{{ ($index % 4) * 0.1 }}s">
                        <div class="alumni-image-container">
                            @if($a->image)
                                <img src="{{ asset('storage/' . $a->image) }}" 
                                     class="alumni-image" 
                                     alt="{{ $a->nama_lengk }}"
                                     loading="lazy">
                            @else
                                <div class="alumni-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                            <div class="alumni-overlay"></div>
                            <div class="alumni-badge">
                                <span>{{ $a->tahun_lulus }}</span>
                            </div>
                        </div>
                        <div class="alumni-content">
                            <h5 class="alumni-name">{{ $a->nama_lengk }}</h5>
                            <p class="alumni-department">{{ $a->jur_sekolah }}</p>
                            
                            <!-- Status Badge -->
                            @if($a->status == 1) <!-- Bekerja -->
                                <span class="alumni-status working">
                                    <i class="bi bi-briefcase me-1"></i> {{ $a->nama_per ?? 'Employed' }}
                                </span>
                            @elseif($a->status == 2) <!-- Kuliah -->
                                <span class="alumni-status studying">
                                    <i class="bi bi-mortarboard me-1"></i> {{ $a->nama_perti ?? 'Studying' }}
                                </span>
                            @elseif($a->wirausaha) <!-- Wirausaha -->
                                <span class="alumni-status entrepreneur">
                                    <i class="bi bi-shop me-1"></i> {{ $a->wirausaha ?? 'Entrepreneur' }}
                                </span>
                            @else
                                <span class="alumni-status other">
                                    <i class="bi bi-question-circle me-1"></i> Other
                                </span>
                            @endif
                        </div>
                        
                        <!-- Detail Button -->
                        <div class="alumni-actions">
                            <button data-bs-toggle="modal" data-bs-target="#detail{{$a->id}}" 
                                    class="btn btn-outline-primary">
                                <i class="bi bi-eye me-1"></i> View Profile
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state animate__animated animate__fadeIn">
                        <i class="bi bi-people"></i>
                        <h5>No Alumni Found</h5>
                        <p>We couldn't find any alumni matching your criteria.</p>
                        <a href="{{ route('alumni.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($alumni->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <nav class="pagination-wrapper animate__animated animate__fadeIn">
                        {{ $alumni->onEachSide(1)->links('pagination::bootstrap-5') }}
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
                    <h2 class="cta-title">Join Our Alumni Network</h2>
                    <p class="cta-subtitle">Stay connected with your alma mater and fellow graduates</p>
                @else
                    <h2 class="cta-title">Welcome Back, {{ Auth::user()->name }}</h2>
                    <p class="cta-subtitle">Continue connecting with your alma mater and fellow graduates</p>
                @endguest
                
                <div class="cta-actions">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-light">
                            <i class="bi bi-person-plus me-2"></i>Register
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                        </a>
                    @else
                        <a href="{{ url('/profile') }}" class="btn btn-light">
                            <i class="bi bi-person-circle me-2"></i>My Profile
                        </a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-light"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
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
@foreach($alumni as $a)
<div class="modal fade" id="detail{{$a->id}}" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div>
                    <h3 class="modal-title">{{ $a->nama_lengk }}</h3>
                    <div class="modal-badges">
                        <span class="badge">{{ $a->jur_sekolah }}</span>
                        <span class="badge">Class of {{ $a->tahun_lulus }}</span>
                        @if($a->nis)
                        <span class="badge">NIS: {{ $a->nis }}</span>
                        @endif
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row g-0">
                    <div class="col-md-5 modal-profile-col">
                        <div class="modal-profile mt-4">
                            @if($a->image)
                                <img src="{{ asset('storage/' . $a->image) }}" 
                                     class="modal-profile-image" 
                                     alt="{{ $a->nama_lengk }}">
                            @else
                                <div class="modal-profile-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7 modal-details-col">
                        <div class="modal-details">
                            <!-- Status Information -->
                            <div class="modal-section">
                                @if($a->status == 1) <!-- Bekerja -->
                                    <div class="info-card working">
                                        <div class="info-icon">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="info-content">
                                            <h5>Professional Career</h5>
                                            <p class="company">{{ $a->nama_per }}</p>
                                            @if($a->nama_tok)
                                            <p class="position">{{ $a->nama_tok }}</p>
                                            @endif
                                            @if($a->lok_bekerja)
                                            <p class="location">
                                                <i class="bi bi-geo-alt"></i>
                                                <span>{{ $a->lok_bekerja }}</span>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                @elseif($a->status == 2) <!-- Kuliah -->
                                    <div class="info-card studying">
                                        <div class="info-icon">
                                            <i class="bi bi-mortarboard"></i>
                                        </div>
                                        <div class="info-content">
                                            <h5>Higher Education</h5>
                                            <p class="institution">{{ $a->nama_perti }}</p>
                                            @if($a->jur_prodi)
                                            <p class="program">{{ $a->jur_prodi }}</p>
                                            @endif
                                            @if($a->lok_kuliah)
                                            <p class="location">
                                                <i class="bi bi-geo-alt"></i>
                                                <span>{{ $a->lok_kuliah }}</span>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                @elseif($a->wirausaha) <!-- Wirausaha -->
                                    <div class="info-card entrepreneur">
                                        <div class="info-icon">
                                            <i class="bi bi-shop"></i>
                                        </div>
                                        <div class="info-content">
                                            <h5>Entrepreneurship</h5>
                                            <p class="business">{{ $a->wirausaha }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="modal-section">
                                <h5 class="section-title">Contact Information</h5>
                                <div class="contact-grid">
                                    <div class="contact-card full-width">
                                        <div class="contact-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                        <div class="contact-info">
                                            <small>Phone</small>
                                            <a href="#" class="phone-link">
                                                {{ $a->nomor_telp ?? 'Not available' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            @if($a->alamat_rum)
                            <div class="modal-section">
                                <h5 class="section-title">Location</h5>
                                <div class="location-card full-width">
                                    <div class="location-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div class="location-info">
                                        <span>{{ $a->alamat_rum }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Action Buttons -->
                            <div class="modal-actions">
                                <a href="{{ route('alumni.invoice', ['id' => $a->id]) }}" class="btn btn-primary"  title="Unduh">
                                    <i class="bi bi-download me-2"></i>Download Profile
                                </a>
                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-"></i>  Close
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
        padding: 2rem 0; /* Added more vertical padding */
    }

    .filter-card {
        background: var(--white-color);
        border-radius: 12px;
        padding: 2rem; /* Increased from 1.5rem */
        box-shadow: var(--card-shadow);
        margin: 0 1rem; /* Added horizontal margin */
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.75rem; /* Increased from 0.5rem */
        display: block; /* Ensures margin works properly */
    }

    .input-group-text {
        background-color: transparent;
        border-right: none;
        padding: 0.75rem 1rem; /* Added padding */
    }

    .form-control, .form-select {
        border-left: none;
        padding: 0.75rem 1rem !important; /* Added important to override */
        padding-left: 1rem !important; /* Added important to override */
    }

    /* Added new styles for better spacing */
    .input-group {
        margin-bottom: 0.5rem;
    }

    .btn {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    /* Alumni Grid */
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

    .alumni-card {
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

    .alumni-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .alumni-image-container {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .alumni-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .alumni-card:hover .alumni-image {
        transform: scale(1.1);
    }

    .alumni-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f5f7fa;
    }

    .alumni-placeholder i {
        font-size: 4rem;
        color: #ced4da;
    }

    .alumni-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 60%);
    }

    .alumni-badge {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        z-index: 2;
    }

    .alumni-badge span {
        background-color: rgba(0,0,0,0.7);
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .alumni-content {
        padding: 1.5rem;
        text-align: center;
        flex-grow: 1;
    }

    .alumni-name {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .alumni-department {
        color: var(--gray-color);
        margin-bottom: 1rem;
    }

    .alumni-status {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .alumni-status.working {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-color);
    }

    .alumni-status.studying {
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info-color);
    }

    .alumni-status.entrepreneur {
        background-color: rgba(255, 193, 7, 0.1);
        color: var(--warning-color);
    }

    .alumni-status.other {
        background-color: rgba(108, 117, 125, 0.1);
        color: var(--gray-color);
    }

    .alumni-actions {
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
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white-color);
        padding: 1.5rem;
        border-bottom: none;
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

    .modal-social {
        margin-top: auto;
    }

    .modal-social h6 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--dark-color);
    }

    .social-links {
        display: flex;
        gap: 0.75rem;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: var(--dark-color);
        transition: var(--transition);
    }

    .social-link:hover {
        background-color: var(--primary-color);
        color: var(--white-color);
        transform: translateY(-3px);
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

    .info-card.working {
        border-left: 4px solid var(--success-color);
    }

    .info-card.studying {
        border-left: 4px solid var(--info-color);
    }

    .info-card.entrepreneur {
        border-left: 4px solid var(--warning-color);
    }

    .info-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .info-card.working .info-icon {
        color: var(--success-color);
    }

    .info-card.studying .info-icon {
        color: var(--info-color);
    }

    .info-card.entrepreneur .info-icon {
        color: var(--warning-color);
    }

    .info-content h5 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .company, .institution, .business {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .position, .program {
        color: var(--gray-color);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .location {
        display: flex;
        align-items: center;
        color: var(--gray-color);
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .location i {
        margin-right: 0.5rem;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .contact-card {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        background-color: #f8f9fa;
    }

    .contact-icon {
        font-size: 1.25rem;
        color: var(--primary-color);
    }

    .contact-info small {
        display: block;
        font-size: 0.75rem;
        color: var(--gray-color);
        margin-bottom: 0.25rem;
    }

    .contact-info span {
        font-weight: 500;
    }

    /* Contact Card Full Width */
    .contact-grid {
        display: block; /* Ubah dari grid ke block */
    }

    .contact-card.full-width {
        width: 100%;
        margin: 0;
    }

    /* Atau jika Anda ingin mempertahankan grid tapi full width */
    .contact-grid {
        grid-template-columns: 1fr; /* Hanya satu kolom full width */
    }

    .contact-card {
        grid-column: 1 / -1; /* Memaksa card mengambil seluruh lebar grid */
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
        
        .alumni-image-container {
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
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- JavaScript for animations -->
<script>
    // Initialize animations when elements come into view
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
        
        const sections = document.querySelectorAll('.alumni-card, .stat-card, .section-header');
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
        const hasSearchParams = urlParams.has('nama') || urlParams.has('nis') || 
                            urlParams.has('jurusan') || urlParams.has('tahun_lulus');
        
        if (hasSearchParams) {
            // Scroll ke alumni grid setelah halaman dimuat
            setTimeout(() => {
                const alumniGrid = document.getElementById('alumni-grid');
                if (alumniGrid) {
                    alumniGrid.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300); // Delay sedikit untuk memastikan konten sudah dimuat
        }
        
        // Tangani submit form
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                // Simpan posisi scroll sebelum submit
                sessionStorage.setItem('shouldScrollToAlumni', 'true');
            });
        }
        
        // Cek setelah halaman dimuat ulang
        if (sessionStorage.getItem('shouldScrollToAlumni') === 'true') {
            sessionStorage.removeItem('shouldScrollToAlumni');
            setTimeout(() => {
                const alumniGrid = document.getElementById('alumni-grid');
                if (alumniGrid) {
                    alumniGrid.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300);
        }
    });
</script>
@endsection