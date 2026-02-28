<x-guest-layout>
    
    <style>
        .min-h-screen {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem !important;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Decorative orbs */
        .min-h-screen::before {
            content: '';
            position: absolute;
            top: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(220,38,38,0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .min-h-screen::after {
            content: '';
            position: absolute;
            bottom: -200px;
            left: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(220,38,38,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Main Container */
        .login-container {
            display: flex;
            width: 960px;
            max-width: 95vw;
            min-height: 560px;
            border-radius: 28px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            box-shadow: 0 30px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05);
        }

        /* Left Side - Form */
        .login-form-side {
            flex: 1.1;
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border-right: 1px solid rgba(255,255,255,0.06);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2.5rem;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #dc2626, #991b1b);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 16px rgba(220,38,38,0.35);
        }

        .brand-icon img {
            width: 26px;
            height: 26px;
            object-fit: contain;
        }

        .brand-name {
            font-size: 1rem;
            font-weight: 800;
            color: #f1f5f9;
            letter-spacing: -0.3px;
        }

        .form-heading {
            color: #ffffff;
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.35rem;
            letter-spacing: -0.5px;
        }

        .form-subheading {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        /* Alerts */
        .alert-box {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
        }
        .alert-error i { color: #ef4444; }
        .alert-error span { color: #fca5a5; }
        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.2);
        }
        .alert-success i { color: #22c55e; }
        .alert-success span { color: #86efac; }

        /* Form Fields */
        .field {
            margin-bottom: 1.25rem;
        }

        .field label {
            display: block;
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 0.85rem;
            pointer-events: none;
            transition: color 0.3s;
        }

        .input-wrap input {
            width: 100%;
            background: rgba(255,255,255,0.05) !important;
            border: 1.5px solid rgba(255,255,255,0.08) !important;
            border-radius: 12px !important;
            padding: 0.8rem 1rem 0.8rem 2.75rem !important;
            color: #f1f5f9 !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrap input::placeholder {
            color: #3f4f63 !important;
        }

        .input-wrap input:focus {
            border-color: rgba(220,38,38,0.5) !important;
            background: rgba(255,255,255,0.07) !important;
            box-shadow: 0 0 0 3px rgba(220,38,38,0.12) !important;
        }

        .input-wrap input:focus ~ .icon {
            color: #dc2626;
        }

        .input-wrap input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 100px #131c2e inset !important;
            -webkit-text-fill-color: #f1f5f9 !important;
        }

        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #475569;
            cursor: pointer;
            padding: 4px;
            font-size: 0.85rem;
            transition: color 0.3s;
        }
        .toggle-pw:hover { color: #dc2626; }

        /* Remember + Forgot */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            accent-color: #dc2626;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 0.85rem !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 6px 20px rgba(220,38,38,0.3);
            letter-spacing: 0.3px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(220,38,38,0.4) !important;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }

        .btn-submit:active { transform: translateY(0); }

        /* Right Side - Info Panel */
        .login-info-side {
            flex: 0.9;
            background: linear-gradient(160deg, #dc2626 0%, #991b1b 50%, #7f1d1d 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .login-info-side::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-info-side::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            pointer-events: none;
        }

        .info-content {
            position: relative;
            z-index: 1;
        }

        .info-icon-circle {
            width: 72px;
            height: 72px;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: white;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .info-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .info-text {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.6;
            margin-bottom: 2rem;
            max-width: 280px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-register {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .btn-register:hover {
            background: white;
            color: #dc2626;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Animations */
        @keyframes slideFromLeft { from { opacity: 0; transform: translateX(-30px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideFromRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        .login-form-side { animation: slideFromLeft 0.7s ease-out both; }
        .login-info-side { animation: slideFromRight 0.7s ease-out 0.2s both; }
        .anim-up-1 { animation: fadeUp 0.5s ease-out 0.3s both; }
        .anim-up-2 { animation: fadeUp 0.5s ease-out 0.4s both; }
        .anim-up-3 { animation: fadeUp 0.5s ease-out 0.5s both; }
        .anim-up-4 { animation: fadeUp 0.5s ease-out 0.6s both; }
        .anim-up-5 { animation: fadeUp 0.5s ease-out 0.7s both; }

        /* Mobile */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column-reverse;
                max-width: 420px;
                min-height: auto;
                border-radius: 20px;
            }
            .login-info-side {
                padding: 1.5rem 1.25rem;
                border-radius: 0;
            }
            .login-form-side {
                padding: 1.75rem 1.25rem;
                border-right: none;
                border-bottom: 1px solid rgba(255,255,255,0.06);
            }
            .info-icon-circle { width: 48px; height: 48px; font-size: 1.2rem; margin-bottom: 0.75rem; }
            .info-title { font-size: 1.1rem; margin-bottom: 0.35rem; }
            .info-text { font-size: 0.75rem; margin-bottom: 1rem; max-width: none; }
            .btn-register { padding: 0.5rem 1.5rem; font-size: 0.75rem; }
            .form-heading { font-size: 1.3rem; }
            .form-subheading { font-size: 0.8rem; margin-bottom: 1.5rem; }
            .brand-row { margin-bottom: 1.5rem; }
        }

        @media (max-width: 480px) {
            .login-container { border-radius: 16px; }
            .login-form-side { padding: 1.5rem 1rem; }
            .login-info-side { padding: 1.25rem 1rem; }
            .form-heading { font-size: 1.15rem; }
            .input-wrap input { padding: 0.7rem 0.9rem 0.7rem 2.5rem !important; font-size: 0.85rem !important; }
            .btn-submit { padding: 0.75rem !important; font-size: 0.85rem !important; }
        }
    </style>

    <div class="login-container">
        {{-- Left Side: Form --}}
        <div class="login-form-side">
            <div class="brand-row anim-up-1">
                <div class="brand-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fas fa-graduation-cap\' style=\'color:white;font-size:1rem\'></i>';">
                </div>
                <span class="brand-name">SerdaduKumbang</span>
            </div>

            <h1 class="form-heading anim-up-1">Masuk ke Akun</h1>
            <p class="form-subheading anim-up-2">Gunakan email dan password yang kamu terima saat pendaftaran</p>

            {{-- Alerts --}}
            @if (session('success'))
                <div class="alert-box alert-success anim-up-2">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-box alert-error anim-up-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" data-turbo="false">
                @csrf

                <div class="field anim-up-3">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope icon"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" autocomplete="email">
                    </div>
                </div>

                <div class="field anim-up-3">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock icon"></i>
                        <input id="password" type="password" name="password" required placeholder="Masukkan password" autocomplete="current-password">
                        <button type="button" class="toggle-pw" onclick="togglePassword()" aria-label="Tampilkan password">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="options-row anim-up-4">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" id="remember_me">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-submit anim-up-5">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </button>
            </form>
        </div>

        {{-- Right Side: Info Panel --}}
        <div class="login-info-side">
            <div class="info-content">
                <div class="info-icon-circle">
                    <i class="fas fa-users"></i>
                </div>
                <h2 class="info-title">Halo, SerKum Muda!</h2>
                <p class="info-text">
                    Belum mendaftarkan diri? Mari bergabung bersama kami dan jadilah bagian dari perubahan.
                </p>
                <a href="{{ route('pendaftaran') }}" class="btn-register">
                    DAFTAR SEKARANG
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</x-guest-layout>