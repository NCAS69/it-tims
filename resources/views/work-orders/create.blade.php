<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Work Order - IT-TIMS</title>

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
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
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
            text-decoration: none;
            color: #334155;
            font-size: 13px;
        }

        .container {
            max-width: 1050px;
            margin: 0 auto;
            padding: 32px 20px;
        }

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h2 {
            margin: 0;
            font-size: 26px;
        }

        .page-heading p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.25fr 1fr;
            gap: 20px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .card h3 {
            margin: 0 0 18px;
            font-size: 16px;
        }

        .finding-number {
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .finding-title {
            font-size: 19px;
            font-weight: 700;
        }

        .finding-description {
            margin-top: 12px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .meta-item {
            background: #f8fafc;
            padding: 13px;
            border-radius: 9px;
        }

        .meta-item span {
            display: block;
            font-size: 10px;
            color: #64748b;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .meta-item strong {
            font-size: 12px;
        }

        .badge {
            display: inline-block;
            margin-top: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: bold;
            background: #fef3c7;
            color: #92400e;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 700;
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
            background: #ffffff;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
            line-height: 1.5;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .hint {
            margin-top: 6px;
            font-size: 11px;
            color: #94a3b8;
        }

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 9px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 12px;
        }

        .alert ul {
            margin: 7px 0 0 18px;
            padding: 0;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            border: 0;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
        }

        .footer {
            text-align: center;
            padding: 28px;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 850px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 0 18px;
            }

            .container {
                padding: 20px 14px;
            }

            .form-row,
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
        href="{{ route('findings.show', $finding) }}"
        class="back"
    >
        ← Back to Finding
    </a>

</header>

<main class="container">

    <div class="page-heading">
        <h2>Create Work Order</h2>
        <p>Buat pekerjaan corrective maintenance berdasarkan finding.</p>
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

        <!-- FINDING SUMMARY -->
        <div class="card">

            <h3>Finding Summary</h3>

            <div class="finding-number">
                {{ $finding->finding_number }}
            </div>

            <div class="finding-title">
                {{ $finding->title }}
            </div>

            <span class="badge">
                {{ strtoupper($finding->severity) }}
            </span>

            <div class="finding-description">
                {{ $finding->description }}
            </div>

            <div class="meta">

                <div class="meta-item">
                    <span>Site</span>
                    <strong>
                        {{ $finding->inspection->tower->site->name }}
                    </strong>
                </div>

                <div class="meta-item">
                    <span>Tower</span>
                    <strong>
                        {{ $finding->inspection->tower->name }}
                    </strong>
                </div>

                <div class="meta-item">
                    <span>Inspection</span>
                    <strong>
                        {{ $finding->inspection->inspection_number }}
                    </strong>
                </div>

                <div class="meta-item">
                    <span>Status Finding</span>
                    <strong>
                        {{ strtoupper(str_replace('_', ' ', $finding->status)) }}
                    </strong>
                </div>

            </div>

        </div>

        <!-- WORK ORDER FORM -->
        <div class="card">

            <h3>Work Order Information</h3>

            <form
                method="POST"
                action="{{ route('work-orders.store', $finding) }}"
            >

                @csrf

                <div class="form-group">

                    <label>
                        Assigned To
                    </label>

                    <select name="assigned_to">

                        <option value="">
                            Unassigned
                        </option>

                        @foreach ($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('assigned_to') == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                            </option>

                        @endforeach

                    </select>

                    <div class="hint">
                        PIC yang akan menangani pekerjaan.
                    </div>

                </div>

                <div class="form-group">

                    <label>
                        Priority <span class="required">*</span>
                    </label>

                    <select name="priority" required>

                        <option value="low"
                            {{ old('priority') === 'low' ? 'selected' : '' }}>
                            Low
                        </option>

                        <option value="medium"
                            {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>
                            Medium
                        </option>

                        <option value="high"
                            {{ old('priority') === 'high' ? 'selected' : '' }}>
                            High
                        </option>

                        <option value="critical"
                            {{ old('priority') === 'critical' ? 'selected' : '' }}>
                            Critical
                        </option>

                    </select>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            value="{{ old('start_date') }}"
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label>
                        Work Description <span class="required">*</span>
                    </label>

                    <textarea
                        name="description"
                        required
                        placeholder="Jelaskan pekerjaan corrective maintenance yang harus dilakukan..."
                    >{{ old('description', $finding->recommendation) }}</textarea>

                </div>

                <div class="actions">

                    <a
                        href="{{ route('findings.show', $finding) }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Create Work Order
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