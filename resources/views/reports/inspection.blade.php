<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        {{ $inspection->inspection_number ?? 'Inspection Report' }}
    </title>

    <style>
        @page {
            margin: 24px 24px 28px 24px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #1f2937;
            line-height: 1.45;
        }

        h1,
        h2,
        h3,
        p {
            margin-top: 0;
        }

        .header {
            border-bottom: 2px solid #111827;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
        }

        .report-title {
            font-size: 15px;
            font-weight: bold;
            margin-top: 3px;
        }

        .report-number {
            text-align: right;
            font-size: 10px;
            color: #4b5563;
        }

        .section-title {
            background: #111827;
            color: #ffffff;
            font-size: 11px;
            font-weight: bold;
            padding: 7px 9px;
            margin-top: 16px;
            margin-bottom: 10px;
        }

        .sub-title {
            font-size: 10px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
            text-align: left;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 6px 7px;
            vertical-align: top;
        }

        .info-label {
            width: 22%;
            background: #f9fafb;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
        }

        .status-normal {
            background: #dcfce7;
            color: #166534;
        }

        .status-abnormal {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-na {
            background: #e5e7eb;
            color: #374151;
        }

        .status-default {
            background: #e5e7eb;
            color: #374151;
        }

        .severity-low {
            background: #dcfce7;
            color: #166534;
        }

        .severity-medium {
            background: #fef3c7;
            color: #92400e;
        }

        .severity-high {
            background: #fed7aa;
            color: #9a3412;
        }

        .severity-critical {
            background: #fee2e2;
            color: #991b1b;
        }

        .finding-box {
            border: 1px solid #d1d5db;
            margin-bottom: 12px;
        }

        .finding-header {
            background: #f9fafb;
            padding: 7px 8px;
            border-bottom: 1px solid #d1d5db;
        }

        .finding-number {
            font-weight: bold;
            font-size: 10px;
        }

        .finding-title {
            font-size: 10px;
            font-weight: bold;
            margin-top: 2px;
        }

        .small {
            font-size: 8px;
            color: #6b7280;
        }

        .muted {
            color: #6b7280;
        }

        .photo-grid {
            width: 100%;
            font-size: 0;
        }

        .photo-card {
            display: inline-block;
            width: 48.5%;
            margin-right: 1.5%;
            margin-bottom: 12px;
            border: 1px solid #d1d5db;
            padding: 7px;
            vertical-align: top;
        }

        .photo-card:nth-child(2n) {
            margin-right: 0;
        }

        .photo-image {
            width: 100%;
            height: 205px;
            object-fit: contain;
        }

        .photo-placeholder {
            width: 100%;
            height: 205px;
            background: #f3f4f6;
            border: 1px dashed #9ca3af;
            text-align: center;
            padding-top: 85px;
            color: #6b7280;
            font-size: 9px;
        }

        .photo-caption {
            font-size: 8px;
            margin-top: 6px;
            color: #374151;
        }

        .wo-box {
            border: 1px solid #d1d5db;
            margin-bottom: 12px;
        }

        .wo-header {
            background: #f9fafb;
            padding: 7px 8px;
            border-bottom: 1px solid #d1d5db;
        }

        .wo-number {
            font-weight: bold;
            font-size: 10px;
        }

        .maintenance-box {
            margin-top: 8px;
        }

        .empty {
            border: 1px dashed #d1d5db;
            padding: 12px;
            text-align: center;
            color: #6b7280;
        }

        .page-break {
            page-break-before: always;
        }

        .signature-table {
            width: 100%;
            margin-top: 38px;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            border: none;
            text-align: center;
            vertical-align: top;
            padding: 8px 25px 0 25px;
        }

        .signature-title {
            font-size: 10px;
            font-weight: bold;
        }

        .signature-space {
            height: 150px;
            min-height: 150px;
            line-height: 150px;
        }

        .signature-line {
            font-size: 9px;
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .signature-name {
            font-size: 10px;
            font-weight: bold;
            line-height: 1.3;
        }

        .signature-position {
            font-size: 8px;
            color: #6b7280;
            line-height: 1.3;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -16px;
            text-align: center;
            font-size: 8px;
            color: #9ca3af;
        }

        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body>

@php
    $toDataUri = function ($relativePath) {

        $sourcePath = storage_path(
            'app/public/' . ltrim($relativePath ?? '', '/')
        );

        if (!file_exists($sourcePath)) {
            return null;
        }

        $imageContent = @file_get_contents($sourcePath);

        if ($imageContent === false) {
            return null;
        }

        $image = @imagecreatefromstring($imageContent);

        if ($image === false) {
            return null;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        $canvas = imagecreatetruecolor(
            $width,
            $height
        );

        $white = imagecolorallocate(
            $canvas,
            255,
            255,
            255
        );

        imagefill(
            $canvas,
            0,
            0,
            $white
        );

        imagecopy(
            $canvas,
            $image,
            0,
            0,
            0,
            0,
            $width,
            $height
        );

        ob_start();

        imagejpeg(
            $canvas,
            null,
            90
        );

        $jpegData = ob_get_clean();

        imagedestroy($canvas);
        imagedestroy($image);

        if (
            $jpegData === false ||
            $jpegData === ''
        ) {
            return null;
        }

        return 'data:image/jpeg;base64,' .
            base64_encode($jpegData);
    };
@endphp


<!-- HEADER -->

<div class="header">

    <table class="header-table">

        <tr>

            <td style="border: none; padding: 0; width: 65%;">

                <div class="brand">
                    IT-TIMS
                </div>

                <div class="report-title">
                    INSPECTION REPORT
                </div>

            </td>

            <td style="border: none; padding: 0; width: 35%;">

                <div class="report-number">

                    <strong>
                        {{ $inspection->inspection_number ?? '-' }}
                    </strong>

                    <br>

                    {{ $inspection->inspection_date?->format('d M Y') ?? '-' }}

                </div>

            </td>

        </tr>

    </table>

</div>


<!-- 1. INSPECTION INFORMATION -->

<div class="section-title">
    1. INSPECTION INFORMATION
</div>

<table>

    <tr>

        <td class="info-label">
            Inspection Number
        </td>

        <td>
            {{ $inspection->inspection_number ?? '-' }}
        </td>

        <td class="info-label">
            Inspection Date
        </td>

        <td>
            {{ $inspection->inspection_date?->format('d M Y') ?? '-' }}
        </td>

    </tr>

    <tr>

        <td class="info-label">
            Site
        </td>

        <td>
            {{ $inspection->tower?->site?->name ?? '-' }}
        </td>

        <td class="info-label">
            Tower
        </td>

        <td>
            {{ $inspection->tower?->name ?? '-' }}
        </td>

    </tr>

    <tr>

        <td class="info-label">
            Tower Type
        </td>

        <td>
            {{ $inspection->tower?->type ?? '-' }}
        </td>

        <td class="info-label">
            Height
        </td>

        <td>
            {{ $inspection->tower?->height ?? '-' }} m
        </td>

    </tr>

    <tr>

        <td class="info-label">
            Template
        </td>

        <td>
            {{ $inspection->template?->name ?? '-' }}
        </td>

        <td class="info-label">
            Inspector
        </td>

        <td>
            {{ $inspection->inspector?->name ?? '-' }}
        </td>

    </tr>

    <tr>

        <td class="info-label">
            Start Time
        </td>

        <td>
            {{ $inspection->start_time ?? '-' }}
        </td>

        <td class="info-label">
            End Time
        </td>

        <td>
            {{ $inspection->end_time ?? '-' }}
        </td>

    </tr>

    <tr>

        <td class="info-label">
            Overall Status
        </td>

        <td>

            @if ($inspection->overall_status === 'abnormal')

                <span class="status status-abnormal">
                    ABNORMAL
                </span>

            @elseif ($inspection->overall_status === 'normal')

                <span class="status status-normal">
                    NORMAL
                </span>

            @else

                <span class="status status-default">
                    {{ strtoupper($inspection->overall_status ?? '-') }}
                </span>

            @endif

        </td>

        <td class="info-label">
            Inspection Status
        </td>

        <td>

            @if ($inspection->status === 'completed')

                <span class="status status-normal">
                    COMPLETED
                </span>

            @else

                <span class="status status-default">
                    {{ strtoupper(str_replace('_', ' ', $inspection->status ?? '-')) }}
                </span>

            @endif

        </td>

    </tr>

</table>


@if ($inspection->notes)

    <div class="sub-title">
        Notes
    </div>

    <table>

        <tr>

            <td>
                {{ $inspection->notes }}
            </td>

        </tr>

    </table>

@endif


<!-- 2. INSPECTION CHECKLIST -->

<div class="section-title">
    2. INSPECTION CHECKLIST
</div>

@if ($inspection->results->count())

    <table>

        <thead>

            <tr>

                <th style="width: 5%;">
                    No.
                </th>

                <th style="width: 30%;">
                    Checklist Item
                </th>

                <th style="width: 12%;">
                    Status
                </th>

                <th>
                    Notes
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach ($inspection->results as $index => $result)

                <tr>

                    <td>
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $result->checklistItem?->item ?? '-' }}
                    </td>

                    <td>

                        @if ($result->status === 'normal')

                            <span class="status status-normal">
                                NORMAL
                            </span>

                        @elseif ($result->status === 'abnormal')

                            <span class="status status-abnormal">
                                ABNORMAL
                            </span>

                        @elseif ($result->status === 'na')

                            <span class="status status-na">
                                N/A
                            </span>

                        @else

                            <span class="status status-default">
                                {{ strtoupper($result->status ?? '-') }}
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $result->notes ?? '-' }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@else

    <div class="empty">
        Belum ada checklist inspection.
    </div>

