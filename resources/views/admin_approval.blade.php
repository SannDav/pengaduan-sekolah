<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Persetujuan Pendaftaran — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            --teal:      #2dd4bf;
            --rose:      #fb7185;
            --amber:     #fbbf24;
            --emerald:   #34d399;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg); color: var(--text); min-height: 100vh;
        }
        body::before {
            content: ''; position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px; pointer-events: none;
        }
        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; top: -120px; right: -100px; background: radial-gradient(circle, rgba(101,116,248,0.45), transparent 70%); }
        .orb-2 { width: 380px; height: 380px; bottom: -80px; left: -80px; background: radial-gradient(circle, rgba(45,212,191,0.28), transparent 70%); }

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
        .nav-link { color: var(--text-soft) !important; font-weight: 500; padding: 0.45rem 1rem !important; border-radius: 999px; font-size: 0.9rem; transition: all 0.2s; }
        .nav-link:hover { color: var(--text) !important; background: rgba(99,130,255,0.1); }
        .dropdown-toggle-pill { background: rgba(99,130,255,0.1) !important; color: var(--text) !important; border-radius: 999px !important; padding: 0.45rem 1.1rem !important; font-weight: 500; border: 1px solid var(--gb) !important; box-shadow: none !important; }
        .dropdown-menu { background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(18px); border: 1px solid var(--gb) !important; border-radius: 1.1rem !important; box-shadow: 0 20px 50px rgba(0,0,0,0.4) !important; padding: 0.5rem !important; }
        .dropdown-item { color: var(--text-soft) !important; border-radius: 0.65rem; padding: 0.6rem 1rem; font-size: 0.88rem; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }
        .dropdown-divider { border-color: rgba(99,130,255,0.1) !important; margin: 0.35rem 0.5rem; }

        /* ── PAGE ── */
        .page-wrap { position: relative; z-index: 1; padding: 2.5rem 0 5rem; }

        /* ── HERO ── */
        .page-hero {
            background: linear-gradient(135deg, rgba(101,116,248,0.15) 0%, rgba(15,23,42,0.9) 60%);
            border: 1px solid var(--gb); border-radius: 1.75rem; padding: 2.25rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.04);
            position: relative; overflow: hidden;
        }
        .page-hero::after { content: ''; position: absolute; top: -60px; right: -60px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(101,116,248,0.18), transparent 70%); }
        .hero-label { display: inline-flex; align-items: center; gap: 0.45rem; background: rgba(101,116,248,0.12); border: 1px solid rgba(101,116,248,0.22); color: #a5b4fc; border-radius: 999px; padding: 0.3rem 0.85rem; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.04em; margin-bottom: 1rem; }
        .page-hero h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(1.6rem, 3vw, 2.2rem); line-height: 1.2; color: var(--text); margin-bottom: 0.6rem; }
        .page-hero p { color: var(--text-soft); font-size: 0.9rem; max-width: 520px; margin-bottom: 0; }

        /* ── STATS ── */
        .stat-chip { background: rgba(99,130,255,0.07); border: 1px solid rgba(99,130,255,0.12); border-radius: 1rem; padding: 0.85rem 1.4rem; text-align: center; min-width: 110px; }
        .stat-chip .num { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.7rem; background: linear-gradient(135deg, var(--indigo), var(--teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .stat-chip small { display: block; color: var(--text-dim); font-size: 0.72rem; margin-top: 0.15rem; }

        /* ── TABS ── */
        .tab-nav { display: flex; gap: 0.4rem; background: rgba(99,130,255,0.06); border: 1px solid var(--gb); border-radius: 999px; padding: 0.3rem; margin-bottom: 1.75rem; width: fit-content; }
        .tab-btn { padding: 0.55rem 1.25rem; border-radius: 999px; background: transparent; border: none; cursor: pointer; color: var(--text-soft); font-size: 0.88rem; font-weight: 600; transition: all 0.25s; font-family: 'DM Sans', sans-serif; display: flex; align-items: center; gap: 0.4rem; }
        .tab-btn.active { background: var(--indigo); color: #fff; box-shadow: 0 4px 14px rgba(101,116,248,0.35); }
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }

        /* ── CONTENT CARD ── */
        .content-card { background: var(--glass); backdrop-filter: blur(16px); border: 1px solid var(--gb); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
        .card-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
        .card-title { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.05rem; color: var(--text); display: flex; align-items: center; gap: 0.55rem; margin: 0; }
        .card-title i { color: var(--indigo); }

        /* ── STUDENT CARDS (Pending) ── */
        .student-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.1rem; }
        .student-card { background: rgba(15,23,42,0.8); border: 1px solid rgba(99,130,255,0.14); border-radius: 1.25rem; padding: 1.4rem; transition: all 0.25s; position: relative; overflow: hidden; }
        .student-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--indigo), var(--teal)); border-radius: 1.25rem 1.25rem 0 0; }
        .student-card:hover { border-color: rgba(99,130,255,0.28); transform: translateY(-2px); box-shadow: 0 12px 32px rgba(0,0,0,0.25); }
        .student-avatar { width: 46px; height: 46px; border-radius: 0.85rem; background: linear-gradient(135deg, rgba(101,116,248,0.2), rgba(45,212,191,0.1)); border: 1px solid rgba(101,116,248,0.25); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
        .student-name { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.95rem; color: var(--text); margin: 0 0 0.2rem; }
        .student-meta { color: var(--text-dim); font-size: 0.78rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
        .meta-pill { background: rgba(99,130,255,0.08); border: 1px solid rgba(99,130,255,0.14); border-radius: 0.4rem; padding: 0.12rem 0.5rem; font-size: 0.72rem; color: #a5b4fc; font-weight: 600; }
        .student-date { color: var(--text-dim); font-size: 0.75rem; margin-top: 0.75rem; display: flex; align-items: center; gap: 0.35rem; }
        .student-actions { display: flex; gap: 0.6rem; margin-top: 1rem; }

        /* ── BUTTONS ── */
        .btn-approve { flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.6rem; border-radius: 0.75rem; background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.3); color: var(--emerald); font-weight: 700; font-size: 0.82rem; cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif; }
        .btn-approve:hover { background: rgba(52,211,153,0.2); border-color: rgba(52,211,153,0.5); transform: translateY(-1px); }
        .btn-reject { flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.6rem; border-radius: 0.75rem; background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.3); color: var(--rose); font-weight: 700; font-size: 0.82rem; cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif; }
        .btn-reject:hover { background: rgba(251,113,133,0.2); border-color: rgba(251,113,133,0.5); transform: translateY(-1px); }
        .btn-bulk { display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.65rem 1.25rem; border-radius: 999px; background: linear-gradient(135deg, var(--indigo), #7c3aed); color: #fff; font-weight: 700; font-size: 0.85rem; border: none; cursor: pointer; box-shadow: 0 6px 18px rgba(101,116,248,0.3); transition: all 0.25s; font-family: 'DM Sans', sans-serif; }
        .btn-bulk:hover { box-shadow: 0 8px 24px rgba(101,116,248,0.45); transform: translateY(-1px); }
        .btn-bulk:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        /* ── TABLE (Approved / Rejected) ── */
        .simple-table { width: 100%; border-collapse: separate; border-spacing: 0 0.5rem; }
        .simple-table thead th { color: var(--text-dim); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 0 1rem 0.5rem; border-bottom: 1px solid rgba(99,130,255,0.1); }
        .simple-table tbody tr { background: rgba(15,23,42,0.7); transition: background 0.2s; }
        .simple-table tbody tr:hover { background: rgba(101,116,248,0.07); }
        .simple-table tbody td { padding: 0.8rem 1rem; font-size: 0.86rem; vertical-align: middle; }
        .simple-table tbody td:first-child { border-radius: 0.85rem 0 0 0.85rem; }
        .simple-table tbody td:last-child  { border-radius: 0 0.85rem 0.85rem 0; }

        /* ── STATUS BADGES ── */
        .badge-approved { display: inline-flex; align-items: center; gap: 0.3rem; background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.25); color: var(--emerald); border-radius: 999px; padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700; }
        .badge-rejected { display: inline-flex; align-items: center; gap: 0.3rem; background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.25); color: var(--rose); border-radius: 999px; padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700; }
        .badge-pending  { display: inline-flex; align-items: center; gap: 0.3rem; background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.25); color: var(--amber); border-radius: 999px; padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700; }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 3.5rem 1rem; }
        .empty-icon { width: 70px; height: 70px; border-radius: 1.2rem; background: rgba(99,130,255,0.08); border: 1px solid rgba(99,130,255,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 1.75rem; color: var(--text-dim); }
        .empty-state h5 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1rem; color: var(--text); margin-bottom: 0.5rem; }
        .empty-state p { color: var(--text-soft); font-size: 0.88rem; }

        /* ── SELECT ALL ── */
        .select-bar { display: flex; align-items: center; gap: 0.85rem; margin-bottom: 1.25rem; padding: 0.85rem 1.1rem; background: rgba(99,130,255,0.06); border: 1px solid var(--gb); border-radius: 0.9rem; }
        .form-check-input { background-color: rgba(99,130,255,0.1); border-color: rgba(99,130,255,0.3); cursor: pointer; }
        .form-check-input:checked { background-color: var(--indigo); border-color: var(--indigo); }

        /* ── MODAL ── */
        .modal-content { background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(20px); border: 1px solid var(--gb) !important; border-radius: 1.5rem !important; box-shadow: 0 40px 80px rgba(0,0,0,0.5) !important; color: var(--text); }
        .modal-header { border-bottom: 1px solid rgba(99,130,255,0.1) !important; padding: 1.5rem 1.75rem 1.25rem; }
        .modal-header .modal-title { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1rem; color: var(--text); }
        .btn-close { filter: invert(1) opacity(0.5); }
        .modal-body { padding: 1.5rem 1.75rem; }
        .modal-footer { border-top: 1px solid rgba(99,130,255,0.1) !important; padding: 1.25rem 1.75rem; }
        .modal-body .form-label { display: block; color: var(--text-soft); font-size: 0.8rem; font-weight: 600; margin-bottom: 0.45rem; }
        .modal-body .form-control { width: 100%; background: rgba(10,16,32,0.7); border: 1px solid rgba(99,130,255,0.16); border-radius: 0.85rem; color: var(--text); padding: 0.75rem 1rem; font-size: 0.88rem; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .modal-body .form-control:focus { border-color: rgba(101,116,248,0.5); box-shadow: 0 0 0 3px rgba(101,116,248,0.12); }
        .btn-modal-danger { display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.7rem 1.5rem; border-radius: 999px; background: rgba(251,113,133,0.15); border: 1px solid rgba(251,113,133,0.4); color: var(--rose); font-weight: 700; font-size: 0.88rem; cursor: pointer; transition: all 0.2s; }
        .btn-modal-danger:hover { background: rgba(251,113,133,0.25); }
        .btn-modal-cancel { display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.7rem 1.25rem; border-radius: 999px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--text-soft); font-weight: 600; font-size: 0.88rem; cursor: pointer; transition: all 0.2s; }

        /* ── FOOTER ── */
        footer { position: relative; z-index: 1; border-top: 1px solid rgba(99,130,255,0.08); padding: 1.5rem 0; text-align: center; color: var(--text-dim); font-size: 0.83rem; }

        @media (max-width: 768px) {
            .student-grid { grid-template-columns: 1fr; }
            .tab-nav { flex-wrap: wrap; width: 100%; }
            .tab-btn { flex: 1; justify-content: center; }
            .page-hero { padding: 1.75rem; }
            .content-card { padding: 1.5rem; }
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
                    <li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a></li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-shield-check me-1"></i> Admin: {{ session('admin_nama') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item active" href="/admin/approvals"><i class="bi bi-person-check me-2"></i>Persetujuan Akun</a></li>
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

            <!-- PAGE HERO -->
            <div class="page-hero">
                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                    <div>
                        <div class="hero-label"><i class="bi bi-person-check-fill me-1"></i> Manajemen Akun</div>
                        <h1>Persetujuan<br>Pendaftaran Siswa</h1>
                        <p>Approve atau tolak permintaan pendaftaran siswa baru. Akun yang disetujui langsung bisa login.</p>
                    </div>
                    <div class="d-flex gap-3 flex-wrap align-items-center">
                        <div class="stat-chip">
                            <div class="num">{{ $countPending }}</div>
                            <small>Menunggu</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num">{{ $approved->count() }}</div>
                            <small>Disetujui</small>
                        </div>
                        <div class="stat-chip">
                            <div class="num">{{ $rejected->count() }}</div>
                            <small>Ditolak</small>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div style="background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.25); border-radius: 0.85rem; padding: 0.85rem 1.1rem; color: #6ee7b7; font-size: 0.88rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
            @endif

            <!-- TABS -->
            <div class="tab-nav">
                <button class="tab-btn active" onclick="switchTab('pending', this)">
                    <i class="bi bi-hourglass-split"></i> Menunggu
                    @if($countPending > 0)
                        <span style="background: var(--amber); color: #1a1a00; border-radius: 999px; padding: 0.1rem 0.5rem; font-size: 0.7rem; font-weight: 800;">{{ $countPending }}</span>
                    @endif
                </button>
                <button class="tab-btn" onclick="switchTab('approved', this)">
                    <i class="bi bi-check-circle"></i> Disetujui
                </button>
                <button class="tab-btn" onclick="switchTab('rejected', this)">
                    <i class="bi bi-x-circle"></i> Ditolak
                </button>
            </div>

            <!-- ═══ TAB PENDING ═══ -->
            <div class="tab-pane active" id="pane-pending">
                <div class="content-card">
                    <div class="card-head">
                        <h4 class="card-title"><i class="bi bi-hourglass-split"></i> Pendaftaran Menunggu Persetujuan</h4>
                        @if($pending->count() > 0)
                        <button class="btn-bulk" id="btn-bulk-approve" disabled onclick="bulkApprove()">
                            <i class="bi bi-check-all"></i> Approve Terpilih
                        </button>
                        @endif
                    </div>

                    @if($pending->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                            <h5>Tidak Ada Pendaftaran Baru</h5>
                            <p>Semua pendaftaran sudah diproses. Mantap, Wak!</p>
                        </div>
                    @else
                        <!-- Select all bar -->
                        <div class="select-bar">
                            <input type="checkbox" class="form-check-input" id="select-all" onchange="toggleSelectAll(this)">
                            <label for="select-all" style="color: var(--text-soft); font-size: 0.85rem; font-weight: 600; cursor: pointer; margin: 0;">Pilih Semua ({{ $pending->count() }} pendaftaran)</label>
                        </div>

                        <div class="student-grid">
                            @foreach($pending as $p)
                            <div class="student-card" id="card-{{ $p->id }}">
                                <div style="position: absolute; top: 1rem; right: 1rem;">
                                    <input type="checkbox" class="form-check-input row-checkbox" value="{{ $p->id }}" onchange="updateBulkBtn()">
                                </div>
                                <div class="d-flex align-items-center gap-0.85rem mb-3" style="gap: 0.85rem;">
                                    <div class="student-avatar">
                                        <i class="bi bi-person-fill" style="color: var(--indigo);"></i>
                                    </div>
                                    <div>
                                        <h5 class="student-name">{{ $p->nama }}</h5>
                                        <div class="student-meta">
                                            <span class="meta-pill"><i class="bi bi-card-text me-1"></i>{{ $p->nis }}</span>
                                            <span class="meta-pill"><i class="bi bi-door-open me-1"></i>{{ $p->kelas }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-date">
                                    <i class="bi bi-clock"></i>
                                    Daftar {{ $p->created_at->diffForHumans() }}
                                </div>
                                <div class="student-actions">
                                    <form action="/admin/approvals/{{ $p->id }}/approve" method="POST" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="btn-approve w-100">
                                            <i class="bi bi-check-lg"></i> Setujui
                                        </button>
                                    </form>
                                    <button type="button" class="btn-reject" style="flex: 1;"
                                        onclick="openRejectModal({{ $p->id }}, '{{ addslashes($p->nama) }}')">
                                        <i class="bi bi-x-lg"></i> Tolak
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- ═══ TAB APPROVED ═══ -->
            <div class="tab-pane" id="pane-approved">
                <div class="content-card">
                    <div class="card-head">
                        <h4 class="card-title"><i class="bi bi-check-circle"></i> Pendaftaran Disetujui</h4>
                        <span style="color: var(--text-dim); font-size: 0.82rem;">Menampilkan 20 data terbaru</span>
                    </div>

                    @if($approved->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon"><i class="bi bi-check-circle"></i></div>
                            <h5>Belum Ada yang Disetujui</h5>
                            <p>Belum ada pendaftaran yang disetujui.</p>
                        </div>
                    @else
                    <div class="table-responsive">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>Nama</th><th>NIS</th><th>Kelas</th><th>Tanggal Daftar</th><th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approved as $a)
                                <tr>
                                    <td style="font-weight: 600; color: var(--text);">{{ $a->nama }}</td>
                                    <td style="color: #a5b4fc; font-family: 'Sora', sans-serif; font-size: 0.82rem;">{{ $a->nis }}</td>
                                    <td style="color: var(--text-soft);">{{ $a->kelas }}</td>
                                    <td style="color: var(--text-dim); font-size: 0.82rem;">{{ $a->created_at->format('d M Y H:i') }}</td>
                                    <td><span class="badge-approved"><span class="badge-dot"></span> Disetujui</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            <!-- ═══ TAB REJECTED ═══ -->
            <div class="tab-pane" id="pane-rejected">
                <div class="content-card">
                    <div class="card-head">
                        <h4 class="card-title"><i class="bi bi-x-circle"></i> Pendaftaran Ditolak</h4>
                        <span style="color: var(--text-dim); font-size: 0.82rem;">Menampilkan 20 data terbaru</span>
                    </div>

                    @if($rejected->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon"><i class="bi bi-x-circle"></i></div>
                            <h5>Belum Ada yang Ditolak</h5>
                            <p>Belum ada pendaftaran yang ditolak.</p>
                        </div>
                    @else
                    <div class="table-responsive">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>Nama</th><th>NIS</th><th>Kelas</th><th>Tanggal Daftar</th><th>Alasan</th><th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rejected as $r)
                                <tr>
                                    <td style="font-weight: 600; color: var(--text);">{{ $r->nama }}</td>
                                    <td style="color: #a5b4fc; font-family: 'Sora', sans-serif; font-size: 0.82rem;">{{ $r->nis }}</td>
                                    <td style="color: var(--text-soft);">{{ $r->kelas }}</td>
                                    <td style="color: var(--text-dim); font-size: 0.82rem;">{{ $r->created_at->format('d M Y H:i') }}</td>
                                    <td style="color: var(--text-soft); font-size: 0.82rem; font-style: italic;">{{ $r->reject_reason ?? '—' }}</td>
                                    <td><span class="badge-rejected"><span class="badge-dot"></span> Ditolak</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL TOLAK -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-x-circle me-2" style="color: var(--rose);"></i>Tolak Pendaftaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p style="color: var(--text-soft); font-size: 0.9rem; margin-bottom: 1rem;">
                            Kamu akan menolak pendaftaran <strong id="reject-name" style="color: var(--text);"></strong>. Isi alasan penolakan (opsional).
                        </p>
                        <div>
                            <label class="form-label">Alasan Penolakan <span style="color: var(--text-dim);">(Opsional)</span></label>
                            <textarea name="reject_reason" class="form-control" rows="3" placeholder="Contoh: NIS tidak terdaftar, data tidak lengkap..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal-danger"><i class="bi bi-x-lg"></i> Ya, Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">© 2026 LaporSekolah! — Panel admin untuk manajemen akun siswa.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab switching
        function switchTab(tab, el) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('pane-' + tab).classList.add('active');
        }

        // Select all checkboxes
        function toggleSelectAll(master) {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = master.checked);
            updateBulkBtn();
        }

        function updateBulkBtn() {
            const checked = document.querySelectorAll('.row-checkbox:checked').length;
            const btn = document.getElementById('btn-bulk-approve');
            if (btn) {
                btn.disabled = checked === 0;
                btn.innerHTML = checked > 0
                    ? `<i class="bi bi-check-all"></i> Approve ${checked} Terpilih`
                    : `<i class="bi bi-check-all"></i> Approve Terpilih`;
            }
            // Sync select-all state
            const total = document.querySelectorAll('.row-checkbox').length;
            const selectAll = document.getElementById('select-all');
            if (selectAll) selectAll.indeterminate = checked > 0 && checked < total;
            if (selectAll) selectAll.checked = checked === total && total > 0;
        }

        // Bulk approve
        function bulkApprove() {
            const ids = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
            if (!ids.length) return;

            Swal.fire({
                title: `Setujui ${ids.length} Pendaftaran?`,
                text: 'Semua akun yang dipilih akan langsung aktif dan bisa login.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#34d399',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Setujui Semua!',
                cancelButtonText: 'Batal',
                background: 'rgba(10,16,32,0.97)',
                color: '#e8edf8',
            }).then(result => {
                if (result.isConfirmed) {
                    fetch('/admin/approvals/bulk-approve', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ ids })
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success', title: 'Berhasil!', text: data.message,
                                background: 'rgba(10,16,32,0.97)', color: '#e8edf8',
                                confirmButtonColor: '#6574f8'
                            }).then(() => location.reload());
                        }
                    });
                }
            });
        }

        // Open reject modal
        function openRejectModal(id, nama) {
            document.getElementById('reject-name').textContent = nama;
            document.getElementById('rejectForm').action = `/admin/approvals/${id}/reject`;
            // Reset textarea
            document.querySelector('#rejectModal textarea').value = '';
            new bootstrap.Modal(document.getElementById('rejectModal')).show();
        }

        // Confirm single approve with SweetAlert
        document.querySelectorAll('.btn-approve').forEach(btn => {
            btn.closest('form')?.addEventListener('submit', function(e) {
                // langsung submit tanpa konfirmasi biar cepat, tapi bisa ditambah kalau mau
            });
        });
    </script>
</body>
</html>