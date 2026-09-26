@extends('layouts.app')

@section('title', 'Inspection Checklist')

@section('content')

@php
    $isAdmin = auth()->user()?->username === 'admin';
@endphp

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="margin:0 0 6px;">Inspection Checklist</h1>

        <p style="margin:0;color:#6b7280;">
            Manage checklist inspection for IT-TIMS
        </p>
    </div>

    <div style="display:flex;gap:10px;">

        @if ($isAdmin)
            <a href="{{ route('checklists.create') }}"
               style="padding:10px 16px;background:#16a34a;color:white;text-decoration:none;border-radius:8px;">
                + Add Checklist
            </a>
        @endif

    </div>
</div>

@if (session('success'))
    <div style="background:#dcfce7;color:#166534;padding:14px 16px;border-radius:8px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<div style="background:white;border-radius:12px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,.06);overflow-x:auto;">

    <table style="width:100%;border-collapse:collapse;">

        <thead>
            <tr style="border-bottom:1px solid #e5e7eb;text-align:left;">
                <th style="padding:12px;">No</th>
                <th style="padding:12px;">Template</th>
                <th style="padding:12px;">Category</th>
                <th style="padding:12px;">Checklist</th>
                <th style="padding:12px;">Description</th>
                <th style="padding:12px;">Required</th>

                @if ($isAdmin)
                    <th style="padding:12px;">Action</th>
                @endif
            </tr>
        </thead>

        <tbody>

        @foreach ($checklists as $checklist)

            <tr style="border-bottom:1px solid #f3f4f6;">

                <td style="padding:12px;">
                    {{ $checklist->sort_order }}
                </td>

                <td style="padding:12px;">
                    {{ $checklist->template?->name ?? '-' }}
                </td>

                <td style="padding:12px;">
                    {{ $checklist->category }}
                </td>

                <td style="padding:12px;">
                    <strong>{{ $checklist->item }}</strong>
                </td>

                <td style="padding:12px;color:#6b7280;">
                    {{ $checklist->description ?: '-' }}
                </td>

                <td style="padding:12px;">
                    @if ($checklist->is_required)
                        <span style="
                            padding:5px 9px;
                            border-radius:999px;
                            background:#dcfce7;
                            color:#166534;
                            font-size:12px;
                        ">
                            Yes
                        </span>
                    @else
                        <span style="
                            padding:5px 9px;
                            border-radius:999px;
                            background:#f3f4f6;
                            color:#374151;
                            font-size:12px;
                        ">
                            No
                        </span>
                    @endif
                </td>

                @if ($isAdmin)
                    <td style="padding:12px;">
                        <a href="{{ route('checklists.edit', $checklist) }}"
                           style="padding:7px 11px;background:#2563eb;color:white;text-decoration:none;border-radius:6px;font-size:13px;">
                            Edit
                        </a>
                    </td>
                @endif

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection