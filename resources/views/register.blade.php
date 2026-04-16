<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg:        #0a1020;
            --surface:   #0f1729;
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
            padding: 2rem 1rem;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px; pointer-events: none;
        }
        .orb { position: fixed; border-radius: 50%; filter: blur(80px); pointer-events: none; }
        .orb-1 { width: 450px; height: 450px; top: -100px; right: -80px; background: radial-gradient(circle, rgba(101,116,248,0.4), transparent 70%); }
        .orb-2 { width: 350px; height: 350px; bottom: -60px; left: -60px; background: radial-gradient(circle, rgba(45,212,191,0.28), transparent 70%); }

        /* ── CARD ── */
        .reg-card {
            position: relative; z-index: 1;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--gb);
            border-radius: 1.75rem;
            box-shadow: 0 40px 90px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.05);
            width: 100%; max-width: 520px;
            padding: 2.75rem;
        }

        /* ── HEADER ── */
        .reg-header { text-align: center; margin-bottom: 2rem; }
        .reg-icon-wrap {
            width: 54px; height: 54px; border-radius: 1rem;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 0 28px rgba(101,116,248,0.4);
        }
        .reg-header h2 {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.5rem;
            color: var(--text); margin-bottom: 0.35rem;
        }
        .reg-header p { color: var(--text-soft); font-size: 0.88rem; }

        /* ── ALERTS ── */
        .alert-success-custom {
            background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.25);
            border-radius: 0.85rem; padding: 0.85rem 1rem;
            color: #6ee7b7; font-size: 0.86rem; margin-bottom: 1.25rem;
        }
        .alert-error-custom {
            background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.25);
            border-radius: 0.85rem; padding: 0.85rem 1rem;
            color: #fca5a5; font-size: 0.86rem; margin-bottom: 1.25rem;
        }
        .alert-error-custom ul { margin: 0; padding-left: 1.1rem; }

        /* ── FORM ── */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label {
            display: block; color: var(--text-soft);
            font-size: 0.8rem; font-weight: 600;
            margin-bottom: 0.45rem; letter-spacing: 0.01em;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%);
            color: var(--text-dim); font-size: 0.88rem; pointer-events: none;
        }
        .form-control {
            width: 100%;
            background: rgba(10,16,32,0.7);
            border: 1px solid rgba(99,130,255,0.16);
            border-radius: 0.9rem;
            color: var(--text);
            padding: 0.75rem 1rem 0.75rem 2.25rem;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control.no-icon { padding-left: 1rem; }
        .form-control::placeholder { color: var(--text-dim); }
        .form-control:focus {
            border-color: rgba(101,116,248,0.5);
            box-shadow: 0 0 0 3px rgba(101,116,248,0.12);
            background: rgba(10,16,32,0.85);
        }

        /* ── DIVIDER ── */
        .form-divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 1.25rem 0;
        }
        .form-divider::before, .form-divider::after {
            content: ''; flex: 1; height: 1px;
            background: rgba(99,130,255,0.12);
        }
        .form-divider span { color: var(--text-dim); font-size: 0.75rem; white-space: nowrap; }

        /* ── BUTTON ── */
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            border-radius: 999px;
            border: none; cursor: pointer;
            font-weight: 700; font-size: 0.92rem;
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, var(--indigo), #7c3aed);
            color: #fff;
            box-shadow: 0 6px 20px rgba(101,116,248,0.35);
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            box-shadow: 0 8px 28px rgba(101,116,248,0.5);
            transform: translateY(-1px);
        }

        /* ── FOOTER ── */
        .form-footer { text-align: center; margin-top: 1.25rem; }
        .form-footer small { color: var(--text-dim); font-size: 0.82rem; }
        .form-footer a { color: var(--indigo); text-decoration: none; font-weight: 600; }
        .form-footer a:hover { color: var(--teal); }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="reg-card">
        <div class="reg-header">
            <div class="reg-icon-wrap">
                <i class="bi bi-person-plus-fill text-white fs-4"></i>
            </div>
            <h2>Daftar Akun Siswa</h2>
            <p>Hanya siswa yang bisa daftar. Akun admin dibuat langsung di database.</p>
        </div>

        @if(session('success'))
            <div class="alert-success-custom"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error-custom">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">NIS</label>
                    <div class="input-wrap">
                        <i class="bi bi-card-text input-icon"></i>
                        <input type="text" name="nis" value="{{ old('nis') }}"
                            class="form-control" placeholder="Nomor Induk" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <div class="input-wrap">
                        <i class="bi bi-door-open input-icon"></i>
                        <input type="text" name="kelas" value="{{ old('kelas') }}"
                            class="form-control" placeholder="Contoh: 12A" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="form-control" placeholder="Nama lengkap kamu" required>
                </div>
            </div>

            <div class="form-divider"><span>Buat Password</span></div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password"
                        class="form-control" placeholder="Buat password yang kuat" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" name="password_confirmation"
                        class="form-control" placeholder="Ulangi passwordmu" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-person-check"></i> Daftar Sekarang
            </button>
        </form>

        <div class="form-footer">
            <small>Sudah punya akun? <a href="/login">Masuk di sini</a></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>