<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Query dasar pendaftar
        $query = Pendaftaran::query();

        if ($user->role === 'admin') {
            // ambil data pendaftar dari tabel pendaftarans dengan pagination
            $pendaftar = $query->latest()->paginate(10)->withQueryString();
            $total = $pendaftar->count(); // atau Pendaftaran::count();

            // return view('admin.dashboard', compact('pendaftar', 'total'));
            return redirect()->route('admin.dashboard');
        } else {
            // Ambil data pendaftaran berdasarkan user yang login
            $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

            // Pastikan melempar kedua variabel ke view (user & pendaftaran)
            return view('user.dashboard', compact('user', 'pendaftaran'));
        }
    }

    public function verifikasi($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'Terverifikasi';
            $user->save();
        }
        return redirect()->back()->with('success', 'Pendaftar berhasil diverifikasi!');
    }
}
