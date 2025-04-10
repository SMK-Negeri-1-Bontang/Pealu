<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Untuk generate PDF

class PengajarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajar::query();

        if ($request->filled('nip')) {
            $query->where('nip', 'like', '%' . $request->nip . '%');
        }

        if ($request->filled('nama_lengkap')) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if ($request->filled('mata_pelajaran')) {
            $query->where('mata_pelajaran', 'like', '%' . $request->mata_pelajaran . '%');
        }

        if ($request->filled('tahun_bergabung')) {
            $query->where('tahun_bergabung', $request->tahun_bergabung);
        }

        $pengajar = $query->paginate(5);

        return view('layouts.pengajar.pengajar', compact('pengajar'));
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

    public function invoice($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $status_map = [1 => 'Aktif', 2 => 'Tidak Aktif', 3 => 'Pensiun'];
        
        $pdf = PDF::loadView('layouts.pengajar.invoice', [
            'pengajar' => $pengajar,
            'status_map' => $status_map
        ]);

        return $pdf->stream('invoice_pengajar_'.$id.'.pdf');
    }
}