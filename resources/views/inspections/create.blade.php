<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inspection - IT-TIMS</title>

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
            color: #64748b;
            font-size: 12px;
        }

        .back {
            text-decoration: none;
            color: #334155;
            font-size: 13px;
        }

        .content {
            max-width: 950px;
            margin: 0 auto;
            padding: 35px 25px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin: 0 0 8px;
            font-size: 26px;
        }

        .page-title p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, 0.05);
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .required {
            color: #dc2626;
        }

        select,
        input {
            width: 100%;
            height: 44px;
            padding: 0 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            font-size: 13px;
            color: #1e293b;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .info-box {
            margin-top: 5px;
            padding: 15px;
            border-radius: 9px;
            background: #eff6ff;
            color: #1e40af;
            font-size: 12px;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            padding-top: 22px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            height: 44px;
            padding: 0 20px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-cancel {
            background: #f1f5f9;
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

        @media (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px 15px;
            }

            .card {
                padding: 20px;
            }

            .actions {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
        }
    </style>
</head>

<body>

<header class="topbar">

    <div>
        <h2>IT-TIMS</h2>
        <p>IT Tower Inspection & Maintenance System</p>
    </div>

    <a href="{{ route('dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

</header>

<main class="content">

    <div class="page-title">
        <h1>New Inspection</h1>
        <p>Create a new tower inspection record.</p>
    </div>

    <div class="card">

        <div class="section-title">
            Inspection Information
        </div>

        <form method="POST" action="{{ route('inspections.store') }}">
    @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Site / Tower <span class="required">*</span>
                    </label>

                    <select name="tower_id" required>

                        <option value="">
                            Select tower
                        </option>

                        @foreach ($towers as $tower)

                            <option value="{{ $tower->id }}">
                                {{ $tower->name }} — {{ $tower->site->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Inspection Template <span class="required">*</span>
                    </label>

                    <select name="template_id" required>

                        <option value="">
                            Select template
                        </option>

                        @foreach ($templates as $template)

                            <option value="{{ $template->id }}">
                                {{ $template->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Inspection Date <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="inspection_date"
                        value="{{ date('Y-m-d') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Inspector
                    </label>

                    <input
                        type="text"
                        value="IT Inspector"
                        disabled
                    >
                </div>

                <div class="form-group full">

                    <div class="info-box">
                        Setelah inspeksi dibuat, sistem akan mengambil
                        checklist dari template yang dipilih dan inspector
                        dapat mengisi status Normal, Abnormal, atau N/A
                        untuk setiap item.
                    </div>

                </div>

            </div>

            <div class="actions">

                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Start Inspection
                </button>

            </div>

        </form>

    </div>

    <div class="footer">
        IT-TIMS © 2026
    </div>

</main>

</body>
</html>