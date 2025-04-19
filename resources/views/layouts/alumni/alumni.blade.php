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
                <div class="">
                    <div class="mb-3 mt-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i> Tambah Data
                        </a>
                    </div>

                    <div class="card-body mb-3">
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('alumni.index') }}" method="GET" class="w-100">
                                <div class="row g-3 justify-content-center">
                                    <div class="col-md-3">
                                        <label class="fw-bold">Nama</label>
                                        <input type="text" name="nama" class="form-control border-primary shadow-sm" 
                                            placeholder="Masukkan Nama" value="{{ request('nama') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fw-bold">NIS</label>
                                        <input type="text" name="nis" class="form-control border-primary shadow-sm" 
                                            placeholder="Masukkan NIS" value="{{ request('nis') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fw-bold">Jurusan</label>
                                        <input type="text" name="jurusan" class="form-control border-primary shadow-sm" 
                                            placeholder="Masukkan Jurusan" value="{{ request('jurusan') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="fw-bold">Tahun Lulus</label>
                                        <input type="text" name="tahun_lulus" class="form-control border-primary shadow-sm" 
                                            placeholder="Masukkan Tahun Lulus" value="{{ request('tahun_lulus') }}">
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


                <div class="pt-10">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama</th>
                                <th scope="col">jurusan</th>
                                <th scope="col">Tahun Lulus</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($alumni as $no => $a)
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td class="text-center">
                                    @if($a->image)
                                        <img src="{{ asset('storage/' . $a->image) }}" width="70">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $a->nis }}</td>
                                <td>{{ $a->nama_lengk}}</td>
                                <td>{{ $a->jur_sekolah}}</td>
                                <td>{{ $a->tahun_lulus}}</td>
                                <td class="text-center align-middle">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$a->id}}" class="text-primary mx-2" style="text-decoration: none;">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$a->id}}" class="text-danger mx-2" style="text-decoration: none;">
                                        <i class="fa-solid fa-xmark fa-lg"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#lihat{{$a->id}}" class="text-info mx-2" style="text-decoration: none;">
                                        <i class="fa-solid fa-eye fa-lg"></i>
                                    </a>
                                    <a href="{{ route('alumni.invoice', ['id' => $a->id]) }}" class="text-success mx-2" style="text-decoration: none;">
                                        <i class="fa-solid fa-file-arrow-down fa-lg"></i>
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
                                        Data alumni Belum Ada
                                    </div>
                                </div>

                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <div>
                            Showing <b>{{ $alumni->firstItem() }}</b> to <b>{{ $alumni->lastItem() }}</b> of
                            <b>{{ $alumni->total() }}</b> results
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    <!-- Tombol Previous -->
                                    @if ($alumni->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $alumni->previousPageUrl() }}" rel="prev">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Nomor Halaman -->
                                    @foreach ($alumni->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $alumni->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Tombol Next -->
                                    @if ($alumni->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $alumni->nextPageUrl() }}" rel="next">Next</a>
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
<!-- Modal Tambah Data Siswa -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengk') is-invalid @enderror" name="nama_lengk" placeholder="Masukkan Nama Lengkap Siswa">
                                @error('nama_lengk')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">NIS</label>
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" placeholder="Masukkan NIS Dengan Benar">
                                @error('nis')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror" name="nomor_telp" placeholder="Masukkan Nomor Telpon">
                                @error('nomor_telp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" class="form-control @error('jur_sekolah') is-invalid @enderror" name="jur_sekolah" placeholder="Contoh 'Rekayasa Perangkat Lunak'">
                                @error('jur_sekolah')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" placeholder="Contoh '2022-2025'">
                                @error('tahun_lulus')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Wirausaha</label>
                                <input type="text" class="form-control @error('wirausaha') is-invalid @enderror" name="wirausaha" placeholder="Masukkan Bidang Wirausaha">
                                <div class="opacity-75 fst-italic">*Kosongkan bila tidak melakukan wirausaha</div>
                                @error('wirausaha')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="image">
                        @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat_rum') is-invalid @enderror" name="alamat_rum" rows="3" placeholder="Alamat Lengkap"></textarea>
                        @error('alamat_rum')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status')
      is-invalid
      @enderror" name="status" aria-label="Pilih Status">
                            <option selected>Pilih</option>
                            <option value="1">Bekerja</option>
                            <option value="2">Kuliah</option>
                            <option value="3">Tidak Ada Kabar</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Section Bekerja -->
                    <div id="bekerja-section" style="display: none;">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Bekerja</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_per') is-invalid @enderror" name="nama_per" placeholder="Nama Perusahaan">
                            @error('nama_per')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Tokoh</label>
                            <input type="text" class="form-control @error('nama_tok') is-invalid @enderror" name="nama_tok" placeholder="Nama Tokoh">
                            @error('nama_tok')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Bekerja</label>
                            <input type="text" class="form-control @error('lok_bekerja') is-invalid @enderror" name="lok_bekerja" placeholder="Lokasi Bekerja">
                            @error('lok_bekerja')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Section Kuliah -->
                    <div id="kuliah-section" style="display: none;">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Kuliah</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jalur</label>
                            <select class="form-select @error('jalur') is-invalid @enderror" name="jalur">
                                <option selected>Pilih</option>
                                <option value="1">PTN</option>
                                <option value="2">PTS</option>
                                <option value="3">DINAS</option>
                            </select>
                            @error('jalur')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan Tinggi</label>
                            <input type="text" class="form-control @error('nama_perti') is-invalid @enderror" name="nama_perti" placeholder="Nama Perguruan Tinggi">
                            @error('nama_perti')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan Prodi</label>
                            <input type="text" class="form-control @error('jur_prodi') is-invalid @enderror" name="jur_prodi" placeholder="Jurusan Prodi">
                            @error('jur_prodi')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kuliah</label>
                            <input type="text" class="form-control @error('lok_kuliah') is-invalid @enderror" name="lok_kuliah" placeholder="Lokasi Kuliah">
                            @error('lok_kuliah')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
<script>
    // Fungsi untuk toggle section
    function toggleSections(context, isEdit = false) {
        const prefix = isEdit ? 'edit-' : '';
        const statusSelect = context.querySelector("select[name='status']");
        
        if (!statusSelect) return;
        
        const bekerjaSection = context.querySelector(`#${prefix}bekerja-section`);
        const kuliahSection = context.querySelector(`#${prefix}kuliah-section`);
        const jalurSelect = context.querySelector("select[name='jalur']");

        if (!bekerjaSection || !kuliahSection) return;

        const status = statusSelect.value;
        
        if (status === "1") {
            bekerjaSection.style.display = "block";
            kuliahSection.style.display = "none";
            if (jalurSelect) jalurSelect.value = '';
        } else if (status === "2") {
            bekerjaSection.style.display = "none";
            kuliahSection.style.display = "block";
        } else {
            bekerjaSection.style.display = "none";
            kuliahSection.style.display = "none";
            if (jalurSelect) jalurSelect.value = '';
        }
    }

    // Inisialisasi untuk modal tambah
    document.addEventListener("DOMContentLoaded", function() {
        // Event listener untuk modal tambah
        const tambahModal = document.getElementById('tambah');
        if (tambahModal) {
            tambahModal.addEventListener('shown.bs.modal', function() {
                const statusSelect = this.querySelector("select[name='status']");
                if (statusSelect) {
                    statusSelect.addEventListener('change', function() {
                        toggleSections(this.closest('.modal'), false);
                    });
                    // Trigger perubahan awal
                    toggleSections(this, false);
                }
            });
        }
        
        // Event delegation untuk modal edit
        document.addEventListener('shown.bs.modal', function(e) {
            if (e.target.id.startsWith('edit')) {
                const modal = e.target;
                const statusSelect = modal.querySelector("select[name='status']");
                if (statusSelect) {
                    statusSelect.addEventListener('change', function() {
                        toggleSections(modal, true);
                    });
                    // Trigger perubahan awal berdasarkan nilai yang sudah ada
                    toggleSections(modal, true);
                }
            }
        });
    });
</script>
@endpush

@foreach($alumni as $a)
<!-- Modal Edit Data Siswa -->
<div class="modal fade" id="edit{{$a->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$a->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgb(240, 240, 240);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel{{$a->id}}">Edit Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-capitalize">
                <form action="{{ route('alumni.update', $a->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengk') is-invalid @enderror" name="nama_lengk" value="{{ old('nama_lengk', $a->nama_lengk) }}" placeholder="Masukkan Nama Lengkap Siswa">
                                @error('nama_lengk')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">NIS</label>
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis', $a->nis) }}" placeholder="Masukkan NIS Dengan Benar">
                                @error('nis')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror" name="nomor_telp" value="{{ old('nomor_telp', $a->nomor_telp) }}" placeholder="Masukkan Nomor Telpon">
                                @error('nomor_telp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" class="form-control @error('jur_sekolah') is-invalid @enderror" name="jur_sekolah" value="{{ old('jur_sekolah', $a->jur_sekolah) }}" placeholder="Contoh 'Rekayasa Perangkat Lunak'">
                                @error('jur_sekolah')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" value="{{ old('tahun_lulus', $a->tahun_lulus) }}" placeholder="Contoh '2022-2025'">
                                @error('tahun_lulus')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                                <label class="form-label">Wirausaha</label>
                                <input type="text" class="form-control @error('wirausaha') is-invalid @enderror" name="wirausaha" value="{{ old('wirausaha', $a->wirausaha) }}" placeholder="Masukkan Bidang Wirausaha">
                                <div class="opacity-75 fst-italic">*Kosongkan bila tidak melakukan wirausaha</div>
                                @error('wirausaha')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="image">
                                @if($a->image)
                                    <small class="d-block mt-1">Gambar sekarang: <img src="{{ asset('storage/' . $a->image) }}" width="80"></small>
                                @endif
                                @error('foto')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Rumah</label>
                                <textarea class="form-control @error('alamat_rum') is-invalid @enderror" name="alamat_rum" rows="3" placeholder="Alamat Lengkap">{{ old('alamat_rum', $a->alamat_rum) }}</textarea>
                                @error('alamat_rum')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status')
      is-invalid
      @enderror" name="status" aria-label="Pilih Status">
                                    <option selected>Pilih</option>
                                    <option value="1" {{ old('status', $a->status) == '1' ? 'selected' : '' }}>Bekerja</option>
                                    <option value="2" {{ old('status', $a->status) == '2' ? 'selected' : '' }}>Kuliah</option>
                                    <option value="3" {{ old('status', $a->status) == '3' ? 'selected' : '' }}>Tidak Ada Kabar</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>

                    <!-- Section Bekerja -->
                    <div id="edit-bekerja-section" style="display: {{ old('status', $a->status) == '1' ? 'block' : 'none' }};">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Bekerja</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_per') is-invalid @enderror" name="nama_per" value="{{ old('nama_per', $a->nama_per) }}" placeholder="Nama Perusahaan">
                            @error('nama_per')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Tokoh</label>
                            <input type="text" class="form-control @error('nama_tok') is-invalid @enderror" name="nama_tok" value="{{ old('nama_tok', $a->nama_tok) }}" placeholder="Nama Tokoh">
                            @error('nama_tok')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Bekerja</label>
                            <input type="text" class="form-control @error('lok_bekerja') is-invalid @enderror" name="lok_bekerja" value="{{ old('lok_bekerja', $a->lok_bekerja) }}" placeholder="Lokasi Bekerja">
                            @error('lok_bekerja')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Section Kuliah -->
                    <div id="edit-kuliah-section" style="display: {{ old('status', $a->status) == '2' ? 'block' : 'none' }};">
                        <div class="text-center mt-3 mb-2">
                            <label class="form-label fw-bold">Kuliah</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jalur</label>
                            <select class="form-select @error('jalur') is-invalid @enderror" name="jalur">
                                <option value="">Pilih</option>
                                <option value="1" {{ old('jalur', $a->jalur) == '1' ? 'selected' : '' }}>PTN</option>
                                <option value="2" {{ old('jalur', $a->jalur) == '2' ? 'selected' : '' }}>PTS</option>
                                <option value="3" {{ old('jalur', $a->jalur) == '3' ? 'selected' : '' }}>DINAS</option>
                            </select>
                            @error('jalur')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan Tinggi</label>
                            <input type="text" class="form-control @error('nama_perti') is-invalid @enderror" name="nama_perti" value="{{ old('nama_perti', $a->nama_perti) }}" placeholder="Nama Perguruan Tinggi">
                            @error('nama_perti')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan Prodi</label>
                            <input type="text" class="form-control @error('jur_prodi') is-invalid @enderror" name="jur_prodi" value="{{ old('jur_prodi', $a->jur_prodi) }}" placeholder="Jurusan Prodi">
                            @error('jur_prodi')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kuliah</label>
                            <input type="text" class="form-control @error('lok_kuliah') is-invalid @enderror" name="lok_kuliah" value="{{ old('lok_kuliah', $a->lok_kuliah) }}" placeholder="Lokasi Kuliah">
                            @error('lok_kuliah')<div class="alert alert-danger">{{ $message }}</div>@enderror
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

@foreach($alumni as $a)
<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $a->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $a->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel{{ $a->id }}">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus pengguna:</p>
                <h5 class="fw-bold text-uppercase mt-2">{{ $a->nama_lengk }}</h5>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('alumni.destroy', $a->id) }}" method="POST">
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
    $status_map = [1 => 'Bekerja', 2 => 'Kuliah', 3 => 'Tidak Ada Kabar'];

    // Mapping untuk jalur (hanya untuk status 2 - Kuliah)
    $jalur_map = [1 => 'PTN', 2 => 'PTS', 3 => 'DINAS'];
