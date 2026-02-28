<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — SerdaduKumbang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }

        /* Decorative orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(80px);
            animation: pulse 6s ease-in-out infinite alternate;
        }
        .orb-1 { width: 400px; height: 400px; background: rgba(220,38,38,0.15); top: -100px; left: -100px; animation-delay: 0s; }
        .orb-2 { width: 350px; height: 350px; background: rgba(124,58,237,0.1); bottom: -100px; right: -100px; animation-delay: 2s; }
        .orb-3 { width: 250px; height: 250px; background: rgba(220,38,38,0.08); top: 50%; left: 50%; transform: translate(-50%,-50%); animation-delay: 4s; }
        @keyframes pulse { from { opacity: 0.6; transform: scale(1); } to { opacity: 1; transform: scale(1.1); } }

        /* Grid pattern overlay */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .card {
            position: relative;
            z-index: 10;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 2.5rem;
            width: 420px;
            max-width: 95vw;
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.07);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }
        .logo-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #dc2626, #9f1239);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 8px 20px rgba(220,38,38,0.4);
        }
        .logo-text { color: white; font-weight: 800; font-size: 1.1rem; line-height: 1.2; }
        .logo-text span { display: block; font-weight: 500; font-size: 0.7rem; color: rgba(255,255,255,0.4); letter-spacing: 0.1em; text-transform: uppercase; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 100px;
            background: rgba(220,38,38,0.12);
            border: 1px solid rgba(220,38,38,0.25);
            color: #fca5a5;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .badge-dot {
            width: 6px; height: 6px; border-radius: 50%; background: #ef4444;
            animation: blink 1.5s ease-in-out infinite;
        }
        @keyframes blink { 0%,100% { opacity: 1; } 50% { opacity: 0.3; } }

        h1 { color: white; font-size: 1.75rem; font-weight: 800; margin-bottom: 0.25rem; }
        .subtitle { color: rgba(255,255,255,0.4); font-size: 0.85rem; margin-bottom: 2rem; }

        .error-box {
            background: rgba(220,38,38,0.1);
            border: 1px solid rgba(220,38,38,0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: #fca5a5;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .field { margin-bottom: 1.25rem; }
        label { display: block; color: rgba(255,255,255,0.6); font-size: 0.8rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 0.5rem; }

        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            color: rgba(255,255,255,0.25); font-size: 0.85rem; pointer-events: none;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            color: white;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            outline: none;
        }
        input::placeholder { color: rgba(255,255,255,0.2); }
        input:focus {
            border-color: rgba(220,38,38,0.5);
            background: rgba(220,38,38,0.05);
            box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
        }
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 100px rgba(15,23,42,0.95) inset;
            -webkit-text-fill-color: white;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.25);
            cursor: pointer;
            padding: 4px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        .toggle-password:hover { color: #dc2626; }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #dc2626, #9f1239);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.85rem;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 20px rgba(220,38,38,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.75rem;
            font-family: 'Inter', sans-serif;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(220,38,38,0.4);
            background: linear-gradient(135deg, #ef4444, #be123c);
        }
        .btn-submit:active { transform: translateY(0); }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0 1rem;
            color: rgba(255,255,255,0.2);
            font-size: 0.75rem;
        }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.08); }

        .user-login-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.35);
            font-size: 0.8rem;
            text-decoration: none;
            padding: 0.6rem;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.07);
            transition: all 0.2s;
        }
        .user-login-link:hover {
            color: rgba(255,255,255,0.6);
            border-color: rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.03);
        }

        .footer-note {
            text-align: center;
            color: rgba(255,255,255,0.15);
            font-size: 0.7rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="card">
        <div class="logo-area">
            <div class="logo-icon"><i class="fas fa-shield-alt"></i></div>
            <div class="logo-text">
                SerdaduKumbang
                <span>Admin Panel</span>
            </div>
        </div>

        <div class="badge">
            <span class="badge-dot"></span>
            Akses Terbatas
        </div>
        <h1>Masuk sebagai Admin</h1>
        <p class="subtitle">Hanya untuk personil yang berwenang</p>

        @if(session('error'))
            <div class="error-box">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-box">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" data-turbo="false">
            @csrf

            <div class="field">
                <label>Email Admin</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                </div>
            </div>

            <div class="field">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="adminPassword" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" onclick="toggleAdminPw()" aria-label="Tampilkan password">
                        <i class="fas fa-eye" id="adminToggleIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i>
                Masuk ke Panel Admin
            </button>
        </form>

        <div class="divider">atau</div>

        <a href="{{ route('login.form') }}" class="user-login-link">
            <i class="fas fa-user"></i>
            Login sebagai Anggota / User
        </a>

        <p class="footer-note">© {{ date('Y') }} SerdaduKumbang. Akses terlindungi.</p>
    </div>

    <script>
        function toggleAdminPw() {
            const input = document.getElementById('adminPassword');
            const icon = document.getElementById('adminToggleIcon');
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
</body>
</html>
