<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa Saya - Lumen-K</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">LUMEN-K PORTAL</a>
            <div class="navbar-nav ms-auto flex-row gap-3">
                <a class="nav-link text-white-50" href="{{ route('customer.katalog') }}">Katalog</a>
                <a class="nav-link active text-white fw-semibold" href="{{ route('customer.riwayat') }}">Riwayat Sewa</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Riwayat Penyewaan Anda</h2>
                <p class="text-muted">Seluruh transaksi penyewaan Anda tercatat otomatis secara real-time di bawah ini.</p>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">Waktu Transaksi</th>
                                <th>Nama Alat</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Total Biaya</th>
                                <th class="pe-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $transaksi)
                                <tr>
                                    <td class="ps-3 text-muted small">{{ $transaksi->created_at->format('d M Y, H:i') }} WIB</td>
                                    <td class="fw-bold text-dark">{{ $transaksi->alat->nama_alat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tgl_sewa)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d M Y') }}</td>
                                    <td class="text-primary fw-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                    <td class="pe-3">
                                        @if($transaksi->status == 'dipinjam')
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Sedang Dipinjam</span>
                                        @else
                                            <span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        Anda belum pernah melakukan transaksi penyewaan alat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>