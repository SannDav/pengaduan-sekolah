<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporSekolah! - Suara Siswa Masa Depan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { transition: 0.3s; }
        .hero-section {
            background: linear-gradient(135deg, #007bff 0%, #00d2ff 100%);
            min-height: 90vh;
            display: flex;
            align-items: center;
            color: white;
            padding: 50px 0;
        }
        .hero-img {
            max-width: 100%;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-white { background: white; color: #007bff; border: none; }
        .btn-white:hover { background: #f0f0f0; transform: translateY(-3px); }
        .card-feature { border: none; border-radius: 15px; transition: 0.3s; }
        .card-feature:hover { transform: translateY(-10px); }

        /* --- INI JURUS UTAMA BIAR DROPDOWN GAK TRANSPARAN --- */
.navbar-nav .dropdown-menu {
    background-color: #ffffff !important; /* Paksa jadi putih bersih! */
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 8px; /* Biar ujungnya sikit tumpul */
    margin-top: 10px; /* Jarak sikit dari navbar biar gak nempel kali */
}

/* --- Ini biar teks di dropdown item hitam pekat dan gak ikutan hover --- */
.navbar-nav .dropdown-item {
    color: #333 !important; /* Warna teks dropdown item hitam pekat */
}

/* --- Ini warna pas di-hover --- */
.navbar-nav .dropdown-item:hover {
    background-color: #f1f1f1 !important; /* Warna background tipis pas hover */
    color: #007bff !important; /* Teks jadi biru */
}

/* --- Ini biar tombol dropdown-nya kelihatan jelas --- */
.navbar-nav .dropdown-toggle {
    color: white !important; /* Warna teks tombol putih */
}

.navbar-nav .dropdown-toggle:after {
    color: white !important; /* Warna panah putih */
}

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/"><i class="bi bi-megaphone-fill"></i> LaporSekolah!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/aspirasi">Semua Laporan</a>
                    </li>

                    @if(session('siswa_nis'))
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle btn btn-dark text-white px-3" href="#" id="navSiswa" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ session('siswa_nama') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="/profile"><i class="bi bi-collection"></i> Laporan Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    @elseif(session('admin_id'))
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle btn btn-dark text-white px-3" href="#" id="navAdmin" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-lock"></i> Admin: {{ session('admin_nama') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="/admin">Dashboard Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-outline-light px-4" href="/login">Masuk Akun</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">Ada Masalah di Sekolah? Tuntaskan Sini, Wak!</h1>
                    <p class="lead mb-4">Gak usah dipendam sendiri. Mau bangku rusak, WC macet, atau mau kasih ide gila, lapor aja. Rahasia terjamin, eksekusi terjamin!</p>
                    
                    <div class="d-flex gap-3">
                        @if(session('siswa_nis'))
                            <a href="/aspirasi" class="btn-custom btn-white shadow">Tulis Laporan Baru</a>
                        @elseif(session('admin_id'))
                            <a href="/admin" class="btn-custom btn-white shadow">Lihat Laporan Masuk</a>
                        @else
                            <a href="/login" class="btn-custom btn-white shadow">Login & Melapor</a>
                        @endif
                        <a href="#tentang" class="btn-custom btn-outline-light">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <img src="https://illustrations.popsy.co/white/abstract-art-4.svg" alt="Hero Image" class="hero-img" style="width: 80%;">
                </div>
            </div>
        </div>
    </header>

    <section id="tentang" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Cemana Alurnya, Lek?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card card-feature shadow-sm p-4 h-100">
                        <div class="display-5 text-primary mb-3"><i class="bi bi-pencil-square"></i></div>
                        <h4 class="fw-bold">1. Tulis Laporan</h4>
                        <p class="text-muted">Login pake NIS kau, terus ceritakan masalah atau aspirasi kau dengan jujur.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-feature shadow-sm p-4 h-100">
                        <div class="display-5 text-warning mb-3"><i class="bi bi-gear-wide-connected"></i></div>
                        <h4 class="fw-bold">2. Proses Verifikasi</h4>
                        <p class="text-muted">Admin bakal nengok laporan kau. Statusnya bakal berubah jadi 'Proses'.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-feature shadow-sm p-4 h-100">
                        <div class="display-5 text-success mb-3"><i class="bi bi-check-all"></i></div>
                        <h4 class="fw-bold">3. Dapat Feedback</h4>
                        <p class="text-muted">Masalah kelar, kau bakal dapat umpan balik langsung dari admin di aplikasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 LaporSekolah! - Tugas UKK Paling Paten Se-Medan.</p>
            <small class="text-muted">Dibuat dengan keringat dan bantuan AI kawan akrabmu.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>