<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IT-TIMS Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f6fa;
            color: #1f2937;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            background: #0f172a;
            color: white;
            padding: 24px 16px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            padding: 0 12px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .brand h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .brand p {
            margin: 6px 0 0;
            font-size: 12px;
            color: #94a3b8;
        }

        .menu {
            margin-top: 25px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            color: #64748b;
            margin: 0 12px 10px;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #cbd5e1;
            padding: 12px 14px;
            margin-bottom: 6px;
            border-radius: 9px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #1e293b;
            color: white;
        }

        .icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 32px;
        }

        .topbar-left h2 {
            margin: 0;
            font-size: 22px;
        }

        .topbar-left span {
            font-size: 13px;
            color: #64748b;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #334155;
        }

        .profile-text strong {
            display: block;
            font-size: 14px;
        }

        .profile-text span {
            font-size: 11px;
            color: #64748b;
        }

        .content {
            padding: 30px;
        }

        /* =========================
           WELCOME
        ========================= */

        .welcome {
            background: linear-gradient(135deg, #111827, #1e3a8a);
            color: white;
            border-radius: 16px;
            padding: 28px 30px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border: 40px solid rgba(255,255,255,0.05);
            border-radius: 50%;
            right: -70px;
            top: -100px;
        }

        .welcome h3 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .welcome p {
            margin: 0;
            color: #cbd5e1;
            font-size: 14px;
        }

        /* =========================
           STAT CARDS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            font-size: 13px;
            color: #64748b;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 17px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 700;
            margin-top: 14px;
        }

        .stat-note {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 5px;
        }

        /* =========================
           GRID
        ========================= */

        .grid {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 20px;
        }

        .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .panel-header h3 {
            margin: 0;
            font-size: 16px;
        }

        .panel-header span {
            font-size: 12px;
            color: #64748b;
        }

        /* =========================
           SITE OVERVIEW
        ========================= */

        .site-box {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
        }

        .site-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .site-name {
            font-size: 16px;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            background: #dcfce7;
            color: #166534;
        }

        .site-location {
            margin-top: 5px;
            font-size: 12px;
            color: #64748b;
        }

        .site-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 20px;
            border-top: 1px solid #e5e7eb;
            padding-top: 16px;
        }

        .site-stat {
            text-align: center;
            border-right: 1px solid #e5e7eb;
        }

        .site-stat:last-child {
            border-right: none;
        }

        .site-stat strong {
            display: block;
            font-size: 20px;
        }

        .site-stat span {
            font-size: 11px;
            color: #64748b;
        }

        /* =========================
           STATUS
        ========================= */

        .status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .status-row:last-child {
            border-bottom: none;
        }

        .status-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #22c55e;
        }

        .status-dot.warning {
            background: #f59e0b;
        }

        .status-text strong {
            display: block;
            font-size: 13px;
        }

        .status-text span {
            font-size: 11px;
            color: #64748b;
        }

        .status-value {
            font-size: 12px;
            font-weight: 600;
        }

        /* =========================
           QUICK ACTION
        ========================= */

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .action {
            text-decoration: none;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            padding: 15px;
            border-radius: 10px;
            background: #f8fafc;
        }

        .action:hover {
            background: #f1f5f9;
        }

        .action strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .action span {
            font-size: 11px;
            color: #64748b;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            text-align: center;
            padding: 25px;
            font-size: 11px;
            color: #94a3b8;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1200px) {
            .stats {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 20px;
            }
        }

        @media (max-width: 450px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .site-stats {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .site-stat {
                border-right: none;
            }
        }
    </style>
</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <h1>IT-TIMS</h1>
            <p>IT Tower Inspection & Maintenance System</p>
        </div>

        <div class="menu">

            <div class="menu-title">Main Menu</div>

            <a href="{{ route('dashboard') }}" class="active">
                <span class="icon">▣</span>
                Dashboard
            </a>

            <a href="#">
                <span class="icon">⌂</span>
                Sites
            </a>

            <a href="#">
                <span class="icon">▲</span>
                Towers
            </a>

            <a href="#">
                <span class="icon">◫</span>
                Assets
            </a>

            <div class="menu-title" style="margin-top: 25px;">Inspection</div>

            <a href="#">
                <span class="icon">✓</span>
                New Inspection
            </a>

            <a href="#">
                <span class="icon">▤</span>
                Inspection History
            </a>

            <a href="#">
                <span class="icon">!</span>
                Findings
            </a>

            <div class="menu-title" style="margin-top: 25px;">Maintenance</div>

            <a href="#">
                <span class="icon">⚒</span>
                Work Orders
            </a>

            <a href="#">
                <span class="icon">◴</span>
                Maintenance History
            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-left">
                <h2>Dashboard</h2>
                <span>Overview sistem IT infrastructure</span>
            </div>

            <div class="profile">
                <div class="avatar">IT</div>

                <div class="profile-text">
                    <strong>IT Admin</strong>
                    <span>Administrator</span>
                </div>
            </div>

        </header>

        <!-- CONTENT -->
        <section class="content">

            <!-- WELCOME -->
            <div class="welcome">
                <h3>Welcome to IT-TIMS 👋</h3>
                <p>
                    Pantau inspeksi tower, aset IT, temuan, dan maintenance
                    dalam satu sistem terintegrasi.
                </p>
            </div>

            <!-- STATS -->
            <div class="stats">

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Sites</span>
                        <div class="stat-icon">⌂</div>
                    </div>

                    <div class="stat-value">
                        {{ $stats['sites'] }}
                    </div>

                    <div class="stat-note">
                        Registered sites
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Towers</span>
                        <div class="stat-icon">▲</div>
                    </div>

                    <div class="stat-value">
                        {{ $stats['towers'] }}
                    </div>

                    <div class="stat-note">
                        Active tower assets
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Assets</span>
                        <div class="stat-icon">◫</div>
                    </div>

                    <div class="stat-value">
                        {{ $stats['assets'] }}
                    </div>

                    <div class="stat-note">
                        IT infrastructure assets
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Inspections</span>
                        <div class="stat-icon">✓</div>
                    </div>

                    <div class="stat-value">
                        {{ $stats['inspections'] }}
                    </div>

                    <div class="stat-note">
                        Total inspections
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Open Findings</span>
                        <div class="stat-icon">!</div>
                    </div>

                    <div class="stat-value">
                        {{ $stats['open_findings'] }}
                    </div>

                    <div class="stat-note">
                        Need attention
                    </div>
                </div>

            </div>

            <!-- LOWER CONTENT -->
            <div class="grid">

                <!-- SITE OVERVIEW -->
                <div class="panel">

                    <div class="panel-header">
                        <h3>Site Overview</h3>
                        <span>Current infrastructure</span>
                    </div>

                    <div class="site-box">

                        <div class="site-header">

                            <div>
                                <div class="site-name">
                                    Penebang Site
                                </div>

                                <div class="site-location">
                                    Penebang
                                </div>
                            </div>

                            <span class="badge">
                                ACTIVE
                            </span>

                        </div>

                        <div class="site-stats">

                            <div class="site-stat">
                                <strong>{{ $stats['towers'] }}</strong>
                                <span>Towers</span>
                            </div>

                            <div class="site-stat">
                                <strong>{{ $stats['assets'] }}</strong>
                                <span>Assets</span>
                            </div>

                            <div class="site-stat">
                                <strong>{{ $stats['inspections'] }}</strong>
                                <span>Inspections</span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- SYSTEM STATUS -->
                <div class="panel">

                    <div class="panel-header">
                        <h3>System Status</h3>
                        <span>Live</span>
                    </div>

                    <div class="status-row">

                        <div class="status-left">
                            <div class="status-dot"></div>

                            <div class="status-text">
                                <strong>Database</strong>
                                <span>MySQL connection</span>
                            </div>
                        </div>

                        <div class="status-value">
                            Operational
                        </div>

                    </div>

                    <div class="status-row">

                        <div class="status-left">
                            <div class="status-dot"></div>

                            <div class="status-text">
                                <strong>Application</strong>
                                <span>Laravel service</span>
                            </div>
                        </div>

                        <div class="status-value">
                            Online
                        </div>

                    </div>

                    <div class="status-row">

                        <div class="status-left">
                            <div class="status-dot"></div>

                            <div class="status-text">
                                <strong>Storage</strong>
                                <span>File system</span>
                            </div>
                        </div>

                        <div class="status-value">
                            Ready
                        </div>

                    </div>

                </div>

            </div>

            <!-- QUICK ACTIONS -->
            <div class="panel" style="margin-top: 20px;">

                <div class="panel-header">
                    <h3>Quick Actions</h3>
                    <span>Frequently used</span>
                </div>

                <div class="actions">

                    <a href="#" class="action">
                        <strong>+ New Inspection</strong>
                        <span>Buat inspeksi tower baru</span>
                    </a>

                    <a href="#" class="action">
                        <strong>+ Add Asset</strong>
                        <span>Tambahkan aset IT</span>
                    </a>

                    <a href="#" class="action">
                        <strong>View Findings</strong>
                        <span>Lihat temuan abnormal</span>
                    </a>

                    <a href="#" class="action">
                        <strong>Maintenance</strong>
                        <span>Kelola work order</span>
                    </a>

                </div>

            </div>

            <div class="footer">
                IT-TIMS © 2026 · IT Tower Inspection & Maintenance System
            </div>

        </section>

    </main>

</div>

</body>
</html>