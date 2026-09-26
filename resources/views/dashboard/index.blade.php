<!DOCTYPE html>
<html lang="id">
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
            background: #f1f5f9;
            color: #1e293b;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
    width: 250px;
    background: #0f172a;
    color: white;
    padding: 25px 15px;
    position: relative;
    z-index: 1000;
}

.menu {
    position: relative;
    z-index: 1001;
}

.menu a {
    display: block;
    padding: 12px 15px;
    margin: 4px 0;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    position: relative;
    z-index: 1002;
    pointer-events: auto;
    cursor: pointer;
}

        .logo {
            padding: 0 15px 25px;
            border-bottom: 1px solid #334155;
        }

        .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        .logo p {
            margin: 7px 0 0;
            color: #94a3b8;
            font-size: 12px;
        }

        .menu-title {
            margin: 25px 12px 10px;
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 1px;
        }

        .menu a {
            display: block;
            padding: 12px 15px;
            margin: 4px 0;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #1e293b;
            color: white;
        }

        .main {
            flex: 1;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar h2 {
            margin: 0;
            font-size: 21px;
        }

        .topbar p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #64748b;
        }

        .user {
            font-size: 13px;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .welcome {
            background: linear-gradient(135deg, #172554, #1d4ed8);
            color: white;
            border-radius: 15px;
            padding: 28px;
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .welcome p {
            margin: 0;
            color: #dbeafe;
            font-size: 14px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
        }

        .card-title {
            color: #64748b;
            font-size: 13px;
        }

        .card-number {
            margin-top: 12px;
            font-size: 31px;
            font-weight: bold;
        }

        .card-footer {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 11px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
        }

        .panel {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
        }

        .panel h3 {
            margin: 0 0 18px;
            font-size: 16px;
        }

        .site {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 17px;
        }

        .site-name {
            font-size: 16px;
            font-weight: bold;
        }

        .site-location {
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
        }

        .active {
            display: inline-block;
            margin-top: 12px;
            padding: 5px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 10px;
            font-weight: bold;
        }

        .site-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .site-info div {
            text-align: center;
        }

        .site-info strong {
            display: block;
            font-size: 22px;
        }

        .site-info span {
            font-size: 11px;
            color: #64748b;
        }

        .status {
            display: flex;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        .status:last-child {
            border-bottom: none;
        }

        .online {
            color: #16a34a;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 1100px) {
            .cards {
                grid-template-columns: repeat(3, 1fr);
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                display: none;
            }

            .cards {
                grid-template-columns: 1fr 1fr;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">
            <h1>IT-TIMS</h1>
            <p>IT Tower Inspection System</p>
        </div>

        <div class="menu-title">Main Menu</div>

        <div class="menu">
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>

<a href="{{ route('sites.index') }}">
    Sites
</a>

<a href="{{ route('towers.index') }}">
    Towers
</a>

<a href="{{ route('assets.index') }}">
    Assets
</a>

...

<a href="{{ route('inspections.create') }}">
    New Inspection
</a>

<a href="{{ route('inspections.index') }}">
    Inspection History
</a>

<a href="{{ route('findings.index') }}">
    Findings
</a>

...

<a href="{{ route('work-orders.index') }}">
    Work Orders
</a>

<a href="{{ route('maintenance.index') }}">
    Maintenance History
</a>
<a href="{{ route('users.index') }}">Users</a>
@if (auth()->user()?->username === 'admin')
    <a href="{{ route('checklists.index') }}">
        Inspection Checklist
    </a>
@endif
        </div>
<form action="{{ route('logout') }}" method="POST" style="margin-top:20px;">
    @csrf

    <button type="submit"
        style="
            width:100%;
            padding:12px 15px;
            border:none;
            background:#dc2626;
            color:white;
            border-radius:8px;
            font-size:14px;
            cursor:pointer;
            text-align:left;
        ">
        Logout
    </button>
</form>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h2>Dashboard</h2>
                <p>IT infrastructure monitoring</p>
            </div>

            <div class="user">
                IT Admin
            </div>
        </header>

        <section class="content">

            <div class="welcome">
                <h1>Welcome to IT-TIMS 👋</h1>
                <p>
                    IT Tower Inspection & Maintenance System
                </p>
            </div>

            <div class="cards">

                <div class="card">
                    <div class="card-title">Total Sites</div>
                    <div class="card-number">{{ $stats['sites'] }}</div>
                    <div class="card-footer">Registered sites</div>
                </div>

                <div class="card">
                    <div class="card-title">Total Towers</div>
                    <div class="card-number">{{ $stats['towers'] }}</div>
                    <div class="card-footer">Active towers</div>
                </div>

                <div class="card">
                    <div class="card-title">Total Assets</div>
                    <div class="card-number">{{ $stats['assets'] }}</div>
                    <div class="card-footer">IT infrastructure</div>
                </div>

                <div class="card">
                    <div class="card-title">Inspections</div>
                    <div class="card-number">{{ $stats['inspections'] }}</div>
                    <div class="card-footer">Total inspections</div>
                </div>

                <div class="card">
                    <div class="card-title">Open Findings</div>
                    <div class="card-number">{{ $stats['open_findings'] }}</div>
                    <div class="card-footer">Need attention</div>
                </div>

            </div>
            <div class="panel" style="margin-bottom:20px;">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">

        <div>
            <h3 style="margin:0 0 5px;">
                Inspection Checklist
            </h3>

            <div style="font-size:12px;color:#64748b;">
                Total Checklist: {{ $checklistCount }}
            </div>
        </div>

        @if (auth()->user()?->username === 'admin')
            <a href="{{ route('checklists.index') }}"
               style="padding:8px 13px;background:#2563eb;color:white;text-decoration:none;border-radius:7px;font-size:12px;">
                Manage Checklist
            </a>
        @endif

    </div>

    @forelse ($checklistItems as $checklist)

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:15px;
            padding:12px 0;
            border-bottom:1px solid #f1f5f9;
        ">

            <div>

                <div style="font-size:13px;font-weight:600;">
                    {{ $checklist->sort_order }}.
                    {{ $checklist->item }}
                </div>

                <div style="font-size:11px;color:#64748b;margin-top:4px;">
                    {{ $checklist->category }}
                    •
                    {{ $checklist->template?->name ?? '-' }}
                </div>

            </div>

            @if ($checklist->is_required)

                <span style="
                    padding:4px 8px;
                    border-radius:999px;
                    background:#dcfce7;
                    color:#166534;
                    font-size:10px;
                ">
                    REQUIRED
                </span>

            @endif

        </div>

    @empty

        <div style="padding:15px;color:#64748b;font-size:13px;">
            Belum ada checklist.
        </div>

    @endforelse

</div>
            <div class="grid">

                <div class="panel">

                    <h3>Site Overview</h3>

                    <div class="site">

                        <div class="site-name">
                            Penebang Site
                        </div>

                        <div class="site-location">
                            Penebang
                        </div>

                        <span class="active">
                            ACTIVE
                        </span>

                        <div class="site-info">

                            <div>
                                <strong>{{ $stats['towers'] }}</strong>
                                <span>Towers</span>
                            </div>

                            <div>
                                <strong>{{ $stats['assets'] }}</strong>
                                <span>Assets</span>
                            </div>

                            <div>
                                <strong>{{ $stats['inspections'] }}</strong>
                                <span>Inspections</span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="panel">

                    <h3>System Status</h3>

                    <div class="status">
                        <span>Database</span>
                        <span class="online">● Online</span>
                    </div>

                    <div class="status">
                        <span>Laravel Application</span>
                        <span class="online">● Online</span>
                    </div>

                    <div class="status">
                        <span>Storage</span>
                        <span class="online">● Ready</span>
                    </div>

                </div>

            </div>

            <div class="footer">
                IT-TIMS © 2026
            </div>

        </section>

    </main>

</div>

</body>
</html>





