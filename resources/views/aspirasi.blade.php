<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Siswa — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            --amber:     #fbbf24;
            --emerald:   #34d399;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg); color: var(--text); min-height: 100vh;
        }
        body::before {
            content: ''; position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px; pointer-events: none; z-index: 0;
        }
        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; top: -100px; right: -80px; background: radial-gradient(circle, rgba(101,116,248,0.35), transparent 70%); }
        .orb-2 { width: 350px; height: 350px; bottom: -60px; left: -60px; background: radial-gradient(circle, rgba(45,212,191,0.25), transparent 70%); }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,16,32,0.88); backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(99,130,255,0.1); padding: 0.85rem 0;
        }
        .navbar-brand {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.2rem;
            color: var(--text) !important; display: flex; align-items: center; gap: 0.55rem;
        }
        .brand-icon {
            width: 32px; height: 32px; border-radius: 9px;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            display: flex; align-items: center; justify-content: center; font-size: 0.82rem;
        }
        .nav-link {
            color: var(--text-soft) !important; font-weight: 500;
            padding: 0.45rem 1rem !important; border-radius: 999px;
            font-size: 0.9rem; transition: all 0.2s;
        }
        .nav-link:hover { color: var(--text) !important; background: rgba(99,130,255,0.1); }
        .dropdown-toggle-pill {
            background: rgba(99,130,255,0.1) !important; color: var(--text) !important;
            border-radius: 999px !important; padding: 0.45rem 1.1rem !important;
            font-weight: 500; border: 1px solid var(--gb) !important; box-shadow: none !important;
        }
        .dropdown-menu {
            background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(18px);
            border: 1px solid var(--gb) !important; border-radius: 1.1rem !important;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4) !important; padding: 0.5rem !important;
        }
        .dropdown-item {
            color: var(--text-soft) !important; border-radius: 0.65rem;
            padding: 0.6rem 1rem; font-size: 0.88rem; transition: all 0.2s;
        }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }
        .dropdown-divider { border-color: rgba(99,130,255,0.1) !important; margin: 0.35rem 0.5rem; }
        .btn-nav-login {
            background: rgba(101,116,248,0.14); color: var(--indigo) !important;
            border: 1px solid rgba(101,116,248,0.3); border-radius: 999px;
            padding: 0.45rem 1.2rem !important; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;
        }

        /* ── PAGE ── */
        .page-wrap { position: relative; z-index: 1; padding: 2.5rem 0 5rem; }

        /* ── HERO BANNER ── */
        .page-hero {
            background: linear-gradient(135deg, rgba(101,116,248,0.15) 0%, rgba(15,23,42,0.9) 60%);
            border: 1px solid var(--gb);
            border-radius: 1.75rem; padding: 2.25rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.04);
            position: relative; overflow: hidden;
        }
        .page-hero::after {
            content: ''; position: absolute; top: -60px; right: -60px;
            width: 250px; height: 250px; border-radius: 50%;
            background: radial-gradient(circle, rgba(101,116,248,0.18), transparent 70%);
        }
        .hero-label {
            display: inline-flex; align-items: center; gap: 0.45rem;
            background: rgba(101,116,248,0.12); border: 1px solid rgba(101,116,248,0.22);
            color: #a5b4fc; border-radius: 999px;
            padding: 0.3rem 0.85rem; font-size: 0.75rem; font-weight: 700;
            letter-spacing: 0.04em; margin-bottom: 1rem;
        }
        .page-hero h1 {
            font-family: 'Sora', sans-serif; font-weight: 800;
            font-size: clamp(1.6rem, 3vw, 2.2rem); line-height: 1.2;
            color: var(--text); margin-bottom: 0.6rem;
        }
        .page-hero p { color: var(--text-soft); font-size: 0.9rem; max-width: 520px; margin-bottom: 0; }
        .btn-hero-new {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1.6rem; border-radius: 999px;
            background: linear-gradient(135deg, var(--indigo), #7c3aed);
            color: #fff; font-weight: 700; font-size: 0.9rem;
            border: none; cursor: pointer;
            box-shadow: 0 6px 20px rgba(101,116,248,0.35);
            transition: all 0.25s; white-space: nowrap; flex-shrink: 0;
        }
        .btn-hero-new:hover {
            box-shadow: 0 8px 28px rgba(101,116,248,0.5);
            transform: translateY(-1px); color: #fff;
        }

        /* ── STAT CHIPS ── */
        .stat-chip {
            background: rgba(99,130,255,0.07); border: 1px solid rgba(99,130,255,0.12);
            border-radius: 1rem; padding: 0.85rem 1.25rem;
            text-align: center; min-width: 90px; flex-shrink: 0;
        }
        .stat-chip .num {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.6rem;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .stat-chip small { display: block; color: var(--text-dim); font-size: 0.72rem; margin-top: 0.1rem; }

        /* ── CONTENT CARD ── */
        .content-card {
            background: var(--glass); backdrop-filter: blur(16px);
            border: 1px solid var(--gb); border-radius: 1.5rem;
            padding: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        .card-head {
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;
        }
        .card-title {
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.05rem;
            color: var(--text); display: flex; align-items: center; gap: 0.55rem; margin: 0;
        }
        .card-title i { color: var(--indigo); }
        .card-subtitle { color: var(--text-dim); font-size: 0.82rem; margin-top: 0.2rem; }
        .btn-outline-new {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.6rem 1.25rem; border-radius: 999px;
            background: rgba(101,116,248,0.08);
            border: 1px solid rgba(101,116,248,0.25);
            color: #a5b4fc; font-weight: 600; font-size: 0.85rem;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-outline-new:hover { background: rgba(101,116,248,0.16); color: #c7d2fe; }

        /* ── TABLE ── */
        .report-table { width: 100%; border-collapse: separate; border-spacing: 0 0.55rem; }
        .report-table thead th {
            color: var(--text-dim); font-size: 0.7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            padding: 0 1rem 0.5rem;
            border-bottom: 1px solid rgba(99,130,255,0.1);
        }
        .report-table tbody tr {
            background: rgba(15,23,42,0.7); transition: all 0.2s;
        }
        .report-table tbody tr:hover { background: rgba(101,116,248,0.07); }
        .report-table tbody td {
            padding: 0.85rem 1rem; border: none;
            vertical-align: middle; font-size: 0.87rem;
        }
        .report-table tbody td:first-child { border-radius: 0.85rem 0 0 0.85rem; }
        .report-table tbody td:last-child  { border-radius: 0 0.85rem 0.85rem 0; }

        /* ── NIS PILL ── */
        .nis-pill {
            display: inline-block;
            background: rgba(101,116,248,0.1); border: 1px solid rgba(101,116,248,0.2);
            color: #a5b4fc; border-radius: 0.5rem;
            padding: 0.18rem 0.6rem; font-size: 0.78rem; font-weight: 700;
            font-family: 'Sora', sans-serif; letter-spacing: 0.02em;
        }

        /* ── CATEGORY TAG ── */
        .cat-tag {
            display: inline-block;
            background: rgba(45,212,191,0.16); border: 1px solid rgba(45,212,191,0.28);
            color: var(--text); border-radius: 0.5rem;
            padding: 0.15rem 0.6rem; font-size: 0.72rem; font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .admin-meta {
            color: var(--text); font-size: 0.85rem;
        }
        .admin-meta i {
            color: var(--text-dim);
        }

        .date-chip {
            color: var(--text); font-size: 0.84rem; display: inline-flex; align-items: center; gap: 0.35rem;
        }
        .date-chip i { color: var(--text-dim); }
        .date-chip small { display: block; font-size: 0.78rem; color: var(--text-dim); }

        /* ── STATUS ── */
        .badge-done {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.25);
            color: var(--emerald); border-radius: 999px;
            padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700;
        }
        .badge-proc {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.25);
            color: var(--amber); border-radius: 999px;
            padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700;
        }
        .badge-wait {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.25);
            color: var(--rose); border-radius: 999px;
            padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700;
        }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

        /* ── FEEDBACK ── */
        .feedback-bubble {
            background: rgba(101,116,248,0.07); border-left: 3px solid var(--indigo);
            border-radius: 0 0.55rem 0.55rem 0;
            padding: 0.45rem 0.7rem; font-size: 0.79rem;
            color: var(--text-soft); font-style: italic;
        }

        /* ── BUTTON VIEW ── */
        .btn-view {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.4rem 0.9rem; border-radius: 999px;
            background: rgba(99,130,255,0.08); border: 1px solid rgba(99,130,255,0.18);
            color: #a5b4fc; font-size: 0.78rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-view:hover { background: rgba(99,130,255,0.16); color: #c7d2fe; }

        .filter-btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.55rem 1rem; border-radius: 999px;
            background: rgba(99,130,255,0.08); border: 1px solid rgba(99,130,255,0.16);
            color: #c7d2fe; font-size: 0.82rem; font-weight: 700;
            text-decoration: none; transition: all 0.2s;
        }
        .filter-btn.active,
        .filter-btn:hover {
            background: rgba(101,116,248,0.18); border-color: rgba(101,116,248,0.36);
            color: #eff6ff;
        }

        /* ── MODAL ── */
        .modal-content {
            background: rgba(10,16,32,0.97) !important;
            backdrop-filter: blur(20px);
            border: 1px solid var(--gb) !important;
            border-radius: 1.5rem !important;
            box-shadow: 0 40px 80px rgba(0,0,0,0.5) !important;
            color: var(--text);
        }
        .modal-header {
            border-bottom: 1px solid rgba(99,130,255,0.1) !important;
            padding: 1.5rem 1.75rem 1.25rem;
        }
        .modal-header .modal-title {
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1rem; color: var(--text);
        }
        .btn-close { filter: invert(1) opacity(0.5); }
        .btn-close:hover { filter: invert(1) opacity(0.9); }
        .modal-body { padding: 1.5rem 1.75rem; }
        .modal-footer {
            border-top: 1px solid rgba(99,130,255,0.1) !important;
            padding: 1.25rem 1.75rem;
        }
        .modal-label { color: var(--text-dim); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.4rem; }
        .modal-value { color: var(--text); font-size: 0.9rem; margin-bottom: 1rem; }
        .date-chip, .modal-date {
            display: inline-flex; align-items: center; gap: 0.35rem;
            color: var(--text-dim); font-size: 0.85rem; font-weight: 500;
        }
        .modal-date { color: var(--text); }

        /* ── FORM IN MODAL ── */
        .modal-body .form-label { display: block; color: var(--text-soft); font-size: 0.8rem; font-weight: 600; margin-bottom: 0.45rem; }
        .modal-body .form-control,
        .modal-body .form-select {
            width: 100%; background: rgba(10,16,32,0.7);
            border: 1px solid rgba(99,130,255,0.16); border-radius: 0.85rem;
            color: var(--text); padding: 0.75rem 1rem; font-size: 0.88rem;
            font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            margin-bottom: 0;
        }
        .modal-body .form-control::placeholder { color: var(--text-dim); }
        .modal-body .form-control:focus,
        .modal-body .form-select:focus {
            border-color: rgba(101,116,248,0.5);
            box-shadow: 0 0 0 3px rgba(101,116,248,0.12);
        }
        .modal-body .form-select option { background: #0f1729; }
        .modal-body .mb-3 { margin-bottom: 1rem !important; }
        .modal-body .text-muted { color: var(--text-dim) !important; font-size: 0.78rem; }

        .btn-modal-primary {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.5rem; border-radius: 999px;
            background: linear-gradient(135deg, var(--indigo), #7c3aed);
            color: #fff; font-weight: 700; font-size: 0.88rem;
            border: none; cursor: pointer;
            box-shadow: 0 6px 18px rgba(101,116,248,0.3);
            transition: all 0.25s;
        }
        .btn-modal-primary:hover { box-shadow: 0 8px 24px rgba(101,116,248,0.45); transform: translateY(-1px); }
        .btn-modal-cancel {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.25rem; border-radius: 999px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-soft); font-weight: 600; font-size: 0.88rem;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-modal-cancel:hover { background: rgba(255,255,255,0.09); color: var(--text); }

        /* ── FOOTER ── */
        footer {
            position: relative; z-index: 1;
            border-top: 1px solid rgba(99,130,255,0.08);
            padding: 1.5rem 0; text-align: center;
            color: var(--text-dim); font-size: 0.83rem;
        }

        /* ── SWEETALERT OVERRIDE ── */
        .swal2-popup {
            background: rgba(10,16,32,0.97) !important;
            border: 1px solid var(--gb) !important;
            border-radius: 1.5rem !important;
            font-family: 'DM Sans', sans-serif !important;
        }
        .swal2-title, .swal2-html-container { color: var(--text) !important; }

        @media (max-width: 992px) {
            .page-wrap { padding: 1.75rem 0 3rem; }
            .page-hero { padding: 1.75rem; }
            .content-card { padding: 1.5rem; }
            .card-head { flex-direction: column; align-items: stretch; gap: 1rem; }
            .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: clamp(1.9rem, 7vw, 2.4rem); }
            .page-hero p { max-width: 100%; }
            .report-table tbody td { padding: 0.75rem; font-size: 0.82rem; }
            .btn-view, .filter-btn, .btn-modal-primary, .btn-modal-cancel { width: 100%; justify-content: center; }
            .modal-dialog { max-width: 100%; margin: 1rem; }
            .modal-content { margin: 0 0.5rem; }
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
                <div class="brand-icon"><i class="bi bi-megaphone-fill text-white" style="font-size: 0.78rem;"></i></div>
                LaporSekolah!
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="color: var(--text-soft);">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house-door me-1"></i>Home</a></li>
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

    <div class="page-wrap">
        <div class="container">

            <!-- PAGE HERO -->
            <div class="page-hero">
                <div class="d-flex justify-content-between align-items-start gap-4 flex-wrap">
                    <div>
                        <div class="hero-label"><i class="bi bi-megaphone-fill me-1"></i> Aspirasi Siswa</div>
                        <h1>Laporkan Masalah<br>Sekolahmu Sekarang</h1>
                        <p>Kirim aspirasi secara aman ke admin sekolah. Semua laporan terjaga kerahasiaannya.</p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="stat-chip">
                            <div class="num" id="stat-total">{{ $stats['total'] ?? count($aspirasis) }}</div>
                            <small>Total</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num" id="stat-menunggu">{{ $stats['menunggu'] ?? $aspirasis->where('status','Menunggu')->count() }}</div>
                            <small>Menunggu</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num" id="stat-proses">{{ $stats['proses'] ?? $aspirasis->where('status','Proses')->count() }}</div>
                            <small>Proses</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num" id="stat-selesai">{{ $stats['selesai'] ?? $aspirasis->where('status','Selesai')->count() }}</div>
                            <small>Selesai</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REPORT CONTENT -->
            <div class="content-card">
                <div class="card-head">
                    <div>
                        <h4 class="card-title"><i class="bi bi-journal-text"></i> {{ session('admin_id') ? 'Semua Laporan Siswa' : 'Daftar Laporan Saya' }}</h4>
                        <p class="card-subtitle">{{ session('admin_id') ? 'Admin dapat melihat semua laporan siswa yang telah masuk.' : 'Hanya laporan yang dikirim oleh NIS kamu sendiri.' }}</p>
                    </div>
                    @if(!session('admin_id'))
                    <button type="button" class="btn-hero-new" data-bs-toggle="modal" data-bs-target="#modalBuatAspirasi">
                        <i class="bi bi-pencil-square"></i> Laporan Baru
                    </button>
                    @endif
                </div>

                @if(session('admin_id'))
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                        <a href="/aspirasi" class="filter-btn {{ empty($status) ? 'active' : '' }}">Total</a>
                        <a href="/aspirasi?status=Menunggu" class="filter-btn {{ $status == 'Menunggu' ? 'active' : '' }}">Menunggu</a>
                        <a href="/aspirasi?status=Proses" class="filter-btn {{ $status == 'Proses' ? 'active' : '' }}">Proses</a>
                        <a href="/aspirasi?status=Selesai" class="filter-btn {{ $status == 'Selesai' ? 'active' : '' }}">Selesai</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @forelse($aspirasis as $aspi)
                        <div class="col">
                            <div class="report-card p-4 h-100">
                                <div class="d-flex justify-content-between gap-3 mb-3 align-items-start">
                                    <div>
                                        <span class="cat-tag">{{ $aspi->kategori->ket_kategori ?? 'Umum' }}</span>
                                        <h5 class="mb-2 text-white">NIS {{ $aspi->nis }}</h5>
                                        @php
                                            $preview = \Illuminate\Support\Str::words($aspi->ket, 7, '...');
                                        @endphp
                                        <p class="mb-2 text-white-75">{{ $preview }}</p>
                                        <small class="admin-meta"><i class="bi bi-geo-alt me-1"></i>{{ $aspi->lokasi }}</small>
                                    </div>
                                    <div class="text-end">
                                        @if($aspi->status == 'Selesai')
                                            <span class="badge-done"><span class="badge-dot"></span>Selesai</span>
                                        @elseif($aspi->status == 'Proses')
                                            <span class="badge-proc"><span class="badge-dot"></span>Proses</span>
                                        @else
                                            <span class="badge-wait"><span class="badge-dot"></span>Menunggu</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top border-white border-opacity-10">
                                    <button type="button" class="btn-view" data-bs-toggle="modal" data-bs-target="#detailModal{{ $aspi->id_pelaporan }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <small class="admin-meta">{{ $aspi->created_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="report-card p-4 text-center">
                                <p class="mb-0 text-muted">Belum ada laporan siswa masuk.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Rincian</th>
                                    <th>Status</th>
                                    <th>Tanggapan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aspirasis as $aspi)
                                <tr>
                                    <td><span class="nis-pill">{{ $aspi->nis }}</span></td>
                                    <td>
                                        <span class="cat-tag">{{ $aspi->kategori->ket_kategori ?? 'Umum' }}</span>
                                        <div style="font-weight: 600; font-size: 0.87rem; color: var(--text);">
                                            @php
                                                $words = preg_split('/\s+/', trim($aspi->ket));
                                                echo count($words) > 8 ? implode(' ', array_slice($words, 0, 8)) . '…' : $aspi->ket;
                                            @endphp
                                        </div>
                                        <small style="color: var(--text-dim);"><i class="bi bi-geo-alt me-1"></i>{{ $aspi->lokasi }}</small>
                                    </td>
                                    <td>
                                        @if($aspi->status == 'Selesai')
                                            <span class="badge-done"><span class="badge-dot"></span>Selesai</span>
                                        @elseif($aspi->status == 'Proses')
                                            <span class="badge-proc"><span class="badge-dot"></span>Proses</span>
                                        @else
                                            <span class="badge-wait"><span class="badge-dot"></span>Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($aspi->feedback)
                                            <div class="feedback-bubble">"{{ $aspi->feedback }}"</div>
                                        @else
                                            <span style="color: var(--text-dim); font-size: 0.8rem;"><i class="bi bi-hourglass-split me-1"></i>Menunggu...</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn-view" data-bs-toggle="modal" data-bs-target="#detailModal{{ $aspi->id_pelaporan }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODAL BUAT ASPIRASI -->
    <div class="modal fade" id="modalBuatAspirasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2" style="color: var(--indigo);"></i>Form Aspirasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/lapor" method="POST" enctype="multipart/form-data" id="aspirasi-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIS Kamu</label>
                            <input type="text" name="nis" class="form-control" value="{{ session('siswa_nis') }}" readonly required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="id_kategori" class="form-select" required>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lokasi Kejadian</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Kantin, Kelas XII RPL 1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Laporan</label>
                            <textarea name="ket" class="form-control" rows="4" placeholder="Jelaskan masalahnya dengan jelas..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Bukti <span style="color: var(--text-dim);">(Opsional)</span></label>
                            <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif">
                            <div class="text-muted mt-1">Maksimal 2MB. Format: JPG, PNG, GIF.</div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-primary"><i class="bi bi-send"></i> Kirim Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- DETAIL MODALS -->
    @foreach($aspirasis as $aspi)
    <div class="modal fade" id="detailModal{{ $aspi->id_pelaporan }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-file-text me-2" style="color: var(--indigo);"></i>Detail Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="modal-label">NIS</div>
                            <div class="modal-value"><span class="nis-pill">{{ $aspi->nis }}</span></div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-label">Kategori</div>
                            <div class="modal-value"><span class="cat-tag">{{ $aspi->kategori->ket_kategori ?? 'Umum' }}</span></div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-label">Status</div>
                            <div class="modal-value">
                                @if($aspi->status == 'Selesai')<span class="badge-done"><span class="badge-dot"></span>Selesai</span>
                                @elseif($aspi->status == 'Proses')<span class="badge-proc"><span class="badge-dot"></span>Proses</span>
                                @else<span class="badge-wait"><span class="badge-dot"></span>Menunggu</span>@endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-label">Lokasi</div>
                            <div class="modal-value"><i class="bi bi-geo-alt me-1" style="color: var(--text-dim);"></i>{{ $aspi->lokasi }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-label">Dibuat</div>
                            <div class="modal-value modal-date"><i class="bi bi-calendar-event me-1" style="color: var(--text-dim);"></i>{{ $aspi->created_at->format('d M Y H:i') }}</div>
                        </div>
                        <div class="col-12">
                            <div class="modal-label">Rincian Laporan</div>
                            <div style="background: rgba(99,130,255,0.06); border: 1px solid rgba(99,130,255,0.12); border-radius: 0.85rem; padding: 1rem; color: var(--text-soft); font-size: 0.9rem; line-height: 1.65;">{{ $aspi->ket }}</div>
                        </div>
                        @if($aspi->foto)
                        <div class="col-12">
                            <div class="modal-label">Foto Bukti</div>
                            <div class="mt-1 text-center">
                                <img src="{{ asset($aspi->foto) }}" alt="Foto" class="img-fluid" style="max-height: 340px; border-radius: 1rem; border: 1px solid var(--gb);">
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="modal-label">Feedback Admin</div>
                            @if(session('admin_id'))
                                <form action="/admin/feedback/{{ $aspi->id_pelaporan }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="Menunggu" {{ $aspi->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="Proses" {{ $aspi->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ $aspi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ulasan / Feedback</label>
                                        <textarea name="feedback" class="form-control" rows="3" placeholder="Tulis feedback untuk siswa...">{{ $aspi->feedback }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn-modal-primary">Simpan Feedback</button>
                                    </div>
                                </form>
                            @else
                                @if($aspi->feedback)
                                    <div class="feedback-bubble">"{{ $aspi->feedback }}"</div>
                                @else
                                    <div style="color: var(--text-dim); font-size: 0.85rem; font-style: italic;"><i class="bi bi-hourglass-split me-1"></i>Belum ada feedback dari admin.</div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <footer>
        <div class="container">© 2026 LaporSekolah! — Suara siswa, perubahan nyata.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                background: 'rgba(10,16,32,0.97)',
                color: '#e8edf8'
            });
        @endif
        @if($errors->any())
            Swal.fire({
                title: 'Aduh, Ada yang Salah!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: 'error',
                confirmButtonColor: '#6574f8',
                background: 'rgba(10,16,32,0.97)',
                color: '#e8edf8'
            });
        @endif

        const statTotal = document.getElementById('stat-total');
        const statMenunggu = document.getElementById('stat-menunggu');
        const statProses = document.getElementById('stat-proses');
        const statSelesai = document.getElementById('stat-selesai');

        async function refreshAspirasiStats() {
            try {
                const response = await fetch('/aspirasi/stats');
                if (!response.ok) throw new Error('Fetch gagal');

                const data = await response.json();
                statTotal.textContent = data.total;
                statMenunggu.textContent = data.menunggu;
                statProses.textContent = data.proses;
                statSelesai.textContent = data.selesai;
            } catch (error) {
                console.warn('Gagal memuat statistik:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const aspirasiForm = document.getElementById('aspirasi-form');
            if (aspirasiForm) {
                aspirasiForm.addEventListener('submit', () => {
                    Swal.fire({
                        title: 'Sabar ya, Wak...', text: 'Lagi kita kirim laporan kau',
                        allowOutsideClick: false,
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        background: 'rgba(10,16,32,0.97)',
                        color: '#e8edf8',
                        didOpen: () => { Swal.showLoading(); }
                    });
                });
            }

            refreshAspirasiStats();
            setInterval(refreshAspirasiStats, 10000);
        });
    </script>
</body>
</html>