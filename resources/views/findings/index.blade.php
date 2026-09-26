<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Findings - IT-TIMS</title>

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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .page-header h1 {
            margin: 0 0 6px;
            font-size: 26px;
        }

        .page-header p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
        }

        .count {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            text-align: left;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 15px 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 17px 18px;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .finding-number {
            font-weight: bold;
            color: #2563eb;
            text-decoration: none;
        }

        .finding-title {
            font-weight: 600;
        }

        .sub {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: bold;
        }

        .severity-low {
            background: #dcfce7;
            color: #166534;
        }

        .severity-medium {
            background: #fef3c7;
            color: #92400e;
        }

        .severity-high {
            background: #fee2e2;
            color: #991b1b;
        }

        .severity-critical {
            background: #7f1d1d;
            color: white;
        }

        .status-open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-progress {
            background: #fef3c7;
            color: #92400e;
        }

        .status-resolved {
            background: #dcfce7;
            color: #166534;
        }

        .status-verified {
            background: #e0e7ff;
            color: #3730a3;
        }

        .status-closed {
            background: #e2e8f0;
            color: #475569;
        }

        .empty {
            padding: 50px;
            text-align: center;
            color: #64748b;
        }

        .pagination {
            padding: 18px;
            border-top: 1px solid #e2e8f0;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 700px) {
            .sidebar {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .page-header {
                display: block;
            }

            .count {
                display: inline-block;
                margin-top: 12px;
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
            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>

            <a href="#">
                Sites
            </a>

            <a href="#">
                Towers
            </a>

            <a href="#">
                Assets
            </a>
        </div>

        <div class="menu-title">Inspection</div>

        <div class="menu">
            <a href="{{ route('inspections.create') }}">
                New Inspection
            </a>

            <a href="#">
                Inspection History
            </a>

            <a href="{{ route('findings.index') }}" class="active">
                Findings
            </a>
        </div>

        <div class="menu-title">Maintenance</div>

        <div class="menu">
            <a href="#">
                Work Orders
            </a>

            <a href="#">
                Maintenance History
            </a>
        </div>

    </aside>

    <main class="main">

        <header class="topbar">

            <div>
                <h2>Findings</h2>
                <p>Inspection findings and corrective actions</p>
            </div>

            <div class="user">
                IT Admin
            </div>

        </header>

        <section class="content">

            <div class="page-header">

                <div>
                    <h1>Inspection Findings</h1>
                    <p>Daftar temuan abnormal dari hasil inspeksi.</p>
                </div>

                <div class="count">
                    Total Findings:
                    <strong>{{ $findings->total() }}</strong>
                </div>

            </div>

            <div class="card">

                @if ($findings->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>Finding</th>
                                    <th>Location</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Target Date</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach ($findings as $finding)

                                <tr>

                                    <td>

                                        <a
                                            href="{{ route('findings.show', $finding) }}"
                                            class="finding-number"
                                        >
                                            {{ $finding->finding_number }}
                                        </a>

                                        <span class="sub">
                                            {{ $finding->title }}
                                        </span>

                                    </td>

                                    <td>

                                        <span class="finding-title">
                                            {{ $finding->inspection->tower->name }}
                                        </span>

                                        <span class="sub">
                                            {{ $finding->inspection->tower->site->name }}
                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge severity-{{ $finding->severity }}">
                                            {{ strtoupper($finding->severity) }}
                                        </span>

                                    </td>

                                    <td>

                                        @php
                                            $statusClass = match ($finding->status) {
                                                'open' => 'status-open',
                                                'on_progress' => 'status-progress',
                                                'resolved' => 'status-resolved',
                                                'verified' => 'status-verified',
                                                'closed' => 'status-closed',
                                                default => 'status-closed',
                                            };
                                        @endphp

                                        <span class="badge {{ $statusClass }}">
                                            {{ strtoupper(str_replace('_', ' ', $finding->status)) }}
                                        </span>

                                    </td>

                                    <td>
                                        {{ $finding->assignee?->name ?? 'Unassigned' }}
                                    </td>

                                    <td>
                                        {{ $finding->target_date?->format('d M Y') ?? '-' }}
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="pagination">
                        {{ $findings->links() }}
                    </div>

                @else

                    <div class="empty">
                        Belum ada finding.
                    </div>

                @endif

            </div>

            <div class="footer">
                IT-TIMS © 2026
            </div>

        </section>

    </main>

</div>

</body>
</html>