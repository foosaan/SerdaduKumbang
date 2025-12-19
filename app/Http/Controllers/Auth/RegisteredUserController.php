<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // tambahkan ini untuk generate password random
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan form pendaftaran.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran user baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        ]);

        // 1️⃣ Buat password acak 8 karakter
        $plainPassword = Str::random(8);

        // 2️⃣ Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
        ]);

        // 3️⃣ Trigger event Registered (jika pakai email verification)
        event(new Registered($user));

        // 4️⃣ Login otomatis (opsional, bisa kamu hapus kalau mau login manual)
        // Auth::login($user);

        // 5️⃣ Redirect ke halaman sukses dengan password yang dibuat
        return redirect()->route('register.success')->with([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $plainPassword,
        ]);
    }
}
