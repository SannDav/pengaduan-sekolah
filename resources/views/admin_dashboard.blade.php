<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: #eef2f7;
            color: #27374d;
            min-height: 100vh;
        }

        .navbar {
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .dashboard-summary .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
            background: #ffffff;
        }

        .dashboard-summary .card h3 {
            font-size: 2rem;
            margin-bottom: 0;
        }

        .dashboard-summary .card p {
            margin-bottom: 0;
            color: #677489;
        }

        .card-compact {
            border-radius: 22px;
            border: none;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
        }

        .table-responsive {
            overflow: hidden;
            border-radius: 20px;
        }

        .table thead th {
            border-bottom: none;
            color: #6c757d;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .table tbody tr {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }

        .table tbody td {
            border: none;
            vertical-align: middle;
        }

        .badge-status {
            font-size: 0.75rem;
            letter-spacing: 0.04em;
            padding: 0.7em 1em;
            border-radius: 999px;
        }

        .action-buttons .btn {
            min-width: 100px;
        }

        .card-header-sm {
            border-bottom: none;
        }

        .summary-top {
            color: #4a5d79;
        }

        .summary-top small {
            color: #6c7a93;
        }

        .modal-content {
            border-radius: 18px;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin">Admin: {{ session('admin_nama') }}</a>
        <div class="d-flex">
            <a href="/" class="btn btn-outline-light btn-sm me-2">Beranda</a>
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-2">Dashboard Admin</h2>
            <p class="text-muted mb-0">Kelola aspirasi siswa dengan mudah, pantau status, dan berikan feedback dalam satu tampilan.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="/" class="btn btn-outline-secondary btn-sm">Beranda</a>
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <div class="row g-3 dashboard-summary mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h3>{{ count($aspirasis) }}</h3>
                        <p class="mb-0">Total Laporan</p>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">Semua</span>
                </div>
                <small class="text-muted">Semua laporan aspirasi masuk yang menunggu tindakan admin.</small>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h3>{{ $aspirasis->where('status', 'Menunggu')->count() }}</h3>
                        <p class="mb-0">Menunggu</p>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning py-2 px-3">Butuh Tindakan</span>
                </div>
                <small class="text-muted">Laporan yang belum diproses atau ditanggapi admin.</small>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h3>{{ $aspirasis->where('status', 'Proses')->count() }}</h3>
                        <p class="mb-0">Proses</p>
                    </div>
                    <span class="badge bg-info bg-opacity-10 text-info py-2 px-3">Sedang Berjalan</span>
                </div>
                <small class="text-muted">Laporan yang sedang ditindaklanjuti oleh petugas.</small>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h3>{{ $aspirasis->where('status', 'Selesai')->count() }}</h3>
                        <p class="mb-0">Selesai</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">Tuntas</span>
                </div>
                <small class="text-muted">Laporan yang sudah selesai ditangani oleh admin.</small>
            </div>
        </div>
    </div>

    <div class="card card-compact p-4">
        <div class="card-header card-header-sm px-0 pb-3 mb-3 border-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <div>
                <h5 class="mb-1">Daftar Aspirasi Masuk</h5>
                <p class="text-muted small mb-0">Data terbaru diurutkan berdasarkan tanggal masuk.</p>
            </div>
            <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">Total {{ count($aspirasis) }}</span>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Laporan</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Feedback</th>
                        <th>Aksi</th>
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
                            <span class="badge-status {{ $aspi->status == 'Selesai' ? 'bg-success text-white' : ($aspi->status == 'Proses' ? 'bg-info text-dark' : 'bg-warning text-dark') }}">
                                {{ $aspi->status }}
                            </span>
                        </td>
                        <td>
                            @if($aspi->foto)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $aspi->id_pelaporan }}">
                                    Lihat Foto
                                </button>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-truncate d-inline-block" style="max-width: 180px;">
                                {{ $aspi->feedback ?? '-' }}
                            </span>
                        </td>
                        <td class="action-buttons">
                            <button class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTanggapan{{ $aspi->id_pelaporan }}">
                                Tanggapi
                            </button>
                            <form action="/admin/hapus/{{ $aspi->id_pelaporan }}" method="POST" class="d-inline form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-outline-danger btn-sm btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalFoto{{ $aspi->id_pelaporan }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Foto Bukti Laporan (NIS: {{ $aspi->nis }})</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset($aspi->foto) }}" alt="Foto Aspirasi" class="img-fluid rounded" style="max-height: 70vh;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalTanggapan{{ $aspi->id_pelaporan }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/admin/feedback/{{ $aspi->id_pelaporan }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Beri Umpan Balik (NIS: {{ $aspi->nis }})</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Ubah Status</label>
                                            <select name="status" class="form-select">
                                                <option value="Menunggu" {{ $aspi->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="Proses" {{ $aspi->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="Selesai" {{ $aspi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Isi Feedback (Maks 50 Huruf)</label>
                                            <textarea name="feedback" class="form-control" rows="3" required>{{ $aspi->feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Kirim Feedback</button>
                                    </div>
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
    // Cari semua tombol yang punya class btn-hapus
    const btnHapus = document.querySelectorAll('.btn-hapus');
    
    btnHapus.forEach(btn => {
        btn.addEventListener('click', function() {
            const form = this.closest('.form-hapus'); // Cari form terdekat
            
            Swal.fire({
                title: 'Yakin kau, Wak?',
                text: "Laporan ini bakal hilang selamanya kek mantan kau!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Aja!',
                cancelButtonText: 'Gak Jadi, Khilaf'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Kalau OK, baru kirim form-nya
                }
            })
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success'))
    <script>Swal.fire('Paten!', "{{ session('success') }}", 'success');</script>
@endif
</body>
</html>