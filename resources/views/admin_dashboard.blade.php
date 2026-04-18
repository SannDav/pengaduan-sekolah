<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* ── STATS ── */
        .stats-row { display: flex; gap: 1rem; flex-wrap: wrap; align-items: stretch; }
        .stat-chip {
            background: rgba(99,130,255,0.07); border: 1px solid rgba(99,130,255,0.12);
            border-radius: 1rem; padding: 0.85rem 1.25rem;
            text-align: center; min-width: 100px;
        }
        .stat-chip .num {
            font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.5rem;
            background: linear-gradient(135deg, var(--indigo), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .stat-chip small { display: block; color: var(--text-dim); font-size: 0.72rem; margin-top: 0.15rem; }

        /* ── CARD ── */
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

        /* ── SEARCH & FILTER ── */
        .search-filter {
            background: rgba(99,130,255,0.06); border: 1px solid rgba(99,130,255,0.12);
            border-radius: 1rem; padding: 1.25rem; margin-bottom: 1.5rem;
        }
        .form-control {
            background: rgba(10,16,32,0.7); border: 1px solid rgba(99,130,255,0.16);
            border-radius: 0.9rem; color: var(--text);
            padding: 0.75rem 1rem; font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: var(--text-dim); }
        .form-control:focus {
            border-color: rgba(101,116,248,0.5);
            box-shadow: 0 0 0 3px rgba(101,116,248,0.12);
            background: rgba(10,16,32,0.85);
        }
        .form-select {
            background: rgba(10,16,32,0.7); border: 1px solid rgba(99,130,255,0.16);
            border-radius: 0.9rem; color: var(--text);
            padding: 0.75rem 1rem; font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif; outline: none;
        }
        .form-select:focus { border-color: rgba(101,116,248,0.5); }

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

        /* ── STATUS BADGES ── */
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

        /* ── BUTTONS ── */
        .btn-primary-pill {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.5rem; border-radius: 999px;
            background: linear-gradient(135deg, var(--indigo), #7c3aed);
            color: #fff; font-weight: 600; font-size: 0.88rem;
            border: none; text-decoration: none;
            box-shadow: 0 6px 18px rgba(101,116,248,0.3);
            transition: all 0.25s; cursor: pointer;
        }
        .btn-primary-pill:hover {
            box-shadow: 0 8px 24px rgba(101,116,248,0.45);
            transform: translateY(-1px); color: #fff;
        }
        .btn-outline-new {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.6rem 1.25rem; border-radius: 999px;
            background: rgba(101,116,248,0.08);
            border: 1px solid rgba(101,116,248,0.25);
            color: #a5b4fc; font-weight: 600; font-size: 0.85rem;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-outline-new:hover { background: rgba(101,116,248,0.16); color: #c7d2fe; }
        .btn-danger-pill {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.5rem; border-radius: 999px;
            background: rgba(251,113,133,0.1); border: 1px solid rgba(251,113,133,0.25);
            color: var(--rose); font-weight: 600; font-size: 0.88rem;
            cursor: pointer; transition: all 0.25s;
        }
        .btn-danger-pill:hover { background: rgba(251,113,133,0.2); color: #fca5a5; }

        /* ── CHART ── */
        .chart-container { position: relative; height: 300px; margin-bottom: 2rem; }

        /* ── FOOTER ── */
        footer {
            position: relative; z-index: 1;
            border-top: 1px solid rgba(99,130,255,0.08);
            padding: 1.5rem 0; text-align: center;
            color: var(--text-dim); font-size: 0.83rem;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 992px) {
            .dashboard-summary .col-sm-6 { flex: 0 0 100%; max-width: 100%; }
            .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .stats-row { flex-direction: column; }
            .card-head { flex-direction: column; align-items: stretch; gap: 1rem; }
        }

        @media (max-width: 768px) {
            .navbar .container { gap: 0.75rem; flex-wrap: wrap; }
            .table tbody td { padding: 0.75rem; font-size: 0.82rem; }
            .d-flex.justify-content-between { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
            .btn-outline-secondary { width: 100%; margin-top: 0.75rem; }
            .orb { display: none; }
            .page-wrap { padding: 1.5rem 0 3rem; }
            .page-hero { padding: 1.75rem; }
            .content-card { padding: 1.5rem; }
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
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4" style="color: var(--text-soft);"></i>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/aspirasi"><i class="bi bi-journal-text me-1"></i>Semua Laporan</a></li>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-wrap">
        <div class="container">
            <!-- PAGE HERO -->
            <div class="page-hero">
                <div class="hero-logo">
                    <div class="logo-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                </div>
                <div class="hero-label"><i class="bi bi-shield-check me-1"></i> Admin Dashboard</div>
                <h1>Panel Kontrol Admin</h1>
                <p>Kelola aspirasi siswa dengan fitur lengkap dan analitik real-time.</p>
            </div>

            <!-- STATS SUMMARY -->
            <div class="stats-row mb-4" id="stats-row">
                <div class="stat-chip">
                    <div class="num" id="total-laporan">{{ count($aspirasis) }}</div>
                    <small>Total Laporan</small>
                </div>
                <div class="stat-chip">
                    <div class="num" id="menunggu">{{ $aspirasis->where('status', 'Menunggu')->count() }}</div>
                    <small>Menunggu</small>
                </div>
                <div class="stat-chip">
                    <div class="num" id="proses">{{ $aspirasis->where('status', 'Proses')->count() }}</div>
                    <small>Proses</small>
                </div>
                <div class="stat-chip">
                    <div class="num" id="selesai">{{ $aspirasis->where('status', 'Selesai')->count() }}</div>
                    <small>Selesai</small>
                </div>
            </div>

            <!-- CHART SECTION -->
            <div class="content-card mb-4">
                <div class="card-head">
                    <h4 class="card-title"><i class="bi bi-bar-chart"></i> Analitik Status Laporan</h4>
                    <button class="btn-outline-new" onclick="refreshChart()"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
                </div>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- SEARCH & FILTER -->
            <div class="search-filter">
                <form method="GET" action="/admin" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari NIS, kategori, atau isi laporan..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach(\App\Models\Kategori::all() as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->ket_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-primary-pill w-100"><i class="bi bi-search"></i> Cari</button>
                    </div>
                    <div class="col-md-2">
                        <a href="/admin" class="btn-outline-new w-100"><i class="bi bi-x-circle"></i> Reset</a>
                    </div>
                </form>
            </div>

            <!-- ASPIRASI TABLE -->
            <div class="content-card">
                <div class="card-head">
                    <div>
                        <h4 class="card-title"><i class="bi bi-table"></i> Daftar Aspirasi</h4>
                        <p class="card-subtitle">Kelola laporan siswa dengan fitur bulk actions</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn-outline-new" onclick="exportData('csv')"><i class="bi bi-file-earmark-spreadsheet"></i> Export CSV</button>
                        <button class="btn-outline-new" onclick="exportData('pdf')"><i class="bi bi-file-earmark-pdf"></i> Export PDF</button>
                    </div>
                </div>

                <!-- BULK ACTIONS -->
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="checkbox" id="select-all" class="form-check-input">
                        <label for="select-all" class="form-check-label text-sm">Pilih Semua</label>
                        <span class="text-dim">|</span>
                        <button class="btn-danger-pill btn-sm" id="bulk-delete" disabled onclick="bulkDelete()"><i class="bi bi-trash"></i> Hapus Terpilih</button>
                        <button class="btn-primary-pill btn-sm" id="bulk-status" disabled onclick="bulkStatusChange('Proses')"><i class="bi bi-play"></i> Ubah ke Proses</button>
                    </div>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">Total {{ $aspirasis->count() }} laporan</span>
                </div>

                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all-header"></th>
                                <th>NIS</th><th>Kategori</th><th>Isi Laporan</th><th>Status</th><th>Foto</th><th>Feedback</th><th>Tanggal</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $aspi)
                            <tr>
                                <td><input type="checkbox" class="row-checkbox" value="{{ $aspi->id_pelaporan }}"></td>
                                <td class="fw-bold">{{ $aspi->nis }}</td>
                                <td>{{ $aspi->kategori->ket_kategori ?? '-' }}</td>
                                <td>
                                    <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                        {{ strlen($aspi->ket) > 50 ? substr($aspi->ket, 0, 47) . '...' : $aspi->ket }}
                                    </div>
                                </td>
                                <td>
                                    @if($aspi->status == 'Selesai')
                                        <span class="badge-done"><span class="badge-dot"></span> Selesai</span>
                                    @elseif($aspi->status == 'Proses')
                                        <span class="badge-proc"><span class="badge-dot"></span> Proses</span>
                                    @else
                                        <span class="badge-wait"><span class="badge-dot"></span> Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($aspi->foto)
                                        <button type="button" class="btn-outline-new btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $aspi->id_pelaporan }}">Lihat</button>
                                    @else <span class="text-dim">-</span> @endif
                                </td>
                                <td>
                                    <div style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $aspi->feedback ? (strlen($aspi->feedback) > 30 ? substr($aspi->feedback, 0, 27) . '...' : $aspi->feedback) : '-' }}
                                    </div>
                                </td>
                                <td class="text-dim">{{ $aspi->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button class="btn-primary-pill btn-sm" data-bs-toggle="modal" data-bs-target="#modalTanggapan{{ $aspi->id_pelaporan }}"><i class="bi bi-pencil"></i></button>
                                        <form action="/admin/hapus/{{ $aspi->id_pelaporan }}" method="POST" class="d-inline form-hapus">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn-danger-pill btn-sm btn-hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-dim);"></i>
                                    <h5 class="mt-3 text-muted">Tidak ada laporan ditemukan</h5>
                                    <p class="text-muted">Coba ubah filter pencarian atau tunggu laporan baru.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                @if($aspirasis->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $aspirasis->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <footer>
        <div class="container">© 2026 LaporSekolah! — Panel admin untuk manajemen aspirasi siswa.</div>
    </footer>

    <!-- MODALS -->
    @foreach($aspirasis as $aspi)
    <!-- Modal Foto -->
    <div class="modal fade" id="modalFoto{{ $aspi->id_pelaporan }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: var(--surface); border: 1px solid var(--gb);">
                <div class="modal-header" style="border-bottom: 1px solid var(--gb);">
                    <h5 class="modal-title" style="color: var(--text);">Foto Bukti - NIS {{ $aspi->nis }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset($aspi->foto) }}" class="img-fluid rounded" style="max-height: 70vh;">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tanggapan -->
    <div class="modal fade" id="modalTanggapan{{ $aspi->id_pelaporan }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background: var(--surface); border: 1px solid var(--gb);">
                <form action="/admin/feedback/{{ $aspi->id_pelaporan }}" method="POST">
                    @csrf
                    <div class="modal-header" style="border-bottom: 1px solid var(--gb);">
                        <h5 class="modal-title" style="color: var(--text);">Umpan Balik Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" style="color: var(--text-soft);">Status</label>
                            <select name="status" class="form-select" style="background: rgba(10,16,32,0.7); border: 1px solid rgba(99,130,255,0.16); color: var(--text);">
                                @foreach(['Menunggu','Proses','Selesai'] as $s)
                                    <option value="{{ $s }}" {{ $aspi->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: var(--text-soft);">Feedback</label>
                            <textarea name="feedback" class="form-control" style="background: rgba(10,16,32,0.7); border: 1px solid rgba(99,130,255,0.16); color: var(--text);" rows="3" required>{{ $aspi->feedback }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--gb);">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.1); color: var(--text-soft); border: 1px solid rgba(255,255,255,0.1);">Batal</button>
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, var(--indigo), #7c3aed); color: #fff; border: none;">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

<script>
    // Chart.js setup
    let statusChart;
    const ctx = document.getElementById('statusChart').getContext('2d');

    function initChart() {
        const data = {
            labels: ['Menunggu', 'Proses', 'Selesai'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [
                    {{ $aspirasis->where('status', 'Menunggu')->count() }},
                    {{ $aspirasis->where('status', 'Proses')->count() }},
                    {{ $aspirasis->where('status', 'Selesai')->count() }}
                ],
                backgroundColor: [
                    'rgba(251, 113, 133, 0.8)',
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(52, 211, 153, 0.8)'
                ],
                borderColor: [
                    'rgba(251, 113, 133, 1)',
                    'rgba(251, 191, 36, 1)',
                    'rgba(52, 211, 153, 1)'
                ],
                borderWidth: 2
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ffffff',
                            font: {
                                size: 14,
                                weight: '500'
                            },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                layout: {
                    padding: {
                        bottom: 20
                    }
                }
            }
        };

        statusChart = new Chart(ctx, config);
    }

    function refreshChart() {
        fetch('/admin/stats')
            .then(response => response.json())
            .then(data => {
                statusChart.data.datasets[0].data = [data.menunggu, data.proses, data.selesai];
                statusChart.update();

                // Update stats chips
                document.getElementById('total-laporan').textContent = data.total;
                document.getElementById('menunggu').textContent = data.menunggu;
                document.getElementById('proses').textContent = data.proses;
                document.getElementById('selesai').textContent = data.selesai;
            })
            .catch(error => console.error('Error refreshing chart:', error));
    }

    // Bulk actions
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkButtons();
    });

    document.getElementById('select-all-header').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        document.getElementById('select-all').checked = this.checked;
        updateBulkButtons();
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('row-checkbox')) {
            updateBulkButtons();
        }
    });

    function updateBulkButtons() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const bulkDelete = document.getElementById('bulk-delete');
        const bulkStatus = document.getElementById('bulk-status');

        bulkDelete.disabled = checkedBoxes.length === 0;
        bulkStatus.disabled = checkedBoxes.length === 0;
    }

    function bulkDelete() {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);

        if (selectedIds.length === 0) return;

        Swal.fire({
            title: 'Hapus Laporan Terpilih?',
            text: `Yakin mau hapus ${selectedIds.length} laporan?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admin/bulk-delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Terhapus!', data.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                });
            }
        });
    }

    function bulkStatusChange(status) {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);

        if (selectedIds.length === 0) return;

        Swal.fire({
            title: `Ubah Status ke ${status}?`,
            text: `Ubah status ${selectedIds.length} laporan terpilih ke ${status}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6574f8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admin/bulk-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedIds, status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                });
            }
        });
    }

    // Export functions
    function exportData(format) {
        const url = `/admin/export/${format}?${new URLSearchParams(window.location.search).toString()}`;
        window.open(url, '_blank');
    }

    // Real-time updates
    setInterval(refreshChart, 30000); // Refresh every 30 seconds

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        initChart();

        // Single delete handlers
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', function() {
                let form = this.closest('.form-hapus');
                Swal.fire({
                    title: 'Yakin mau hapus?',
                    text: "Laporan ini bakal hilang selamanya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        @if(session('success'))
            Swal.fire('Berhasil!', "{{ session('success') }}", 'success');
        @endif
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>