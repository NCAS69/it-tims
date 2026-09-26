<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maintenance Record - IT-TIMS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f9;
            color: #0f172a;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .brand h1 {
            margin: 0;
            font-size: 21px;
        }

        .brand p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .back {
            color: #334155;
            text-decoration: none;
            font-size: 13px;
        }

        .container {
            max-width: 1050px;
            margin: auto;
            padding: 30px 20px;
        }

        .heading {
            margin-bottom: 22px;
        }

        .heading h2 {
            margin: 0;
            font-size: 26px;
        }

        .heading p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
        }

        .card h3 {
            margin: 0 0 18px;
            font-size: 16px;
        }

        .finding-number {
            color: #2563eb;
            font-size: 12px;
            font-weight: bold;
        }

        .finding-title {
            margin-top: 7px;
            font-size: 19px;
            font-weight: bold;
        }

        .meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .meta-item {
            background: #f8fafc;
            border-radius: 9px;
            padding: 13px;
        }

        .meta-item span {
            display: block;
            color: #64748b;
            font-size: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .meta-item strong {
            font-size: 12px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .required {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 11px 12px;
            font-family: inherit;
            font-size: 13px;
            background: white;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .hint {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 11px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 12px;
        }

        .alert ul {
            margin: 5px 0 0 18px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding-top: 20px;
            margin-top: 10px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            border: 0;
            border-radius: 8px;
            padding: 12px 20px;
            text-decoration: none;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 800px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .row,
            .meta {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<header class="topbar">

    <div class="brand">
        <h1>IT-TIMS</h1>
        <p>IT Tower Inspection & Maintenance System</p>
    </div>

    <a
        href="{{ route('findings.show', $workOrder->finding) }}"
        class="back"
    >
        ← Back to Finding
    </a>

</header>

<main class="container">

    <div class="heading">
        <h2>Maintenance Record</h2>
        <p>Catat pekerjaan maintenance yang telah dilakukan oleh teknisi.</p>
    </div>

    @if ($errors->any())

        <div class="alert">
            <strong>Input belum valid.</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="grid">

        <div class="card">

            <h3>Work Order</h3>

            <div class="finding-number">
                {{ $workOrder->work_order_number }}
            </div>

            <div class="finding-title">
                {{ $workOrder->finding->title }}
            </div>

            <div class="meta">

                <div class="meta-item">
                    <span>Site</span>
                    <strong>
                        {{ $workOrder->finding->inspection->tower->site->name }}
                    </strong>
                </div>

                <div class="meta-item">
                    <span>Tower</span>
                    <strong>
                        {{ $workOrder->finding->inspection->tower->name }}
                    </strong>
                </div>

                <div class="meta-item">
                    <span>Priority</span>
                    <strong>
                        {{ strtoupper($workOrder->priority) }}
                    </strong>
                </div>

                <div class="meta-item">
                    <span>Status</span>
                    <strong>
                        {{ strtoupper(str_replace('_', ' ', $workOrder->status)) }}
                    </strong>
                </div>

            </div>

        </div>

        <div class="card">

            <h3>Maintenance Information</h3>

            <form
                method="POST"
                action="{{ route('maintenance.store', $workOrder) }}"
            >

                @csrf

                <div class="form-group">

                    <label>
                        Asset <span class="required">*</span>
                    </label>

                    <select name="asset_id" required>

                        <option value="">
                            Select asset
                        </option>

                        @foreach ($assets as $asset)

                            <option
                                value="{{ $asset->id }}"
                                {{ old('asset_id') == $asset->id ? 'selected' : '' }}
                            >
                                {{ $asset->asset_code }}
                                — {{ $asset->name }}
                                @if ($asset->brand)
                                    ({{ $asset->brand }})
                                @endif
                            </option>

                        @endforeach

                    </select>

                    <div class="hint">
                        Hanya asset pada tower finding yang ditampilkan.
                    </div>

                </div>

                <div class="form-group">

                    <label>
                        Technician <span class="required">*</span>
                    </label>

                    <select name="technician_id" required>

                        <option value="">
                            Select technician
                        </option>

                        @foreach ($technicians as $technician)

                            <option
                                value="{{ $technician->id }}"
                                {{ old('technician_id') == $technician->id ? 'selected' : '' }}
                            >
                                {{ $technician->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">

                    <label>
                        Action Taken <span class="required">*</span>
                    </label>

                    <textarea
                        name="action"
                        required
                        placeholder="Jelaskan tindakan maintenance yang dilakukan..."
                    >{{ old('action') }}</textarea>

                </div>

                <div class="form-group">

                    <label>
                        Result
                    </label>

                    <textarea
                        name="result"
                        placeholder="Jelaskan hasil pekerjaan dan kondisi setelah maintenance..."
                    >{{ old('result') }}</textarea>

                </div>

                <div class="form-group">

                    <label>
                        Parts / Material Used
                    </label>

                    <textarea
                        name="parts_used"
                        placeholder="Contoh: SFP 1G x 1, patch cord LC-LC x 2..."
                    >{{ old('parts_used') }}</textarea>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label>
                            Cost <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            name="cost"
                            min="0"
                            step="0.01"
                            value="{{ old('cost', 0) }}"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Maintenance Date <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            name="maintenance_date"
                            value="{{ old('maintenance_date', date('Y-m-d')) }}"
                            required
                        >

                    </div>

                </div>

                <div class="actions">

                    <a
                        href="{{ route('findings.show', $workOrder->finding) }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Maintenance Record
                    </button>

                </div>

            </form>

        </div>

    </div>

    <div class="footer">
        IT-TIMS © 2026
    </div>

</main>

</body>
</html>