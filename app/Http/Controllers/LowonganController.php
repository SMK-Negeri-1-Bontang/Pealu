<?php

namespace App\Http\Controllers;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
{
    $lowongan = Lowongan::paginate(10);
    return view('lowongan.index', compact('lowongan'));
}
}