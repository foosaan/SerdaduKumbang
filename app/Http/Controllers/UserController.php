<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

class UserController extends Controller
{
    public function dashboard() 
    {
        $pendaftaran = Auth::user()->pendaftaran;
        return view('user.dashboard', compact('pendaftaran'));
    }

    public function editPendaftaran()
    {
        $pendaftaran = Auth::user()->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('user.dashboard')->with('error', 'Anda belum memiliki data pendaftaran.');
        }

        // Hanya bisa edit jika status masih "Menunggu"
        if ($pendaftaran->status !== 'Menunggu') {
            return redirect()->route('user.dashboard')->with('error', 'Data tidak dapat diubah karena sudah diverifikasi.');
        }

        return view('user.edit-pendaftaran', compact('pendaftaran'));
    }

    public function updatePendaftaran(Request $request)
    {
        $pendaftaran = Auth::user()->pendaftaran;

        if (!$pendaftaran || $pendaftaran->status !== 'Menunggu') {
            return redirect()->route('user.dashboard')->with('error', 'Data tidak dapat diubah.');
        }

        $request->validate([
            'nama_lengkap' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => [
                'required',
                'regex:/^[0-9]+$/',
                'min:10',
                'max:15'
            ],
            'alamat' => 'required|string|max:255',
            'berkas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 15 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
            'berkas.mimes' => 'Berkas harus PDF, JPG, JPEG, atau PNG.',
            'berkas.max' => 'Ukuran berkas maksimal 5MB.',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        // Upload berkas baru jika ada
        if ($request->hasFile('berkas')) {
            // Hapus berkas lama
            if ($pendaftaran->berkas && \Storage::disk('public')->exists($pendaftaran->berkas)) {
                \Storage::disk('public')->delete($pendaftaran->berkas);
            }
            $data['berkas'] = $request->file('berkas')->store('berkas', 'public');
        }

        $pendaftaran->update($data);

        // Update juga nama user
        Auth::user()->update(['name' => $request->nama_lengkap]);

        return redirect()->route('user.dashboard')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }
}
