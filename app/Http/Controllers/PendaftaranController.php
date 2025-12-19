<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Informasi;
use App\Models\StatusForm;
use App\Models\User;
use App\Models\Kontak;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterSuccessMail;
use Illuminate\Support\Facades\Mail;


class PendaftaranController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function informasi()
    {
        $informasi = Informasi::latest()->get();
        return view('public.informasi', compact('informasi'));
    }

    public function contact()
    {
        $kontak = Kontak::first();
        return view('public.contact', compact('kontak'));
    }

    public function create()
    {
        $status = StatusForm::latest()->first();
        if ($status && $status->status === 'Tutup') {
            return redirect()->route('home')->with('error', 'Pendaftaran sedang ditutup');
        }
        return view('public.pendaftaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'no_hp' => [
                'required',
                'regex:/^[0-9]+$/',
                'min:10',
                'max:15'
            ],
            'alamat' => 'required|string|max:255',
            'berkas' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 15 digit.',

            'alamat.required' => 'Alamat wajib diisi.',

            'berkas.required' => 'Berkas wajib diunggah.',
            'berkas.mimes' => 'Berkas harus PDF, JPG, JPEG, atau PNG.',
            'berkas.max' => 'Ukuran berkas maksimal 2MB.',
        ]);

        // 🔹 Upload file
        $filePath = $request->file('berkas')->store('berkas', 'public');

        // 🔹 Buat password acak 8 karakter
        $plainPassword = \Illuminate\Support\Str::random(8);

        // 🔹 Buat user baru
        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
            'role' => 'user',
            'status' => 'aktif',
        ]);

        // 🔹 Simpan data pendaftaran
        Pendaftaran::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'berkas' => $filePath,
            'status' => 'Menunggu',
        ]);

        // Kirim email ke user
        Mail::to($user->email)->send(new RegisterSuccessMail(
            $user->name,
            $user->email,
            $plainPassword
        ));

        // 🔹 Arahkan ke halaman sukses
        return redirect()->route('register.success')->with([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $plainPassword,
        ]);
    }
}
