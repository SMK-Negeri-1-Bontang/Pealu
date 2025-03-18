<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('layouts.user.index', compact('users'));
    }

    public function create()
    {
        return view('layouts.user.create');
    }

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
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'nama_lengkap' => $request->nama_lengkap,
                    'hp' => $request->hp,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $role = Role::create([
                    'user_id' => $user->id,
                    'role' => $request->role,
                ]);

                $user->update(['role_id' => $role->id]);
            });

            return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('layouts.user.edit', compact('user'));
    }

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
            DB::transaction(function () use ($request, $id) {
                $user = User::findOrFail($id);
                $user->update([
                    'name' => $request->name,
                    'nama_lengkap' => $request->nama_lengkap,
                    'hp' => $request->hp,
                    'email' => $request->email,
                ]);

                if ($request->filled('password')) {
                    $user->update(['password' => Hash::make($request->password)]);
                }

                Role::updateOrCreate(
                    ['user_id' => $id],
                    ['role' => $request->role]
                );
            });

            return redirect()->route('user.index')->with('success', 'Data Berhasil Diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Diperbarui');
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        try {
            DB::transaction(function () use ($id, $user) {
                $user->role()->delete();
                $user->delete();
            });

            return redirect()->route('user.index')->with('success', 'User Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'User gagal dihapus');
        }
    }
}