@endphp
@foreach($alumni as $a)
<!-- Modal Tampil -->
<div class="modal fade" id="lihat{{$a->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Alumni</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                <h2 class="text-center mb-4 mt-2">BIODATA DIRI {{ strtoupper($a->nama_lengk ?? '-') }}</h2>

                <div class="row justify-content-center align-items-start mt-5 mb-2">
                    {{-- Kolom Data --}}
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td>NIS</td><td>: {{ $a->nis ?? '-' }}</td></tr>
                            <tr><td>Nama Lengkap</td><td>: {{ $a->nama_lengk ?? '-' }}</td></tr>
                            <tr><td>Jurusan</td><td>: {{ $a->jur_sekolah ?? '-' }}</td></tr>
                            <tr><td>Nomor Telpon</td><td>: {{ $a->nomor_telp ?? '-' }}</td></tr>
                            <tr><td>Alamat</td><td>: {{ $a->alamat_rum ?? '-' }}</td></tr>
                            <tr><td>Wirausaha</td><td>: {{ $a->wirausaha ?? '-' }}</td></tr>
                            <tr><td>Status</td><td>: {{ $status_map[$a->status] ?? '-' }}</td></tr>
                        </table>

                        @if($a->status == 1)
                            <h5 class="mt-4"><strong>BEKERJA</strong></h5>
                            <table class="table table-borderless">
                                <tr><td>Nama Perusahaan</td><td>: {{ $a->nama_per ?? '-' }}</td></tr>
                                <tr><td>Nama Tokoh</td><td>: {{ $a->nama_tok ?? '-' }}</td></tr>
                                <tr><td>Lokasi Bekerja</td><td>: {{ $a->lok_bekerja ?? '-' }}</td></tr>
                            </table>
                        @elseif($a->status == 2)
                            <h5 class="mt-4"><strong>KULIAH</strong></h5>
                            <table class="table table-borderless">
                                <tr><td>Jalur</td><td>: {{ $jalur_map[$a->jalur] ?? '-' }}</td></tr>
                                <tr><td>Nama Perguruan Tinggi</td><td>: {{ $a->nama_perti ?? '-' }}</td></tr>
                                <tr><td>Jurusan Prodi</td><td>: {{ $a->jur_prodi ?? '-' }}</td></tr>
                                <tr><td>Lokasi Kuliah</td><td>: {{ $a->lok_kuliah ?? '-' }}</td></tr>
                            </table>
                        @endif
                    </div>

                    {{-- Kolom Gambar --}}
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('storage/' . ($a->image ?? 'default.jpg')) }}" class="img-thumbnail mb-3" style="width: 180px; height: auto;" alt="Foto Alumni">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
