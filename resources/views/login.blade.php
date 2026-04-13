<!DOCTYPE html>
<html>
<head>
    <title>Login - LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #007bff 0%, #00d2ff 100%); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border: none; border-radius: 15px; }
        .nav-tabs .nav-link { color: #555; font-weight: 600; }
        .nav-tabs .nav-link.active { color: #007bff; border-bottom: 3px solid #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card shadow mx-auto" style="max-width: 400px;">
            <div class="card-body p-4">
                <h3 class="text-center fw-bold mb-4">Masuk ke Sistem</h3>
                
                <ul class="nav nav-tabs nav-justified mb-4" id="loginTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa" type="button">Siswa</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button">Admin</button>
                    </li>
                </ul>

                <div class="tab-content" id="loginTabContent">
                    <div class="tab-pane fade show active" id="siswa" role="tabpanel">
                        <form action="/login-siswa" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS kau" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password kau" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login Siswa</button>
                            <div class="text-center mt-3">
                                <small>Belum punya akun? <a href="/register">Daftar di sini</a></small>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="admin" role="tabpanel">
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Username Admin</label>
                                <input type="text" name="username" class="form-control" placeholder="Username admin" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Admin</label>
                                <input type="password" name="password" class="form-control" placeholder="Password admin" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Login Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>