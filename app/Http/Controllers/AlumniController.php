<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::query();

        if ($request->filled('nama')) {
            $query->where('nama_lengk', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('nis')) {
            $query->where('nis', 'like', '%' . $request->nis . '%');
        }

        if ($request->filled('jurusan')) {
            $query->where('jur_sekolah', 'like', '%' . $request->jurusan . '%');
        }

        if ($request->filled('tahun_lulus')) {
            $query->where('tahun_lulus', $request->tahun_lulus);
        }

        $alumni = $query->paginate(5);

        return view('layouts.alumni.alumni', compact('alumni'));
    }

    public function generatePdf($id)
    {
        $data = Alumni::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan.');
        }

        $status_map = [1 => 'Bekerja', 2 => 'Kuliah', 3 => 'Tidak Ada Kabar'];
        $jalur_map = [1 => 'PTN', 2 => 'PTS', 3 => 'DINAS'];

        $pdf = PDF::loadView('layouts.alumni.invoice', compact('data', 'status_map', 'jalur_map'));

        return $pdf->stream();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|numeric|unique:alumnis,nis',
            'nama_lengk' => 'required|string|max:255',
            'jur_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'nullable|string',
            'nomor_telp' => 'required|numeric',
            'alamat_rum' => 'required|string',
            'wirausaha' => 'nullable|string|max:255',
            'status' => 'required|in:1,2,3',
            'nama_per' => 'nullable|required_if:status,1|string|max:255',
            'nama_tok' => 'nullable|required_if:status,1|string|max:255',
            'lok_bekerja' => 'nullable|required_if:status,1|string|max:255',
            'jalur' => 'nullable|in:1,2,3|required_if:status,2',
            'nama_perti' => 'nullable|required_if:status,2|string|max:255',
            'jur_prodi' => 'nullable|required_if:status,2|string|max:255',
            'lok_kuliah' => 'nullable|required_if:status,2|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('foto_siswa', 'public');
            $validated['image'] = $image;
        }

        $alumni = Alumni::create([
            'nis' => $request->input('nis'),
            'nama_lengk' => $request->input('nama_lengk'),
            'jur_sekolah' => $request->input('jur_sekolah'),
            'tahun_lulus' => $request->input('tahun_lulus'),
            'nomor_telp' => $request->input('nomor_telp'),
            'alamat_rum' => $request->input('alamat_rum'),
            'wirausaha' => $request->input('wirausaha'),
            'status' => $request->input('status'),
            'nama_per' => $request->input('status') == 1 ? $request->input('nama_per') : null,
            'nama_tok' => $request->input('status') == 1 ? $request->input('nama_tok') : null,
            'lok_bekerja' => $request->input('status') == 1 ? $request->input('lok_bekerja') : null,
            'jalur' => $request->input('status') == 2 ? $request->input('jalur') : null,
            'nama_perti' => $request->input('status') == 2 ? $request->input('nama_perti') : null,
            'jur_prodi' => $request->input('status') == 2 ? $request->input('jur_prodi') : null,
            'lok_kuliah' => $request->input('status') == 2 ? $request->input('lok_kuliah') : null,
            'image' => $validated['image'] ?? null,
        ]);

        if($alumni) {
            return redirect('alumni')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('alumni')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('layouts.alumni.show', compact('alumni'));
    }

    public function edit(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('layouts.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nis' => 'required|numeric',
            'nama_lengk' => 'required|string|max:255',
            'jur_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'nullable|string',
            'nomor_telp' => 'required|numeric',
            'alamat_rum' => 'required|string',
            'wirausaha' => 'nullable|string|max:255',
            'status' => 'required|in:1,2,3',
            'nama_per' => 'nullable|required_if:status,1|string|max:255',
            'nama_tok' => 'nullable|required_if:status,1|string|max:255',
            'lok_bekerja' => 'nullable|required_if:status,1|string|max:255',
            'jalur' => 'nullable|in:1,2,3|required_if:status,2',
            'nama_perti' => 'nullable|required_if:status,2|string|max:255',
            'jur_prodi' => 'nullable|required_if:status,2|string|max:255',
            'lok_kuliah' => 'nullable|required_if:status,2|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $alumni = Alumni::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foto_siswa', 'public');
            $validated['image'] = $imagePath;
        }

        $alumni->update([
            'nis' => $request->input('nis'),
            'nama_lengk' => $request->input('nama_lengk'),
            'jur_sekolah' => $request->input('jur_sekolah'),
            'tahun_lulus' => $request->input('tahun_lulus'),
            'nomor_telp' => $request->input('nomor_telp'),
            'alamat_rum' => $request->input('alamat_rum'),
            'wirausaha' => $request->input('wirausaha'),
            'status' => $request->input('status'),
            'nama_per' => $request->input('status') == 1 ? $request->input('nama_per') : null,
            'nama_tok' => $request->input('status') == 1 ? $request->input('nama_tok') : null,
            'lok_bekerja' => $request->input('status') == 1 ? $request->input('lok_bekerja') : null,
            'jalur' => $request->input('status') == 2 ? $request->input('jalur') : null,
            'nama_perti' => $request->input('status') == 2 ? $request->input('nama_perti') : null,
            'jur_prodi' => $request->input('status') == 2 ? $request->input('jur_prodi') : null,
            'lok_kuliah' => $request->input('status') == 2 ? $request->input('lok_kuliah') : null,
            'image' => $validated['image'] ?? $alumni->image,
        ]);

        if($alumni) {
            return redirect('alumni')->with(['update' => 'Data Berhasil Di Update']);
        } else {
            return redirect('alumni')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        if($alumni) {
            return redirect('alumni')->with(['delete' => 'Data Berhasil Didelete']);
        } else {
            return redirect('alumni')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
