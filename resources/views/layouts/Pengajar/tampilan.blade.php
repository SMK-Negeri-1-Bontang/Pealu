@extends('welcome')

@section('content')
<div class="container py-5">
    <div class="text-center mb-6">
        <h1 class="display-5 fw-bold mb-3 text-dark">Our Expert Educators</h1>
        <p class="lead text-secondary">Meet our passionate team of professional instructors</p>
    </div>

    <div class="row g-4 justify-content-center">
        @foreach ($pengajar as $p)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card teacher-card border-0 overflow-hidden h-100 rounded-3">
                <div class="teacher-image-container position-relative">
                    <img src="{{ asset('storage/' . $p->foto) }}" 
                         class="card-img-top teacher-image img-fluid" 
                         alt="{{ $p->nama_lengkap }}"
                         loading="lazy">
                    <div class="teacher-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                </div>
                <div class="card-body text-center px-4 pb-4 pt-0">
                    <div class="teacher-content">
                        <h5 class="fw-bold mb-2 mt-3 text-dark">{{ $p->nama_lengkap }}</h5>
                        <p class="text-secondary mb-3">{{ $p->jabatan }}</p>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 mb-3">
                            {{ $p->mata_pelajaran }}
                        </span>
                        
                        <div class="teacher-social mt-3 d-flex justify-content-center">
                            <a href="#" class="text-secondary mx-2 hover-primary"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-secondary mx-2 hover-primary"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="text-secondary mx-2 hover-primary"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .teacher-card {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background: #fff;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }
    
    .teacher-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
    
    .teacher-image-container {
        height: 220px;
        overflow: hidden;
    }
    
    .teacher-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .teacher-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0) 60%);
    }
    
    .teacher-card:hover .teacher-image {
        transform: scale(1.05);
    }
    
    .teacher-social {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .teacher-card:hover .teacher-social {
        opacity: 1;
    }
    
    .hover-primary:hover {
        color: #0d6efd !important;
    }
    
    @media (max-width: 768px) {
        .teacher-image-container {
            height: 180px;
        }
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection