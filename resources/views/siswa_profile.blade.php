<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .profile-header { background: linear-gradient(135deg, #007bff 0%, #00d2ff 100%); color: white; border-radius: 15px; padding: 30px; margin-bottom: 30px; }
        .badge-status { padding: 8px 12px; border-radius: 30px; font-weight: 600; font-size: 11px; text-transform: uppercase; }
        .table { border-collapse: separate; border-spacing: 0 10px; }
        .table tbody tr { background-color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
        .table tbody td { padding: 15px; vertical-align: middle; border: none; }
        .table tbody td:first-child { border-radius: 10px 0 0 10px; }
        .table tbody td:last-child { border-radius: 0 10px 10px 0; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><i class="bi bi-megaphone-fill"></i> LaporSekolah!</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house-door"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/aspirasi"><i class="bi bi-chat-left-text"></i> Semua Laporan</a></li>
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle btn btn-dark text-white px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ $user->nama }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="/profile">Laporan Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="profile-header shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-2 text-center mb-3 mb-md-0">
                <i class="bi bi-person-bounding-box" style="font-size: 80px;"></i>
            </div>
            <div class="col-md-10">
                <h2 class="fw-bold mb-1">{{ $user->nama }}</h2>
                <p class="mb-0 fs-5"><i class="bi bi-card-text"></i> NIS: {{ $user->nis }} | <i class="bi bi-door-open"></i> Kelas: {{ $user->kelas }}</p>
                <span class="badge bg-white text-primary mt-2">Siswa Aktif</span>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h4 class="fw-bold mb-4"><i class="bi bi-clock-history text-primary"></i> Riwayat Laporan Saya</h4>
        
        @if($laporan_saya->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-emoji-smile text-muted" style="font-size: 50px;"></i>
                <p class="text-muted mt-2">Belum ada laporan, Wak. Aman-aman aja sekolah kita ya?</p>
                <a href="/aspirasi" class="btn btn-primary btn-sm">Buat Laporan Sekarang</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th>Tanggal</th>
                            <th>Isi Laporan</th>
                            <th>Status</th>
                            <th>Feedback Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan_saya as $laporan)
                        <tr>
                            <td class="small">{{ $laporan->created_at->format('d M Y') }}</td>
                            <td>
                                <strong>{{ $laporan->kategori->ket_kategori }}</strong><br>
                                <span class="text-muted">{{ $laporan->ket }}</span>
                            </td>
                            <td>
                                @if($laporan->status == 'Selesai')
                                    <span class="badge-status bg-success text-white">Selesai</span>
                                @elseif($laporan->status == 'Proses')
                                    <span class="badge-status bg-warning text-dark">Proses</span>
                                @else
                                    <span class="badge-status bg-danger text-white">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if($laporan->feedback)
                                    <small class="fst-italic text-primary fw-bold">"{{ $laporan->feedback }}"</small>
                                @else
                                    <small class="text-muted fst-italic">Belum ada tanggapan</small>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>