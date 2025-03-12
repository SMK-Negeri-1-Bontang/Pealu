@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('STATUS LOGIN ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::check())
                        <p>Halo, {{ Auth::user()->name }}!</p>
                        @if (Auth::user()->role->role == 'admin') 
                            <p>{{ __('You are logged in as Admin') }}</p>
                        @elseif (Auth::user()->role->role == 'user') 
                            <p>{{ __('You are logged in as User') }}</p>
                        @else
                            <p>{{ __('You are logged in with an unknown role') }}</p>
                        @endif
                    @else
                    <p>Anda belum login.</p>
                @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
