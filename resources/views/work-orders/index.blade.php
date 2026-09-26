<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Work Orders - IT-TIMS</title>

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
            font-size: 11px;
            font-weight: 700;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .progress {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .open {
            background: #fef3c7;
            color: #92400e;
        }

        .cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .action {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .muted {
            color: #6b7280;
            margin-top: 4px;
        }
    </style>
</head>

<body>

<div class="topbar">
    IT-TIMS
</div>

<div class="container">

    <div class="title">
        Work Orders
    </div>

    <div class="subtitle">
        Daftar pekerjaan maintenance
    </div>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>WO Number</th>
                    <th>Finding</th>
                    <th>Tower</th>
                    <th>Assigned To</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($workOrders as $workOrder)

                    <tr>

                        <td>
                            <strong>
                                {{ $workOrder->work_order_number }}
                            </strong>

                            <div class="muted">
                                {{ \Illuminate\Support\Str::limit($workOrder->description, 50) }}
                            </div>
                        </td>

                        <td>
                            {{ $workOrder->finding?->finding_number ?? '-' }}
                        </td>

                        <td>
                            {{ $workOrder->finding?->inspection?->tower?->name ?? '-' }}
                        </td>

                        <td>
                            {{ $workOrder->assignee?->name ?? 'Unassigned' }}
                        </td>

                        <td>
                            {{ strtoupper($workOrder->priority ?? '-') }}
                        </td>

                        <td>
                            {{ $workOrder->due_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td>

                            @if ($workOrder->status === 'completed')

                                <span class="badge completed">
                                    COMPLETED
                                </span>

                            @elseif ($workOrder->status === 'on_progress')

                                <span class="badge progress">
                                    ON PROGRESS
                                </span>

                            @elseif ($workOrder->status === 'cancelled')

                                <span class="badge cancelled">
                                    CANCELLED
                                </span>

                            @else

                                <span class="badge open">
                                    {{ strtoupper(str_replace('_', ' ', $workOrder->status)) }}
                                </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('work-orders.show', $workOrder) }}"
                                class="action"
                            >
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" style="text-align:center;">
                            Belum ada Work Order.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <div style="padding: 18px;">
            {{ $workOrders->links() }}
        </div>

    </div>

</div>

</body>
</html>