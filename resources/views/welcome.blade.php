<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporSekolah! — Suara Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-deep:   #060c18;
            --bg:        #0a1020;
            --surface:   #0f1729;
            --surface-2: #16213a;
            --surface-3: #1e2d4a;
            --glass:     rgba(15,23,42,0.72);
            --gb:        rgba(99,130,255,0.13);
            --text:      #e8edf8;
            --text-soft: #a8b5d0;
            --text-dim:  #607090;
            --indigo:    #6574f8;
            --indigo-g:  rgba(101,116,248,0.32);
            --indigo-dk: #4a5ae0;
            --teal:      #2dd4bf;
            --teal-g:    rgba(45,212,191,0.22);
            --rose:      #fb7185;
            --amber:     #fbbf24;
            --emerald:   #34d399;
            --r:         1.25rem;
            --rl:        1.75rem;
            --rxl:       2.25rem;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }
        /* ── BG GRID ── */
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }
        /* ── GLOW ORBS ── */
        .orb {
            position: fixed; border-radius: 50%;
            filter: blur(90px); opacity: 0.45; pointer-events: none; z-index: 0;
        }
        .orb-1 { width: 500px; height: 500px; top: -120px; right: -100px; background: radial-gradient(circle, rgba(101,116,248,0.55), transparent 70%); }
        .orb-2 { width: 400px; height: 400px; bottom: 80px; left: -80px; background: radial-gradient(circle, rgba(45,212,191,0.35), transparent 70%); }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,16,32,0.85);
            backdrop-filter: blur(18px) saturate(1.4);
            border-bottom: 1px solid rgba(99,130,255,0.1);
            padding: 0.85rem 0;
        }
        .navbar-brand {
            font-family: 'Sora', sans-serif;
            font-weight: 800; font-size: 1.25rem;
            color: var(--text) !important;
            letter-spacing: -0.02em;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .brand-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; flex-shrink: 0;
        }
        .nav-link {
            color: var(--text-soft) !important; font-weight: 500;
            padding: 0.45rem 1rem !important; border-radius: 999px;
            transition: color 0.2s, background 0.2s;
            font-size: 0.92rem;
        }
        .nav-link:hover { color: var(--text) !important; background: rgba(99,130,255,0.1); }
        .btn-nav-login {
            background: rgba(101,116,248,0.14);
            color: var(--indigo) !important;
            border: 1px solid rgba(101,116,248,0.3);
            border-radius: 999px;
            padding: 0.45rem 1.2rem !important;
            font-weight: 600; font-size: 0.9rem;
            transition: all 0.2s;
        }
        .btn-nav-login:hover { background: rgba(101,116,248,0.25); border-color: rgba(101,116,248,0.55); }
        .dropdown-toggle-pill {
            background: rgba(99,130,255,0.1) !important;
            color: var(--text) !important;
            border-radius: 999px !important;
            padding: 0.45rem 1.1rem !important;
            font-weight: 500; border: 1px solid var(--gb) !important;
            box-shadow: none !important;
        }
        .dropdown-menu {
            background: rgba(10,16,32,0.97) !important;
            backdrop-filter: blur(18px);
            border: 1px solid var(--gb) !important;
            border-radius: var(--r) !important;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4), 0 0 0 1px rgba(99,130,255,0.08) !important;
            padding: 0.5rem !important;
            min-width: 190px;
        }
        .dropdown-item {
            color: var(--text-soft) !important; border-radius: 0.65rem;
            padding: 0.6rem 1rem; font-size: 0.9rem; transition: all 0.2s;
        }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }
        .dropdown-divider { border-color: rgba(99,130,255,0.1) !important; margin: 0.35rem 0.5rem; }

        /* ── HERO ── */
        .hero {
            position: relative; z-index: 1;
            padding: 6rem 0 4rem;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(101,116,248,0.12);
            border: 1px solid rgba(101,116,248,0.25);
            color: #a5b4fc;
            border-radius: 999px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem; font-weight: 600;
            letter-spacing: 0.02em;
            margin-bottom: 1.75rem;
        }
        .hero-badge .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--teal);
            box-shadow: 0 0 8px var(--teal);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(0.8); }
        }
        .hero h1 {
            font-family: 'Sora', sans-serif;
            font-weight: 800; font-size: clamp(2.4rem, 5vw, 3.8rem);
            line-height: 1.1; letter-spacing: -0.03em;
            color: var(--text);
        }
        .hero h1 .accent {
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            color: var(--text-soft); font-size: 1.1rem; line-height: 1.7;
            max-width: 540px; margin-top: 1.25rem;
        }
        .hero-actions { margin-top: 2.25rem; display: flex; gap: 0.85rem; flex-wrap: wrap; }
        .btn-hero {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.8rem 1.8rem;
            border-radius: 999px; font-weight: 600; font-size: 0.95rem;
            text-decoration: none; transition: all 0.25s; border: none;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--indigo), #7c3aed);
            color: #fff;
            box-shadow: 0 0 24px rgba(101,116,248,0.4), 0 8px 24px rgba(0,0,0,0.3);
        }
        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 36px rgba(101,116,248,0.55), 0 12px 32px rgba(0,0,0,0.35);
            color: #fff;
        }
        .btn-hero-ghost {
            background: rgba(255,255,255,0.05);
            color: var(--text-soft);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .btn-hero-ghost:hover {
            background: rgba(255,255,255,0.09);
            color: var(--text);
            transform: translateY(-1px);
        }

        /* ── HERO VISUAL ── */
        .hero-visual {
            position: relative;
        }
        .hero-card-mock {
            background: var(--glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--gb);
            border-radius: var(--rl);
            padding: 1.5rem;
            box-shadow: 0 40px 80px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .mock-stat {
            background: rgba(101,116,248,0.08);
            border: 1px solid rgba(101,116,248,0.16);
            border-radius: var(--r); padding: 1rem 1.25rem;
            text-align: center;
        }
        .mock-stat .num {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.8rem;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .mock-stat small { color: var(--text-dim); font-size: 0.75rem; display: block; margin-top: 0.2rem; }
        .mock-item {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(99,130,255,0.1);
            border-radius: var(--r); padding: 0.85rem 1rem;
            display: flex; align-items: center; gap: 0.85rem;
        }
        .mock-item-icon {
            width: 36px; height: 36px; border-radius: 0.6rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .mock-tag {
            display: inline-block; padding: 0.18rem 0.6rem;
            border-radius: 999px; font-size: 0.68rem; font-weight: 600;
        }

        /* ── HOW IT WORKS ── */
        .section { position: relative; z-index: 1; padding: 5rem 0; }
        .section-label {
            display: inline-flex; align-items: center; gap: 0.5rem;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--indigo);
            margin-bottom: 1rem;
        }
        .section-title {
            font-family: 'Sora', sans-serif; font-weight: 800;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            letter-spacing: -0.025em; color: var(--text);
        }
        .step-card {
            background: var(--surface);
            border: 1px solid var(--gb);
            border-radius: var(--rl);
            padding: 2rem;
            position: relative; overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
        }
        .step-card::before {
            content: ''; position: absolute;
            inset: 0; border-radius: inherit;
            opacity: 0; transition: opacity 0.3s;
        }
        .step-card:hover { transform: translateY(-6px); border-color: rgba(101,116,248,0.3); }
        .step-card:hover::before { opacity: 1; }
        .step-card:hover { box-shadow: 0 24px 50px rgba(0,0,0,0.3), 0 0 0 1px rgba(101,116,248,0.15), 0 0 40px rgba(101,116,248,0.08); }
        .step-num {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 3.5rem;
            line-height: 1; letter-spacing: -0.04em;
            background: linear-gradient(135deg, rgba(101,116,248,0.25), rgba(101,116,248,0.05));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            position: absolute; top: 1.25rem; right: 1.5rem;
        }
        .step-icon {
            width: 52px; height: 52px; border-radius: var(--r);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 1.25rem;
        }
        .step-card h4 {
            font-family: 'Sora', sans-serif; font-weight: 700;
            font-size: 1.1rem; color: var(--text); margin-bottom: 0.6rem;
        }
        .step-card p { color: var(--text-soft); font-size: 0.92rem; line-height: 1.65; margin: 0; }

        /* ── FOOTER ── */
        footer {
            position: relative; z-index: 1;
            border-top: 1px solid rgba(99,130,255,0.1);
            background: rgba(10,16,32,0.9); backdrop-filter: blur(12px);
            padding: 2rem 0;
            color: var(--text-dim); text-align: center; font-size: 0.88rem;
        }
        footer span { color: var(--indigo); }

        @media (max-width: 992px) {
            .hero { padding: 4rem 0 2.5rem; }
            .hero-actions { flex-direction: column; align-items: stretch; }
            .hero-card-mock { padding: 1.25rem; }
            .step-card { padding: 1.35rem; }
        }

        @media (max-width: 768px) {
            .page-wrap { padding: 2rem 0; }
            .hero h1 { font-size: clamp(2.1rem, 7vw, 3rem); }
            .hero p { max-width: 100%; }
            .btn-hero, .btn-hero-primary, .btn-hero-ghost { width: 100%; justify-content: center; }
            .navbar .container { gap: 0.75rem; flex-wrap: wrap; }
            .navbar-nav { flex-direction: column; align-items: stretch; }
            .orb { display: none; }
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="brand-icon"><i class="bi bi-megaphone-fill text-white"></i></div>
                LaporSekolah!
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="color: var(--text-soft);">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="/aspirasi"><i class="bi bi-journal-text me-1"></i>Semua Laporan</a></li>
                    @if(session('siswa_nis'))
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ session('siswa_nama') }}
                                @php
                                    $unreadCount = \App\Models\Notification::where('user_id', session('siswa_nis'))->whereNull('read_at')->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="badge bg-danger ms-1" style="font-size: 0.7rem;">{{ $unreadCount }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile"><i class="bi bi-collection me-2"></i>Laporan Saya</a></li>
                                <li><a class="dropdown-item" href="/notifications"><i class="bi bi-bell me-2"></i>Notifikasi @if($unreadCount > 0)<span class="badge bg-danger ms-1" style="font-size: 0.7rem;">{{ $unreadCount }}</span>@endif</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li><a class="dropdown-item" href="/logout" style="color: var(--rose) !important;"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    @elseif(session('admin_id'))
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-check me-1"></i> Admin: {{ session('admin_nama') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li><a class="dropdown-item" href="/logout" style="color: var(--rose) !important;"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a class="btn-nav-login nav-link" href="/login">Masuk Akun</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Platform Aspirasi Siswa
                    </div>
                    <h1>Ada Masalah<br>di Sekolah?<br><span class="accent">Tuntaskan Sini,</span><br><span class="accent">Wak!</span></h1>
                    <p>Gak usah dipendam sendiri. Mau bangku rusak, WC macet, atau mau kasih ide gila — lapor aja. Rahasia terjamin, eksekusi terjamin!</p>
                    <div class="hero-actions">
                        @if(session('siswa_nis'))
                            <a href="/aspirasi" class="btn-hero btn-hero-primary"><i class="bi bi-pencil-square"></i> Tulis Laporan</a>
                        @elseif(session('admin_id'))
                            <a href="/admin" class="btn-hero btn-hero-primary"><i class="bi bi-speedometer2"></i> Dashboard Admin</a>
                        @else
                            <a href="/login" class="btn-hero btn-hero-primary"><i class="bi bi-box-arrow-in-right"></i> Login & Melapor</a>
                        @endif
                        <a href="#alur" class="btn-hero btn-hero-ghost"><i class="bi bi-arrow-down"></i> Lihat Alurnya</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-visual">
                        <div class="hero-card-mock">
                            <div class="row g-2 mb-3">
                                <div class="col-4">
                                    <div class="mock-stat">
                                        <div class="num">48</div>
                                        <small>Total Laporan</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mock-stat">
                                        <div class="num">12</div>
                                        <small>Diproses</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mock-stat">
                                        <div class="num">31</div>
                                        <small>Selesai</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <div class="mock-item">
                                    <div class="mock-item-icon" style="background: rgba(34,211,238,0.12);"><i class="bi bi-tools" style="color: #22d3ee;"></i></div>
                                    <div>
                                        <div style="font-size: 0.82rem; font-weight: 600; color: var(--text);">Bangku Kelas Rusak</div>
                                        <div style="margin-top: 2px;"><span class="mock-tag" style="background: rgba(251,191,36,0.15); color: var(--amber);">Proses</span></div>
                                    </div>
                                </div>
                                <div class="mock-item">
                                    <div class="mock-item-icon" style="background: rgba(52,211,153,0.12);"><i class="bi bi-droplet-fill" style="color: var(--emerald);"></i></div>
                                    <div>
                                        <div style="font-size: 0.82rem; font-weight: 600; color: var(--text);">WC Lantai 2 Macet</div>
                                        <div style="margin-top: 2px;"><span class="mock-tag" style="background: rgba(52,211,153,0.15); color: var(--emerald);">Selesai</span></div>
                                    </div>
                                </div>
                                <div class="mock-item">
                                    <div class="mock-item-icon" style="background: rgba(251,113,133,0.12);"><i class="bi bi-lightbulb" style="color: var(--rose);"></i></div>
                                    <div>
                                        <div style="font-size: 0.82rem; font-weight: 600; color: var(--text);">Lampu Lab Mati</div>
                                        <div style="margin-top: 2px;"><span class="mock-tag" style="background: rgba(251,113,133,0.15); color: var(--rose);">Menunggu</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="alur" class="section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label"><i class="bi bi-diagram-3"></i> Alur Kerja</div>
                <h2 class="section-title">Cemana Alurnya, Lek?</h2>
                <p style="color: var(--text-soft); max-width: 480px; margin: 0.85rem auto 0; font-size: 0.95rem;">Tiga langkah simpel dari laporan ke solusi nyata.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card">
                        <span class="step-num">01</span>
                        <div class="step-icon" style="background: rgba(101,116,248,0.14);">
                            <i class="bi bi-pencil-square" style="color: var(--indigo);"></i>
                        </div>
                        <h4>Tulis Laporan</h4>
                        <p>Login pake NIS kau, terus ceritakan masalah atau aspirasi dengan jujur dan jelas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <span class="step-num">02</span>
                        <div class="step-icon" style="background: rgba(251,191,36,0.12);">
                            <i class="bi bi-gear-wide-connected" style="color: var(--amber);"></i>
                        </div>
                        <h4>Proses Verifikasi</h4>
                        <p>Admin bakal nengok laporan kau. Statusnya berubah jadi 'Proses' tanda sedang ditangani.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <span class="step-num">03</span>
                        <div class="step-icon" style="background: rgba(52,211,153,0.12);">
                            <i class="bi bi-check2-all" style="color: var(--emerald);"></i>
                        </div>
                        <h4>Dapat Feedback</h4>
                        <p>Masalah kelar, kau dapat umpan balik langsung dari admin di aplikasi ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>© 2026 <span>LaporSekolah!</span> — Tugas UKK Paling Paten Se-Medan</p>
            <p style="margin-top: 0.35rem; font-size: 0.8rem;">Dibuat dengan keringat dan bantuan AI kawan akrabmu.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>