<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('layouts.user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nama_lengkap' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'hp' => 'nullable|string|max:15',
            'role' => 'required|in:user,admin,petugas',
            'password' => 'nullable|string|min:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $user = Auth::user();

            // Update data dasar
            $user->name = $request->name;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->email = $request->email;
            $user->hp = $request->hp;
            $user->role = $request->role;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('foto_siswa', 'public');
                $user->image = $imagePath;
            }
            

            // Jika password diisi
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('profile.show')->with('error', 'Gagal memperbarui profil.');
        }
    }
}
