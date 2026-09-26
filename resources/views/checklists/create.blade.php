@extends('layouts.app')

@section('title', 'Add Checklist')

@section('content')

<div style="max-width:800px;">

    <div style="margin-bottom:24px;">
        <h1 style="margin:0 0 6px;">Add Inspection Checklist</h1>

        <p style="margin:0;color:#6b7280;">
            Add a new checklist item
        </p>
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:14px;border-radius:8px;margin-bottom:20px;">
            <ul style="margin:0 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checklists.store') }}" method="POST">
        @csrf

        <div style="background:white;padding:24px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);">

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Template
                </label>

                <select
                    name="template_id"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
                    <option value="">-- Select Template --</option>

                    @foreach ($templates as $template)
                        <option value="{{ $template->id }}"
                            {{ old('template_id') == $template->id ? 'selected' : '' }}>
                            {{ $template->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Category
                </label>

                <input
                    type="text"
                    name="category"
                    value="{{ old('category') }}"
                    placeholder="Example: Networking"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Checklist Item
                </label>

                <input
                    type="text"
                    name="item"
                    value="{{ old('item') }}"
                    placeholder="Example: Kondisi kabel FO"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    placeholder="Description / inspection instruction"
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >{{ old('description') }}</textarea>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Sort Order
                </label>

                <input
                    type="number"
                    name="sort_order"
                    value="{{ old('sort_order') }}"
                    min="1"
                    placeholder="Leave empty for automatic"
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:22px;">
                <label style="display:flex;align-items:center;gap:8px;font-weight:600;">
                    <input
                        type="checkbox"
                        name="is_required"
                        value="1"
                        checked
                    >
                    Required Checklist
                </label>
            </div>

            <button
                type="submit"
                style="padding:11px 20px;background:#16a34a;color:white;border:none;border-radius:8px;cursor:pointer;"
            >
                Save Checklist
            </button>

            <a
                href="{{ route('checklists.index') }}"
                style="margin-left:8px;padding:11px 18px;background:#e5e7eb;color:#374151;text-decoration:none;border-radius:8px;"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection