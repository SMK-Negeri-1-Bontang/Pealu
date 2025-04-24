@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            
                    {{-- Flash message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('update'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('update') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-2 flex-wrap gap-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambahBerita" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> Tambah Berita
                    </a>

                    <form action="{{ route('tmbberita.index') }}" method="GET" class="d-flex align-items-center gap-2">
                        <input id="search-focus" type="search" name="search" class="form-control border-primary shadow-sm" placeholder="Search" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>


                    <div class="pt-10">
                        {{-- Table --}}
                        <table class="table table-hover">
                            <thead class="">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse($tmbberita as $no => $b)
                                <tr>
                                    <th scope="row">{{ ++$no }}</th>
                                    <td>{{ $b->title }}</td>
                                    <td class="text-center">
                                        @if($b->image)
                                            <img src="{{ asset('storage/' . $b->image) }}" width="70" height="70">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($b->content, 50) }}</td>
                                    <td class="text-center align-middle">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit{{$b->id}}"
                                            class="text-primary mx-2" style="text-decoration: none;">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus{{$b->id}}"
                                            class="text-danger mx-2" style="text-decoration: none;">
                                            <i class="fa-solid fa-xmark fa-lg"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLihat{{$b->id}}"
                                            class="text-info mx-2" style="text-decoration: none;">
                                            <i class="fa-solid fa-eye fa-lg"></i>
                                        </a>
                                    </td>
                                    @empty
                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            width="24" height="24" 
                                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" 
                                            viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        <div>
                                            Data Berita Belum Ada
                                        </div>
                                    </div>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-between align-items-center p-2">
                        <div>
                            Showing <b>{{ $tmbberita->firstItem() }}</b> to <b>{{ $tmbberita->lastItem() }}</b> of
                            <b>{{ $tmbberita->total() }}</b> results
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    <!-- Tombol Previous -->
                                    @if ($tmbberita->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $tmbberita->previousPageUrl() }}" rel="prev">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Nomor Halaman -->
                                    @foreach ($tmbberita->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $tmbberita->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Tombol Next -->
                                    @if ($tmbberita->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $tmbberita->nextPageUrl() }}" rel="next">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Next</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    </div>

                    {{-- Modal Tambah --}}
                    <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background:rgb(240, 240, 240);">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Berita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('tmbberita.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Deskripsi Berita</label>
                                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modals Lihat, Edit, Hapus --}}
                    @foreach($tmbberita as $b)

                    {{-- Modal Lihat --}}
                    <div class="modal fade" id="modalLihat{{ $b->id }}" tabindex="-1" aria-labelledby="modalLihatLabel{{ $b->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content" style="background:rgb(240, 240, 240);">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLihatLabel{{ $b->id }}">Detail Berita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    {{-- Judul --}}
                                    <h2 class="fw-bold mb-5">{{ $b->title }}</h2>

                                    {{-- Gambar --}}
                                    @if($b->image)
                                        <div class="col-left">
                                            <img src="{{ asset('storage/' . $b->image) }}" style="max-height: 400px; width: 100%; object-fit: cover;" class="mb-4 rounded" alt="gambar">
                                        </div>
                                    @endif

                                    {{-- Deskripsi / Konten --}}
                                    <div class="berita-content">
                                        @foreach(explode("\n", $b->content) as $paragraph)
                                            @if(trim($paragraph) !== '')
                                                <p class="mb-3" style="text-indent: 30px; line-height: 1.7;">{{ $paragraph }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- Modal Edit --}}
                    <div class="modal fade" id="modalEdit{{ $b->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $b->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background:rgb(240, 240, 240);">
                                <form action="{{ route('tmbberita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $b->id }}">Edit Berita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="title" class="form-control" value="{{ $b->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar (opsional)</label>
                                            <input type="file" name="image" class="form-control">
                                            @if($b->image)
                                                <small class="d-block mt-1">Gambar sekarang: <img src="{{ asset('storage/' . $b->image) }}" width="80"></small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="content" class="form-control" rows="3" required>{{ $b->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Hapus --}}
                        <div class="modal fade" id="modalHapus{{ $b->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $b->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $b->id }}">
                                            <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                                        <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                                        <h5 class="fw-bold text-uppercase mt-2">{{ $b->title }}</h5>
                                        <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
                                    </div>
                                    <div class="modal-footer border-0 d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                        <form action="{{ route('tmbberita.destroy', $b->id) }}" method="POST">
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

                </div>
            </div>
    </div>
</div>
@endsection
