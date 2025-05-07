@extends('welcome')

@section('content')
<div class="container py-5">
    @foreach($tmbberita as $b)
    <div class="card border-0 shadow-sm mb-5 overflow-hidden">
        <div class="row g-0">
            <!-- Featured Image -->
            <div class="col-lg-5">
                <img src="{{ asset('storage/' . $b->image) }}" 
                     class="img-fluid h-100 object-fit-cover" 
                     alt="{{ $b->title }}"
                     loading="lazy">
            </div>
            
            <!-- Content -->
            <div class="col-lg-7">
                <div class="card-body p-4 p-lg-5">
                    <!-- Article Header -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary me-2">News</span>
                        <small class="text-muted">{{ $b->created_at->format('F j, Y') }}</small>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="display-5 fw-bold mb-4">{{ $b->title }}</h1>
                    
                    <!-- Content -->
                    <div class="article-content">
                        @foreach(explode("\n", $b->content) as $paragraph)
                            <p class="mb-4">{{ $paragraph }}</p>
                        @endforeach
                    </div>
                    
                    <!-- Footer -->
                    <div class="d-flex align-items-center mt-4 pt-3 border-top">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-4 text-muted me-2"></i>
                            <span class="text-muted">Admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .object-fit-cover {
        object-fit: cover;
        width: 100%;
        height: 100%;
        min-height: 350px;
    }
    
    .article-content p {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #495057;
    }
    
    @media (max-width: 992px) {
        .object-fit-cover {
            min-height: 250px;
            height: auto;
        }
        
        .card-body {
            padding: 2rem !important;
        }
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }
        
        h1.display-5 {
            font-size: 2rem;
        }
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection