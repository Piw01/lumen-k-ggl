<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lumen-K | Equipment Rental' }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome untuk Icon Kamera/Video -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts (Inter untuk kesan modern/techy ala Death Stranding) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Custom CSS bawaan Lumen-K -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0a0a; /* Hitam pekat */
            color: #e5e5e5;
        }

        /* Aksen warna khas Death Stranding (Kuning/Emas) */
        :root {
            --ds-accent: #facc15; 
            --ds-darker: #ca8a04;
        }

        .navbar {
            background-color: rgba(10, 10, 10, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #333;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 2px;
            color: var(--ds-accent) !important;
        }

        .nav-link {
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--ds-accent) !important;
        }

        .ds-btn {
            background-color: transparent;
            color: var(--ds-accent);
            border: 1px solid var(--ds-accent);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 0; /* Mengotak, kesan industrial */
            transition: all 0.3s ease;
        }

        .ds-btn:hover {
            background-color: var(--ds-accent);
            color: #000;
        }

        /* Styling untuk card/tabel agar nyambung dengan tema */
        .card {
            background-color: #171717;
            border: 1px solid #333;
            border-radius: 4px;
        }

        .table-dark {
            --bs-table-bg: #171717;
            --bs-table-border-color: #333;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Top Navigation / Header -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top px-3">
        <div class="container-fluid">
            <!-- Logo / Nama Web -->
            <a class="navbar-brand" href="/">
                <i class="fa-solid fa-camera-retro me-2"></i>LUMEN-K
            </a>
            
            <button class="navbar-toggler ds-btn border-0" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kategori">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/alat">Katalog Alat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pelanggan">Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/transaksi">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT AREA (SLOT) -->
    <!-- Di sinilah halaman-halaman lain akan disuntikkan -->
    <main class="flex-grow-1 container py-5">
        {{ $slot }}
    </main>

    <!-- Footer Industrial -->
    <footer class="py-4 text-center mt-auto" style="border-top: 1px solid #333; background-color: #0a0a0a;">
        <div class="container text-muted small">
            <p class="mb-1 fw-bold" style="letter-spacing: 1px;">LUMEN-K EQUIPMENT RENTALS</p>
            <p class="mb-0">&copy; 2026 BRIDGES NETWORK - ALL RIGHTS RESERVED.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>