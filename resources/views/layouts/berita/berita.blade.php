@extends('welcome')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .article-wrapper {
            margin-bottom: 40px;
        }

        .col-left img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #212529;
            margin-bottom: 10px;
        }

        .berita-desc {
    font-size: 1.2rem; /* sedikit lebih besar */
    color: #333;       /* lebih terang dari sebelumnya */
    line-height: 1.8;  /* buat jarak baris yang lebih lega */
    white-space: pre-line; /* jaga newline dari textarea tetap terlihat */
    text-indent: 30px;
}



        .divider {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        @forelse($tmbberita as $no => $b)
        <div class="row justify-content-center article-wrapper">
            <div class="col-md-8 col-left divider">
                <h2>{{ $b->title }}</h2>
                <img src="{{ asset('storage/' . $b->image) }}" alt="Gambar {{ $b->title }}">
                <br><br>

                @php
    $limit = 500;
    $lineLimit = 5;

    $content = $b->content;
    $lineCount = substr_count($content, "\n") + 1;
    $isLong = strlen($content) > $limit || $lineCount > $lineLimit;
    $preview = Str::limit($content, $limit);
@endphp


<p class="berita-desc">
    <span class="preview">{{ $preview }}</span>
    @if($isLong)
        <span class="full d-none">{{ $b->content }}</span>
        <button class="btn btn-link p-0 m-0 baca-selengkapnya" style="font-size: 1rem;">Baca Selengkapnya</button>
    @endif
</p>


            </div>
        </div>
        @empty
        <p class="text-center">Belum ada berita tersedia.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll(".baca-selengkapnya");

            buttons.forEach(button => {
                button.addEventListener("click", function () {
                    const parent = button.closest(".berita-desc");
                    const preview = parent.querySelector(".preview");
                    const full = parent.querySelector(".full");

                    preview.classList.add("d-none");
                    full.classList.remove("d-none");
                    button.classList.add("d-none");
                });
            });
        });
    </script>
</body>
</html>

@endsection
