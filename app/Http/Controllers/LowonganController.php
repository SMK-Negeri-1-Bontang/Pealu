<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Exception;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::paginate(10);
        return view('lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        return view('lowongan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
        ]);

        Lowongan::create($validated);

        return redirect()->route('lowongan.index')->with('success', 'Data lowongan kerja berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lowongan = Lowongan::find($id);
        return view('lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
        ]);

        try {
            // Find the existing 'lowongan' record by ID
            $lowongan = Lowongan::findOrFail($id);

            // Update the record with new data
            $lowongan->company_name = $request->company_name;
            $lowongan->position = $request->position;
            $lowongan->location = $request->location;
            $lowongan->employment_type = $request->employment_type;
            $lowongan->education = $request->education;
            $lowongan->experience = $request->experience;
            $lowongan->category = $request->category;
            $lowongan->salary_min = $request->salary_min;
            $lowongan->salary_max = $request->salary_max;

            // Save the updated record
            $lowongan->save();

            // Redirect with success message
            return redirect()->route('lowongan.index')->with('success', 'Data Lowongan Kerja Berhasil Diperbarui');
        } catch (Exception $e) {
            // Handle any errors
            return redirect()->back()->with('error', 'Data Lowongan Kerja Gagal Diperbarui');
        }
    }

    public function destroy($id) {
        $lowongan = Lowongan::find($id);
        $lowongan->delete();
        return redirect()->route('lowongan.index')->with('success', 'Data Lowongan Kerja Berhasil Dihapus');
    }

    

}
