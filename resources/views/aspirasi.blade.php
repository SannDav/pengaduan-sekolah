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
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .btn-primary { background-color: #007bff; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; }
        
        /* Navbar Custom */
        .navbar-nav .dropdown-menu {
            background-color: #ffffff !important;
            border: none;
            border-radius: 12px;
            margin-top: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .navbar-nav .dropdown-item { color: #333 !important; padding: 10px 20px; }
        .navbar-nav .dropdown-item:hover { background-color: #f8f9fa !important; color: #007bff !important; }
        .navbar-nav .dropdown-toggle { color: white !important; }

        /* Status Badges */
        .badge-status { padding: 8px 12px; border-radius: 30px; font-weight: 600; font-size: 11px; text-transform: uppercase; }
        
        /* Table Styling */
        .table { border-collapse: separate; border-spacing: 0 10px; }
        .table thead th { border: none; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 12px; }
        .table tbody tr { background-color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.02); transition: 0.3s; }
        .table tbody tr:hover { transform: scale(1.01); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .table tbody td { padding: 20px; vertical-align: middle; border: none; }
        .table tbody td:first-child { border-radius: 10px 0 0 10px; }
        .table tbody td:last-child { border-radius: 0 10px 10px 0; }
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
    <div class="row g-4">
        <div class="col-lg-5 mx-auto">
            <div class="card p-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-pencil-square text-primary"></i> Tulis Aspirasi</h4>
                <form action="/lapor" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-600">NIS Kau</label>
                            <input type="text" name="nis" class="form-control bg-light" value="{{ session('siswa_nis') }}" readonly required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-600">Kategori</label>
                            <select name="id_kategori" class="form-select bg-light" required>
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
                        <textarea name="ket" class="form-control" rows="3" placeholder="Jelaskan masalahnya, Lek..." required></textarea>
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

        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold m-0"><i class="bi bi-journal-text text-primary"></i> Daftar Laporan Terbaru</h4>
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
                                <div class="d-flex flex-column">
                                    <span class="badge bg-info text-dark mb-1" style="width: fit-content; font-size: 10px;">{{ $aspi->kategori->ket_kategori ?? 'Umum' }}</span>
                                    <span class="text-dark fw-bold">{{ $aspi->ket }}</span>
                                    <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $aspi->lokasi }}</small>
                                    @if($aspi->foto)
                                        <div class="mt-2">
                                            <a href="{{ asset($aspi->foto) }}" target="_blank" class="text-decoration-none">
                                                <img src="{{ asset($aspi->foto) }}" alt="Foto Aspirasi" style="max-width: 120px; max-height: 90px; object-fit: cover; border-radius: 10px;">
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