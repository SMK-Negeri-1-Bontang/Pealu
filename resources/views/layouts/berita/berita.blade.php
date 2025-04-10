@extends('welcome')

@section('content')

<style>
    .content {
        margin-bottom: 0px;
    }

    .content h2 {
        margin-top: 0px;
        margin-bottom: 50px;
        font-weight: bold;
    }

    .col-left img {
        width: 95%;
        max-height: 400px;
        object-fit: cover;
        margin-bottom: 20px;
        margin-left: 50px;
        border-radius: 10px;
    }

    p {
        margin-left: 50px;
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

<div class="">
    <div class="card">
        <div class="card-body">
                @foreach($tmbberita as $b)
                    <div class="col-left">
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

@endsection
