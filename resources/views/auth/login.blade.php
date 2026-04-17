<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – Haawwaa Galaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e40af 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            animation: float 8s ease-in-out infinite;
        }
        .blob-1 { width: 500px; height: 500px; background: #3b82f6; top: -150px; left: -100px; animation-delay: 0s; }
        .blob-2 { width: 400px; height: 400px; background: #8b5cf6; bottom: -100px; right: -100px; animation-delay: 3s; }
        .blob-3 { width: 300px; height: 300px; background: #06b6d4; top: 50%; left: 50%; animation-delay: 1.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        /* Grid pattern overlay */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
        }

        /* Main container */
        .login-wrapper {
            position: relative;
            z-index: 10;
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left panel */
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            color: white;
        }
        .left-panel .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 50px;
        }
        .left-panel .brand-icon {
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
        }
        .left-panel .brand-name {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .left-panel h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            text-align: center;
        }
        .left-panel p {
            font-size: 1.05rem;
            opacity: 0.75;
            text-align: center;
            max-width: 380px;
            line-height: 1.7;
        }
        .stats {
            display: flex;
            gap: 40px;
            margin-top: 50px;
        }
        .stat { text-align: center; }
        .stat-num { font-size: 1.8rem; font-weight: 800; color: #93c5fd; }
        .stat-label { font-size: 0.8rem; opacity: 0.65; margin-top: 4px; }

        /* Right panel - login card */
        .right-panel {
            width: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
        }
        .login-card {
            background: rgba(255,255,255,0.97);
            border-radius: 28px;
            padding: 50px 45px;
            width: 100%;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.1);
        }
        .card-header {
            text-align: center;
            margin-bottom: 35px;
        }
        .card-header .avatar {
            width: 70px; height: 70px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(30,58,138,0.35);
        }
        .card-header h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }
        .card-header p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        /* Form fields */
        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.9rem;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #111827;
            background: #f9fafb;
            transition: all 0.2s;
            outline: none;
            font-family: 'Inter', sans-serif;
        }
        .input-wrap input:focus {
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
        }
        .input-wrap .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            font-size: 0.9rem;
            pointer-events: all;
        }
        .input-wrap .toggle-pw:hover { color: #374151; }

        /* Error */
        .field-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Remember + forgot */
        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #374151;
            cursor: pointer;
        }
        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: #1e3a8a;
            cursor: pointer;
        }
        .forgot {
            font-size: 0.85rem;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot:hover { color: #1d4ed8; text-decoration: underline; }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 4px 15px rgba(30,58,138,0.4);
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(30,58,138,0.5);
        }
        .btn-login:active { transform: translateY(0); }

        /* Alert */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 20px; }
            .login-card { padding: 40px 30px; }
        }
        @media (max-width: 480px) {
            .login-card { padding: 30px 20px; border-radius: 20px; }
        }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="login-wrapper">

        {{-- Left decorative panel --}}
        <div class="left-panel">
            <div class="brand">
                <div class="brand-icon">
                    <i class="fas fa-landmark" style="font-size:1.5rem;color:white;"></i>
                </div>
                <span class="brand-name">HAAWWAA GALAAN</span>
            </div>

            <h1>Baga Gara<br>Admin Panel<br>Nagaan Dhuftan</h1>
            <p>Aanaa Haawwaa Galaan bulchiinsa sirna odeeffannoo keessatti baga nagaan argamtan.</p>

            <div class="stats">
                <div class="stat">
                    <div class="stat-num">100K+</div>
                    <div class="stat-label">Jiraattota</div>
                </div>
                <div class="stat">
                    <div class="stat-num">30+</div>
                    <div class="stat-label">Gandoota</div>
                </div>
                <div class="stat">
                    <div class="stat-num">200+</div>
                    <div class="stat-label">Bara Seenaa</div>
                </div>
            </div>
        </div>

        {{-- Right login card --}}
        <div class="right-panel">
            <div class="login-card">
                <div class="card-header">
                    <div class="avatar">
                        <i class="fas fa-user-shield" style="font-size:1.6rem;color:white;"></i>
                    </div>
                    <h2>Admin Login</h2>
                    <p>Gara bulchiinsaatti seenaa</p>
                </div>

                {{-- Session status --}}
                @if (session('status'))
                <div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:12px 16px;border-radius:10px;font-size:0.85rem;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
                    <i class="fas fa-check-circle"></i> {{ session('status') }}
                </div>
                @endif

                {{-- Error --}}
                @if ($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="field">
                        <label for="email">Email Address</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="admin@example.com"
                                   required autofocus autocomplete="username">
                        </div>
                        @error('email')
                        <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="field">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password"
                                   placeholder="••••••••"
                                   required autocomplete="current-password">
                            <span class="toggle-pw" onclick="togglePw()">
                                <i class="fas fa-eye" id="pw-icon"></i>
                            </span>
                        </div>
                        @error('password')
                        <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="row-between">
                        <label class="remember">
                            <input type="checkbox" name="remember" id="remember_me">
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function togglePw() {
        const input = document.getElementById('password');
        const icon = document.getElementById('pw-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
    </script>
</body>
</html>
