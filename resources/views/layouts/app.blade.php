<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pelanggaran & Tata Tertib Sekolah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background: #f4f6f9;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1d2939;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar .brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar .brand-title {
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 0;
        }
        .sidebar .brand-sub {
            color: #8b95a5;
            font-size: 0.75rem;
        }
        .sidebar-section {
            color: #6b7280;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem 0.5rem;
        }
        .sidebar .nav-link {
            color: #cbd2dc;
            padding: 0.65rem 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            border-left: 3px solid transparent;
            transition: all 0.15s ease;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-left: 3px solid #2a9d8f;
            font-weight: 600;
        }
        .sidebar .nav-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
        }
        .main-content {
            margin-left: 250px;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.9rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-chip {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #264653;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <p class="brand-title mb-0">SPPTTS</p>
            <p class="brand-sub mb-0">Sistem Pelanggaran & Tata Tertib</p>
        </div>

        <div class="sidebar-section">Menu Utama</div>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard.bk') }}" class="nav-link {{ request()->routeIs('dashboard.bk') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
        </nav>

        <div class="sidebar-section">Pelanggaran & Poin</div>
        <nav class="nav flex-column">
            <a href="{{ route('pelanggaran.index') }}" class="nav-link {{ request()->routeIs('pelanggaran.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-triangle-fill"></i> Data Pelanggaran
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-chat-left-text-fill"></i> Pembinaan Siswa
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-file-earmark-text-fill"></i> Surat Perjanjian (SP)
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-bar-chart-fill"></i> Rekap Laporan Bulanan
            </a>
        </nav>

        <div class="sidebar-section">Akun</div>
        <nav class="nav flex-column">
            <a href="#" class="nav-link">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="topbar">
            <h6 class="mb-0 fw-semibold text-dark">@yield('title', 'Dashboard')</h6>
            <div class="user-chip">
                <div class="text-end d-none d-sm-block">
                    <div class="small fw-semibold text-dark">Ahmad Fauzan, S.Pd</div>
                    <div class="small text-muted" style="font-size:0.75rem;">Guru BK</div>
                </div>
                <div class="user-avatar">AF</div>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
