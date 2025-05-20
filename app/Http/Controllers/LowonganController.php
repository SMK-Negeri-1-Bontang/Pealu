<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowongan = Lowongan::paginate(5);
        return view('layouts.lowongan.index', compact('lowongan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'position' => 'required',
            'location' => 'required',
            'employment_type' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'category' => 'required',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric',
        ]);

        Lowongan::create($request->all());
        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lowongan $lowongan)
    {
        return view('layouts.lowongan.show', compact('lowongan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lowongan $lowongan)
    {
        return view('layouts.lowongan.edit', compact('lowongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'company_name' => 'required',
            'position' => 'required',
            'location' => 'required',
            'employment_type' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'category' => 'required',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric',
        ]);

        $lowongan->update($request->all());
        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil dihapus');
    }
} 