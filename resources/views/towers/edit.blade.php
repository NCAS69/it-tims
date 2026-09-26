<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Tower - IT-TIMS</title>

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
            max-width: 900px;
            margin: auto;
            padding: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
        }

        .subtitle {
            margin-top: 6px;
            margin-bottom: 24px;
            color: #6b7280;
            font-size: 14px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 700;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            font-size: 14px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn {
            border: 0;
            padding: 11px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #111827;
            color: white;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .error {
            margin-bottom: 18px;
            padding: 12px 15px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
        }

        .info {
            margin-bottom: 18px;
            padding: 12px 15px;
            background: #eff6ff;
            color: #1d4ed8;
            border-radius: 8px;
        }

        @media (max-width: 700px) {
            .row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="topbar">
    IT-TIMS
</div>

<div class="container">

    <div class="title">
        Edit Tower
    </div>

    <div class="subtitle">
        Perbarui informasi tower
    </div>

    @if (session('success'))

        <div class="info">
            {{ session('success') }}
        </div>

    @endif

    @if ($errors->any())

        <div class="error">

            <ul style="margin: 0; padding-left: 18px;">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <div class="card">

        <form
            method="POST"
            action="{{ route('towers.update', $tower) }}"
        >

            @csrf

            @method('PUT')

            <div class="field">

                <label>
                    Site
                </label>

                <select
                    name="site_id"
                    required
                >

                    @foreach ($sites as $site)

                        <option
                            value="{{ $site->id }}"
                            @selected(
                                old(
                                    'site_id',
                                    $tower->site_id
                                ) == $site->id
                            )
                        >
                            {{ $site->code }} - {{ $site->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="row">

                <div class="field">

                    <label>
                        Tower Code
                    </label>

                    <input
                        type="text"
                        name="code"
                        value="{{ old('code', $tower->code) }}"
                        required
                    >

                </div>

                <div class="field">

                    <label>
                        Tower Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $tower->name) }}"
                        required
                    >

                </div>

            </div>

            <div class="row">

                <div class="field">

                    <label>
                        Tower Type
                    </label>

                    <input
                        type="text"
                        name="tower_type"
                        value="{{ old(
                            'tower_type',
                            $tower->tower_type
                        ) }}"
                    >

                </div>

                <div class="field">

                    <label>
                        Height (meter)
                    </label>

                    <input
                        type="number"
                        name="height"
                        step="0.01"
                        min="0"
                        value="{{ old(
                            'height',
                            $tower->height
                        ) }}"
                    >

                </div>

            </div>

            <div class="field">

                <label>
                    Installation Date
                </label>

                <input
                    type="date"
                    name="installation_date"
                    value="{{ old(
                        'installation_date',
                        $tower->installation_date
                            ? $tower->installation_date->format('Y-m-d')
                            : null
                    ) }}"
                >

            </div>

            <div class="field">

                <label>
                    Description
                </label>

                <textarea
                    name="description"
                    placeholder="Deskripsi tower"
                >{{ old(
                    'description',
                    $tower->description
                ) }}</textarea>

            </div>

            <div class="field">

                <label>
                    Status
                </label>

                <select
                    name="status"
                    required
                >

                    <option
                        value="active"
                        @selected(
                            old(
                                'status',
                                $tower->status
                            ) === 'active'
                        )
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        @selected(
                            old(
                                'status',
                                $tower->status
                            ) === 'inactive'
                        )
                    >
                        Inactive
                    </option>

                    <option
                        value="maintenance"
                        @selected(
                            old(
                                'status',
                                $tower->status
                            ) === 'maintenance'
                        )
                    >
                        Maintenance
                    </option>

                </select>

            </div>

            <div class="actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Tower
                </button>

                <a
                    href="{{ route('towers.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>