@endif


<!-- 3. FINDINGS -->

<div class="section-title">
    3. FINDINGS
</div>

@if ($findings->count())

    @foreach ($findings as $finding)

        <div class="finding-box">

            <div class="finding-header">

                <div class="finding-number">
                    {{ $finding->finding_number }}
                </div>

                <div class="finding-title">
                    {{ $finding->title }}
                </div>

            </div>

            <table>

                <tr>

                    <td class="info-label">
                        Severity
                    </td>

                    <td>

                        @php
                            $severityClass = match ($finding->severity) {
                                'low' => 'severity-low',
                                'medium' => 'severity-medium',
                                'high' => 'severity-high',
                                'critical' => 'severity-critical',
                                default => 'status-default',
                            };
                        @endphp

                        <span class="status {{ $severityClass }}">
                            {{ strtoupper($finding->severity ?? '-') }}
                        </span>

                    </td>

                    <td class="info-label">
                        Status
                    </td>

                    <td>

                        <span class="status status-default">
                            {{ strtoupper(str_replace('_', ' ', $finding->status ?? '-')) }}
                        </span>

                    </td>

                </tr>

                <tr>

                    <td class="info-label">
                        Assigned To
                    </td>

                    <td>
                        {{ $finding->assignee?->name ?? 'Unassigned' }}
                    </td>

                    <td class="info-label">
                        Target Date
                    </td>

                    <td>
                        {{ $finding->target_date?->format('d M Y') ?? '-' }}
                    </td>

                </tr>

                <tr>

                    <td class="info-label">
                        Description
                    </td>

                    <td colspan="3">
                        {{ $finding->description ?? '-' }}
                    </td>

                </tr>

                <tr>

                    <td class="info-label">
                        Recommendation
                    </td>

                    <td colspan="3">
                        {{ $finding->recommendation ?? '-' }}
                    </td>

                </tr>

                @if ($finding->resolved_at)

                    <tr>

                        <td class="info-label">
                            Resolved At
                        </td>

                        <td colspan="3">
                            {{ $finding->resolved_at->format('d M Y H:i') }}
                        </td>

                    </tr>

                @endif

                @if ($finding->verified_at)

                    <tr>

                        <td class="info-label">
                            Verified At
                        </td>

                        <td colspan="3">
                            {{ $finding->verified_at->format('d M Y H:i') }}
                        </td>

                    </tr>

                @endif

            </table>

        </div>

    @endforeach

