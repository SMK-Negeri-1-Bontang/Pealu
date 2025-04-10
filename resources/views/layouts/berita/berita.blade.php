@extends('welcome')

@section('content')

<style>
    .scrollable {
        max-height: 100vh;
        overflow-y: auto;
        padding: 20px;
    }

    .content {
        margin-bottom: 0px;
    }

    .content h2 {
        margin-top: 0px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .col-left img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .indent {
        text-indent: 30px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: pre-wrap;
        line-height: 1.8;
        font-size: 16px;
    }

</style>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="">
                @foreach($tmbberita as $b)
                    <div class="col-left scrollable">
                        <div class="content">
                            <h2>{{ $b->title }}</h2>
                            <img src="{{ asset('storage/' . $b->image) }}" alt="Gambar Berita">
                            <p class="indent">{{ $b->content }}</p>
                            <hr>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection
