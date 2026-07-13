<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Rental - Lumen-K</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">LUMEN-K PORTAL</a>
            <div class="navbar-nav ms-auto flex-row gap-3">
                <a class="nav-link active text-white fw-semibold" href="{{ route('customer.katalog') }}">Katalog</a>
                <a class="nav-link text-white-50" href="{{ route('customer.riwayat') }}">Riwayat Sewa</a>
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
                <h2 class="fw-bold">Katalog Alat Fotografi & Videografi</h2>
                <p class="text-muted">Pilih alat terbaik untuk mendukung produksi profesional Anda.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($alats as $alat)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <span class="badge bg-secondary mb-2">{{ $alat->kategori->nama_kategori }}</span>
                            <h5 class="card-title fw-bold mb-1">{{ $alat->nama_alat }}</h5>
                            <p class="text-muted small mb-3">Merk: {{ $alat->merk }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary fw-bold fs-5">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }}<small class="text-muted fs-6">/hari</small></span>
                                <span class="badge bg-success-subtle text-success">Stok: {{ $alat->stok }}</span>
                            </div>

                            <hr>

                            <!-- Form Sewa Mandiri -->
                            <form action="{{ route('customer.sewa', $alat->id) }}" method="POST">
                                @csrf
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label small fw-semibold">Tgl Sewa</label>
                                        <input type="date" name="tgl_sewa" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-semibold">Tgl Kembali</label>
                                        <input type="date" name="tgl_kembali" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold">Sewa Alat Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>