@else

    <div class="empty">
        Tidak ada finding pada inspection ini.
    </div>

@endif


<!-- 4. CORRECTIVE ACTION / WORK ORDERS -->

<div class="section-title">
    4. CORRECTIVE ACTION / WORK ORDER
</div>

@php
    $hasWorkOrders = false;

    foreach ($findings as $finding) {

        if ($finding->workOrders->count()) {

            $hasWorkOrders = true;

            break;
        }
    }
@endphp

@if ($hasWorkOrders)

    @foreach ($findings as $finding)

        @if ($finding->workOrders->count())

            @foreach ($finding->workOrders as $workOrder)

                <div class="wo-box">

                    <div class="wo-header">

                        <div class="wo-number">
                            {{ $workOrder->work_order_number }}
                        </div>

                        <div class="small">
                            Finding:
                            {{ $finding->finding_number }}
                        </div>

                    </div>

                    <table>

                        <tr>

                            <td class="info-label">
                                Description
                            </td>

                            <td colspan="3">
                                {{ $workOrder->description ?? '-' }}
                            </td>

                        </tr>

                        <tr>

                            <td class="info-label">
                                Assigned To
                            </td>

                            <td>
                                {{ $workOrder->assignee?->name ?? 'Unassigned' }}
                            </td>

                            <td class="info-label">
                                Priority
                            </td>

                            <td>
                                {{ strtoupper($workOrder->priority ?? '-') }}
                            </td>

                        </tr>

                        <tr>

                            <td class="info-label">
                                Start Date
                            </td>

                            <td>
                                {{ $workOrder->start_date?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="info-label">
                                Due Date
                            </td>

                            <td>
                                {{ $workOrder->due_date?->format('d M Y') ?? '-' }}
                            </td>

                        </tr>

                        <tr>

                            <td class="info-label">
                                Completed Date
                            </td>

                            <td>
                                {{ $workOrder->completed_date?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="info-label">
                                Status
                            </td>

                            <td>
                                {{ strtoupper(str_replace('_', ' ', $workOrder->status ?? '-')) }}
                            </td>

                        </tr>

                    </table>


                    @if ($workOrder->maintenanceRecords->count())

                        <div class="maintenance-box">

                            <div class="sub-title">
                                Maintenance Records
                            </div>

                            <table>

                                <thead>

                                    <tr>

                                        <th>
                                            Date
                                        </th>

                                        <th>
                                            Asset
                                        </th>

                                        <th>
                                            Technician
                                        </th>

                                        <th>
                                            Action
                                        </th>

                                        <th>
                                            Result
                                        </th>

                                        <th>
                                            Cost
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($workOrder->maintenanceRecords as $maintenance)

                                        <tr>

                                            <td class="nowrap">
                                                {{ $maintenance->maintenance_date?->format('d M Y') ?? '-' }}
                                            </td>

                                            <td>

                                                {{ $maintenance->asset?->name ?? '-' }}

                                                <br>

                                                <span class="small">
                                                    {{ $maintenance->asset?->asset_code ?? '' }}
                                                </span>

                                            </td>

                                            <td>
                                                {{ $maintenance->technician?->name ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $maintenance->action ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $maintenance->result ?? '-' }}
                                            </td>

                                            <td class="nowrap">
                                                Rp
                                                {{ number_format((float) $maintenance->cost, 0, ',', '.') }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @endif

                </div>

            @endforeach

        @endif

    @endforeach

@else

    <div class="empty">
        Belum ada Work Order / Corrective Action.
    </div>

@endif


<!-- 5. INSPECTION PHOTO DOCUMENTATION -->

<div class="page-break"></div>

<div class="section-title">
    5. INSPECTION PHOTO DOCUMENTATION
</div>

@if ($inspection->photos->count())

    <div class="photo-grid">

        @foreach ($inspection->photos as $photo)

            @php
                $imageSrc = $toDataUri($photo->file_path);
            @endphp

            <div class="photo-card">

                @if ($imageSrc)

                    <img
                        src="{{ $imageSrc }}"
                        class="photo-image"
                    >

                @else

                    <div class="photo-placeholder">
                        Gambar tidak dapat ditampilkan
                    </div>

                @endif

                <div class="photo-caption">

                    <strong>
                        {{ $photo->caption ?? 'Inspection Photo' }}
                    </strong>

                    <br>

                    {{ $photo->file_name }}

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="empty">
        Belum ada foto inspection.
    </div>

@endif


<!-- 6. FINDING PHOTO DOCUMENTATION -->

<div class="section-title">
    6. FINDING PHOTO DOCUMENTATION
</div>

@php
    $hasFindingPhotos = false;

    foreach ($findings as $finding) {

        if ($finding->photos->count()) {

            $hasFindingPhotos = true;

            break;
        }
    }
@endphp

@if ($hasFindingPhotos)

    @foreach ($findings as $finding)

        @if ($finding->photos->count())

            <div class="sub-title">
                {{ $finding->finding_number }}
                -
                {{ $finding->title }}
            </div>

            <div class="photo-grid">

                @foreach ($finding->photos as $photo)

                    @php
                        $imageSrc = $toDataUri($photo->file_path);
                    @endphp

                    <div class="photo-card">

                        @if ($imageSrc)

                            <img
                                src="{{ $imageSrc }}"
                                class="photo-image"
                            >

                        @else

                            <div class="photo-placeholder">
                                Gambar tidak dapat ditampilkan
                            </div>

                        @endif

                        <div class="photo-caption">

                            <strong>
                                {{ $photo->caption ?? 'Finding Photo' }}
                            </strong>

                            <br>

                            {{ $photo->file_name }}

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    @endforeach

@else

    <div class="empty">
        Belum ada foto finding.
    </div>

@endif


<!-- 7. REVIEWED BY -->

<div class="section-title">
    7. REVIEWED BY
</div>

<table class="signature-table">

    <tr>

        <td>

            <div class="signature-title">
                Inspector
            </div>

            <div class="signature-space">
                &nbsp;
            </div>

            <div class="signature-line">
                ______________________________
            </div>

            <div class="signature-name">
                {{ $inspection->inspector?->name ?? '________________' }}
            </div>

            <div class="signature-position">
                Inspection Officer
            </div>

        </td>


        <td>

            <div class="signature-title">
                Reviewed By
            </div>

            <div class="signature-space">
                &nbsp;
            </div>

            <div class="signature-line">
                ______________________________
            </div>

            <div class="signature-name">
                Rachmani Mas Sasmitha
            </div>

            <div class="signature-position">
                IT SUPERVISOR
            </div>

        </td>

    </tr>

</table>


<div class="footer">
    IT-TIMS — IT Tower Inspection & Maintenance System
</div>

</body>
</html>