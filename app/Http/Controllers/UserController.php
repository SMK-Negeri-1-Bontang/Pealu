<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('nama')) {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('hp')) {
            $query->where('hp', 'like', '%' . $request->hp . '%');
        }

        // Paginate hasil pencarian
        $users = $query->paginate(5);

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
            'name' => 'required|string|min:5|unique:users,name',
            'nama_lengkap' => 'required|string',
            'hp' => 'required|digits_between:9,15|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role' => 'required|in:user,admin,petugas',
        ]);        

        try {
            $user = User::create([
                'name' => $request->name,
                'nama_lengkap' => $request->nama_lengkap,
                'hp' => $request->hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($user) {
                $role = new Role;
                $role->user_id = $user->id;
                $role->role = $request->role;
                $role->save();
            }

            return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementasi jika diperlukan
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
        $validate = $request->validate([
            'name' => ['required', 'string', 'unique:users,name,' . $id],
            'nama_lengkap' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => ['required', 'string', 'email', 'unique:users,email,' . $id],
            'password' => 'nullable|min:5', // Tanpa confirmed
            'role' => 'required|in:user,admin,petugas',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->hp = $request->hp;
            $user->email = $request->email;
            $user->role = $request->role;

            // Update password hanya jika diisi
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // Update atau buat role baru
            $role = Role::firstOrNew(['user_id' => $id]);
            $role->role = $request->role;
            $role->save();

            return redirect()->route('user.index')->with('success', 'Data Berhasil Diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            // Hapus data role yang berelasi dengan user ini
            Role::where('user_id', $id)->delete();

            // Hapus user
            $user->delete();

            return redirect()->route('user.index')->with('delete', 'Data Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->route('user.index')->with('error', 'Data Gagal Dihapus');
        }
    }

}