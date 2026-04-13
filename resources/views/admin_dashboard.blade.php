<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - LaporSekolah!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <h2 class="fw-bold mb-4">Daftar Aspirasi Masuk</h2>
    
    <div class="card shadow border-0 p-4">
        <table class="table table-striped align-middle">
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
                    <td>{{ $aspi->nis }}</td>
                    <td>
                        <strong>{{ $aspi->kategori->ket_kategori ?? '-' }}</strong><br>
                        <small class="text-muted">{{ $aspi->ket }}</small>
                    </td>
                    <td>
                        <span class="badge {{ $aspi->status == 'Selesai' ? 'bg-success' : ($aspi->status == 'Proses' ? 'bg-warning' : 'bg-danger') }}">
                            {{ $aspi->status }}
                        </span>
                    </td>
                    <td>
                        @if($aspi->foto)
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $aspi->id_pelaporan }}">
                                Lihat Foto
                            </button>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $aspi->feedback ?? '-' }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTanggapan{{ $aspi->id_pelaporan }}">
                            Tanggapi
                        </button>
                    
                        <form action="/admin/hapus/{{ $aspi->id_pelaporan }}" method="POST" class="d-inline form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
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