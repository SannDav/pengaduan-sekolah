<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg:        #0a1020;
            --surface:   #0f1729;
            --surface-2: #16213a;
            --glass:     rgba(15,23,42,0.75);
            --gb:        rgba(99,130,255,0.13);
            --text:      #e8edf8;
            --text-soft: #a8b5d0;
            --text-dim:  #607090;
            --indigo:    #6574f8;
            --indigo-dk: #4a5ae0;
            --teal:      #2dd4bf;
            --rose:      #fb7185;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }
        .orb {
            position: fixed; border-radius: 50%;
            filter: blur(80px); pointer-events: none;
        }
        .orb-1 { width: 450px; height: 450px; top: -120px; right: -80px; background: radial-gradient(circle, rgba(101,116,248,0.45), transparent 70%); }
        .orb-2 { width: 380px; height: 380px; bottom: -80px; left: -80px; background: radial-gradient(circle, rgba(45,212,191,0.3), transparent 70%); }

        /* ── LAYOUT ── */
        .login-wrap {
            position: relative; z-index: 1;
            display: flex; align-items: stretch;
            width: 100%; max-width: 860px;
            border-radius: 1.75rem;
            overflow: hidden;
            border: 1px solid var(--gb);
            box-shadow: 0 40px 90px rgba(0,0,0,0.55), inset 0 1px 0 rgba(255,255,255,0.05);
            margin: 1rem;
        }

        /* ── LEFT PANEL ── */
        .login-panel-left {
            background: linear-gradient(150deg, rgba(101,116,248,0.18), rgba(45,212,191,0.1));
            flex: 0 0 280px;
            padding: 3rem 2rem;
            display: flex; flex-direction: column; justify-content: space-between;
            border-right: 1px solid var(--gb);
            position: relative; overflow: hidden;
        }
        .login-panel-left::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(101,116,248,0.2), transparent 60%);
        }
        .brand {
            position: relative;
            display: flex; align-items: center; gap: 0.65rem;
            font-family: 'Sora', sans-serif; font-weight: 800;
            font-size: 1.2rem; color: var(--text);
        }
        .brand-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
        }
        .panel-tagline {
            position: relative;
        }
        .panel-tagline h2 {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.55rem;
            color: var(--text); line-height: 1.25; margin-bottom: 0.75rem;
        }
        .panel-tagline p {
            color: var(--text-soft); font-size: 0.88rem; line-height: 1.6;
        }
        .panel-dots {
            position: relative;
            display: flex; gap: 0.4rem; margin-top: 2rem;
        }
        .panel-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: rgba(255,255,255,0.25);
        }
        .panel-dot.active { background: var(--indigo); box-shadow: 0 0 8px var(--indigo); }

        /* ── RIGHT PANEL ── */
        .login-panel-right {
            background: var(--glass);
            backdrop-filter: blur(20px);
            flex: 1;
            padding: 2.75rem 2.5rem;
        }
        .login-panel-right h3 {
            font-family: 'Sora', sans-serif; font-weight: 700;
            font-size: 1.4rem; color: var(--text); margin-bottom: 0.35rem;
        }
        .login-panel-right .subtitle {
            color: var(--text-soft); font-size: 0.88rem; margin-bottom: 2rem;
        }

        /* ── TABS ── */
        .tab-switcher {
            display: flex; gap: 0.4rem;
            background: rgba(99,130,255,0.06);
            border: 1px solid var(--gb);
            border-radius: 999px;
            padding: 0.3rem;
            margin-bottom: 2rem;
        }
        .tab-btn {
            flex: 1; padding: 0.55rem; border-radius: 999px;
            background: transparent; border: none; cursor: pointer;
            color: var(--text-soft); font-size: 0.88rem; font-weight: 600;
            transition: all 0.25s;
            font-family: 'DM Sans', sans-serif;
        }
        .tab-btn.active {
            background: var(--indigo);
            color: #fff;
            box-shadow: 0 4px 14px rgba(101,116,248,0.35);
        }

        /* ── FORM ── */
        .form-group { margin-bottom: 1.15rem; }
        .form-label {
            display: block; color: var(--text-soft);
            font-size: 0.82rem; font-weight: 600;
            margin-bottom: 0.5rem; letter-spacing: 0.01em;
        }
        .form-control {
            width: 100%;
            background: rgba(10,16,32,0.7);
            border: 1px solid rgba(99,130,255,0.16);
            border-radius: 0.9rem;
            color: var(--text);
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: var(--text-dim); }
        .form-control:focus {
            border-color: rgba(101,116,248,0.5);
            box-shadow: 0 0 0 3px rgba(101,116,248,0.12);
            background: rgba(10,16,32,0.85);
        }

        /* ── BUTTONS ── */
        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            border-radius: 999px;
            border: none; cursor: pointer;
            font-weight: 700; font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.25s; margin-top: 0.25rem;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }
        .btn-siswa {
            background: linear-gradient(135deg, var(--indigo), #7c3aed);
            color: #fff;
            box-shadow: 0 6px 20px rgba(101,116,248,0.35);
        }
        .btn-siswa:hover {
            box-shadow: 0 8px 28px rgba(101,116,248,0.5);
            transform: translateY(-1px);
        }
        .btn-admin {
            background: rgba(255,255,255,0.06);
            color: var(--text-soft);
            border: 1px solid rgba(255,255,255,0.1) !important;
        }
        .btn-admin:hover {
            background: rgba(255,255,255,0.1);
            color: var(--text);
        }

        /* ── LINK ── */
        .form-footer { text-align: center; margin-top: 1.25rem; }
        .form-footer small { color: var(--text-dim); font-size: 0.82rem; }
        .form-footer a { color: var(--indigo); text-decoration: none; font-weight: 600; }
        .form-footer a:hover { color: var(--teal); }

        /* ── ALERT ── */
        .alert-custom {
            background: rgba(251,113,133,0.1);
            border: 1px solid rgba(251,113,133,0.25);
            border-radius: 0.85rem;
            padding: 0.85rem 1rem;
            color: #fca5a5; font-size: 0.86rem;
            margin-bottom: 1.25rem;
        }

        /* ── PANE HIDE ── */
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .login-panel-left { display: none; }
            .login-panel-right { padding: 2rem 1.5rem; }
            .login-wrap { max-width: 100%; margin: 1rem; }
            .tab-switcher { flex-direction: column; gap: 0.5rem; }
            .orb { display: none; }
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-wrap">
        <!-- LEFT PANEL -->
        <div class="login-panel-left">
            <div class="brand">
                <div class="brand-icon"><i class="bi bi-megaphone-fill text-white" style="font-size: 0.85rem;"></i></div>
                LaporSekolah!
            </div>
            <div class="panel-tagline">
                <h2>Suara Kau,<br>Perubahan<br>Nyata.</h2>
                <p>Platform aspirasi siswa yang aman, cepat, dan langsung ke pihak yang tepat.</p>
                <div class="panel-dots">
                    <div class="panel-dot active"></div>
                    <div class="panel-dot"></div>
                    <div class="panel-dot"></div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="login-panel-right">
            <h3>Masuk ke Sistem</h3>
            <p class="subtitle">Pilih tipe akun dan isi kredensialmu.</p>

            @if(session('error'))
                <div class="alert-custom"><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</div>
            @endif

            <!-- TAB SWITCHER -->
            <div class="tab-switcher">
                <button class="tab-btn active" onclick="switchTab('siswa', this)">
                    <i class="bi bi-mortarboard me-1"></i> Siswa
                </button>
                <button class="tab-btn" onclick="switchTab('admin', this)">
                    <i class="bi bi-shield-check me-1"></i> Admin
                </button>
            </div>

            <!-- SISWA PANE -->
            <div class="tab-pane active" id="pane-siswa">
                <form action="/login-siswa" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">NIS</label>
                        <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS kamu" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn-submit btn-siswa">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk Sebagai Siswa
                    </button>
                </form>
                <div class="form-footer">
                    <small>Belum punya akun? <a href="/register">Daftar di sini</a></small>
                </div>
            </div>

            <!-- ADMIN PANE -->
            <div class="tab-pane" id="pane-admin">
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Username Admin</label>
                        <input type="text" name="username" class="form-control" placeholder="Username admin" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Admin</label>
                        <input type="password" name="password" class="form-control" placeholder="Password admin" required>
                    </div>
                    <button type="submit" class="btn-submit btn-admin">
                        <i class="bi bi-shield-lock"></i> Masuk Sebagai Admin
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchTab(tab, el) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('pane-' + tab).classList.add('active');
        }
    </script>
</body>
</html>