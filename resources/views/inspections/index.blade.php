<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inspection History - IT-TIMS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #111827;
        }

        .topbar {
            height: 64px;
            background: #111827;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 28px;
            font-size: 18px;
            font-weight: 700;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
        }

        .subtitle {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        .btn {
            text-decoration: none;
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-primary {
            background: #111827;
            color: white;
        }

        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            background: #f9fafb;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            padding: 14px 18px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .number {
            font-weight: 700;
            color: #111827;
        }

        .muted {
            color: #6b7280;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-progress {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-default {
            background: #f3f4f6;
            color: #374151;
        }

        .status-abnormal {
            background: #fee2e2;
            color: #991b1b;
        }

        .action {
            text-decoration: none;
            color: #2563eb;
            font-weight: 600;
        }

        .empty {
            padding: 50px;
            text-align: center;
            color: #6b7280;
        }

        .pagination {
            padding: 18px;
            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 1000px) {
            .container {
                padding: 20px;
                overflow-x: auto;
            }

            .card {
                min-width: 1000px;
            }
        }
    </style>
</head>

<body>

<div class="topbar">
    IT-TIMS
</div>

<div class="container">

    <div class="header">

        <div>
            <div class="title">
                Inspection History
            </div>

            <div class="subtitle">
                Riwayat seluruh inspeksi tower dan perangkat IT
            </div>
        </div>

        <a
            href="{{ route('inspections.create') }}"
            class="btn btn-primary"
        >
            + New Inspection
        </a>

    </div>

    <div class="card">

        @if ($inspections->count())

            <table>

                <thead>
                    <tr>
                        <th>Inspection Number</th>
                        <th>Date</th>
                        <th>Tower</th>
                        <th>Site</th>
                        <th>Inspector</th>
                        <th>Overall</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($inspections as $inspection)

                        <tr>

                            <td>
                                <div class="number">
                                    {{ $inspection->inspection_number }}
                                </div>

                                <div class="muted">
                                    {{ $inspection->template?->name ?? '-' }}
                                </div>
                            </td>

                            <td>
                                {{ $inspection->inspection_date?->format('d M Y') ?? '-' }}
                            </td>

                            <td>
                                {{ $inspection->tower?->name ?? '-' }}
                            </td>

                            <td>
                                {{ $inspection->tower?->site?->name ?? '-' }}
                            </td>

                            <td>
                                {{ $inspection->inspector?->name ?? '-' }}
                            </td>

                            <td>

                                @if ($inspection->overall_status === 'abnormal')

                                    <span class="badge status-abnormal">
                                        ABNORMAL
                                    </span>

                                @else

                                    <span class="badge status-completed">
                                        NORMAL
                                    </span>

                                @endif

                            </td>

                            <td>

                                @if ($inspection->status === 'completed')

                                    <span class="badge status-completed">
                                        COMPLETED
                                    </span>

                                @elseif ($inspection->status === 'in_progress')

                                    <span class="badge status-progress">
                                        IN PROGRESS
                                    </span>

                                @else

                                    <span class="badge status-default">
                                        {{ strtoupper($inspection->status ?? '-') }}
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('inspections.show', $inspection) }}"
                                    class="action"
                                >
                                    View
                                </a>

                                &nbsp;

                                <a
                                    href="{{ route('inspections.pdf', $inspection) }}"
                                    class="action"
                                    target="_blank"
                                >
                                    PDF
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="pagination">
                {{ $inspections->links() }}
            </div>

        @else

            <div class="empty">
                Belum ada data inspection.
            </div>

        @endif

    </div>

</div>

</body>
</html>