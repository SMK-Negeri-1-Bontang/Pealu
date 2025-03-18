@extends('welcome')

@section('content')
<!-- Font Awesome 6.5.1 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">{{ __('Dashboard') }}</div>
               <div class="card-body">
                  @if(session('delete'))
                     <div class="alert alert-danger" role="alert">
                       <strong>{{ session('delete') }}</strong>
                     </div>
                  @endif
                  @if(session('edit'))
                     <div class="alert alert-success" role="alert">
                       <strong>{{ session('edit') }}</strong>
                     </div>
                  @endif

                  <a href="{{ route('user.create') }}" class="btn btn-success btn-md m-4">
                     <i class="fa fa-plus"></i> Tambah User
                  </a>
                   
                   <table class="table table-striped table-bordered">
                     <thead>
                       <tr>
                           <th>No.</th>
                           <th>Username</th>
                           <th>Nama</th>
                           <th>Email</th>
                           <th>Level</th>
                           <th>Aksi</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($users as $user) 
                       <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $user->name }}</td>
                         <td>{{ $user->nama_lengkap }}</td>
                         <td>{{ $user->email }}</td>
                         <td>{{ ucfirst($user->role ?? '-') }}</td>
                         <td>
                            <div class="d-flex">
                                <!-- Tombol Edit -->
                                <a href="{{ route('user.edit', $user->id) }}" 
                                    class="btn btn-success mx-1 shadow d-flex align-items-center justify-content-center"
                                    style="width: 36px; height: 36px;">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}" 
                                    class="btn btn-danger d-flex align-items-center justify-content-center"
                                    style="width: 36px; height: 36px;">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </a>
                            </div>
                         </td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                   {{ $users->links() }}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@foreach($users as $user)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data <b>{{ $user->nama_lengkap }}</b>?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Keluar</button>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
