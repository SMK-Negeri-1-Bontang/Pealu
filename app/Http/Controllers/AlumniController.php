<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Alumni::query();
        
        // Filter berdasarkan nama (case insensitive untuk MySQL)
        if ($request->filled('nama')) {
            $query->where('nama_lengk', 'like', '%' . $request->nama . '%');
        }
        
        // Filter berdasarkan NIS (exact match)
        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }
        
        // Filter berdasarkan jurusan (dropdown exact match)
        if ($request->filled('jurusan')) {
            $query->where('jur_sekolah', $request->jurusan);
        }
        
        // Filter berdasarkan tahun lulus (dropdown exact match)
        if ($request->filled('tahun_lulus')) {
            $query->where('tahun_lulus', $request->tahun_lulus);
        }
        
        // Sorting default
        $query->orderBy('nama_lengk');
        
        // Get data untuk dropdown filter
        $jurusanList = Alumni::select('jur_sekolah')
                            ->distinct()
                            ->orderBy('jur_sekolah')
                            ->pluck('jur_sekolah');
        
        $tahunList = Alumni::select('tahun_lulus')
                          ->distinct()
                          ->orderBy('tahun_lulus', 'desc')
                          ->pluck('tahun_lulus');
        
        // Pagination dengan 10 item per halaman
        $perPage = request('per_page', 10);
        $alumni = $query->paginate($perPage)
                      ->appends($request->query());
        
        return view('layouts.alumni.index', compact('alumni', 'jurusanList', 'tahunList'));
    }

    public function dashboard(Request $request)
    {
        // Query dasar
        $query = Alumni::query();
        
        // Filter berdasarkan nama (case insensitive untuk MySQL)
        if ($request->filled('nama')) {
            $query->where('nama_lengk', 'like', '%' . $request->nama . '%');
        }
        
        // Filter berdasarkan NIS (exact match)
        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }
        
        // Filter berdasarkan jurusan (dropdown exact match)
        if ($request->filled('jurusan')) {
            $query->where('jur_sekolah', $request->jurusan);
        }
        
        // Filter berdasarkan tahun lulus (dropdown exact match)
        if ($request->filled('tahun_lulus')) {
            $query->where('tahun_lulus', $request->tahun_lulus);
        }
        
        // Sorting default
        $query->orderBy('nama_lengk');
        
        // Get data untuk dropdown filter
        $jurusanList = Alumni::select('jur_sekolah')
                            ->distinct()
                            ->orderBy('jur_sekolah')
                            ->pluck('jur_sekolah');
        
        $tahunList = Alumni::select('tahun_lulus')
                          ->distinct()
                          ->orderBy('tahun_lulus', 'desc')
                          ->pluck('tahun_lulus');
        
        // Get statistics for the dashboard
        $totalAlumni = Alumni::count();
        $workingCount = Alumni::where('status', 1)->count();
        $studyingCount = Alumni::where('status', 2)->count();
        $entrepreneurCount = Alumni::whereNotNull('wirausaha')->count();
        
        // Pagination dengan 10 item per halaman
        $perPage = request('per_page', 10);
        $alumni = $query->paginate($perPage)
                      ->appends($request->query());
        
        return view('dashboard', compact(
            'alumni', 
            'jurusanList', 
            'tahunList',
            'totalAlumni',
            'workingCount',
            'studyingCount',
            'entrepreneurCount'
        ));
    }


    
    public function generatePdf($id)
    {
        $data = Alumni::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan.');
        }

        $status_map = [1 => 'Bekerja', 2 => 'Kuliah', 3 => 'Tidak Ada Kabar'];
        $jalur_map = [1 => 'PTN', 2 => 'PTS', 3 => 'DINAS'];
    
        // Handle image conversion for PDF
        if (!empty($data->image)) {
            try {
                $imagePath = storage_path('app/public/' . $data->image);
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $data->image_base64 = 'data:'.mime_content_type($imagePath).';base64,'.$imageData;
                }
            } catch (\Exception $e) {
                Log::error("Error processing image: " . $e->getMessage());
            }
        }
    
        $pdf = PDF::loadView('layouts.alumni.invoice', compact('data', 'status_map', 'jalur_map'))
                  ->setPaper('a4', 'portrait');
    
        return $pdf->stream('kartu_alumni_'.$data->nis.'.pdf');
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
            return redirect()->route('alumni.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('alumni.index')->with(['error' => 'Data Gagal Disimpan']);
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
            return redirect()->route('alumni.index')->with(['update' => 'Data Berhasil Di Update']);
        } else {
            return redirect()->route('alumni.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        if($alumni) {
            return redirect()->route('alumni.index')->with(['delete' => 'Data Berhasil Didelete']);
        } else {
            return redirect()->route('alumni.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
