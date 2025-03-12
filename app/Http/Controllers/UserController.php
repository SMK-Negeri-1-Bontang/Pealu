<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Roles;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(10); // Pastikan relasi ikut di-load
        return view('layouts.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'nama_lengkap' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'nama_lengkap' => $request->nama_lengkap,
                'hp' => $request->hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                Role::create([
                    'user_id' => $user->id,
                    'role' => $request->role
                ]);                
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }

        return redirect('user')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('layouts.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,' . $id,
            'nama_lengkap' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => 'required|string|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'nama_lengkap' => $request->nama_lengkap,
                'hp' => $request->hp,
                'email' => $request->email,
            ]);

            if (!empty($request->password)) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            $role = Role::firstOrNew(['user_id' => $id]);
            $role->role = $request->role;
            $role->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }

        return redirect('user')->with('edit', 'Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        try {
            Role::where('user_id', $id)->delete();
            $user->delete();
            return redirect()->route('user.index')->with('delete', 'User Berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'User gagal dihapus');
        }
    }
}