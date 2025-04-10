<?php

namespace App\Http\Controllers;

use App\Models\TambahBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TambahBeritaController extends Controller
{
    /**
     * Tampilkan daftar berita.
     */
    public function index(Request $request)
    {
        $query = TambahBerita::query(); // definisikan dulu query-nya
        $tmbberita = $query->paginate(5);
        return view('layouts.berita.index', compact('tmbberita'));
    }

    /**
     * Simpan berita baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') 
            ? $request->file('image')->store('TambahBerita', 'public') 
            : null;

        $berita = TambahBerita::create([
            'title'   => $validated['title'],
            'content' => $validated['content'],
            'image'   => $imagePath,
        ]);

        if ($berita) {
            return redirect()->route('tmbberita.index')->with(['success' => 'Berita berhasil ditambahkan.']);
        } else {
            return redirect()->route('tmbberita.index')->with(['error' => 'Gagal menambahkan berita.']);
        }
    }

    /**
     * Update berita.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        $berita = TambahBerita::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }

            $berita->image = $request->file('image')->store('TambahBerita', 'public');
        }

        $berita->update([
            'title'   => $validated['title'],
            'content' => $validated['content'],
            'image'   => $berita->image, // sudah diperbarui di atas jika ada gambar baru
        ]);

        return redirect()->route('tmbberita.index')->with(['update' => 'Berita berhasil diperbarui.']);
    }

    /**
     * Hapus berita.
     */
    public function destroy($id)
    {
        $berita = TambahBerita::findOrFail($id);

        if ($berita->image) {
            Storage::disk('public')->delete($berita->image);
        }

        $berita->delete();

        if ($berita) {
            return redirect()->route('tmbberita.index')->with(['delete' => 'Berita berhasil dihapus.']);
        } else {
            return redirect()->route('tmbberita.index')->with(['error' => 'Berita gagal dihapus.']);
        }
    }

    /**
     * Tampilkan detail berita (opsional).
     */
    public function show($id)
    {
        $berita = TambahBerita::findOrFail($id);
        return view('layouts.berita.berita', compact('berita'));
    }
}
