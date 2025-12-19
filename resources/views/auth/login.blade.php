<x-guest-layout>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* Reset background default agar bisa full screen desain custom */
        .min-h-screen {
            background-color: #f8fafc !important;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 !important;
        }

        /* Container Utama Desain Split */
        .login-main-container {
            background: white;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.15);
            display: flex;
            width: 1000px;
            max-width: 95%;
            min-height: 600px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        /* Sisi Kiri: Form Login */
        .login-left-side {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Sisi Kanan: Panel Info (Biru sesuai gambar) */
        .login-right-panel {
            flex: 1;
            background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 3rem;
            border-radius: 150px 0 0 150px; /* Bentuk melengkung unik sesuai gambar */
        }

        .login-title {
            color: #0f172a;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .input-hint {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        /* Styling Input Field */
        input[type="email"], input[type="password"] {
            border-radius: 12px !important;
            border: 1.5px solid #e2e8f0 !important;
            padding: 0.85rem 1rem !important;
            background-color: #f8fafc !important;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        input:focus {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
            background-color: white !important;
        }

        /* Tombol Login (Biru) */
        .btn-custom-signin {
            background-color: #2563eb !important;
            border-radius: 12px !important;
            padding: 1rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            transition: all 0.3s ease !important;
            width: 100%;
            margin-top: 1.5rem;
            border: none !important;
            color: white !important;
        }

        .btn-custom-signin:hover {
            background-color: #1d4ed8 !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3) !important;
        }

        /* Teks Panel Kanan */
        .right-panel-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .right-panel-text {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .login-main-container { flex-direction: column-reverse; }
            .login-right-panel { border-radius: 0 0 50px 50px; padding: 2rem; }
        }
    </style>

    <div class="login-main-container" data-aos="zoom-in" data-aos-duration="1000">
        
        <div class="login-left-side">
            <div class="text-center">
                <h2 class="login-title">Sign In</h2>
                <p class="input-hint">Gunakan email dan password akun Anda</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />
            @if (session('success'))
                <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" class="font-bold text-gray-700" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="mb-4">
                    <div class="flex justify-between">
                        <x-input-label for="password" class="font-bold text-gray-700" :value="__('Password')" />
                        @if (Route::has('password.request'))
                            <!-- <a class="text-xs text-blue-600 hover:underline" href="{{ route('password.request') }}">Lupa Password?</a> -->
                        @endif
                    </div>
                    <x-text-input id="password" type="password" name="password" required placeholder="Masukkan password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </div>

                <button type="submit" class="btn-custom-signin">
                    Sign In
                </button>
            </form>
        </div>

        <div class="login-right-panel">
            <h2 class="right-panel-title" data-aos="fade-left" data-aos-delay="300">Ahlan, Sahabat!</h2>
            <p class="right-panel-text" data-aos="fade-left" data-aos-delay="500">
                Belum mendaftarkan diri? Mari bergabung bersama kami untuk mencetak generasi Qur'ani yang berakhlak mulia.
            </p>
            <a href="{{ route('pendaftaran') }}" 
               class="px-8 py-3 border-2 border-white rounded-full font-bold hover:bg-white hover:text-blue-600 transition-all duration-300 no-underline text-white"
               data-aos="fade-up" data-aos-delay="700">
                DAFTAR SEKARANG
            </a>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ once: true });
        });
    </script>
</x-guest-layout>