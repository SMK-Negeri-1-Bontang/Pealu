@extends('welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                    @if(session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($message = Session::get('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
            <div class="card">
                <div class="card-body">
                        <div class="">
                            <div class="mb-3 mt-2">
                                <a href="{{ route('user.create') }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah User
                                </a>
                            </div>

                            <div class="card-body mb-3">
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('user.index') }}" method="GET" class="w-100">
                                        <div class="row g-3 justify-content-center">
                                            <div class="col-md-3">
                                                <label class="fw-bold">Nama</label>
                                                <input type="text" name="name" class="form-control border-primary shadow-sm" 
                                                    placeholder="Masukkan Nama" value="{{ request('name') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fw-bold">Email</label>
                                                <input type="text" name="email" class="form-control border-primary shadow-sm" 
                                                    placeholder="Masukkan Email" value="{{ request('email') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fw-bold">Hp</label>
                                                <input type="text" name="hp" class="form-control border-primary shadow-sm" 
                                                    placeholder="Masukkan Hp" value="{{ request('hp') }}">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary w-100 shadow">
                                                    <i class="fas fa-search"></i> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    <div class="">
                        <table class="table table-hover">
                            <thead class="">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->firstItem() - 1 : 0) }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nama_lengkap }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                @empty
                                        <div class="alert alert-primary d-flex align-items-center mb-0" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                width="24" height="24" 
                                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" 
                                                viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div>
                                                Data User Belum Ada
                                            </div>
                                        </div>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                        
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@foreach($users as $user)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $user->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $user->name }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection