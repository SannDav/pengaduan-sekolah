<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Aspirasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eff2f7 0%, #e9edf4 100%);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
        }

        .form-card {
            border-left: 5px solid #0d6efd;
        }

        .form-card h4 {
            color: #0d6efd;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0056d6 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.25);
        }

        .form-control,
        .form-select {
            border: 1px solid #d8dee6;
            border-radius: 12px;
            background: #f9fbfd;
            padding: 12px 14px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
            background: #ffffff;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .navbar-nav .dropdown-menu {
            background-color: #ffffff !important;
            border: none;
            border-radius: 14px;
            margin-top: 15px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .navbar-nav .dropdown-item {
            color: #333 !important;
            padding: 12px 20px;
        }

        .navbar-nav .dropdown-item:hover {
            background-color: #f3f8ff !important;
            color: #0d6efd !important;
        }

        .navbar-nav .dropdown-toggle {
            color: white !important;
        }

        .badge-status {
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table thead th {
            border: none;
            color: #6c757d;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.08em;
            padding: 18px 20px;
        }

        .table tbody tr {
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border-radius: 16px;
        }

        .table tbody tr:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }

        .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border: none;
        }

        .table tbody td:first-child {
            border-radius: 16px 0 0 16px;
        }

        .table tbody td:last-child {
            border-radius: 0 16px 16px 0;
        }

        .report-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            margin-bottom: 18px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        }

        .report-card .badge {
            font-size: 11px;
            padding: 6px 12px;
        }

        .reports-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .reports-header h4 {
            margin-bottom: 0;
        }

        .highlight-box {
            background: #ffffff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
            margin-bottom: 22px;
        }

        @media (min-width: 992px) {
            .sticky-top-custom {
                position: sticky;
                top: 90px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><i class="bi bi-megaphone-fill"></i> LaporSekolah!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="bi bi-house-door"></i> Home</a>
                </li>

                @if(session('siswa_nis') || session('admin_id'))
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-dark text-white px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ session('siswa_nama') ?? session('admin_nama') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            @if(session('role') == 'siswa')
                                <li><a class="dropdown-item" href="/profile"><i class="bi bi-collection"></i> Laporan Saya</a></li>
                            @endif
                            @if(session('admin_id'))
                                <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2"></i> Dashboard Admin</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm px-4" href="/login">Masuk</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="row g-4 align-items-start">
        <div class="col-lg-7">
            <div class="highlight-box">
                <div class="reports-header">
                    <h4 class="fw-bold"><i class="bi bi-journal-text text-primary"></i> Daftar Laporan Terbaru</h4>
                    <span class="badge bg-white text-dark shadow-sm border p-2">Total: {{ count($aspirasis) }} Laporan</span>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th style="width: 10%">NIS</th>
                                <th style="width: 40%">Rincian Laporan</th>
                                <th style="width: 15%">Status</th>
                                <th style="width: 35%">Tanggapan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasis as $aspi)
                            <tr>
                                <td class="fw-bold text-primary">{{ $aspi->nis }}</td>
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="badge bg-info text-dark" style="width: fit-content; font-size: 10px;">{{ $aspi->kategori->ket_kategori ?? 'Umum' }}</span>
                                        <span class="text-dark fw-bold">{{ $aspi->ket }}</span>
                                        <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $aspi->lokasi }}</small>
                                        @if($aspi->foto)
                                            <div class="mt-2">
                                                <a href="{{ asset($aspi->foto) }}" target="_blank" class="text-decoration-none">
                                                    <img src="{{ asset($aspi->foto) }}" alt="Foto Aspirasi" style="max-width: 140px; max-height: 100px; object-fit: cover; border-radius: 12px;">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($aspi->status == 'Selesai')
                                        <span class="badge-status bg-success text-white">Selesai</span>
                                    @elseif($aspi->status == 'Proses')
                                        <span class="badge-status bg-warning text-dark">Proses</span>
                                    @else
                                        <span class="badge-status bg-danger text-white">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($aspi->feedback)
                                        <div class="p-3 rounded-3 bg-light border-start border-primary border-4 shadow-sm">
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="bi bi-chat-left-text-fill text-primary me-2"></i>
                                                <small class="fw-bold">Admin Berkata:</small>
                                            </div>
                                            <p class="mb-0 text-dark small fst-italic">"{{ $aspi->feedback }}"</p>
                                        </div>
                                    @else
                                        <div class="text-muted small">
                                            <div class="spinner-grow spinner-grow-sm text-secondary me-1" role="status"></div>
                                            <i>Menunggu verifikasi admin...</i>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card p-4 form-card sticky-top-custom">
                <h4 class="fw-bold mb-3"><i class="bi bi-pencil-square text-primary"></i> Tulis Aspirasi</h4>
                <form action="/lapor" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-600">NIS Kau</label>
                            <input type="text" name="nis" class="form-control" value="{{ session('siswa_nis') }}" readonly required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-600">Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600">Lokasi Kejadian</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Kantin, Kelas XII RPL 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600">Laporan</label>
                        <textarea name="ket" class="form-control" rows="4" placeholder="Jelaskan masalahnya, Lek..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600">Foto Bukti (Opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif">
                        <small class="text-muted">Unggah foto jika ingin memperjelas laporan, maksimal 2MB.</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 shadow-sm">Kirim Laporan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Alert logic tetep sama kek kemaren
    @if(session('success'))
        Swal.fire({ title: 'Paten Kali!', text: "{{ session('success') }}", icon: 'success', confirmButtonColor: '#007bff' });
    @endif

    @if($errors->any())
        Swal.fire({ title: 'Aduhh!', html: '{!! implode("<br>", $errors->all()) !!}', icon: 'error', confirmButtonColor: '#dc3545' });
    @endif

    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        Swal.fire({ title: 'Sabar ya, Wak...', text: 'Lagi kita kirim laporan kau', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>