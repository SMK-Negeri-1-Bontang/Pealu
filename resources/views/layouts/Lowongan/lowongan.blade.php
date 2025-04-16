@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($message = Session::get('update'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
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
                <div class="mb-3 mt-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> Tambah Lowongan
                    </a>
                </div>
                <div class="card-body mb-3">
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('lowongan.index') }}" method="GET" class="w-100">
                            <div class="row g-3 justify-content-center">
                                <div class="col-md-3">
                                    <label class="fw-bold">Kode Lowongan</label>
                                    <input type="text" name="kode_lowongan" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Kode Lowongan" value="{{ request('kode_lowongan') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="fw-bold">Nama Pekerjaan</label>
                                    <input type="text" name="nama_pekerjaan" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Nama Pekerjaan" value="{{ request('nama_pekerjaan') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="fw-bold">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Lokasi" value="{{ request('lokasi') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="fw-bold">Tahun Dibuka</label>
                                    <input type="text" name="tahun_dibuka" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Tahun" value="{{ request('tahun_dibuka') }}">
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
                <div class="">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Pekerjaan</th>
                                <th scope="col">Perusahaan</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Tahun Dibuka</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowongan as $no => $l)
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td>{{ $l->kode_lowongan }}</td>
                                <td>{{ $l->nama_pekerjaan }}</td>
                                <td>{{ $l->perusahaan }}</td>
                                <td>{{ $l->lokasi }}</td>
                                <td>{{ $l->tahun_dibuka }}</td>
                                <td class="text-center align-middle">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$l->id}}" 
                                        class="text-primary mx-2" style="text-decoration: none;">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$l->id}}" 
                                        class="text-danger mx-2" style="text-decoration: none;">
                                        <i class="fa-solid fa-xmark fa-lg"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#lihat{{$l->id}}" 
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
                                        Data Lowongan Belum Ada
                                    </div>
                                </div>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <div>
                            Showing <b>{{ $lowongan->firstItem() }}</b> to <b>{{ $lowongan->lastItem() }}</b> of
                            <b>{{ $lowongan->total() }}</b> results
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    <!-- Tombol Previous -->
                                    @if ($lowongan->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $lowongan->previousPageUrl() }}" rel="prev">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Nomor Halaman -->
                                    @foreach ($lowongan->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $lowongan->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Tombol Next -->
                                    @if ($lowongan->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $lowongan->nextPageUrl() }}" rel="next">Next</a>
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<!-- Modal Tambah Data Lowongan -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Lowongan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Kode Lowongan -->
                            <div class="mb-3">
                                <label class="form-label">Kode Lowongan</label>
                                <input type="text" class="form-control @error('kode_lowongan') is-invalid @enderror" name="kode_lowongan" placeholder="Masukkan Kode Lowongan">
                                @error('kode_lowongan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Pekerjaan -->
                            <div class="mb-3">
                                <label class="form-label">Nama Pekerjaan</label>
                                <input type="text" class="form-control @error('nama_pekerjaan') is-invalid @enderror" name="nama_pekerjaan" placeholder="Masukkan Nama Pekerjaan">
                                @error('nama_pekerjaan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Perusahaan -->
                            <div class="mb-3">
                                <label class="form-label">Perusahaan</label>
                                <input type="text" class="form-control @error('perusahaan') is-invalid @enderror" name="perusahaan" placeholder="Masukkan Nama Perusahaan">
                                @error('perusahaan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" placeholder="Masukkan Lokasi Pekerjaan">
                                @error('lokasi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Tahun Dibuka -->
                            <div class="mb-3">
                                <label class="form-label">Tahun Dibuka</label>
                                <input type="text" class="form-control @error('tahun_dibuka') is-invalid @enderror" name="tahun_dibuka" placeholder="Masukkan Tahun Dibuka">
                                @error('tahun_dibuka')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Pekerjaan</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="Deskripsi Pekerjaan"></textarea>
                                @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kualifikasi -->
                            <div class="mb-3">
                                <label class="form-label">Kualifikasi</label>
                                <textarea class="form-control @error('kualifikasi') is-invalid @enderror" name="kualifikasi" rows="3" placeholder="Kualifikasi yang dibutuhkan"></textarea>
                                @error('kualifikasi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
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
</div>
@endpush

@foreach($lowongan as $l)
<!-- Modal Edit Data Lowongan -->
<div class="modal fade" id="edit{{$l->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$l->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel{{$l->id}}">Edit Data Lowongan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('lowongan.update', $l->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Kode Lowongan -->
                            <div class="mb-3">
                                <label class="form-label">Kode Lowongan</label>
                                <input type="text" class="form-control @error('kode_lowongan') is-invalid @enderror" name="kode_lowongan" value="{{ old('kode_lowongan', $l->kode_lowongan) }}" placeholder="Masukkan Kode Lowongan">
                                @error('kode_lowongan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Pekerjaan -->
                            <div class="mb-3">
                                <label class="form-label">Nama Pekerjaan</label>
                                <input type="text" class="form-control @error('nama_pekerjaan') is-invalid @enderror" name="nama_pekerjaan" value="{{ old('nama_pekerjaan', $l->nama_pekerjaan) }}" placeholder="Masukkan Nama Pekerjaan">
                                @error('nama_pekerjaan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Perusahaan -->
                            <div class="mb-3">
                                <label class="form-label">Perusahaan</label>
                                <input type="text" class="form-control @error('perusahaan') is-invalid @enderror" name="perusahaan" value="{{ old('perusahaan', $l->perusahaan) }}" placeholder="Masukkan Nama Perusahaan">
                                @error('perusahaan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi', $l->lokasi) }}" placeholder="Masukkan Lokasi Pekerjaan">
                                @error('lokasi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Tahun Dibuka -->
                            <div class="mb-3">
                                <label class="form-label">Tahun Dibuka</label>
                                <input type="text" class="form-control @error('tahun_dibuka') is-invalid @enderror" name="tahun_dibuka" value="{{ old('tahun_dibuka', $l->tahun_dibuka) }}" placeholder="Masukkan Tahun Dibuka">
                                @error('tahun_dibuka')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Pekerjaan</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="Deskripsi Pekerjaan">{{ old('deskripsi', $l->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kualifikasi -->
                            <div class="mb-3">
                                <label class="form-label">Kualifikasi</label>
                                <textarea class="form-control @error('kualifikasi') is-invalid @enderror" name="kualifikasi" rows="3" placeholder="Kualifikasi yang dibutuhkan">{{ old('kualifikasi', $l->kualifikasi) }}</textarea>
                                @error('kualifikasi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
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
</div>
@endforeach

@foreach($lowongan as $l)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $l->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $l->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $l->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus lowongan pekerjaan:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $l->nama_pekerjaan }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('lowongan.destroy', $l->id) }}" method="POST">
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

@foreach($lowongan as $l)
<!-- Modal Tampil -->
<div class="modal fade" id="lihat{{$l->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Lowongan Pekerjaan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <h2 class="text-center mb-4 mt-2">DETAIL LOWONGAN {{ strtoupper($l->nama_pekerjaan) }}</h2>

                <div class="row justify-content-center align-items-start mt-5 mb-2">
                    <div class="col-md-12">
                        <table class="table table-borderless text-capitalize">
                            <tr><td width="30%">Kode Lowongan</td><td>: {{ $l->kode_lowongan ?? '-' }}</td></tr>
                            <tr><td>Nama Pekerjaan</td><td>: {{ $l->nama_pekerjaan ?? '-' }}</td></tr>
                            <tr><td>Perusahaan</td><td>: {{ $l->perusahaan ?? '-' }}</td></tr>
                            <tr><td>Lokasi</td><td>: {{ $l->lokasi ?? '-' }}</td></tr>
                            <tr><td>Tahun Dibuka</td><td>: {{ $l->tahun_dibuka ?? '-' }}</td></tr>
                            <tr><td>Deskripsi Pekerjaan</td><td>: {{ $l->deskripsi ?? '-' }}</td></tr>
                            <tr><td>Kualifikasi</td><td>: {{ $l->kualifikasi ?? '-' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach