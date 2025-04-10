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
                        <i class="fa-solid fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body mb-3">
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('pengajar.index') }}" method="GET" class="w-100">
                            <div class="row g-3 justify-content-center">
                                <div class="col-md-3">
                                    <label class="fw-bold">NIP</label>
                                    <input type="text" name="nip" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan NIP" value="{{ request('nip') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Nama Lengkap" value="{{ request('nama_lengkap') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="fw-bold">Mata Pelajaran</label>
                                    <input type="text" name="mata_pelajaran" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Mata Pelajaran" value="{{ request('mata_pelajaran') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="fw-bold">Tahun Bergabung</label>
                                    <input type="text" name="tahun_bergabung" class="form-control border-primary shadow-sm" 
                                        placeholder="Masukkan Tahun Bergabung" value="{{ request('tahun_bergabung') }}">
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
                                <th scope="col">Foto</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Tahun Bergabung</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($pengajar as $no => $p)
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td><img src="{{ asset('storage/' . $p->foto) }}" width="70" alt="Foto Pengajar"></td>
                                <td>{{ $p->nip }}</td>
                                <td>{{ $p->nama_lengkap }}</td>
                                <td>{{ $p->mata_pelajaran }}</td>
                                <td>{{ $p->tahun_bergabung }}</td>
                                <td class="text-center align-middle">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$p->id}}"
                                        class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$p->id}}"
                                        class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#lihat{{$p->id}}"
                                        class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('pengajar.invoice', ['id' => $p->id]) }}" class="btn btn-primary"><i class="fa-solid fa-file-arrow-down"></i></a>
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
                                        Data Pengajar Belum Ada
                                    </div>
                                </div>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <div>
                            Showing <b>{{ $pengajar->firstItem() }}</b> to <b>{{ $pengajar->lastItem() }}</b> of
                            <b>{{ $pengajar->total() }}</b> results
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    <!-- Tombol Previous -->
                                    @if ($pengajar->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $pengajar->previousPageUrl() }}" rel="prev">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Nomor Halaman -->
                                    @foreach ($pengajar->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $pengajar->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Tombol Next -->
                                    @if ($pengajar->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $pengajar->nextPageUrl() }}" rel="next">Next</a>
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
<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body text-capitalize">
                    <form action="{{ route('pengajar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Foto Pengajar</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                        @error('foto')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="number" class="form-control @error('nip')
      is-invalid
      @enderror" name="nip" placeholder="Masukkan NIP Dengan Benar">
                        @error('nip')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap')
      is-invalid
      @enderror" name="nama_lengkap" placeholder="Masukkan Nama Lengkap Pengajar">
                        @error('nama_lengkap')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control @error('mata_pelajaran')
      is-invalid
      @enderror" name="mata_pelajaran" placeholder="Contoh 'Matematika'">
                        @error('mata_pelajaran')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Bergabung</label>
                        <input type="text" class="form-control @error('tahun_bergabung')
      is-invalid
      @enderror" name="tahun_bergabung" placeholder="Contoh '2022'">
                        @error('tahun_bergabung')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control @error('nomor_telp')
      is-invalid
      @enderror" name="nomor_telp" placeholder="Masukkan Nomor Telpon Dengan Benar">
                        @error('nomor_telp')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat')
        is-invalid
      @enderror" name="alamat" rows="3"></textarea>
                        @error('alamat')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status')
      is-invalid
      @enderror" name="status" aria-label="Pilih Status">
                            <option selected>Pilih</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
                            <option value="3">Pensiun</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" class="form-control @error('pendidikan_terakhir')
      is-invalid
      @enderror" name="pendidikan_terakhir" placeholder="Contoh 'S1 Pendidikan Matematika'">
                        @error('pendidikan_terakhir')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan')
      is-invalid
      @enderror" name="jabatan" placeholder="Contoh 'Guru Matematika'">
                        @error('jabatan')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
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

@foreach($pengajar as $p)
<!-- Modal Edit -->
<div class="modal fade" id="edit{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('pengajar.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Foto Pengajar</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                        <input type="hidden" name="foto_lama" value="{{ $p->foto }}">
                        
                        @error('foto')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror

                        @if($p->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $p->foto) }}" width="100" alt="Foto Pengajar Sebelumnya">
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="number" class="form-control @error('nip')
      is-invalid
      @enderror" name="nip" value="{{ old('nip', $p->nip) }}" placeholder="Masukkan NIP Dengan Benar">
                        @error('nip')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap')
      is-invalid
      @enderror" name="nama_lengkap" value="{{ old('nama_lengkap', $p->nama_lengkap) }}" placeholder="Masukkan Nama Lengkap Pengajar">
                        @error('nama_lengkap')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control @error('mata_pelajaran')
      is-invalid
      @enderror" name="mata_pelajaran" value="{{ old('mata_pelajaran', $p->mata_pelajaran) }}" placeholder="Contoh 'Matematika'">
                        @error('mata_pelajaran')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Bergabung</label>
                        <input type="text" class="form-control @error('tahun_bergabung')
      is-invalid
      @enderror" name="tahun_bergabung" value="{{ old('tahun_bergabung', $p->tahun_bergabung) }}" placeholder="Contoh '2022'">
                        @error('tahun_bergabung')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control @error('nomor_telp')
      is-invalid
      @enderror" name="nomor_telp" value="{{ old('nomor_telp', $p->nomor_telp) }}" placeholder="Masukkan Nomor Telpon Dengan Benar">
                        @error('nomor_telp')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat')
        is-invalid
      @enderror" name="alamat" rows="3">{{ old('alamat', $p->alamat) }}</textarea>
                        @error('alamat')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status')
      is-invalid
      @enderror" name="status" aria-label="Pilih Status">
                            <option selected>Pilih</option>
                            <option value="1" {{ old('status', $p->status) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="2" {{ old('status', $p->status) == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="3" {{ old('status', $p->status) == '3' ? 'selected' : '' }}>Pensiun</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" class="form-control @error('pendidikan_terakhir')
      is-invalid
      @enderror" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $p->pendidikan_terakhir) }}" placeholder="Contoh 'S1 Pendidikan Matematika'">
                        @error('pendidikan_terakhir')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan')
      is-invalid
      @enderror" name="jabatan" value="{{ old('jabatan', $p->jabatan) }}" placeholder="Contoh 'Guru Matematika'">
                        @error('jabatan')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
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

@foreach($pengajar as $p)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $p->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $p->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus data pengajar:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $p->nama_lengkap }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('pengajar.destroy', $p->id) }}" method="POST">
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

@php
    // Mapping untuk status
    $status_map = [1 => 'Aktif', 2 => 'Tidak Aktif', 3 => 'Pensiun'];
@endphp

@foreach($pengajar as $p)
<!-- Modal Tampil -->
<div class="modal fade" id="lihat{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <table class="table table-striped text-capitalize">
                <tr>
                    <th>1.</th>
                    <th scope="row">NIP</th>
                    <td>:</td>
                    <td>{{ $p->nip }}</td>
                </tr>   
                <tr>
                    <th>2.</th>
                    <th scope="row">Nama Lengkap</th>
                    <td>:</td>
                    <td>{{ $p->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>3.</th>
                    <th scope="row">Mata Pelajaran</th>
                    <td>:</td>
                    <td>{{ $p->mata_pelajaran }}</td>
                </tr>
                <tr>
                    <th>4.</th>
                    <th scope="row">Tahun Bergabung</th>
                    <td>:</td>
                    <td>{{ $p->tahun_bergabung }}</td>
                </tr>
                <tr>
                    <th>5.</th>
                    <th scope="row">Nomor Telpon</th>
                    <td>:</td>
                    <td>{{ $p->nomor_telp }}</td>
                </tr>
                <tr>   
                    <th>6.</th> 
                    <th scope="row">Alamat Rumah</th>
                    <td>:</td>
                    <td>{{ $p->alamat }}</td>
                </tr>
                <tr>
                    <th>7.</th>
                    <th scope="row">Status</th>
                    <td>:</td>
                    <td>{{ $status_map[$p->status] ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>8.</th>
                    <th scope="row">Pendidikan Terakhir</th>
                    <td>:</td>
                    <td>{{ $p->pendidikan_terakhir }}</td>
                </tr>
                <tr>
                    <th>9.</th>
                    <th scope="row">Jabatan</th>
                    <td>:</td>
                    <td>{{ $p->jabatan }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endforeach