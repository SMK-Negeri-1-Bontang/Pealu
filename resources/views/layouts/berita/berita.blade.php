@extends('welcome')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Berita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Garis tengah */
        .divider {
            border-right: 2px solid #ccc; /* Garis vertikal */
            height: 100vh; /* Garis memenuhi tinggi layar */
        }

        /* Scroll independen untuk setiap bagian */
        .scrollable {
        height: 100vh; /* Tinggi penuh layar */
        overflow-y: auto; /* Aktifkan scroll vertikal */
        padding: 20px;
}

        /* Mengatur lebar scrollbar */
        .scrollable::-webkit-scrollbar {
            width: 6px; /* Lebar scrollbar lebih kecil */
        }

        /* Warna track scrollbar */
        .scrollable::-webkit-scrollbar-track {
            background: #f1f1f1; /* Warna latar belakang track */
            border-radius: 10px;
        }

        /* Warna thumb (bagian yang bisa digeser) */
        .scrollable::-webkit-scrollbar-thumb {
            background: #888; /* Warna thumb */
            border-radius: 10px; /* Membuatnya lebih bulat */
        }

        /* Efek saat hover di scrollbar */
        .scrollable::-webkit-scrollbar-thumb:hover {
            background: #555;
        }


        /* Pastikan row dan column mengambil tinggi penuh */
        .full-height {
            height: 100vh;
        }

        /* Kolom kiri (30% lebar) */
        .col-left {
            width: 70%; /* Lebar 30% */
        }

        /* Kolom kanan (70% lebar) */
        .col-right {
            width: 30%; /* Lebar 70% */
        }

        /* Layout artikel dengan gambar dan teks sejajar */
        .article {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        /* Ukuran gambar kecil dan seragam */
        .article img {
            width: 80px; 
            height: auto;
            flex-shrink: 0;
        }

        /* Ukuran gambar di bagian kiri harus sama */
        .col-left img {
            width: 100%; /* Menyesuaikan dengan lebar kontainer */
            height: 400px; /* Menjaga aspek rasio */
        }
        .indent {
        text-indent: 30px; /* Sesuaikan jaraknya */
    }
    </style>
</head>
<body>

    <div class="container">
        <div class="row full-height">
        @forelse($tmbberita as $no => $b)
            <!-- Bagian Kiri (30%) -->
            <div class="col-left divider scrollable">
                <div class="content">
                  <h2>{{ $b->title }}</h2>
                  <br>
                
                        <img src="{{ asset('storage/' . $b->image) }}">
                  <br>
                  <br>
                  <p class="indent">{{ Str::limit($b->content, 50) }}</p>
              
                    <hr>
                    <br>
                </div>
            </div>
        @endforeach

            <!-- Bagian Kanan (70%) -->
            <div class="col-right scrollable">
                <h4>Artikel Terbaru</h4>
                <div class="content">
                    <div class="article">
                        <img src="https://cdn-web-2.ruangguru.com/landing-pages/assets/0394debe-32f7-45b3-ad8e-ce8e3775331d.png" alt="Portofolio SNBP dan SNBT">
                        <a href="#"><h6>Portofolio SNBP dan SNBT: Jenis, Ketentuan & Cara Mengisinya</h6></a>
                    </div>
                    <hr>
                    <div class="article">
                        <img src="https://cdn-web.ruangguru.com/landing-pages/assets/hs/kritik-sastra-dan-esai.png" alt="Kritik Sastra dan Esai">
                        <a href="#"><h6>Perbedaan Kritik Sastra dan Esai: Ciri, Struktur, dan Contoh</h6></a>
                    </div>
                    <hr>
                    <div class="article">
                        <img src="https://cdn-web.ruangguru.com/landing-pages/assets/hs/teks-diskusi.png" alt="Teks Diskusi">
                        <a href="#"><h6>Pengertian Teks Diskusi, Ciri, Struktur, Kebahasaan, & Jenis</h6></a>
                    </div>
                    <hr>
                    <div class="article">
                        <img src="https://cdn-web-2.ruangguru.com/landing-pages/assets/d30e3210-06a6-4ece-a01c-6d4a6df0d3ee.png" alt="SPAN PTKIN 2025">
                        <a href="#"><h6>Jadwal Pendaftaran SPAN PTKIN 2025, Syarat dan Tahapannya</h6></a>
                    </div>
                    <hr>
                    <div class="article">
                        <img src="https://cdn-web.ruangguru.com/landing-pages/assets/hs/Header%20-%20Pojok%20Sekolah%20-%20Resensi.jpg" alt="Teks Resensi">
                        <a href="#"><h6>Pengertian Teks Resensi, Struktur, Jenis, dan Contohnya!</h6></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <!-- Boostrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    
</html>

@endsection