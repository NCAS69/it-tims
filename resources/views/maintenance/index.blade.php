<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maintenance History - IT-TIMS</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial, Helvetica, sans-serif;
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
            max-width: 1500px;
            margin: auto;
            padding: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f9fafb;
            padding: 14px 18px;
            text-align: left;
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid #f1f5f9;
            font-size: 14px;
            vertical-align: top;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            background: #eef2ff;
            color: #3730a3;
            font-size: 11px;
            font-weight: 700;
        }

        .muted {
            color: #6b7280;
            margin-top: 4px;
        }

        .cost {
            font-weight: 700;
        }

        .action {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="topbar">
    IT-TIMS
</div>

<div class="container">

    <div class="title">
        Maintenance History
    </div>

    <div class="subtitle">
        Riwayat maintenance dan tindakan perbaikan
    </div>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Date</th>
                    <th>Work Order</th>
                    <th>Finding</th>
                    <th>Asset</th>
                    <th>Technician</th>
                    <th>Action</th>
                    <th>Result</th>
                    <th>Cost</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($maintenanceRecords as $record)

                    <tr>

                        <td>
                            {{ $record->maintenance_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td>
                            <span class="badge">
                                {{ $record->workOrder?->work_order_number ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ $record->workOrder?->finding?->finding_number ?? '-' }}
                        </td>

                        <td>

                            <strong>
                                {{ $record->asset?->name ?? '-' }}
                            </strong>

                            <div class="muted">
                                {{ $record->asset?->asset_code ?? '' }}
                            </div>

                        </td>

                        <td>
                            {{ $record->technician?->name ?? '-' }}
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($record->action, 70) }}
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($record->result ?? '-', 60) }}
                        </td>

                        <td>
                            <div class="cost">
                                Rp {{ number_format((float) $record->cost, 0, ',', '.') }}
                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" style="text-align:center;">
                            Belum ada Maintenance Record.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <div style="padding: 18px;">
            {{ $maintenanceRecords->links() }}
        </div>

    </div>

</div>

</body>
</html>