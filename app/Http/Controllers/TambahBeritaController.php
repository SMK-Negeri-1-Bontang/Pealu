<?php

namespace App\Http\Controllers;

use App\Models\TambahBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TambahBeritaController extends Controller
{
    /**
     * Tampilkan daftar TambahBerita.
     */
    public function index()
    {
        $berita = TambahBerita::latest()->paginate(10);
return view('TambahBerita.index', compact('berita'));

    }

    /**
     * Tampilkan form tambah TambahBerita.
     */
    public function create()
    {
        return view('TambahBerita.create');
    }

    /**
     * Simpan TambahBerita baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('TambahBerita', 'public') : null;

        TambahBerita::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('TambahBerita.index')->with('success', 'TambahBerita berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail TambahBerita.
     */
    public function show(TambahBerita $TambahBerita)
    {
        return view('TambahBerita.show', compact('TambahBerita'));
    }

    /**
     * Tampilkan form edit TambahBerita.
     */
    public function edit(TambahBerita $TambahBerita)
    {
        return view('TambahBerita.edit', compact('TambahBerita'));
    }

    /**
     * Update TambahBerita.
     */
    public function update(Request $request, TambahBerita $TambahBerita)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($TambahBerita->image) {
                Storage::disk('public')->delete($TambahBerita->image);
            }

            $imagePath = $request->file('image')->store('TambahBerita', 'public');
            $TambahBerita->update(['image' => $imagePath]);
        }

        $TambahBerita->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('TambahBerita.index')->with('success', 'TambahBerita berhasil diperbarui.');
    }

    /**
     * Hapus TambahBerita.
     */
    public function destroy(TambahBerita $TambahBerita)
    {
        if ($TambahBerita->image) {
            Storage::disk('public')->delete($TambahBerita->image);
        }

        $TambahBerita->delete();

        return redirect()->route('TambahBerita.index')->with('success', 'TambahBerita berhasil dihapus.');
    }
}
