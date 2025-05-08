@extends('welcome')

@section('content')
<div class="container py-5">
    <div class="text-center mb-6">
        <h1 class="display-5 fw-bold mb-3 text-dark">Our Distinguished Alumni</h1>
        <p class="lead text-secondary">Meet our successful graduates from various fields</p>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4 g-3 justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <form action="{{ route('alumni.index') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" name="nama_lengk" class="form-control border-start-0" 
                                           placeholder="Search alumni..." value="{{ request('nama_lengk') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="tahun_lulus" class="form-select">
                                    <option value="">All Graduation Years</option>
                                    @isset($tahunList)
                                        @foreach($tahunList as $tahun)
                                            <option value="{{ $tahun }}" {{ request('tahun_lulus') == $tahun ? 'selected' : '' }}>
                                                Class of {{ $tahun }}
                                            </option>
                                        @endforeach
                                    @else
                                        <!-- Default years if variable not set -->
                                        @for($year = date('Y'); $year >= 2000; $year--)
                                            <option value="{{ $year }}" {{ request('tahun_lulus') == $year ? 'selected' : '' }}>
                                                Class of {{ $year }}
                                            </option>
                                        @endfor
                                    @endisset
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-funnel me-1"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alumni Cards -->
    <div class="row g-4 justify-content-center">
        @forelse ($alumni as $a)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card alumni-card border-0 overflow-hidden h-100 rounded-3">
                <div class="alumni-image-container position-relative">
                    @if($a->image)
                        <img src="{{ asset('storage/' . $a->image) }}" 
                             class="card-img-top alumni-image img-fluid" 
                             alt="{{ $a->nama_lengk }}"
                             loading="lazy">
                    @else
                        <div class="alumni-placeholder d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-circle fs-1 text-muted"></i>
                        </div>
                    @endif
                    <div class="alumni-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                    <div class="alumni-badge position-absolute bottom-0 start-0 p-2">
                        <span class="badge bg-dark rounded-pill px-3">
                            {{ $a->tahun_lulus }}
                        </span>
                    </div>
                </div>
                <div class="card-body text-center px-4 pb-4 pt-0">
                    <div class="alumni-content">
                        <h5 class="fw-bold mb-2 mt-3 text-dark">{{ $a->nama_lengk }}</h5>
                        <p class="text-secondary mb-3">{{ $a->jur_sekolah }}</p>
                        
                        <!-- Status Badge -->
                        @if($a->status == 1) <!-- Bekerja -->
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 mb-3">
                                <i class="bi bi-briefcase me-1"></i> {{ $a->nama_per ?? 'Employed' }}
                            </span>
                        @elseif($a->status == 2) <!-- Kuliah -->
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1 mb-3">
                                <i class="bi bi-mortarboard me-1"></i> {{ $a->nama_perti ?? 'Studying' }}
                            </span>
                        @elseif($a->wirausaha) <!-- Wirausaha -->
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-1 mb-3">
                                <i class="bi bi-shop me-1"></i> {{ $a->wirausaha ?? 'Entrepreneur' }}
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1 mb-3">
                                <i class="bi bi-question-circle me-1"></i> Other
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Detail Button -->
                <div class="card-footer bg-transparent border-0 pt-0 pb-3 text-center">
                    <button data-bs-toggle="modal" data-bs-target="#detail{{$a->id}}" 
                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-eye me-1"></i> View Profile
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-5">
                    <i class="bi bi-people fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted">No Alumni Found</h5>
                    <p class="text-muted">We couldn't find any alumni matching your criteria.</p>
                    <a href="{{ route('alumni.index') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($alumni->hasPages())
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                {{ $alumni->onEachSide(1)->links() }}
            </nav>
        </div>
    </div>
    @endif
</div>

<style>
    .alumni-card {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background: #fff;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }
    
    .alumni-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
    
    .alumni-image-container {
        height: 220px;
        overflow: hidden;
        background-color: #f8f9fa;
    }
    
    .alumni-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .alumni-placeholder {
        width: 100%;
        height: 100%;
        background-color: #f8f9fa;
    }
    
    .alumni-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0) 60%);
    }
    
    .alumni-card:hover .alumni-image {
        transform: scale(1.05);
    }
    
    .alumni-badge {
        z-index: 2;
    }
    
    @media (max-width: 768px) {
        .alumni-image-container {
            height: 180px;
        }
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Modal Detail Alumni -->
@foreach($alumni as $a)
<div class="modal fade" id="detail{{$a->id}}" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4 pt-0">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($a->image)
                            <img src="{{ asset('storage/' . $a->image) }}" 
                                 class="img-fluid rounded-3 mb-4 shadow-sm" 
                                 alt="{{ $a->nama_lengk }}"
                                 style="max-height: 250px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center mb-4" 
                                 style="height: 250px; width: 100%;">
                                <i class="bi bi-person-circle fs-1 text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-3">{{ $a->nama_lengk }}</h3>
                        
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="badge bg-dark rounded-pill px-3 py-1">
                                Class of {{ $a->tahun_lulus }}
                            </span>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                {{ $a->jur_sekolah }}
                            </span>
                            @if($a->nis)
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1">
                                NIS: {{ $a->nis }}
                            </span>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            @if($a->status == 1) <!-- Bekerja -->
                                <div class="d-flex align-items-start mb-3">
                                    <i class="bi bi-briefcase fs-5 text-success me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Currently Working At</h6>
                                        <p class="mb-0">{{ $a->nama_per }} ({{ $a->nama_tok }})</p>
                                        @if($a->lok_bekerja)
                                        <small class="text-muted">{{ $a->lok_bekerja }}</small>
                                        @endif
                                    </div>
                                </div>
                            @elseif($a->status == 2) <!-- Kuliah -->
                                <div class="d-flex align-items-start mb-3">
                                    <i class="bi bi-mortarboard fs-5 text-info me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Currently Studying At</h6>
                                        <p class="mb-0">{{ $a->nama_perti }} - {{ $a->jur_prodi }}</p>
                                        @if($a->lok_kuliah)
                                        <small class="text-muted">{{ $a->lok_kuliah }}</small>
                                        @endif
                                    </div>
                                </div>
                            @elseif($a->wirausaha) <!-- Wirausaha -->
                                <div class="d-flex align-items-start mb-3">
                                    <i class="bi bi-shop fs-5 text-warning me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Entrepreneur</h6>
                                        <p class="mb-0">{{ $a->wirausaha }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($a->alamat_rum)
                                <div class="d-flex align-items-start mb-3">
                                    <i class="bi bi-geo-alt fs-5 text-muted me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Location</h6>
                                        <p class="mb-0">{{ $a->alamat_rum }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-3">Contact Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone me-2 text-muted"></i>
                                        <span>{{ $a->nomor_telp ?? 'Not available' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope me-2 text-muted"></i>
                                        <span>{{ $a->email ?? 'Not available' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection