<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Towers - IT-TIMS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #111827;
            font-family: Arial, Helvetica, sans-serif;
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
            margin: auto;
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
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
        }

        .primary {
            background: #111827;
            color: white;
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
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
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

        .code {
            font-weight: 700;
        }

        .muted {
            color: #6b7280;
            margin-top: 4px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .inactive {
            background: #f3f4f6;
            color: #374151;
        }

        .action {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .success {
            margin-bottom: 18px;
            padding: 12px 15px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
        }

        .empty {
            padding: 50px;
            text-align: center;
            color: #6b7280;
        }

        .pagination {
            padding: 18px;
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
                Towers
            </div>

            <div class="subtitle">
                Daftar tower yang terdaftar pada site
            </div>
        </div>

        <a
            href="{{ route('towers.create') }}"
            class="btn primary"
        >
            + Add Tower
        </a>

    </div>

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Site</th>
                    <th>Type</th>
                    <th>Height</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($towers as $tower)

                    <tr>

                        <td>
                            <div class="code">
                                {{ $tower->code }}
                            </div>
                        </td>

                        <td>
                            <div class="code">
                                {{ $tower->name }}
                            </div>
                        </td>

                        <td>
                            {{ $tower->site?->name ?? '-' }}
                        </td>

                        <td>
                            {{ $tower->tower_type ?? '-' }}
                        </td>

                        <td>
                            {{ $tower->height ?? '-' }}

                            @if ($tower->height)
                                m
                            @endif
                        </td>

                        <td>

                            <span class="badge {{ $tower->status }}">
                                {{ strtoupper($tower->status) }}
                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route('towers.edit', $tower) }}"
                                class="action"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            style="text-align: center; padding: 40px;"
                        >
                            Belum ada tower.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="pagination">
            {{ $towers->links() }}
        </div>

    </div>

</div>

</body>
</html>