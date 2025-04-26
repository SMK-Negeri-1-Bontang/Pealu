<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Untuk generate PDF

class PengajarController extends Controller
{
    public function index(Request $request)
    {
        // Get distinct values for filters
        $mataPelajaranList = Pengajar::select('mata_pelajaran')
                                    ->distinct()
                                    ->orderBy('mata_pelajaran')
                                    ->pluck('mata_pelajaran');
        
        $tahunBergabungList = Pengajar::select('tahun_bergabung')
                                    ->distinct()
                                    ->orderBy('tahun_bergabung', 'desc')
                                    ->pluck('tahun_bergabung');

        // Base query
        $query = Pengajar::query();
        
        // Search filters
        if ($request->filled('nip')) {
            $query->where('nip', 'like', '%' . $request->nip . '%');
        }
        
        if ($request->filled('nama_lengkap')) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }
        
        // Exact match for dropdown filters
        if ($request->filled('mata_pelajaran')) {
            $query->where('mata_pelajaran', $request->mata_pelajaran);
        }
        
        if ($request->filled('tahun_bergabung')) {
            $query->where('tahun_bergabung', $request->tahun_bergabung);
        }
        
        // Default sorting
        $query->orderBy('nama_lengkap');
        
        // Pagination with 10 items per page (better for the new layout)
        $pengajar = $query->paginate(10)
                        ->appends($request->query());
        
        return view('layouts.pengajar.pengajar', compact('pengajar', 'mataPelajaranList', 'tahunBergabungList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|numeric|unique:pengajars',
            'nama_lengkap' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'tahun_bergabung' => 'nullable|string',
            'nomor_telp' => 'required|numeric',
            'alamat' => 'required|string',
            'status' => 'required|in:1,2,3',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

            // Cek apakah ada file foto
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('foto_pengajar', 'public');
                $validated['foto'] = $foto;
            }
            

        Pengajar::create($validated);

        return redirect()->route('pengajar.index')
            ->with('success', 'Data pengajar berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nip' => 'required|numeric|unique:pengajars,nip,'.$id,
            'nama_lengkap' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'tahun_bergabung' => 'nullable|string',
            'nomor_telp' => 'required|numeric',
            'alamat' => 'required|string',
            'status' => 'required|in:1,2,3',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengajar = Pengajar::findOrFail($id);

        // Simpan foto baru kalau ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pengajar', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Sekarang update semua data termasuk foto (jika ada)
        $pengajar->update($validated);

        return redirect()->route('pengajar.index')
            ->with('update', 'Data pengajar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $pengajar->delete();

        return redirect()->route('pengajar.index')
            ->with('delete', 'Data pengajar berhasil dihapus');
    }
}