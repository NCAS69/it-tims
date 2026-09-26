<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assets - IT-TIMS</title>

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
            vertical-align: top;
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

        .maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .damaged,
        .retired {
            background: #fee2e2;
            color: #991b1b;
        }

        .muted {
            color: #6b7280;
            margin-top: 4px;
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
            <div class="title">Assets</div>

            <div class="subtitle">
                Daftar perangkat dan asset IT
            </div>
        </div>

        <a
            href="{{ route('assets.create') }}"
            class="btn"
        >
            + Add Asset
        </a>

    </div>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Asset Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Tower</th>
                    <th>IP</th>
                    <th>MAC</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($assets as $asset)

                    <tr>

                        <td>
                            <strong>
                                {{ $asset->asset_code }}
                            </strong>
                        </td>

                        <td>

                            <strong>
                                {{ $asset->name }}
                            </strong>

                            @if ($asset->brand || $asset->model)

                                <div class="muted">
                                    {{ $asset->brand ?? '' }}
                                    {{ $asset->model ?? '' }}
                                </div>

                            @endif

                        </td>

                        <td>
                            {{ $asset->category?->name ?? '-' }}
                        </td>

                        <td>

                            {{ $asset->tower?->name ?? '-' }}

                            <div class="muted">
                                {{ $asset->tower?->site?->name ?? '' }}
                            </div>

                        </td>

                        <td>
                            {{ $asset->ip_address ?? '-' }}
                        </td>

                        <td>
                            {{ $asset->mac_address ?? '-' }}
                        </td>

                        <td>
                            <span class="badge {{ $asset->status }}">
                                {{ strtoupper($asset->status) }}
                            </span>
                        </td>

                        <td>
                            <a
                                href="{{ route('assets.edit', $asset) }}"
                                class="action"
                            >
                                Edit
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" style="text-align:center;">
                            Belum ada asset.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <div style="padding: 18px;">
            {{ $assets->links() }}
        </div>

    </div>

</div>

</body>
</html>