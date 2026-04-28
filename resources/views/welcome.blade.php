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
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── BG GRID ── */
        body::before {
            content: ''; position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px; pointer-events: none;
        }

        /* ── GLOW ORBS ── */
        .orb { position: fixed; border-radius: 50%; filter: blur(90px); opacity: 0.45; pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; top: -120px; right: -100px; background: radial-gradient(circle, rgba(101,116,248,0.55), transparent 70%); }
        .orb-2 { width: 400px; height: 400px; bottom: 80px; left: -80px; background: radial-gradient(circle, rgba(45,212,191,0.35), transparent 70%); }

        /* ── FADE IN ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; } to { opacity: 1; }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(0.8); }
        }
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-8px); }
        }
        @keyframes shimmer {
            0%   { background-position: -400px 0; }
            100% { background-position: 400px 0; }
        }
        .fade-up { animation: fadeUp 0.7s ease both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.15s; }
        .fade-up-3 { animation-delay: 0.25s; }
        .fade-up-4 { animation-delay: 0.35s; }
        .fade-up-5 { animation-delay: 0.45s; }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,16,32,0.85); backdrop-filter: blur(18px) saturate(1.4);
            border-bottom: 1px solid rgba(99,130,255,0.1); padding: 0.85rem 0;
        }
        .navbar-brand {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.25rem;
            color: var(--text) !important; letter-spacing: -0.02em;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .brand-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0;
        }
        .nav-link { color: var(--text-soft) !important; font-weight: 500; padding: 0.45rem 1rem !important; border-radius: 999px; transition: color 0.2s, background 0.2s; font-size: 0.92rem; }
        .nav-link:hover { color: var(--text) !important; background: rgba(99,130,255,0.1); }
        .btn-nav-login { background: rgba(101,116,248,0.14); color: var(--indigo) !important; border: 1px solid rgba(101,116,248,0.3); border-radius: 999px; padding: 0.45rem 1.2rem !important; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; }
        .btn-nav-login:hover { background: rgba(101,116,248,0.25); border-color: rgba(101,116,248,0.55); }
        .dropdown-toggle-pill { background: rgba(99,130,255,0.1) !important; color: var(--text) !important; border-radius: 999px !important; padding: 0.45rem 1.1rem !important; font-weight: 500; border: 1px solid var(--gb) !important; box-shadow: none !important; }
        .dropdown-menu { background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(18px); border: 1px solid var(--gb) !important; border-radius: var(--r) !important; box-shadow: 0 20px 50px rgba(0,0,0,0.4), 0 0 0 1px rgba(99,130,255,0.08) !important; padding: 0.5rem !important; min-width: 200px; }
        .dropdown-item { color: var(--text-soft) !important; border-radius: 0.65rem; padding: 0.6rem 1rem; font-size: 0.9rem; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }
        .dropdown-divider { border-color: rgba(99,130,255,0.1) !important; margin: 0.35rem 0.5rem; }

        /* ── TICKER / MARQUEE ── */
        .ticker-wrap {
            position: relative; z-index: 1;
            background: rgba(101,116,248,0.06);
            border-top: 1px solid rgba(101,116,248,0.12);
            border-bottom: 1px solid rgba(101,116,248,0.12);
            padding: 0.55rem 0; overflow: hidden;
        }
        .ticker-inner { display: flex; width: max-content; animation: ticker 35s linear infinite; }
        .ticker-inner:hover { animation-play-state: paused; }
        .ticker-item {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0 2.5rem; font-size: 0.78rem; font-weight: 600;
            color: var(--text-soft); white-space: nowrap; letter-spacing: 0.01em;
        }
        .ticker-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
        .ticker-label { color: var(--text-dim); font-weight: 400; }

        /* ── HERO ── */
        .hero { position: relative; z-index: 1; padding: 5.5rem 0 3.5rem; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(101,116,248,0.12); border: 1px solid rgba(101,116,248,0.25);
            color: #a5b4fc; border-radius: 999px; padding: 0.4rem 1rem;
            font-size: 0.8rem; font-weight: 600; letter-spacing: 0.02em; margin-bottom: 1.75rem;
        }
        .hero-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal); box-shadow: 0 0 8px var(--teal); animation: pulse 2s infinite; }
        .hero h1 {
            font-family: 'Sora', sans-serif; font-weight: 800;
            font-size: clamp(2.4rem, 5vw, 3.8rem); line-height: 1.1; letter-spacing: -0.03em; color: var(--text);
        }
        .hero h1 .accent { background: linear-gradient(135deg, var(--indigo), var(--teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero p { color: var(--text-soft); font-size: 1.1rem; line-height: 1.7; max-width: 520px; margin-top: 1.25rem; }
        .hero-actions { margin-top: 2.25rem; display: flex; gap: 0.85rem; flex-wrap: wrap; }
        .btn-hero { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.8rem; border-radius: 999px; font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: all 0.25s; border: none; }
        .btn-hero-primary { background: linear-gradient(135deg, var(--indigo), #7c3aed); color: #fff; box-shadow: 0 0 24px rgba(101,116,248,0.4), 0 8px 24px rgba(0,0,0,0.3); }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 0 36px rgba(101,116,248,0.55), 0 12px 32px rgba(0,0,0,0.35); color: #fff; }
        .btn-hero-ghost { background: rgba(255,255,255,0.05); color: var(--text-soft); border: 1px solid rgba(255,255,255,0.1); }
        .btn-hero-ghost:hover { background: rgba(255,255,255,0.09); color: var(--text); transform: translateY(-1px); }

        /* ── HERO VISUAL / MOCKCARD ── */
        .hero-card-mock {
            background: var(--glass); backdrop-filter: blur(16px); border: 1px solid var(--gb);
            border-radius: var(--rl); padding: 1.5rem;
            box-shadow: 0 40px 80px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.06);
            animation: float 5s ease-in-out infinite;
        }
        .mock-stat { background: rgba(101,116,248,0.08); border: 1px solid rgba(101,116,248,0.16); border-radius: var(--r); padding: 1rem 1.25rem; text-align: center; }
        .mock-stat .num { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.8rem; background: linear-gradient(135deg, var(--indigo), var(--teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .mock-stat small { color: var(--text-dim); font-size: 0.75rem; display: block; margin-top: 0.2rem; }
        .mock-item { background: rgba(255,255,255,0.03); border: 1px solid rgba(99,130,255,0.1); border-radius: var(--r); padding: 0.85rem 1rem; display: flex; align-items: center; gap: 0.85rem; }
        .mock-item-icon { width: 36px; height: 36px; border-radius: 0.6rem; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
        .mock-tag { display: inline-block; padding: 0.18rem 0.6rem; border-radius: 999px; font-size: 0.68rem; font-weight: 600; }

        /* ── SECTION COMMONS ── */
        .section { position: relative; z-index: 1; padding: 5rem 0; }
        .section-label { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--indigo); margin-bottom: 1rem; }
        .section-title { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(1.7rem, 3vw, 2.4rem); letter-spacing: -0.025em; color: var(--text); }
        .section-sub { color: var(--text-soft); max-width: 480px; margin: 0.85rem auto 0; font-size: 0.95rem; }

        /* ── STEP CARDS ── */
        .step-card { background: var(--surface); border: 1px solid var(--gb); border-radius: var(--rl); padding: 2rem; position: relative; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s; }
        .step-card:hover { transform: translateY(-6px); border-color: rgba(101,116,248,0.3); box-shadow: 0 24px 50px rgba(0,0,0,0.3), 0 0 40px rgba(101,116,248,0.08); }
        .step-num { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 3.5rem; line-height: 1; letter-spacing: -0.04em; background: linear-gradient(135deg, rgba(101,116,248,0.25), rgba(101,116,248,0.05)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; position: absolute; top: 1.25rem; right: 1.5rem; }
        .step-icon { width: 52px; height: 52px; border-radius: var(--r); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.25rem; }
        .step-card h4 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.1rem; color: var(--text); margin-bottom: 0.6rem; }
        .step-card p { color: var(--text-soft); font-size: 0.92rem; line-height: 1.65; margin: 0; }

        /* ── STATS SECTION ── */
        .stats-section { position: relative; z-index: 1; padding: 4rem 0; }
        .stats-band {
            background: linear-gradient(135deg, rgba(101,116,248,0.1), rgba(45,212,191,0.06));
            border: 1px solid var(--gb); border-radius: 2rem; padding: 3rem 2rem;
            position: relative; overflow: hidden;
        }
        .stats-band::before { content: ''; position: absolute; top: -80px; left: -80px; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(101,116,248,0.12), transparent 70%); pointer-events: none; }
        .stats-band::after { content: ''; position: absolute; bottom: -80px; right: -80px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(45,212,191,0.1), transparent 70%); pointer-events: none; }
        .stat-big { text-align: center; padding: 1rem; }
        .stat-big .number {
            font-family: 'Sora', sans-serif; font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 3.5rem); line-height: 1;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .stat-big .label { color: var(--text-soft); font-size: 0.9rem; margin-top: 0.4rem; }
        .stat-divider { width: 1px; background: rgba(99,130,255,0.15); margin: 0 1rem; }

        /* ── LIVE FEED SECTION ── */
        .feed-section { position: relative; z-index: 1; padding: 5rem 0; }
        .feed-card {
            background: var(--glass); backdrop-filter: blur(12px);
            border: 1px solid var(--gb); border-radius: var(--rl);
            padding: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        .feed-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem; }
        .feed-title { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.1rem; color: var(--text); display: flex; align-items: center; gap: 0.55rem; }
        .live-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--emerald); box-shadow: 0 0 10px var(--emerald); animation: pulse 1.8s infinite; }
        .feed-link { color: #a5b4fc; font-size: 0.83rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 0.35rem; transition: color 0.2s; }
        .feed-link:hover { color: var(--teal); }

        /* Feed items */
        .feed-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .feed-item {
            display: flex; align-items: flex-start; gap: 1rem;
            background: rgba(15,23,42,0.7); border: 1px solid rgba(99,130,255,0.1);
            border-radius: 1rem; padding: 1rem 1.1rem;
            transition: all 0.22s; position: relative; overflow: hidden;
        }
        .feed-item::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; border-radius: 1rem 0 0 1rem; }
        .feed-item.status-menunggu::before { background: var(--rose); }
        .feed-item.status-proses::before   { background: var(--amber); }
        .feed-item.status-selesai::before  { background: var(--emerald); }
        .feed-item:hover { background: rgba(101,116,248,0.07); border-color: rgba(99,130,255,0.2); transform: translateX(3px); }

        .feed-icon {
            width: 38px; height: 38px; border-radius: 0.75rem; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 1rem;
        }
        .feed-body { flex: 1; min-width: 0; }
        .feed-kat { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--indigo); margin-bottom: 0.25rem; }
        .feed-text { color: var(--text); font-size: 0.88rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; }
        .feed-meta { display: flex; align-items: center; gap: 0.6rem; margin-top: 0.3rem; flex-wrap: wrap; }
        .feed-time { color: var(--text-dim); font-size: 0.74rem; display: flex; align-items: center; gap: 0.25rem; }
        .feed-loc  { color: var(--text-dim); font-size: 0.74rem; display: flex; align-items: center; gap: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px; }

        .badge-status { display: inline-flex; align-items: center; gap: 0.28rem; border-radius: 999px; padding: 0.18rem 0.65rem; font-size: 0.7rem; font-weight: 700; flex-shrink: 0; }
        .badge-status .bd { width: 4px; height: 4px; border-radius: 50%; background: currentColor; }
        .badge-menunggu { background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.25); color: var(--rose); }
        .badge-proses   { background: rgba(251,191,36,0.1);  border: 1px solid rgba(251,191,36,0.25);  color: var(--amber); }
        .badge-selesai  { background: rgba(52,211,153,0.1);  border: 1px solid rgba(52,211,153,0.25);  color: var(--emerald); }

        /* Empty feed */
        .feed-empty { text-align: center; padding: 2.5rem 1rem; color: var(--text-dim); }
        .feed-empty i { font-size: 2rem; margin-bottom: 0.75rem; display: block; }

        /* ── WHY US SECTION ── */
        .why-section { position: relative; z-index: 1; padding: 5rem 0; }
        .why-card {
            background: var(--surface); border: 1px solid var(--gb); border-radius: var(--rl);
            padding: 1.75rem; height: 100%; transition: all 0.3s;
        }
        .why-card:hover { border-color: rgba(101,116,248,0.28); transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.25); }
        .why-icon { width: 48px; height: 48px; border-radius: var(--r); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 1.1rem; }
        .why-card h5 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.98rem; color: var(--text); margin-bottom: 0.5rem; }
        .why-card p { color: var(--text-soft); font-size: 0.87rem; line-height: 1.65; margin: 0; }

        /* ── CTA SECTION ── */
        .cta-section { position: relative; z-index: 1; padding: 5rem 0 6rem; }
        .cta-box {
            background: linear-gradient(135deg, rgba(101,116,248,0.18), rgba(45,212,191,0.08));
            border: 1px solid rgba(101,116,248,0.25); border-radius: 2rem;
            padding: 4rem 2rem; text-align: center; position: relative; overflow: hidden;
        }
        .cta-box::before { content: ''; position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 500px; height: 300px; border-radius: 50%; background: radial-gradient(ellipse, rgba(101,116,248,0.15), transparent 70%); pointer-events: none; }
        .cta-box h2 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(1.75rem, 3.5vw, 2.6rem); color: var(--text); margin-bottom: 1rem; letter-spacing: -0.025em; }
        .cta-box p { color: var(--text-soft); font-size: 1rem; max-width: 460px; margin: 0 auto 2rem; }

        /* ── FOOTER ── */
        footer {
            position: relative; z-index: 1;
            border-top: 1px solid rgba(99,130,255,0.1);
            background: rgba(10,16,32,0.9); backdrop-filter: blur(12px);
            padding: 2.5rem 0; color: var(--text-dim); font-size: 0.88rem;
        }
        .footer-brand { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.1rem; color: var(--text); display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; }
        .footer-links { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .footer-links a { color: var(--text-dim); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--text-soft); }

        /* ── RESPONSIVE ── */
        @media (max-width: 992px) {
            .hero { padding: 4rem 0 2.5rem; }
            .section, .feed-section, .why-section, .cta-section { padding: 3.5rem 0; }
            .stats-section { padding: 2.5rem 0; }
            .stats-band { padding: 2rem 1.25rem; }
            .hero-card-mock { margin-top: 2rem; }
        }
        @media (max-width: 768px) {
            .hero h1 { font-size: clamp(2.1rem, 7vw, 3rem); }
            .btn-hero, .btn-hero-primary, .btn-hero-ghost { width: 100%; justify-content: center; }
            .hero-actions { flex-direction: column; }
            .stat-divider { display: none; }
            .stat-big { border-bottom: 1px solid rgba(99,130,255,0.1); padding-bottom: 1.5rem; margin-bottom: 0.5rem; }
            .stat-big:last-child { border-bottom: none; }
            .orb { display: none; }
            .ticker-wrap { display: none; }
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- ═══ NAVBAR ═══ -->
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
                    <li class="nav-item"><a class="nav-link" href="#alur"><i class="bi bi-diagram-3 me-1"></i>Alur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#laporan"><i class="bi bi-journal-text me-1"></i>Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/aspirasi"><i class="bi bi-megaphone me-1"></i>Semua Laporan</a></li>
                    @if(session('siswa_nis'))
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ session('siswa_nama') }}
                                @php $unreadCount = \App\Models\Notification::where('user_id', session('siswa_nis'))->whereNull('read_at')->count(); @endphp
                                @if($unreadCount > 0)<span class="badge bg-danger ms-1" style="font-size: 0.7rem;">{{ $unreadCount }}</span>@endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile"><i class="bi bi-collection me-2"></i>Laporan Saya</a></li>
                                <li><a class="dropdown-item" href="/notifications"><i class="bi bi-bell me-2"></i>Notifikasi @if($unreadCount > 0)<span class="badge bg-danger ms-1" style="font-size: 0.7rem;">{{ $unreadCount }}</span>@endif</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li><a class="dropdown-item" href="/logout" style="color: var(--rose) !important;"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    @elseif(session('admin_id'))
                        @php $pendingCount = \App\Models\PendingSiswa::where('status','pending')->count(); @endphp
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-check me-1"></i> Admin: {{ session('admin_nama') }}
                                @if($pendingCount > 0)<span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">{{ $pendingCount }}</span>@endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li>
                                    <a class="dropdown-item" href="/admin/approvals">
                                        <i class="bi bi-person-check me-2"></i>Persetujuan Akun
                                        @if($pendingCount > 0)<span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">{{ $pendingCount }}</span>@endif
                                    </a>
                                </li>
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

    <!-- ═══ TICKER ═══ -->
    @php
        $tickerItems = \App\Models\Aspirasi::with('kategori')->latest()->limit(8)->get();
    @endphp
    @if($tickerItems->count() > 0)
    <div class="ticker-wrap">
        <div class="ticker-inner">
            {{-- Duplicate for seamless loop --}}
            @foreach([$tickerItems, $tickerItems] as $items)
                @foreach($items as $t)
                <span class="ticker-item">
                    @php
                        $dotColor = match($t->status) { 'Selesai' => '#34d399', 'Proses' => '#fbbf24', default => '#fb7185' };
                    @endphp
                    <span class="ticker-dot" style="background: {{ $dotColor }};"></span>
                    <span class="ticker-label">{{ $t->kategori->ket_kategori ?? 'Laporan' }}</span>
                    &mdash;
                    {{ \Illuminate\Support\Str::words($t->ket, 5, '...') }}
                    <span style="color: var(--text-dim); margin-left: 0.25rem;">· {{ $t->status }}</span>
                </span>
                @endforeach
            @endforeach
        </div>
    </div>
    @endif

    <!-- ═══ HERO ═══ -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-badge fade-up fade-up-1">
                        <span class="dot"></span>
                        Platform Aspirasi Siswa
                    </div>
                    <h1 class="fade-up fade-up-2">
                        Ada Masalah<br>di Sekolah?<br>
                        <span class="accent">Tuntaskan Sini,</span><br>
                        <span class="accent">Wak!</span>
                    </h1>
                    <p class="fade-up fade-up-3">Gak usah dipendam sendiri. Mau bangku rusak, WC macet, atau mau kasih ide gila — lapor aja. Rahasia terjamin, eksekusi terjamin!</p>
                    <div class="hero-actions fade-up fade-up-4">
                        @if(session('siswa_nis'))
                            <a href="/aspirasi" class="btn-hero btn-hero-primary"><i class="bi bi-pencil-square"></i> Tulis Laporan</a>
                        @elseif(session('admin_id'))
                            <a href="/admin" class="btn-hero btn-hero-primary"><i class="bi bi-speedometer2"></i> Dashboard Admin</a>
                        @else
                            <a href="/login" class="btn-hero btn-hero-primary"><i class="bi bi-box-arrow-in-right"></i> Login & Melapor</a>
                        @endif
                        <a href="#laporan" class="btn-hero btn-hero-ghost"><i class="bi bi-eye"></i> Lihat Laporan Terkini</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block fade-up fade-up-5">
                    <div class="hero-card-mock">
                        @php
                            $heroStats = [
                                'total'    => \App\Models\Aspirasi::count(),
                                'proses'   => \App\Models\Aspirasi::where('status','Proses')->count(),
                                'selesai'  => \App\Models\Aspirasi::where('status','Selesai')->count(),
                            ];
                        @endphp
                        <div class="row g-2 mb-3">
                            <div class="col-4"><div class="mock-stat"><div class="num">{{ $heroStats['total'] }}</div><small>Total Laporan</small></div></div>
                            <div class="col-4"><div class="mock-stat"><div class="num">{{ $heroStats['proses'] }}</div><small>Diproses</small></div></div>
                            <div class="col-4"><div class="mock-stat"><div class="num">{{ $heroStats['selesai'] }}</div><small>Selesai</small></div></div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <div class="mock-item">
                                <div class="mock-item-icon" style="background: rgba(34,211,238,0.12);"><i class="bi bi-tools" style="color: #22d3ee;"></i></div>
                                <div><div style="font-size: 0.82rem; font-weight: 600; color: var(--text);">Bangku Kelas Rusak</div><div style="margin-top: 2px;"><span class="mock-tag" style="background: rgba(251,191,36,0.15); color: var(--amber);">Proses</span></div></div>
                            </div>
                            <div class="mock-item">
                                <div class="mock-item-icon" style="background: rgba(52,211,153,0.12);"><i class="bi bi-droplet-fill" style="color: var(--emerald);"></i></div>
                                <div><div style="font-size: 0.82rem; font-weight: 600; color: var(--text);">WC Lantai 2 Macet</div><div style="margin-top: 2px;"><span class="mock-tag" style="background: rgba(52,211,153,0.15); color: var(--emerald);">Selesai</span></div></div>
                            </div>
                            <div class="mock-item">
                                <div class="mock-item-icon" style="background: rgba(251,113,133,0.12);"><i class="bi bi-lightbulb" style="color: var(--rose);"></i></div>
                                <div><div style="font-size: 0.82rem; font-weight: 600; color: var(--text);">Lampu Lab Mati</div><div style="margin-top: 2px;"><span class="mock-tag" style="background: rgba(251,113,133,0.15); color: var(--rose);">Menunggu</span></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ STATS BAND ═══ -->
    @php
        $statTotal    = \App\Models\Aspirasi::count();
        $statSelesai  = \App\Models\Aspirasi::where('status','Selesai')->count();
        $statSiswa    = \App\Models\Siswa::count();
        $pctSelesai   = $statTotal > 0 ? round(($statSelesai / $statTotal) * 100) : 0;
    @endphp
    <div class="stats-section">
        <div class="container">
            <div class="stats-band">
                <div class="row g-0 align-items-center justify-content-center">
                    <div class="col-6 col-md-3">
                        <div class="stat-big">
                            <div class="number" data-target="{{ $statTotal }}">{{ $statTotal }}</div>
                            <div class="label"><i class="bi bi-journal-text me-1"></i>Total Laporan Masuk</div>
                        </div>
                    </div>
                    <div class="d-none d-md-block stat-divider" style="height: 70px;"></div>
                    <div class="col-6 col-md-3">
                        <div class="stat-big">
                            <div class="number">{{ $statSelesai }}</div>
                            <div class="label"><i class="bi bi-check2-all me-1"></i>Laporan Diselesaikan</div>
                        </div>
                    </div>
                    <div class="d-none d-md-block stat-divider" style="height: 70px;"></div>
                    <div class="col-6 col-md-3">
                        <div class="stat-big">
                            <div class="number">{{ $statSiswa }}</div>
                            <div class="label"><i class="bi bi-people me-1"></i>Siswa Aktif</div>
                        </div>
                    </div>
                    <div class="d-none d-md-block stat-divider" style="height: 70px;"></div>
                    <div class="col-6 col-md-3">
                        <div class="stat-big">
                            <div class="number">{{ $pctSelesai }}%</div>
                            <div class="label"><i class="bi bi-graph-up me-1"></i>Tingkat Penyelesaian</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ LIVE FEED LAPORAN ═══ -->
    @php
        $recentReports = \App\Models\Aspirasi::with('kategori')->latest()->limit(6)->get();
    @endphp
    <section class="feed-section" id="laporan">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label"><i class="bi bi-broadcast"></i> Live Feed</div>
                <h2 class="section-title">Laporan Terkini Siswa</h2>
                <p class="section-sub">Sekilas laporan yang baru masuk — detail lengkap hanya untuk yang sudah login.</p>
            </div>

            <div class="feed-card">
                <div class="feed-header">
                    <div class="feed-title">
                        <span class="live-dot"></span>
                        Update Terbaru
                    </div>
                    <a href="/aspirasi" class="feed-link">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @if($recentReports->isEmpty())
                    <div class="feed-empty">
                        <i class="bi bi-inbox"></i>
                        Belum ada laporan yang masuk. Jadilah yang pertama melapor!
                    </div>
                @else
                    <div class="feed-list">
                        @foreach($recentReports as $r)
                        @php
                            $statusClass = match($r->status) {
                                'Selesai' => 'status-selesai',
                                'Proses'  => 'status-proses',
                                default   => 'status-menunggu',
                            };
                            $badgeClass = match($r->status) {
                                'Selesai' => 'badge-selesai',
                                'Proses'  => 'badge-proses',
                                default   => 'badge-menunggu',
                            };
                            $iconColor = match($r->status) {
                                'Selesai' => ['bg' => 'rgba(52,211,153,0.12)',  'color' => '#34d399', 'icon' => 'bi-check-circle'],
                                'Proses'  => ['bg' => 'rgba(251,191,36,0.12)', 'color' => '#fbbf24', 'icon' => 'bi-gear'],
                                default   => ['bg' => 'rgba(251,113,133,0.12)','color' => '#fb7185', 'icon' => 'bi-exclamation-circle'],
                            };
                            // Sensor isi laporan: tampil 6 kata pertama + blur sisanya
                            $words     = explode(' ', trim($r->ket));
                            $preview   = implode(' ', array_slice($words, 0, 6));
                            $hasMore   = count($words) > 6;
                        @endphp
                        <div class="feed-item {{ $statusClass }}">
                            <div class="feed-icon" style="background: {{ $iconColor['bg'] }};">
                                <i class="bi {{ $iconColor['icon'] }}" style="color: {{ $iconColor['color'] }};"></i>
                            </div>
                            <div class="feed-body">
                                <div class="feed-kat">{{ $r->kategori->ket_kategori ?? 'Umum' }}</div>
                                <div class="feed-text">
                                    {{ $preview }}{{ $hasMore ? '...' : '' }}
                                    @if($hasMore)
                                        <span style="display: inline-block; background: rgba(99,130,255,0.15); border-radius: 4px; padding: 0 6px; font-size: 0.72rem; color: var(--text-dim); margin-left: 4px;">+ detail tersembunyi</span>
                                    @endif
                                </div>
                                <div class="feed-meta">
                                    <span class="feed-time"><i class="bi bi-clock"></i>{{ $r->created_at->diffForHumans() }}</span>
                                    <span class="feed-loc"><i class="bi bi-geo-alt"></i>{{ \Illuminate\Support\Str::limit($r->lokasi, 20) }}</span>
                                </div>
                            </div>
                            <span class="badge-status {{ $badgeClass }}">
                                <span class="bd"></span>{{ $r->status }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div style="text-align: center; margin-top: 1.5rem;">
                        <a href="{{ session('siswa_nis') || session('admin_id') ? '/aspirasi' : '/login' }}" style="display: inline-flex; align-items: center; gap: 0.45rem; color: #a5b4fc; font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: color 0.2s;">
                            @if(session('siswa_nis') || session('admin_id'))
                                <i class="bi bi-journal-text"></i> Lihat semua laporan lengkap
                            @else
                                <i class="bi bi-lock"></i> Login untuk lihat detail lengkap
                            @endif
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ═══ ALUR KERJA ═══ -->
    <section id="alur" class="section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label"><i class="bi bi-diagram-3"></i> Alur Kerja</div>
                <h2 class="section-title">Cemana Alurnya, Lek?</h2>
                <p class="section-sub">Tiga langkah simpel dari laporan ke solusi nyata.</p>
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

    <!-- ═══ KENAPA LAPOR SINI ═══ -->
    <section class="why-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label"><i class="bi bi-shield-check"></i> Keunggulan</div>
                <h2 class="section-title">Kenapa Harus Lapor di Sini?</h2>
                <p class="section-sub">Bukan sekadar form biasa — ini platform yang beneran dijaga.</p>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: rgba(101,116,248,0.14);">
                            <i class="bi bi-incognito" style="color: var(--indigo);"></i>
                        </div>
                        <h5>Identitas Aman</h5>
                        <p>Laporan kamu cuma bisa dilihat admin. Siswa lain nggak bisa tahu siapa yang lapor.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: rgba(251,191,36,0.12);">
                            <i class="bi bi-lightning-charge" style="color: var(--amber);"></i>
                        </div>
                        <h5>Respons Cepat</h5>
                        <p>Admin langsung ternotifikasi setiap ada laporan baru masuk. Nggak akan tenggelam.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: rgba(52,211,153,0.12);">
                            <i class="bi bi-graph-up-arrow" style="color: var(--emerald);"></i>
                        </div>
                        <h5>Bisa Dipantau</h5>
                        <p>Lacak status laporan kamu real-time — dari Menunggu, Proses, sampai Selesai.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: rgba(251,113,133,0.12);">
                            <i class="bi bi-camera" style="color: var(--rose);"></i>
                        </div>
                        <h5>Lampirkan Foto</h5>
                        <p>Laporan lebih kuat dengan bukti foto. Upload langsung dari HP atau laptop kamu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ CTA ═══ -->
    @if(!session('siswa_nis') && !session('admin_id'))
    <section class="cta-section">
        <div class="container">
            <div class="cta-box">
                <h2>Siap Bikin Perubahan<br>di Sekolah Kamu?</h2>
                <p>Daftar sekarang, gratis, dan mulai lapor. Suara kau yang bakal mengubah sekolah jadi lebih baik.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/register" class="btn-hero btn-hero-primary"><i class="bi bi-person-plus"></i> Daftar Sekarang</a>
                    <a href="/login" class="btn-hero btn-hero-ghost"><i class="bi bi-box-arrow-in-right"></i> Sudah Punya Akun</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-md-4">
                    <div class="footer-brand">
                        <div class="brand-icon" style="width: 28px; height: 28px; border-radius: 7px; background: linear-gradient(135deg, var(--indigo), var(--teal)); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0;">
                            <i class="bi bi-megaphone-fill text-white"></i>
                        </div>
                        LaporSekolah!
                    </div>
                    <div style="font-size: 0.8rem;">Platform aspirasi siswa yang aman & transparan.</div>
                </div>
                <div class="col-md-4 text-md-center">
                    <div class="footer-links justify-content-md-center">
                        <a href="/">Beranda</a>
                        <a href="#alur">Alur</a>
                        <a href="#laporan">Laporan</a>
                        <a href="/aspirasi">Semua Laporan</a>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div style="font-size: 0.8rem;">© 2026 LaporSekolah! — Tugas UKK Paling Paten Se-Medan</div>
                    <div style="font-size: 0.75rem; margin-top: 0.25rem; color: var(--text-dim);">Dibuat dengan keringat dan bantuan AI kawan akrabmu.</div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll-triggered fade for stat numbers (simple counter animation)
        function animateNumber(el) {
            const target = parseInt(el.dataset.target || el.textContent);
            if (isNaN(target) || target === 0) return;
            let start = 0;
            const duration = 1200;
            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                const ease = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.floor(ease * target);
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = target;
            };
            requestAnimationFrame(step);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.number[data-target]').forEach(animateNumber);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.stats-band').forEach(el => observer.observe(el));
    </script>
</body>
</html>