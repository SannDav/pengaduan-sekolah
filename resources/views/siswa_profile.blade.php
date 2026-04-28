<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg:        #0a1020;
            --glass:     rgba(15,23,42,0.75);
            --gb:        rgba(99,130,255,0.13);
            --text:      #e8edf8;
            --text-soft: #a8b5d0;
            --text-dim:  #607090;
            --indigo:    #6574f8;
            --teal:      #2dd4bf;
            --rose:      #fb7185;
            --amber:     #fbbf24;
            --emerald:   #34d399;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        body::before {
            content: ''; position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px; pointer-events: none; z-index: 0;
        }
        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; top: -100px; right: -80px; background: radial-gradient(circle, rgba(101,116,248,0.35), transparent 70%); }

        /* NAVBAR */
        .navbar { position: sticky; top: 0; z-index: 100; background: rgba(10,16,32,0.88); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(99,130,255,0.1); padding: 0.85rem 0; }
        .navbar-brand { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.2rem; color: var(--text) !important; display: flex; align-items: center; gap: 0.55rem; }
        .brand-icon { width: 32px; height: 32px; border-radius: 9px; background: linear-gradient(135deg, var(--indigo), var(--teal)); display: flex; align-items: center; justify-content: center; font-size: 0.82rem; }
        .nav-link { color: var(--text-soft) !important; font-weight: 500; padding: 0.45rem 1rem !important; border-radius: 999px; font-size: 0.9rem; transition: all 0.2s; }
        .nav-link:hover { color: var(--text) !important; background: rgba(99,130,255,0.1); }
        .dropdown-toggle-pill { background: rgba(99,130,255,0.1) !important; color: var(--text) !important; border-radius: 999px !important; padding: 0.45rem 1.1rem !important; font-weight: 500; border: 1px solid var(--gb) !important; box-shadow: none !important; }
        .dropdown-menu { background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(18px); border: 1px solid var(--gb) !important; border-radius: 1.1rem !important; box-shadow: 0 20px 50px rgba(0,0,0,0.4) !important; padding: 0.5rem !important; }
        .dropdown-item { color: var(--text-soft) !important; border-radius: 0.65rem; padding: 0.6rem 1rem; font-size: 0.88rem; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }
        .dropdown-divider { border-color: rgba(99,130,255,0.1) !important; margin: 0.35rem 0.5rem; }

        /* PAGE */
        .page-wrap { position: relative; z-index: 1; padding: 2.5rem 0 5rem; }

        /* PROFILE HERO */
        .profile-hero { background: var(--glass); backdrop-filter: blur(16px); border: 1px solid var(--gb); border-radius: 1.75rem; padding: 2rem 2.25rem; margin-bottom: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.05); position: relative; overflow: hidden; }
        .profile-hero::before { content: ''; position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(101,116,248,0.15), transparent 70%); }
        .avatar-ring { width: 68px; height: 68px; border-radius: 1.1rem; background: linear-gradient(135deg, rgba(101,116,248,0.25), rgba(45,212,191,0.15)); border: 1px solid rgba(101,116,248,0.3); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
        .profile-name { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.35rem; color: var(--text); margin: 0 0 0.3rem; }
        .profile-meta { color: var(--text-soft); font-size: 0.88rem; }
        .profile-meta span { color: var(--text-dim); }
        .pill-active { display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.25); color: var(--emerald); border-radius: 999px; padding: 0.3rem 0.85rem; font-size: 0.75rem; font-weight: 700; margin-top: 0.6rem; }
        .pill-active::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--emerald); box-shadow: 0 0 8px var(--emerald); }

        /* STATS */
        .stats-row { display: flex; gap: 1rem; flex-wrap: wrap; align-items: stretch; }
        .stat-chip { background: rgba(99,130,255,0.07); border: 1px solid rgba(99,130,255,0.12); border-radius: 1rem; padding: 0.85rem 1.25rem; text-align: center; min-width: 100px; }
        .stat-chip .num { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.5rem; background: linear-gradient(135deg, var(--indigo), var(--teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .stat-chip small { display: block; color: var(--text-dim); font-size: 0.72rem; margin-top: 0.15rem; }

        /* CARD */
        .content-card { background: var(--glass); backdrop-filter: blur(16px); border: 1px solid var(--gb); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2); margin-bottom: 1.5rem; }
        .card-title { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.05rem; color: var(--text); display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.5rem; }
        .card-title i { color: var(--indigo); }

        /* TABLE */
        .report-table { width: 100%; border-collapse: separate; border-spacing: 0 0.6rem; }
        .report-table thead th { color: var(--text-dim); font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 0 1rem 0.5rem; border-bottom: 1px solid rgba(99,130,255,0.1); }
        .report-table tbody tr { background: rgba(15,23,42,0.7); transition: all 0.2s; }
        .report-table tbody tr:hover { background: rgba(101,116,248,0.07); /* transform dihapus untuk hilangkan scrollbar */ }
        .report-table tbody td { padding: 0.9rem 1rem; border: none; vertical-align: middle; font-size: 0.88rem; }
        .report-table tbody td:first-child { border-radius: 0.9rem 0 0 0.9rem; }
        .report-table tbody td:last-child  { border-radius: 0 0.9rem 0.9rem 0; }

        /* BADGES */
        .badge-done { display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.25); color: var(--emerald); border-radius: 999px; padding: 0.25rem 0.75rem; font-size: 0.73rem; font-weight: 700; }
        .badge-proc { display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.25); color: var(--amber); border-radius: 999px; padding: 0.25rem 0.75rem; font-size: 0.73rem; font-weight: 700; }
        .badge-wait { display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.25); color: var(--rose); border-radius: 999px; padding: 0.25rem 0.75rem; font-size: 0.73rem; font-weight: 700; }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 3.5rem 1rem; }
        .empty-icon { width: 70px; height: 70px; border-radius: 1.2rem; background: rgba(99,130,255,0.08); border: 1px solid rgba(99,130,255,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 1.75rem; color: var(--text-dim); }
        .empty-state h5 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1rem; color: var(--text); margin-bottom: 0.5rem; }
        .empty-state p { color: var(--text-soft); font-size: 0.88rem; margin-bottom: 1.5rem; }
        .btn-primary-pill { display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.7rem 1.5rem; border-radius: 999px; background: linear-gradient(135deg, var(--indigo), #7c3aed); color: #fff; font-weight: 600; font-size: 0.88rem; border: none; text-decoration: none; box-shadow: 0 6px 18px rgba(101,116,248,0.3); transition: all 0.25s; cursor: pointer; }
        .btn-primary-pill:hover { box-shadow: 0 8px 24px rgba(101,116,248,0.45); transform: translateY(-1px); color: #fff; }

        /* FEEDBACK BUBBLE */
        .feedback-bubble { background: rgba(101,116,248,0.08); border-left: 3px solid var(--indigo); border-radius: 0 0.6rem 0.6rem 0; padding: 0.5rem 0.75rem; font-size: 0.8rem; color: var(--text-soft); font-style: italic; }

        /* ── AUDIT LOG TIMELINE ─────────────────────────────────── */
        .audit-timeline { position: relative; padding: 0.25rem 0; }
        .audit-timeline::before { content: ''; position: absolute; left: 18px; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, rgba(101,116,248,0.4), rgba(45,212,191,0.15)); border-radius: 2px; }
        .audit-item { position: relative; display: flex; gap: 1rem; padding: 0 0 1.5rem 0; animation: fadeSlideIn 0.3s ease both; }
        .audit-item:last-child { padding-bottom: 0.5rem; }
        @keyframes fadeSlideIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .audit-dot { position: relative; z-index: 1; width: 38px; height: 38px; border-radius: 0.7rem; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.25); }
        .audit-dot.color-emerald { background: rgba(52,211,153,0.15); border: 1px solid rgba(52,211,153,0.3); color: #34d399; }
        .audit-dot.color-amber   { background: rgba(251,191,36,0.15);  border: 1px solid rgba(251,191,36,0.3);  color: #fbbf24; }
        .audit-dot.color-rose    { background: rgba(251,113,133,0.15); border: 1px solid rgba(251,113,133,0.3); color: #fb7185; }
        .audit-dot.color-indigo  { background: rgba(101,116,248,0.15); border: 1px solid rgba(101,116,248,0.3); color: #6574f8; }
        .audit-body { flex: 1; background: rgba(15,23,42,0.6); border: 1px solid rgba(99,130,255,0.1); border-radius: 1rem; padding: 0.9rem 1.1rem; transition: border-color 0.2s; }
        .audit-body:hover { border-color: rgba(99,130,255,0.22); }
        .audit-header { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 0.5rem; }
        .audit-action-label { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.85rem; color: #e8edf8; }
        .audit-time { font-size: 0.75rem; color: #607090; white-space: nowrap; }
        .audit-admin { font-size: 0.78rem; color: #a8b5d0; margin-bottom: 0.45rem; }
        .audit-admin i { color: #607090; }
        .audit-status-row { display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.45rem; }
        .status-pill { display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 999px; padding: 0.18rem 0.65rem; font-size: 0.7rem; font-weight: 700; }
        .status-pill.s-menunggu { background: rgba(251,113,133,0.12); border: 1px solid rgba(251,113,133,0.25); color: #fb7185; }
        .status-pill.s-proses   { background: rgba(251,191,36,0.12);  border: 1px solid rgba(251,191,36,0.25);  color: #fbbf24; }
        .status-pill.s-selesai  { background: rgba(52,211,153,0.12);  border: 1px solid rgba(52,211,153,0.25);  color: #34d399; }
        .status-pill.s-default  { background: rgba(99,130,255,0.1);   border: 1px solid rgba(99,130,255,0.2);   color: #a5b4fc; }
        .audit-arrow { color: #607090; font-size: 0.75rem; }
        .audit-feedback { background: rgba(101,116,248,0.07); border-left: 3px solid rgba(101,116,248,0.4); border-radius: 0 0.6rem 0.6rem 0; padding: 0.45rem 0.75rem; font-size: 0.82rem; color: #a8b5d0; font-style: italic; margin-top: 0.4rem; }
        .audit-notes { font-size: 0.78rem; color: #607090; margin-top: 0.35rem; }
        .audit-empty { text-align: center; padding: 2.5rem 1rem; }
        .audit-empty-icon { width: 56px; height: 56px; border-radius: 1rem; background: rgba(99,130,255,0.07); border: 1px solid rgba(99,130,255,0.12); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.4rem; color: #607090; }
        .audit-empty h6 { font-family: 'Sora', sans-serif; font-weight: 700; color: #e8edf8; margin-bottom: 0.4rem; }
        .audit-empty p  { color: #a8b5d0; font-size: 0.85rem; margin: 0; }

        /* LAPORAN FILTER TABS */
        .laporan-tabs { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
        .tab-pill { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; cursor: pointer; border: 1px solid rgba(99,130,255,0.15); background: rgba(99,130,255,0.06); color: var(--text-soft); transition: all 0.2s; }
        .tab-pill:hover, .tab-pill.active { background: rgba(101,116,248,0.15); border-color: rgba(101,116,248,0.35); color: #c7d2fe; }
        .tab-pill .count-badge { background: rgba(101,116,248,0.2); border-radius: 999px; padding: 0.1rem 0.45rem; font-size: 0.7rem; }

        footer { position: relative; z-index: 1; border-top: 1px solid rgba(99,130,255,0.08); padding: 1.5rem 0; text-align: center; color: var(--text-dim); font-size: 0.83rem; }

        @media (max-width: 992px) { .profile-hero { padding: 1.5rem; } .stats-row { flex-direction: column; } .content-card { padding: 1.5rem; } }
        @media (max-width: 768px) { .page-wrap { padding: 1.5rem 0 3rem; } .report-table tbody td { padding: 0.8rem; } .orb { display: none; } }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>

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
                    <li class="nav-item"><a class="nav-link" href="/aspirasi"><i class="bi bi-journal-text me-1"></i>Semua Laporan</a></li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ $user->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile"><i class="bi bi-collection me-2"></i>Laporan Saya</a></li>
                            <li><a class="dropdown-item" href="/notifications"><i class="bi bi-bell me-2"></i>Notifikasi</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li><a class="dropdown-item" href="/logout" style="color: var(--rose) !important;"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-wrap">
        <div class="container">

            <!-- PROFILE HERO -->
            <div class="profile-hero">
                <div class="d-flex align-items-start gap-4 flex-wrap">
                    <div class="avatar-ring">
                        <i class="bi bi-person-fill" style="color: var(--indigo);"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h2 class="profile-name">{{ $user->nama }}</h2>
                        <p class="profile-meta">
                            <i class="bi bi-card-text me-1"></i> NIS: {{ $user->nis }}
                            <span class="mx-2">·</span>
                            <i class="bi bi-door-open me-1"></i> Kelas {{ $user->kelas }}
                        </p>
                        <div class="pill-active">Siswa Aktif</div>
                    </div>
                    <div class="stats-row">
                        <div class="stat-chip">
                            <div class="num">{{ $laporan_saya->count() }}</div>
                            <small>Total Laporan</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num">{{ $laporan_saya->where('status','Selesai')->count() }}</div>
                            <small>Selesai</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num">{{ $laporan_saya->where('status','Menunggu')->count() }}</div>
                            <small>Menunggu</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num">{{ $auditLogs->count() }}</div>
                            <small>Aktivitas</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LAPORAN SAYA -->
            <div class="content-card">
                <div class="card-title">
                    <i class="bi bi-clock-history"></i> Riwayat Laporan Saya
                </div>

                @if($laporan_saya->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon"><i class="bi bi-clipboard2-check"></i></div>
                        <h5>Belum Ada Laporan</h5>
                        <p>Aman-aman aja sekolah kita ya? Kalau ada masalah, langsung lapor aja!</p>
                        <a href="/aspirasi" class="btn-primary-pill"><i class="bi bi-pencil-square"></i> Buat Laporan Sekarang</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                    <th>Feedback Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan_saya as $laporan)
                                <tr>
                                    <td>
                                        <span style="color: var(--text-dim); font-size: 0.8rem; white-space: nowrap;">
                                            {{ $laporan->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; font-size: 0.88rem; color: var(--text);">{{ $laporan->kategori->ket_kategori }}</div>
                                        <div style="color: var(--text-soft); font-size: 0.82rem; margin-top: 0.2rem; max-width: 320px;">{{ $laporan->ket }}</div>
                                        @if($laporan->foto)
                                            <div class="mt-2">
                                                <a href="{{ asset($laporan->foto) }}" target="_blank">
                                                    <img src="{{ asset($laporan->foto) }}" alt="Foto" style="width: 80px; height: 56px; object-fit: cover; border-radius: 0.6rem; border: 1px solid var(--gb);">
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($laporan->status == 'Selesai')
                                            <span class="badge-done"><span class="badge-dot"></span> Selesai</span>
                                        @elseif($laporan->status == 'Proses')
                                            <span class="badge-proc"><span class="badge-dot"></span> Proses</span>
                                        @else
                                            <span class="badge-wait"><span class="badge-dot"></span> Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($laporan->feedback)
                                            <div class="feedback-bubble">"{{ $laporan->feedback }}"</div>
                                        @else
                                            <span style="color: var(--text-dim); font-size: 0.8rem; font-style: italic;">
                                                <i class="bi bi-hourglass-split me-1"></i>Belum ada tanggapan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- ═══════════════════════════════════════════════════════
                 AUDIT LOG / HISTORY AKTIVITAS ADMIN
                 ═══════════════════════════════════════════════════════ -->
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div class="card-title mb-0">
                        <i class="bi bi-shield-check"></i> Riwayat Aktivitas Admin
                        @if($auditLogs->count() > 0)
                            <span style="background: rgba(101,116,248,0.15); border: 1px solid rgba(101,116,248,0.25); color: #a5b4fc; border-radius: 999px; padding: 0.1rem 0.6rem; font-size: 0.72rem; font-weight: 700; font-family: 'DM Sans', sans-serif;">
                                {{ $auditLogs->count() }} aktivitas
                            </span>
                        @endif
                    </div>
                    <div style="font-size: 0.8rem; color: var(--text-dim);">
                        <i class="bi bi-info-circle me-1"></i>Setiap aksi admin pada laporan kamu tercatat di sini
                    </div>
                </div>

                @if($auditLogs->isEmpty())
                    <div class="audit-empty">
                        <div class="audit-empty-icon"><i class="bi bi-shield-check"></i></div>
                        <h6>Belum Ada Aktivitas</h6>
                        <p>Riwayat aksi admin akan tampil di sini setelah laporan kamu diproses.</p>
                    </div>
                @else
                    <div class="audit-timeline">
                        @foreach($auditLogs as $log)
                            @php
                                $dotColor = match($log->new_status) {
                                    'Selesai'  => 'color-emerald',
                                    'Proses'   => 'color-amber',
                                    'Menunggu' => 'color-rose',
                                    default    => 'color-indigo',
                                };
                                $pillClass = match(true) {
                                    $log->old_status === 'Selesai'  => 's-selesai',
                                    $log->old_status === 'Proses'   => 's-proses',
                                    $log->old_status === 'Menunggu' => 's-menunggu',
                                    default                          => 's-default',
                                };
                                $pillClassNew = match(true) {
                                    $log->new_status === 'Selesai'  => 's-selesai',
                                    $log->new_status === 'Proses'   => 's-proses',
                                    $log->new_status === 'Menunggu' => 's-menunggu',
                                    default                          => 's-default',
                                };
                            @endphp
                            <div class="audit-item">
                                <div class="audit-dot {{ $dotColor }}">
                                    <i class="bi {{ $log->action_icon }}"></i>
                                </div>
                                <div class="audit-body">
                                    <div class="audit-header">
                                        <span class="audit-action-label">{{ $log->action_label }}</span>
                                        <span class="audit-time">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $log->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                    <div class="audit-admin">
                                        <i class="bi bi-shield-check me-1"></i>
                                        Oleh: <strong>{{ $log->admin_nama }}</strong>
                                        @if($log->aspirasi)
                                            &nbsp;·&nbsp;
                                            <i class="bi bi-tag me-1"></i>
                                            {{ $log->aspirasi->kategori->ket_kategori ?? 'Kategori tidak diketahui' }}
                                        @endif
                                    </div>
                                    <!-- Tambahan: menampilkan cuplikan isi laporan agar lebih jelas -->
                                    @if($log->aspirasi && $log->aspirasi->ket)
                                    <div class="audit-report" style="font-size:0.8rem; margin-top: 0.3rem; color: var(--text-soft); background: rgba(99,130,255,0.05); padding: 0.3rem 0.6rem; border-radius: 0.5rem;">
                                        <i class="bi bi-file-text me-1"></i> 
                                        <strong>Laporan:</strong> 
                                        {{ Str::limit($log->aspirasi->ket, 80) }}
                                    </div>
                                    @endif
                                    @if($log->old_status && $log->new_status)
                                        <div class="audit-status-row">
                                            <span class="status-pill {{ $pillClass }}">{{ $log->old_status }}</span>
                                            <span class="audit-arrow"><i class="bi bi-arrow-right"></i></span>
                                            <span class="status-pill {{ $pillClassNew }}">{{ $log->new_status }}</span>
                                        </div>
                                    @endif
                                    @if($log->feedback)
                                        <div class="audit-feedback">
                                            <i class="bi bi-chat-quote me-1" style="color: rgba(101,116,248,0.6);"></i>
                                            "{{ $log->feedback }}"
                                        </div>
                                    @endif
                                    @if($log->notes)
                                        <div class="audit-notes">
                                            <i class="bi bi-info-circle me-1"></i>{{ $log->notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($auditLogs->count() >= 10)
                        <div class="text-center mt-3">
                            <a href="/notifications" class="btn-primary-pill" style="font-size: 0.82rem; padding: 0.55rem 1.25rem;">
                                <i class="bi bi-bell"></i> Lihat Semua di Notifikasi
                            </a>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>

    <footer>
        <div class="container">© 2026 LaporSekolah! — Semua laporan aman dan terjaga.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>