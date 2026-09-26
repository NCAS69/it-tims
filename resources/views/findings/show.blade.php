<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finding Detail - IT-TIMS</title>

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

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 21px;
        }

        .topbar p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .back {
            text-decoration: none;
            color: #334155;
            font-size: 13px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 25px;
        }

        .finding-number {
            margin-top: 6px;
            color: #2563eb;
            font-size: 13px;
            font-weight: bold;
        }

        .badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: bold;
        }

        .severity {
            background: #fef3c7;
            color: #92400e;
        }

        .status {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 23px;
            margin-bottom: 20px;
        }

        .card h3 {
            margin: 0 0 18px;
            font-size: 16px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info {
            padding: 14px;
            background: #f8fafc;
            border-radius: 9px;
        }

        .info span {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .info strong {
            font-size: 13px;
        }

        .description {
            line-height: 1.7;
            color: #475569;
            font-size: 13px;
            white-space: pre-line;
        }

        .recommendation {
            background: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 15px;
            border-radius: 9px;
            line-height: 1.7;
            color: #1e40af;
            font-size: 13px;
        }

        .timeline-item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
        }

        .timeline-item:last-child {
            border-bottom: none;
        }

        .timeline-label {
            color: #64748b;
        }

        .timeline-value {
            font-weight: 600;
            text-align: right;
        }

        .empty {
            color: #64748b;
            font-size: 13px;
            text-align: center;
            padding: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .success {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
        }

        .work-order {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 12px;
        }

        .work-order:last-child {
            margin-bottom: 0;
        }

        .work-order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .work-order-number {
            font-size: 13px;
            font-weight: bold;
            color: #2563eb;
        }

        .work-order-meta {
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .work-order-actions {
            margin-top: 14px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 800px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .header {
                display: block;
            }

            .badges {
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">

    <div>
        <h1>IT-TIMS</h1>
        <p>IT Tower Inspection & Maintenance System</p>
    </div>

    <a
        href="{{ route('findings.index') }}"
        class="back"
    >
        ← Back to Findings
    </a>

</header>

<main class="container">

    @if (session('success'))

        <div class="success">
            ✓ {{ session('success') }}
        </div>

    @endif

    <div class="header">

        <div>

            <h2>
                {{ $finding->title }}
            </h2>

            <div class="finding-number">
                {{ $finding->finding_number }}
            </div>

        </div>

        <div class="badges">

            <span class="badge severity">
                {{ strtoupper($finding->severity) }}
            </span>

            <span class="badge status">
                {{ strtoupper(str_replace('_', ' ', $finding->status)) }}
            </span>

        </div>

    </div>

    <div class="grid">

        <!-- LEFT -->
        <div>

            <div class="card">

                <h3>Finding Information</h3>

                <div class="info-grid">

                    <div class="info">

                        <span>Site</span>

                        <strong>
                            {{ $finding->inspection->tower->site->name }}
                        </strong>

                    </div>

                    <div class="info">

                        <span>Tower</span>

                        <strong>
                            {{ $finding->inspection->tower->name }}
                        </strong>

                    </div>

                    <div class="info">

                        <span>Inspection</span>

                        <strong>
                            {{ $finding->inspection->inspection_number }}
                        </strong>

                    </div>

                    <div class="info">

                        <span>Checklist</span>

                        <strong>
                            {{ $finding->inspectionResult->checklistItem->item }}
                        </strong>

                    </div>

                </div>

            </div>

            <div class="card">

                <h3>Description</h3>

                <div class="description">
                    {{ $finding->description }}
                </div>

            </div>

            <div class="card">

                <h3>Recommendation</h3>

                <div class="recommendation">

                    {{ $finding->recommendation ?? 'Belum ada rekomendasi.' }}

                </div>

            </div>

            <div class="card">

                <h3>Finding Photos</h3>

                @<div class="card">

    <h3>Finding Photos</h3>

    <form
        method="POST"
        action="{{ route('findings.photos.store', $finding) }}"
        enctype="multipart/form-data"
    >

        @csrf

        <div style="margin-bottom: 15px;">

            <label
                style="
                    display: block;
                    margin-bottom: 7px;
                    font-size: 11px;
                    font-weight: bold;
                "
            >
                Photos
            </label>

            <input
                type="file"
                name="photos[]"
                accept="image/jpeg,image/png,image/webp"
                multiple
                required
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #cbd5e1;
                    border-radius: 8px;
                "
            >

        </div>

        <div style="margin-bottom: 15px;">

            <label
                style="
                    display: block;
                    margin-bottom: 7px;
                    font-size: 11px;
                    font-weight: bold;
                "
            >
                Caption
            </label>

            <input
                type="text"
                name="caption"
                placeholder="Contoh: Kondisi NVR sebelum perbaikan"
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #cbd5e1;
                    border-radius: 8px;
                "
            >

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Upload Finding Photos
        </button>

    </form>

    @if ($finding->photos->count())

        <div class="photos" style="margin-top: 20px;">

            @foreach ($finding->photos as $photo)

                <div class="photo">

                    <a
                        href="{{ asset('storage/' . $photo->file_path) }}"
                        target="_blank"
                    >
                        <img
                            src="{{ asset('storage/' . $photo->file_path) }}"
                            alt="{{ $photo->file_name }}"
                        >
                    </a>

                    <div class="photo-info">

    <strong>
        {{ $photo->caption ?? 'Finding Photo' }}
    </strong>

    <span>
        {{ $photo->file_name }}
    </span>

    <form
        method="POST"
        action="{{ route('findings.photos.destroy', [$finding, $photo]) }}"
        onsubmit="return confirm('Hapus foto ini? Foto akan dihapus permanen.')"
        style="margin-top: 10px;"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            style="
                border: none;
                padding: 7px 12px;
                border-radius: 6px;
                background: #dc2626;
                color: white;
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
            "
        >
            Hapus Foto
        </button>
    </form>

</div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty" style="margin-top: 20px;">
            Belum ada foto bukti finding.
        </div>

    @endif

</div>

        </div>

        <!-- RIGHT -->
        <div>

            <div class="card">

                <h3>Assignment</h3>

                <div class="timeline-item">

                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">

    <div style="font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 8px;">
        Update Finding Status
    </div>

    <form
        method="POST"
        action="{{ route('findings.status.update', $finding) }}"
    >
        @csrf
        @method('PUT')

        <select
            name="status"
            style="
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                background: #fff;
                font-size: 14px;
                margin-bottom: 10px;
            "
        >
            <option value="open" @selected($finding->status === 'open')>
                Open
            </option>

            <option value="on_progress" @selected($finding->status === 'on_progress')>
                On Progress
            </option>

            <option value="resolved" @selected($finding->status === 'resolved')>
                Resolved
            </option>

            <option value="verified" @selected($finding->status === 'verified')>
                Verified
            </option>

            <option value="closed" @selected($finding->status === 'closed')>
                Closed
            </option>
        </select>

        <button
            type="submit"
            style="
                width: 100%;
                border: none;
                padding: 10px 18px;
                border-radius: 8px;
                background: #111827;
                color: white;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
            "
        >
            Update Status
        </button>
    </form>

</div>
                    <span class="timeline-label">
                        Assigned To
                    </span>

                    <span class="timeline-value">
                        {{ $finding->assignee?->name ?? 'Unassigned' }}
                    </span>

                </div>

                <div class="timeline-item">

                    <span class="timeline-label">
                        Target Date
                    </span>

                    <span class="timeline-value">
                        {{ $finding->target_date?->format('d M Y') ?? '-' }}
                    </span>

                </div>

                <div class="timeline-item">

                    <span class="timeline-label">
                        Created
                    </span>

                    <span class="timeline-value">
                        {{ $finding->created_at->format('d M Y H:i') }}
                    </span>

                </div>

            </div>

            <div class="card">

                <h3>Work Orders</h3>

                @if ($finding->workOrders->count())

                    @foreach ($finding->workOrders as $workOrder)

                        <div class="work-order">

                            <div class="work-order-header">

                                <div>

                                    <div class="work-order-number">
                                        {{ $workOrder->work_order_number }}
                                    </div>

                                    <div class="work-order-meta">
                                        Priority:
                                        {{ strtoupper($workOrder->priority) }}
                                    </div>

                                </div>

                                <span class="badge status">
                                    {{ strtoupper(str_replace('_', ' ', $workOrder->status)) }}
                                </span>

                            </div>

                            <div class="work-order-meta">
                                Assigned:
                                {{ $workOrder->assignee?->name ?? 'Unassigned' }}
                            </div>

                            <div class="work-order-actions">

                                <a
                                    href="{{ route('maintenance.create', $workOrder) }}"
                                    class="btn btn-primary"
                                >
                                    + Maintenance Record
                                </a>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="empty">
                        Belum ada Work Order.
                    </div>

                @endif

            </div>

            <div class="card">

                <h3>Next Action</h3>

                <a
                    href="{{ route('work-orders.create', $finding) }}"
                    class="btn btn-primary"
                >
                    Create Work Order
                </a>

            </div>

        </div>

    </div>

    <div class="footer">
        IT-TIMS © 2026
    </div>

</main>

</body>
</html>