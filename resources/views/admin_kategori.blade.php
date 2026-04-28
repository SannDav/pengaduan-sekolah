<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }
        .orb {
            position: fixed; border-radius: 50%;
            filter: blur(90px); opacity: 0.45; pointer-events: none; z-index: 0;
        }
        .orb-1 { width: 500px; height: 500px; top: -120px; right: -100px; background: radial-gradient(circle, rgba(101,116,248,0.55), transparent 70%); }
        .orb-2 { width: 400px; height: 400px; bottom: 80px; left: -80px; background: radial-gradient(circle, rgba(45,212,191,0.35), transparent 70%); }

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

        .dropdown-toggle-pill { background: rgba(99,130,255,0.1) !important; color: var(--text) !important; border-radius: 999px !important; padding: 0.45rem 1.1rem !important; font-weight: 500; border: 1px solid var(--gb) !important; box-shadow: none !important; }
        .dropdown-menu { background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(18px); border: 1px solid var(--gb) !important; border-radius: 1.1rem !important; box-shadow: 0 20px 50px rgba(0,0,0,0.4) !important; padding: 0.5rem !important; }
        .dropdown-item { color: var(--text-soft) !important; border-radius: 0.65rem; padding: 0.6rem 1rem; font-size: 0.88rem; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }
        .dropdown-divider { border-color: rgba(99,130,255,0.1) !important; margin: 0.35rem 0.5rem; }
        
        .page-wrap { position: relative; z-index: 1; padding: 2.5rem 0 5rem; }
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
            color: var(--text);
        }

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

        .badge-count {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: rgba(101,116,248,0.1); border: 1px solid rgba(101,116,248,0.2);
            color: var(--indigo); border-radius: 999px;
            padding: 0.22rem 0.7rem; font-size: 0.72rem; font-weight: 700;
        }

        footer {
            position: relative; z-index: 1;
            border-top: 1px solid rgba(99,130,255,0.08);
            padding: 1.5rem 0; text-align: center;
            color: var(--text-dim); font-size: 0.83rem;
        }

        @media (max-width: 768px) {
            .page-wrap { padding: 1.5rem 0 3rem; }
            .page-hero { padding: 1.75rem; }
            .content-card { padding: 1.5rem; }
            .card-head { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    @php
        $pendingCount = \App\Models\PendingSiswa::where('status', 'pending')->count();
    @endphp

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
                            @if($pendingCount > 0)
                                <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">{{ $pendingCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li>
                                <a class="dropdown-item" href="/admin/approvals">
                                    <i class="bi bi-person-check me-2"></i>Persetujuan Akun
                                    @if($pendingCount > 0)
                                        <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">{{ $pendingCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li><a class="dropdown-item active" href="/admin/kategori"><i class="bi bi-tags me-2"></i>Manajemen Kategori</a></li>
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
                <div class="hero-label"><i class="bi bi-tags me-1"></i> Manajemen Kategori</div>
                <h1>Kelola Kategori Laporan</h1>
                <p>Tambah, ubah, atau hapus kategori untuk klasifikasi aspirasi siswa.</p>
            </div>

            <!-- CONTENT CARD -->
            <div class="content-card">
                <div class="card-head">
                    <div>
                        <h4 class="card-title"><i class="bi bi-tags"></i> Daftar Kategori</h4>
                        <p class="card-subtitle">Total {{ count($kategoris) }} kategori tersedia</p>
                    </div>
                    <button class="btn-primary-pill" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                        <i class="bi bi-plus-lg"></i> Tambah Kategori
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>ID Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Jumlah Laporan</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $kat)
                            <tr>
                                <td class="fw-bold">{{ $kat->id_kategori }}</td>
                                <td>{{ $kat->ket_kategori }}</td>
                                <td>
                                    <span class="badge-count">{{ $kat->aspirasis()->count() }} laporan</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end flex-wrap">
                                        <button class="btn-outline-new btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKategori{{ $kat->id_kategori }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <form action="/admin/kategori/{{ $kat->id_kategori }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-danger-pill btn-sm btn-hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-dim);"></i>
                                    <h5 class="mt-3 text-muted">Belum ada kategori</h5>
                                    <p class="text-muted">Klik tombol "Tambah Kategori" untuk membuat yang pertama.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">© 2026 LaporSekolah! — Panel admin untuk manajemen aspirasi siswa.</div>
    </footer>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="modalTambahKategori" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background: var(--surface); border: 1px solid var(--gb);">
                <form action="/admin/kategori" method="POST">
                    @csrf
                    <div class="modal-header" style="border-bottom: 1px solid var(--gb);">
                        <h5 class="modal-title" style="color: var(--text);"><i class="bi bi-plus-lg me-2"></i>Tambah Kategori Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" style="color: var(--text-soft);">ID Kategori</label>
                            <input type="number" name="id_kategori" class="form-control" placeholder="Contoh: 1, 2, 3..." required>
                            <div class="form-text" style="color: var(--text-dim); font-size: 0.8rem;">ID harus unik dan berupa angka.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: var(--text-soft);">Nama Kategori</label>
                            <input type="text" name="ket_kategori" class="form-control" placeholder="Contoh: Fasilitas, Kedisiplinan..." maxlength="30" required>
                            <div class="form-text" style="color: var(--text-dim); font-size: 0.8rem;">Maksimal 30 karakter.</div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--gb);">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.1); color: var(--text-soft); border: 1px solid rgba(255,255,255,0.1);">Batal</button>
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, var(--indigo), #7c3aed); color: #fff; border: none;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    @foreach($kategoris as $kat)
    <div class="modal fade" id="modalEditKategori{{ $kat->id_kategori }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background: var(--surface); border: 1px solid var(--gb);">
                <form action="/admin/kategori/{{ $kat->id_kategori }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header" style="border-bottom: 1px solid var(--gb);">
                        <h5 class="modal-title" style="color: var(--text);"><i class="bi bi-pencil me-2"></i>Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" style="color: var(--text-soft);">ID Kategori</label>
                            <input type="number" class="form-control" value="{{ $kat->id_kategori }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: var(--text-soft);">Nama Kategori</label>
                            <input type="text" name="ket_kategori" class="form-control" value="{{ $kat->ket_kategori }}" maxlength="30" required>
                            <div class="form-text" style="color: var(--text-dim); font-size: 0.8rem;">Maksimal 30 karakter.</div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--gb);">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.1); color: var(--text-soft); border: 1px solid rgba(255,255,255,0.1);">Batal</button>
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, var(--indigo), #7c3aed); color: #fff; border: none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hapus confirmation
            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', function() {
                    let form = this.closest('.form-hapus');
                    Swal.fire({
                        title: 'Yakin mau hapus?',
                        text: "Kategori yang sudah dihapus tidak bisa dikembalikan!",
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

            @if(session('error'))
                Swal.fire('Gagal!', "{{ session('error') }}", 'error');
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

