<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifikasi — LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f1729; --text: #e8edf8; --text-soft: #94a3b8; --text-dim: #64748b;
            --gb: rgba(99,130,255,0.1); --indigo: #6574f8; --indigo-dk: #4a5ae0;
            --teal: #2dd4bf; --rose: #fb7185; --amber: #fbbf24; --emerald: #34d399;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh;
        }
        body::before {
            content: ''; position: fixed; inset: 0;
            background-image: linear-gradient(rgba(99,130,255,0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(99,130,255,0.04) 1px, transparent 1px);
            background-size: 48px 48px; pointer-events: none; z-index: 0;
        }
        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; top: -100px; right: -80px; background: radial-gradient(circle, rgba(101,116,248,0.35), transparent 70%); }
        .orb-2 { width: 350px; height: 350px; bottom: -60px; left: -60px; background: radial-gradient(circle, rgba(45,212,191,0.25), transparent 70%); }

        .navbar { position: sticky; top: 0; z-index: 100; background: rgba(10,16,32,0.88); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(99,130,255,0.1); padding: 0.85rem 0; }
        .navbar-brand { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.2rem; color: var(--text) !important; display: flex; align-items: center; gap: 0.55rem; }
        .brand-icon { width: 32px; height: 32px; border-radius: 9px; background: linear-gradient(135deg, var(--indigo), var(--teal)); display: flex; align-items: center; justify-content: center; font-size: 0.82rem; }
        .nav-link { color: var(--text-soft) !important; font-weight: 500; padding: 0.45rem 1rem !important; border-radius: 999px; font-size: 0.9rem; transition: all 0.2s; }
        .nav-link:hover { color: var(--text) !important; background: rgba(99,130,255,0.1); }
        .dropdown-toggle-pill { background: rgba(99,130,255,0.1) !important; color: var(--text) !important; border-radius: 999px !important; padding: 0.45rem 1.1rem !important; font-weight: 500; border: 1px solid var(--gb) !important; box-shadow: none !important; }
        .dropdown-menu { background: rgba(10,16,32,0.97) !important; backdrop-filter: blur(18px); border: 1px solid var(--gb) !important; border-radius: 1.1rem !important; box-shadow: 0 20px 50px rgba(0,0,0,0.4) !important; padding: 0.5rem !important; }
        .dropdown-item { color: var(--text-soft) !important; border-radius: 0.65rem; padding: 0.6rem 1rem; font-size: 0.88rem; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(99,130,255,0.12) !important; color: var(--text) !important; }

        .page-wrap { position: relative; z-index: 1; padding: 2.5rem 0 5rem; }
        .page-hero { background: linear-gradient(135deg, rgba(101,116,248,0.15) 0%, rgba(15,23,42,0.9) 60%); border: 1px solid var(--gb); border-radius: 1.75rem; padding: 2.25rem; margin-bottom: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.04); position: relative; overflow: hidden; }
        .page-hero::after { content: ''; position: absolute; top: -60px; right: -60px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(101,116,248,0.18), transparent 70%); }
        .hero-label { display: inline-flex; align-items: center; gap: 0.45rem; background: rgba(101,116,248,0.12); border: 1px solid rgba(101,116,248,0.22); color: #a5b4fc; border-radius: 999px; padding: 0.3rem 0.85rem; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.04em; margin-bottom: 1rem; }
        .hero-logo { display: flex; justify-content: center; margin-bottom: 1.5rem; }
        .logo-icon { position: relative; width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--indigo), var(--teal)); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; box-shadow: 0 20px 40px rgba(101,116,248,0.4), 0 0 0 4px rgba(101,116,248,0.1); animation: logoPulse 2s ease-in-out infinite; }
        .logo-glow { position: absolute; inset: -10px; border-radius: 50%; background: radial-gradient(circle, rgba(101,116,248,0.3), transparent 70%); animation: logoGlow 3s ease-in-out infinite; }
        @keyframes logoPulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        @keyframes logoGlow { 0%, 100% { opacity: 0.3; transform: scale(1); } 50% { opacity: 0.6; transform: scale(1.1); } }
        .page-hero h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(1.6rem, 3vw, 2.2rem); line-height: 1.2; color: var(--text); margin-bottom: 0.6rem; }
        .page-hero p { color: var(--text-soft); font-size: 0.9rem; max-width: 520px; margin-bottom: 0; }

        .content-card { background: rgba(15,23,42,0.7); backdrop-filter: blur(16px); border: 1px solid var(--gb); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
        .card-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
        .card-title { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1.05rem; color: var(--text); display: flex; align-items: center; gap: 0.55rem; margin: 0; }
        .card-title i { color: var(--indigo); }

        .notification-item { background: rgba(99,130,255,0.06); border: 1px solid rgba(99,130,255,0.12); border-radius: 1rem; padding: 1.25rem; margin-bottom: 1rem; transition: all 0.2s; cursor: pointer; }
        .notification-item:hover { background: rgba(99,130,255,0.1); border-color: rgba(99,130,255,0.2); }
        .notification-item.unread { border-left: 4px solid var(--indigo); background: rgba(101,116,248,0.08); }
        .notification-title { font-weight: 600; color: var(--text); margin-bottom: 0.25rem; }
        .notification-message { color: var(--text-soft); font-size: 0.9rem; margin-bottom: 0.5rem; }
        .notification-time { color: var(--text-dim); font-size: 0.8rem; }
        .badge-unread { background: var(--indigo); color: #fff; font-size: 0.7rem; padding: 0.2rem 0.5rem; border-radius: 999px; }

        .btn-mark-all { display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.6rem 1.25rem; border-radius: 999px; background: rgba(101,116,248,0.08); border: 1px solid rgba(101,116,248,0.25); color: #a5b4fc; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: all 0.2s; }
        .btn-mark-all:hover { background: rgba(101,116,248,0.16); color: #c7d2fe; }

        .pagination { justify-content: center; }
        .page-link { background: rgba(99,130,255,0.06); border-color: rgba(99,130,255,0.12); color: var(--text-soft); }
        .page-link:hover { background: rgba(99,130,255,0.1); color: var(--text); }
        .page-item.active .page-link { background: var(--indigo); border-color: var(--indigo); }

        footer { position: relative; z-index: 1; border-top: 1px solid rgba(99,130,255,0.08); padding: 1.5rem 0; text-align: center; color: var(--text-dim); font-size: 0.83rem; }
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
                    <li class="nav-item"><a class="nav-link" href="/aspirasi"><i class="bi bi-journal-text me-1"></i>Semua Laporan</a></li>
                    @if(session('siswa_nis'))
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle-pill" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ session('siswa_nama') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile"><i class="bi bi-collection me-2"></i>Laporan Saya</a></li>
                                <li><a class="dropdown-item active" href="/notifications"><i class="bi bi-bell me-2"></i>Notifikasi</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li><a class="dropdown-item" href="/logout" style="color: var(--rose) !important;"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
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
                        <i class="bi bi-bell-fill"></i>
                        <div class="logo-glow"></div>
                    </div>
                </div>
                <div class="hero-label"><i class="bi bi-bell-fill me-1"></i> Notifikasi</div>
                <h1>Pemberitahuan Terbaru</h1>
                <p>Dapatkan update status laporan kamu secara real-time.</p>
            </div>

            <!-- NOTIFICATIONS LIST -->
            <div class="content-card">
                <div class="card-head">
                    <h4 class="card-title"><i class="bi bi-bell"></i> Daftar Notifikasi</h4>
                    <button class="btn-mark-all" onclick="markAllAsRead()">Tandai Semua Dibaca</button>
                </div>

                @forelse($notifications as $notif)
                <div class="notification-item {{ $notif->read_at ? '' : 'unread' }}" onclick="markAsRead({{ $notif->id }})">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="notification-title">{{ $notif->title }}</div>
                            <div class="notification-message">{{ $notif->message }}</div>
                            <div class="notification-time">{{ $notif->created_at->diffForHumans() }}</div>
                        </div>
                        @if(!$notif->read_at)
                        <span class="badge-unread">Baru</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash" style="font-size: 3rem; color: var(--text-dim);"></i>
                    <h5 class="mt-3 text-muted">Belum ada notifikasi</h5>
                    <p class="text-muted">Notifikasi akan muncul saat ada update pada laporan kamu.</p>
                </div>
                @endforelse

                {{ $notifications->links() }}
            </div>
        </div>
    </div>

    <footer>
        <div class="container">© 2026 LaporSekolah! — Suara siswa, perubahan nyata.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function markAsRead(id) {
            try {
                const response = await fetch(`/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });
                if (response.ok) {
                    location.reload(); // Refresh untuk update UI
                }
            } catch (error) {
                console.error('Error marking as read:', error);
            }
        }

        async function markAllAsRead() {
            try {
                const response = await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });
                if (response.ok) {
                    location.reload();
                }
            } catch (error) {
                console.error('Error marking all as read:', error);
            }
        }
    </script>
</body>
</html>