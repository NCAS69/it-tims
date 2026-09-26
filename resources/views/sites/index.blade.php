<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sites - IT-TIMS</title>

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
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
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
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid #f1f5f9;
            font-size: 14px;
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

        .inactive {
            background: #f3f4f6;
            color: #374151;
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

    <div class="header">

        <div>
            <div class="title">Sites</div>

            <div class="subtitle">
                Daftar lokasi/site IT
            </div>
        </div>

        <a
            href="{{ route('sites.create') }}"
            class="btn"
        >
            + Add Site
        </a>

    </div>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Towers</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($sites as $site)

                    <tr>

                        <td>
                            <strong>{{ $site->code }}</strong>
                        </td>

                        <td>
                            {{ $site->name }}
                        </td>

                        <td>
                            {{ $site->location ?? '-' }}
                        </td>

                        <td>
                            {{ $site->towers_count }}
                        </td>

                        <td>
                            <span class="badge {{ $site->status }}">
                                {{ strtoupper($site->status) }}
                            </span>
                        </td>

                        <td>
                            <a
                                href="{{ route('sites.edit', $site) }}"
                                class="action"
                            >
                                Edit
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" style="text-align:center;">
                            Belum ada site.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <div style="padding: 18px;">
            {{ $sites->links() }}
        </div>

    </div>

</div>

</body>
</html>