<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inspection Detail - IT-TIMS</title>

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
            max-width: 1150px;
            margin: auto;
            padding: 30px 20px;
        }

        .success {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
        }

        .error {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 13px;
        }

        .error ul {
            margin: 7px 0 0 18px;
        }

        .header-card,
        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
        }

        .inspection-header {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-start;
        }

        .inspection-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .inspection-number {
            margin-top: 6px;
            color: #2563eb;
            font-weight: bold;
            font-size: 12px;
        }

        .badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-running {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-normal {
            background: #dcfce7;
            color: #166534;
        }

        .badge-abnormal {
            background: #fee2e2;
            color: #991b1b;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 22px;
        }

        .info {
            background: #f8fafc;
            padding: 14px;
            border-radius: 9px;
        }

        .info span {
            display: block;
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .info strong {
            font-size: 13px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 18px;
        }

        .section-title h3 {
            margin: 0;
            font-size: 17px;
        }

        .section-title span {
            color: #64748b;
            font-size: 12px;
        }

        .checklist-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 19px;
            margin-bottom: 14px;
        }

        .checklist-item:last-child {
            margin-bottom: 0;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .item-number {
            color: #64748b;
            font-size: 11px;
        }

        .item-title {
            margin-top: 4px;
            font-size: 15px;
            font-weight: bold;
        }

        .category {
            padding: 5px 8px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #475569;
            font-size: 10px;
            font-weight: bold;
        }

        .description {
            margin-top: 10px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .status-options {
            display: flex;
            gap: 9px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .status-options input {
            display: none;
        }

        .status-options label {
            cursor: pointer;
        }

        .status-button {
            display: inline-block;
            padding: 9px 17px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: white;
            font-size: 11px;
            font-weight: bold;
        }

        .status-options input:checked + .status-button {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
        }

        textarea {
            width: 100%;
            min-height: 75px;
            margin-top: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 11px;
            font-family: inherit;
            font-size: 12px;
            resize: vertical;
        }

        textarea:focus,
        input:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 11px 18px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        /* PHOTO */

        .photo-form {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 18px;
            align-items: end;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 11px;
            font-weight: bold;
        }

        .form-group select,
        .form-group input[type="file"],
        .form-group input[type="text"] {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px;
            font-size: 12px;
            background: white;
        }

        .photo-actions {
            margin-top: 15px;
        }

        .photos {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 20px;
        }

        .photo {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
        }

        .photo img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-info {
            padding: 10px;
        }

        .photo-info strong {
            display: block;
            font-size: 11px;
        }

        .photo-info span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 10px;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 25px;
            font-size: 12px;
            background: #f8fafc;
            border-radius: 9px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 900px) {

            .info-grid {
                grid-template-columns: 1fr 1fr;
            }

            .photos {
                grid-template-columns: repeat(2, 1fr);
            }

            .photo-form {
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

            .inspection-header {
                display: block;
            }

            .inspection-header .badge {
                margin-top: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .photos {
                grid-template-columns: 1fr;
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
        href="{{ route('dashboard') }}"
        class="back"
    >
        ← Dashboard
    </a>

</header>

<main class="container">

    @if (session('success'))

        <div class="success">
            ✓ {{ session('success') }}
        </div>

    @endif

    @if ($errors->any())

        <div class="error">

            <strong>Terjadi kesalahan:</strong>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- INSPECTION HEADER -->

    <div class="header-card">

        <div class="inspection-header">

            <div
    style="
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 18px;
    "
>

    <a
        href="{{ route('inspections.pdf', $inspection) }}"
        target="_blank"
        class="btn btn-secondary"
    >
        PDF Report
    </a>

    @if ($inspection->status !== 'completed')

        <form
            method="POST"
            action="{{ route('inspections.complete', $inspection) }}"
            onsubmit="return confirm('Selesaikan inspection ini? Setelah completed, checklist dan foto tidak dapat diedit lagi.')"
        >

            @csrf
            @method('PUT')

            <button
                type="submit"
                class="btn btn-primary"
            >
                Complete Inspection
            </button>

        </form>

    @endif

</div>

            @php
                $statusClass = match ($inspection->status) {
                    'in_progress' => 'badge-running',
                    'completed',
                    'submitted',
                    'approved' => 'badge-normal',
                    'rejected' => 'badge-abnormal',
                    default => 'badge-running',
                };
            @endphp

            <span class="badge {{ $statusClass }}">
                {{ strtoupper(str_replace('_', ' ', $inspection->status)) }}
            </span>

        </div>

        <div class="info-grid">

            <div class="info">
                <span>Site</span>
                <strong>
                    {{ $inspection->tower->site->name }}
                </strong>
            </div>

            <div class="info">
                <span>Tower</span>
                <strong>
                    {{ $inspection->tower->name }}
                </strong>
            </div>

            <div class="info">
                <span>Template</span>
                <strong>
                    {{ $inspection->template->name }}
                </strong>
            </div>

            <div class="info">
                <span>Inspector</span>
                <strong>
                    {{ $inspection->inspector->name }}
                </strong>
            </div>

        </div>

    </div>


    <!-- CHECKLIST -->

    <div class="card">

        <div class="section-title">

            <h3>
                Inspection Checklist
            </h3>

            <span>
                {{ $inspection->results->count() }} Items
            </span>

        </div>

        <form
            method="POST"
            action="{{ route('inspections.results.update', $inspection) }}"
        >

            @csrf
            @method('PUT')

            @foreach ($inspection->results as $index => $result)

                <div class="checklist-item">

                    <div class="item-header">

                        <div>

                            <div class="item-number">
                                Item {{ $index + 1 }}
                            </div>

                            <div class="item-title">
                                {{ $result->checklistItem->item }}
                            </div>

                        </div>

                        <span class="category">
                            {{ $result->checklistItem->category }}
                        </span>

                    </div>

                    @if ($result->checklistItem->description)

                        <div class="description">
                            {{ $result->checklistItem->description }}
                        </div>

                    @endif

                    <div class="status-options">

                        <label>

                            <input
                                type="radio"
                                name="results[{{ $result->id }}][status]"
                                value="normal"
                                {{ $result->status === 'normal' ? 'checked' : '' }}
                            >

                            <span class="status-button">
                                Normal
                            </span>

                        </label>

                        <label>

                            <input
                                type="radio"
                                name="results[{{ $result->id }}][status]"
                                value="abnormal"
                                {{ $result->status === 'abnormal' ? 'checked' : '' }}
                            >

                            <span class="status-button">
                                Abnormal
                            </span>

                        </label>

                        <label>

                            <input
                                type="radio"
                                name="results[{{ $result->id }}][status]"
                                value="na"
                                {{ $result->status === 'na' ? 'checked' : '' }}
                            >

                            <span class="status-button">
                                N/A
                            </span>

                        </label>

                    </div>

                    <textarea
                        name="results[{{ $result->id }}][notes]"
                        placeholder="Catatan inspeksi..."
                    >{{ $result->notes }}</textarea>

                </div>

            @endforeach

            <div class="actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Inspection
                </button>

            </div>

        </form>

    </div>


    <!-- PHOTO UPLOAD -->

    <div class="card">

        <div class="section-title">

            <h3>
                Inspection Photos
            </h3>

            <span>
                {{ $inspection->photos->count() }} Photos
            </span>

        </div>

        <form
            method="POST"
            action="{{ route('inspections.photos.upload', $inspection) }}"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="photo-form">

                <div class="form-group">

                    <label>
                        Checklist
                    </label>

                    <select name="inspection_result_id">

                        <option value="">
                            General Inspection Photo
                        </option>

                        @foreach ($inspection->results as $result)

                            <option value="{{ $result->id }}">
                                {{ $result->checklistItem->item }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">

                    <label>
                        Photos
                    </label>

                    <input
                        type="file"
                        name="photos[]"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                        required
                    >

                </div>

            </div>

            <div
                class="form-group"
                style="margin-top: 15px;"
            >

                <label>
                    Caption
                </label>

                <input
                    type="text"
                    name="caption"
                    placeholder="Contoh: Kondisi NVR sebelum perbaikan"
                >

            </div>

            <div class="photo-actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Upload Photos
                </button>

            </div>

        </form>

        @if ($inspection->photos->count())

            <div class="photos">

                @foreach ($inspection->photos as $photo)

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
            {{ $photo->caption ?? 'Inspection Photo' }}
        </strong>

        <span>
            {{ $photo->file_name }}
        </span>

        @if ($inspection->status !== 'completed')

            <form
                method="POST"
                action="{{ route('inspections.photos.destroy', [$inspection, $photo]) }}"
                onsubmit="return confirm('Hapus foto inspection ini? Foto akan dihapus permanen.')"
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

        @endif

    </div>

</div>

                @endforeach

            </div>

        @else

            <div class="empty" style="margin-top: 20px;">
                Belum ada foto inspection.
            </div>

        @endif

    </div>


    <div class="footer">
        IT-TIMS © 2026
    </div>

</main>

</body>
</html>