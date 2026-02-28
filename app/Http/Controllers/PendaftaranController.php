<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\StatusForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterSuccessMail;
use Illuminate\Support\Facades\Mail;


class PendaftaranController extends Controller
{
    public function create()
    {
        $status = StatusForm::latest()->first();
        if ($status && $status->status === 'Tutup') {
            return redirect()->route('home')->with('error', 'Pendaftaran sedang ditutup');
        }

        $divisiList = [
            'Community Management',
            'Curriculum',
            'Program Relation and Development',
            'Fundraising',
            'Media Branding',
        ];

        return view('public.pendaftaran', compact('divisiList'));
    }

    public function store(Request $request)
    {
        // === STEP 1: Data Diri ===
        $request->validate([
            'nama_lengkap' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|email|unique:users,email',
            'no_hp' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'asal_instansi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string|max:500',

            // === STEP 2: Dokumen ===
            'cv' => 'required|file|mimes:pdf|max:10240',
            'follow_ig' => 'required|file|mimes:pdf|max:10240',
            'follow_tiktok' => 'required|file|mimes:pdf|max:10240',
            'portofolio' => 'nullable|file|mimes:pdf|max:10240',

            // === STEP 3: Divisi ===
            'sumber_info' => 'required|string|max:255',
            'motivasi' => 'required|string|max:2000',
            'pilihan_1' => 'required|string|in:Community Management,Curriculum,Program Relation and Development,Fundraising,Media Branding',
            'alasan_1' => 'required|string|max:2000',
            'pilihan_2' => 'required|string|in:Community Management,Curriculum,Program Relation and Development,Fundraising,Media Branding',
            'alasan_2' => 'required|string|max:2000',
            'bersedia_divisi_lain' => 'required|in:ya,tidak',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_hp.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'no_hp.min' => 'Nomor WhatsApp minimal 10 digit.',
            'no_hp.max' => 'Nomor WhatsApp maksimal 15 digit.',
            'asal_instansi.required' => 'Asal instansi wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'alamat.required' => 'Alamat di Yogyakarta wajib diisi.',
            'cv.required' => 'File CV wajib diunggah.',
            'cv.mimes' => 'CV harus format PDF, JPG, JPEG, atau PNG.',
            'cv.max' => 'Ukuran CV maksimal 10MB.',
            'follow_ig.required' => 'Bukti follow Instagram wajib diunggah.',
            'follow_ig.max' => 'Ukuran file maksimal 10MB.',
            'follow_tiktok.required' => 'Bukti follow TikTok wajib diunggah.',
            'follow_tiktok.max' => 'Ukuran file maksimal 10MB.',
            'portofolio.max' => 'Ukuran portofolio maksimal 10MB.',
            'sumber_info.required' => 'Sumber informasi wajib diisi.',
            'motivasi.required' => 'Motivasi bergabung wajib diisi.',
            'pilihan_1.required' => 'Pilihan divisi 1 wajib dipilih.',
            'alasan_1.required' => 'Alasan pilihan 1 wajib diisi.',
            'pilihan_2.required' => 'Pilihan divisi 2 wajib dipilih.',
            'alasan_2.required' => 'Alasan pilihan 2 wajib diisi.',
            'bersedia_divisi_lain.required' => 'Konfirmasi kesediaan divisi lain wajib dipilih.',
        ]);

        // Validasi portofolio wajib jika pilih Media Branding
        if (in_array('Media Branding', [$request->pilihan_1, $request->pilihan_2]) && !$request->hasFile('portofolio')) {
            return back()->withErrors(['portofolio' => 'Portofolio Desain wajib diunggah jika memilih divisi Media Branding.'])->withInput();
        }

        // 🔹 Upload files
        $cvPath = $request->file('cv')->store('cv', 'public');
        $followIgPath = $request->file('follow_ig')->store('follow_ig', 'public');
        $followTiktokPath = $request->file('follow_tiktok')->store('follow_tiktok', 'public');
        $portofolioPath = $request->hasFile('portofolio') ? $request->file('portofolio')->store('portofolio', 'public') : null;

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

        // 🔹 Get active gelombang
        $statusForm = StatusForm::first();
        $gelombangAktif = $statusForm ? ($statusForm->gelombang_aktif ?? 1) : 1;

        // 🔹 Simpan data pendaftaran
        Pendaftaran::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'asal_instansi' => $request->asal_instansi,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'cv' => $cvPath,
            'follow_ig' => $followIgPath,
            'follow_tiktok' => $followTiktokPath,
            'portofolio' => $portofolioPath,
            'sumber_info' => $request->sumber_info,
            'motivasi' => $request->motivasi,
            'pilihan_1' => $request->pilihan_1,
            'alasan_1' => $request->alasan_1,
            'pilihan_2' => $request->pilihan_2,
            'alasan_2' => $request->alasan_2,
            'bersedia_divisi_lain' => $request->bersedia_divisi_lain === 'ya',
            'status' => 'Menunggu',
            'gelombang' => $gelombangAktif,
        ]);

        // Kirim email ke user
        try {
            Mail::to($user->email)->send(new RegisterSuccessMail(
                $user->name,
                $user->email,
                $plainPassword
            ));
        } catch (\Exception $e) {
            \Log::warning('Failed to send registration email to ' . $user->email . ': ' . $e->getMessage());
        }

        // 🔔 Notifikasi WA ke admin
        try {
            if (config('services.fonnte.token') && config('services.fonnte.admin_phone')) {
                $pesanAdmin = "🔔 *Pendaftar Baru Masuk!*\n\n"
                    . "👤 Nama: {$user->name}\n"
                    . "📧 Email: {$user->email}\n"
                    . "📱 No HP: {$request->no_hp}\n"
                    . "🏫 Asal: {$request->asal_instansi}\n"
                    . "🎯 Divisi 1: {$request->pilihan_1}\n"
                    . "🎯 Divisi 2: {$request->pilihan_2}\n"
                    . "🌊 Gelombang: {$gelombangAktif}\n\n"
                    . "Silakan cek dashboard admin untuk memverifikasi.";

                \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => config('services.fonnte.token'),
                ])->post('https://api.fonnte.com/send', [
                    'target' => config('services.fonnte.admin_phone'),
                    'message' => $pesanAdmin,
                ]);
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to send admin WA notification: ' . $e->getMessage());
        }

        // 🔹 Tampilkan halaman sukses langsung (tanpa redirect, agar data tidak hilang)
        return view('auth.register_success', [
            'regName' => $user->name,
            'regEmail' => $user->email,
            'regPassword' => $plainPassword,
        ]);
    }
}
