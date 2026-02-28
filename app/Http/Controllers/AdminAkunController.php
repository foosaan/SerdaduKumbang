<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAkunController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('admin.akun.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'active',
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.akun.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Data admin diperbarui');
    }

    public function destroy($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Tidak boleh menghapus akun sendiri');
        }

        User::where('id', $id)->where('role', 'admin')->delete();

        return back()->with('success', 'Admin berhasil dihapus');
    }

    public function resetPasswordForm($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.akun.reset-password', compact('admin'));
    }
    
    public function resetPasswordUpdate(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $admin = User::where('role', 'admin')->findOrFail($id);

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Password admin berhasil direset');
    }
}
