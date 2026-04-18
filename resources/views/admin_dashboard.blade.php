<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-800);
        }
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--gray-200);
            padding: 0.75rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
            font-size: 1.4rem;
        }
        .navbar-nav .nav-link {
            color: var(--gray-600) !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
        }
        .card {
            border: none;
            border-radius: 1.25rem;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.03);
        }
        .dashboard-summary .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dashboard-summary .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -12px rgba(0,0,0,0.08);
        }
        .badge-status {
            font-size: 0.7rem;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
        }
        .table tbody tr {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            transition: all 0.2s;
        }
        .table tbody tr:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .table tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }
        .btn-primary, .btn-success, .btn-outline-danger {
            border-radius: 2rem;
            padding: 0.4rem 1rem;
            font-weight: 500;
        }
        .btn-primary {
            background-color: var(--primary);
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        .modal-content {
            border-radius: 1.25rem;
            border: none;
        }

        @media (max-width: 992px) {
            .dashboard-summary .col-sm-6 { flex: 0 0 100%; max-width: 100%; }
            .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        }

        @media (max-width: 768px) {
            .navbar .container { gap: 0.75rem; flex-wrap: wrap; }
            .table tbody td { padding: 0.75rem; font-size: 0.82rem; }
            .d-flex.justify-content-between { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
            .btn-outline-secondary { width: 100%; margin-top: 0.75rem; }
            .orb { display: none; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><i class="bi bi-megaphone-fill"></i> LaporSekolah!</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-4"></i>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Dashboard Admin</h2>
            <p class="text-muted mb-0">Selamat datang, {{ session('admin_nama') }}. Kelola aspirasi siswa dengan mudah.</p>
        </div>
        <a href="/" class="btn btn-outline-secondary btn-sm rounded-pill">Beranda</a>
    </div>

    <div class="row g-4 dashboard-summary mb-5">
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-0">{{ count($aspirasis) }}</h3>
                        <p class="text-muted mb-0">Total Laporan</p>
                    </div>
                    <i class="bi bi-files fs-1 text-primary opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-0">{{ $aspirasis->where('status', 'Menunggu')->count() }}</h3>
                        <p class="text-muted mb-0">Menunggu</p>
                    </div>
                    <i class="bi bi-hourglass-split fs-1 text-warning opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-0">{{ $aspirasis->where('status', 'Proses')->count() }}</h3>
                        <p class="text-muted mb-0">Proses</p>
                    </div>
                    <i class="bi bi-arrow-repeat fs-1 text-info opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-0">{{ $aspirasis->where('status', 'Selesai')->count() }}</h3>
                        <p class="text-muted mb-0">Selesai</p>
                    </div>
                    <i class="bi bi-check2-circle fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h5 class="fw-bold mb-0">Daftar Aspirasi Masuk</h5>
            <span class="badge bg-light text-dark rounded-pill px-3 py-2">Total {{ count($aspirasis) }} laporan</span>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>NIS</th><th>Laporan</th><th>Status</th><th>Foto</th><th>Feedback</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aspirasis as $aspi)
                    <tr>
                        <td class="fw-bold">{{ $aspi->nis }}</td>
                        <td>
                            <strong>{{ $aspi->kategori->ket_kategori ?? '-' }}</strong><br>
                            <small class="text-muted">{{ strlen($aspi->ket) > 80 ? substr($aspi->ket, 0, 77) . '...' : $aspi->ket }}</small>
                        </td>
                        <td>
                            <span class="badge-status {{ $aspi->status == 'Selesai' ? 'bg-success text-white' : ($aspi->status == 'Proses' ? 'bg-warning text-dark' : 'bg-danger text-white') }}">
                                {{ $aspi->status }}
                            </span>
                        </td>
                        <td>
                            @if($aspi->foto)
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $aspi->id_pelaporan }}">Lihat Foto</button>
                            @else <span class="text-muted">-</span> @endif
                        </td>
                        <td><span class="text-truncate d-inline-block" style="max-width: 180px;">{{ $aspi->feedback ?? '-' }}</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm rounded-pill mb-1" data-bs-toggle="modal" data-bs-target="#modalTanggapan{{ $aspi->id_pelaporan }}">Tanggapi</button>
                            <form action="/admin/hapus/{{ $aspi->id_pelaporan }}" method="POST" class="d-inline form-hapus">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Foto & Tanggapan (sama seperti sebelumnya) -->
                    <div class="modal fade" id="modalFoto{{ $aspi->id_pelaporan }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header"><h5 class="modal-title">Foto Bukti</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body text-center"><img src="{{ asset($aspi->foto) }}" class="img-fluid rounded" style="max-height: 70vh;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalTanggapan{{ $aspi->id_pelaporan }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/admin/feedback/{{ $aspi->id_pelaporan }}" method="POST">
                                    @csrf
                                    <div class="modal-header"><h5 class="modal-title">Umpan Balik</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                    <div class="modal-body">
                                        <div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-select rounded-pill">@foreach(['Menunggu','Proses','Selesai'] as $s)<option value="{{ $s }}" {{ $aspi->status == $s ? 'selected' : '' }}>{{ $s }}</option>@endforeach</select></div>
                                        <div class="mb-3"><label class="form-label">Feedback</label><textarea name="feedback" class="form-control rounded-3" rows="3" required>{{ $aspi->feedback }}</textarea></div>
                                    </div>
                                    <div class="modal-footer"><button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-success rounded-pill">Kirim</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function() {
            let form = this.closest('.form-hapus');
            Swal.fire({ title: 'Yakin kau, Wak?', text: "Laporan ini bakal hilang selamanya!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d', confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal' }).then((result) => { if (result.isConfirmed) form.submit(); });
        });
    });
    @if(session('success'))
        Swal.fire('Paten!', "{{ session('success') }}", 'success');
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>