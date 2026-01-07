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
            box-shadow: 0 25px 50px -12px rgba(220, 38, 38, 0.15);
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
            background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 100%);
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
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1) !important;
            background-color: white !important;
        }

        /* Tombol Login (Biru) */
        .btn-custom-signin {
            background-color: #dc2626 !important;
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
            background-color: #b91c1c !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3) !important;
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

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .login-main-container { 
                flex-direction: column-reverse; 
                width: 95%;
                min-height: auto;
                margin: 0.5rem;
                border-radius: 20px;
            }
            .login-right-panel { 
                border-radius: 0 0 20px 20px; 
                padding: 1.5rem 1rem;
            }
            .login-left-side {
                padding: 1.5rem 1rem;
            }
            .login-title {
                font-size: 1.4rem;
            }
            .right-panel-title {
                font-size: 1.2rem;
            }
            .right-panel-text {
                font-size: 0.85rem;
            }
            .btn-custom-signin {
                padding: 0.7rem !important;
                font-size: 0.85rem !important;
            }
            .input-hint {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .login-main-container {
                margin: 0.25rem;
                border-radius: 16px;
            }
            .login-left-side {
                padding: 1.25rem 0.875rem;
            }
            .login-right-panel {
                padding: 1.25rem 0.875rem;
            }
            .login-title {
                font-size: 1.25rem;
            }
            .right-panel-title {
                font-size: 1.1rem;
            }
            .right-panel-text {
                font-size: 0.8rem;
                margin-bottom: 1rem;
            }
            input[type="email"], input[type="password"] {
                padding: 0.65rem 0.75rem !important;
                font-size: 14px !important;
            }
        }

        @media (max-width: 360px) {
            .login-title {
                font-size: 1.1rem;
            }
            .right-panel-title {
                font-size: 1rem;
            }
            .right-panel-text {
                font-size: 0.75rem;
            }
            .login-left-side, .login-right-panel {
                padding: 1rem 0.75rem;
            }
        }
        /* Custom Register Button to fix Deploy issues */
        .btn-register-outline {
            border: 2px solid #ffffff !important;
            color: #ffffff !important;
            padding: 12px 32px !important;
            border-radius: 50px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            display: inline-block;
            background: transparent !important;
        }
        
        .btn-register-outline:hover {
            background-color: #ffffff !important;
            color: #dc2626 !important;
        }
    </style>

    <div class="login-main-container shadow-2xl overflow-hidden bg-white" data-aos="zoom-in" data-aos-duration="1000">
        
        <div class="login-left-side relative">
            <div class="text-center">
                <h2 class="login-title mb-2 text-gray-800" data-aos="fade-right">Sign In</h2>
                <p class="text-gray-500 mb-8" data-aos="fade-right" data-aos-delay="100">Gunakan email dan password akun Anda</p>
            </div>

            
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

                <button type="submit" class="btn-custom-signin text-white shadow-lg transform hover:scale-105" data-aos="fade-up" data-aos-delay="200">
                    SIGN IN <i class="fas fa-sign-in-alt ms-2"></i>
                </button>
            </form>
        </div>

        <div class="login-right-panel">
            <h2 class="right-panel-title" data-aos="fade-left" data-aos-delay="300">Halo SerKum Muda</h2>
            <p class="right-panel-text" data-aos="fade-left" data-aos-delay="500">
                Belum mendaftarkan diri? Mari bergabung bersama kami 
            </p>
            <a href="{{ route('pendaftaran') }}" 
               class="btn-register-outline"
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