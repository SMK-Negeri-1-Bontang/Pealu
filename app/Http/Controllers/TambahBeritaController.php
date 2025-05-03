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
        $query = TambahBerita::query();
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }
        
        // Pagination dengan 10 item per halaman
        $tmbberita = $query->orderBy('created_at', 'desc')
                          ->paginate(10)
                          ->onEachSide(1);

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

        $tmbberita = TambahBerita::create([
            'title'   => $validated['title'],
            'content' => $validated['content'],
            'image'   => $imagePath,
        ]);

        return redirect()->route('tmbberita.index')->with('success', 'Berita berhasil ditambahkan.');
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

        $tmbberita = TambahBerita::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($tmbberita->image) {
                Storage::disk('public')->delete($tmbberita->image);
            }

            $tmbberita->image = $request->file('image')->store('TambahBerita', 'public');
        }

        $tmbberita->update([
            'title'   => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('tmbberita.index')->with('update', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita.
     */
    public function destroy($id)
    {
        $tmbberita = TambahBerita::findOrFail($id);

        if ($tmbberita->image) {
            Storage::disk('public')->delete($tmbberita->image);
        }

        $tmbberita->delete();

        return redirect()->route('tmbberita.index')->with('delete', 'Berita berhasil dihapus.');
    }

    /**
     * Tampilkan detail berita.
     */
    public function show($id)
    {
        $tmbberita = TambahBerita::findOrFail($id);
        return view('layouts.berita.show', compact('tmbberita'));
    }
}