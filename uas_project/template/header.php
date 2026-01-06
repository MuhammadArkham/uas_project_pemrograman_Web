<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkham Store - Electronics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --space-dark: #0b1120; /* Lebih gelap agar kontras */
            --space-card: #1e293b;
            --neon-teal: #06b6d4; /* Cyan lebih terang */
            --text-main: #e2e8f0;
            --text-dim: #94a3b8; /* Ganti text-muted dengan ini */
        }
        body {
            background-color: var(--space-dark);
            color: var(--text-main);
            font-family: 'Rajdhani', sans-serif;
            /* Background efek nebula halus */
            background-image: radial-gradient(circle at 50% 0%, rgba(6, 182, 212, 0.15) 0%, transparent 50%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Perbaikan Navbar agar simetris */
        .navbar-space {
            background: rgba(11, 17, 32, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(6, 182, 212, 0.3);
            padding: 15px 0;
        }
        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-teal) !important;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 2px;
            text-shadow: 0 0 15px rgba(6, 182, 212, 0.6);
        }
        .nav-link {
            font-size: 1.1rem;
            font-weight: 600;
            transition: color 0.3s;
        }
        .nav-link:hover {
            color: var(--neon-teal) !important;
            text-shadow: 0 0 8px rgba(6, 182, 212, 0.4);
        }
        /* Custom Button yang menyala */
        .btn-teal {
            background: linear-gradient(45deg, var(--neon-teal), #0891b2);
            color: #fff;
            border: none;
            font-family: 'Orbitron', sans-serif;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-teal:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(6, 182, 212, 0.6);
            color: #fff;
        }
        .text-dim { color: var(--text-dim) !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-space fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">ARKHAM STORE</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: var(--neon-teal);">
      <span class="navbar-toggler-icon" style="background-color: var(--neon-teal);"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item px-2">
            <a class="nav-link text-white" href="?mod=home&page=dashboard">BERANDA</a>
        </li>
        <li class="nav-item px-2">
            <a class="nav-link text-white" href="?mod=barang&page=katalog">PRODUK</a>
        </li>
        
        <?php if(isset($_SESSION['is_login'])): ?>
            <li class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle text-info" href="#" role="button" data-bs-toggle="dropdown">
                    <?= strtoupper($_SESSION['username']) ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark border-info">
                    <li><a class="dropdown-item text-danger" href="?mod=auth&page=logout">LOGOUT</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item px-2">
                <a class="btn btn-sm btn-outline-info px-4 py-2 rounded-pill fw-bold" href="?mod=auth&page=login" style="border: 1px solid var(--neon-teal); color: var(--neon-teal);">LOGIN</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container d-flex flex-column" style="margin-top: 80px; flex: 1; min-height: 60vh;">