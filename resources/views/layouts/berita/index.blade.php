@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Daftar Berita</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
                        Tambah Berita
                    </button>

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

                    {{-- Table --}}
                    <table class="table table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tmbberita as $no => $b)
                            <tr>
                                <td class="text-center">{{ $no + 1 }}</td>
                                <td>{{ $b->title }}</td>
                                <td class="text-center">
                                    @if($b->image)
                                        <img src="{{ asset('storage/' . $b->image) }}" width="100">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($b->content, 50) }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalLihat{{ $b->id }}">Lihat</button>
                                    <button class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $b->id }}">Edit</button>
                                    <button class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $b->id }}">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada berita yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Modal Tambah --}}
                    <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
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
                                            <label for="content" class="form-label">Deskripsi Berita</label>
                                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modals Lihat, Edit, Hapus --}}
                    @foreach($tmbberita as $b)

                    {{-- Modal Lihat --}}
                    <div class="modal fade" id="modalLihat{{ $b->id }}" tabindex="-1" aria-labelledby="modalLihatLabel{{ $b->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLihatLabel{{ $b->id }}">Detail Berita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>{{ $b->title }}</h5>
                                    <p>{{ $b->content }}</p>
                                    @if($b->image)
                                        <img src="{{ asset('storage/' . $b->image) }}" class="img-fluid mt-2" alt="gambar">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="modalEdit{{ $b->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $b->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
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
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="content" class="form-control" rows="3" required>{{ $b->content }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar (opsional)</label>
                                            <input type="file" name="image" class="form-control">
                                            @if($b->image)
                                                <small class="d-block mt-1">Gambar sekarang: <img src="{{ asset('storage/' . $b->image) }}" width="80"></small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Hapus --}}
                    <div class="modal fade" id="modalHapus{{ $b->id }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $b->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('tmbberita.destroy', $b->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHapusLabel{{ $b->id }}">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus berita "<strong>{{ $b->title }}</strong>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
