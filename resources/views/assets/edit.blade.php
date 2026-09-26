@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 6px;">Edit Asset</h1>
            <p style="margin:0;color:#6b7280;">
                Perbarui informasi asset {{ $asset->asset_code }}
            </p>
        </div>

        <a href="{{ route('assets.index') }}"
           style="padding:10px 16px;background:#6b7280;color:white;text-decoration:none;border-radius:8px;">
            ← Back
        </a>
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:14px 16px;border-radius:8px;margin-bottom:20px;">
            <strong>Terdapat kesalahan:</strong>
            <ul style="margin:8px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="background:#dcfce7;color:#166534;padding:14px 16px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('assets.update', $asset) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="background:white;border-radius:12px;padding:24px;box-shadow:0 2px 10px rgba(0,0,0,.06);">

            <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px;">

                <div>
                    <label for="tower_id" style="display:block;font-weight:600;margin-bottom:7px;">
                        Tower
                    </label>

                    <select name="tower_id" id="tower_id" required
                            style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                        <option value="">-- Select Tower --</option>

                        @foreach ($towers as $tower)
                            <option value="{{ $tower->id }}"
                                {{ old('tower_id', $asset->tower_id) == $tower->id ? 'selected' : '' }}>
                                {{ $tower->name }}
                                @if ($tower->site)
                                    - {{ $tower->site->name }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="category_id" style="display:block;font-weight:600;margin-bottom:7px;">
                        Category
                    </label>

                    <select name="category_id" id="category_id" required
                            style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                        <option value="">-- Select Category --</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="asset_code" style="display:block;font-weight:600;margin-bottom:7px;">
                        Asset Code
                    </label>

                    <input type="text"
                           name="asset_code"
                           id="asset_code"
                           value="{{ old('asset_code', $asset->asset_code) }}"
                           required
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="name" style="display:block;font-weight:600;margin-bottom:7px;">
                        Asset Name
                    </label>

                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $asset->name) }}"
                           required
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="brand" style="display:block;font-weight:600;margin-bottom:7px;">
                        Brand
                    </label>

                    <input type="text"
                           name="brand"
                           id="brand"
                           value="{{ old('brand', $asset->brand) }}"
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="model" style="display:block;font-weight:600;margin-bottom:7px;">
                        Model
                    </label>

                    <input type="text"
                           name="model"
                           id="model"
                           value="{{ old('model', $asset->model) }}"
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="serial_number" style="display:block;font-weight:600;margin-bottom:7px;">
                        Serial Number
                    </label>

                    <input type="text"
                           name="serial_number"
                           id="serial_number"
                           value="{{ old('serial_number', $asset->serial_number) }}"
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="ip_address" style="display:block;font-weight:600;margin-bottom:7px;">
                        IP Address
                    </label>

                    <input type="text"
                           name="ip_address"
                           id="ip_address"
                           value="{{ old('ip_address', $asset->ip_address) }}"
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="mac_address" style="display:block;font-weight:600;margin-bottom:7px;">
                        MAC Address
                    </label>

                    <input type="text"
                           name="mac_address"
                           id="mac_address"
                           value="{{ old('mac_address', $asset->mac_address) }}"
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="installation_date" style="display:block;font-weight:600;margin-bottom:7px;">
                        Installation Date
                    </label>

                    <input type="date"
                           name="installation_date"
                           id="installation_date"
                           value="{{ old('installation_date', optional($asset->installation_date)->format('Y-m-d')) }}"
                           style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">
                </div>

                <div>
                    <label for="status" style="display:block;font-weight:600;margin-bottom:7px;">
                        Status
                    </label>

                    <select name="status" id="status" required
                            style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;">

                        @foreach ([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'maintenance' => 'Maintenance',
                            'damaged' => 'Damaged',
                            'retired' => 'Retired'
                        ] as $value => $label)

                            <option value="{{ $value }}"
                                {{ old('status', $asset->status) === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>

                        @endforeach
                    </select>
                </div>

                <div style="grid-column:1 / -1;">
                    <label for="description" style="display:block;font-weight:600;margin-bottom:7px;">
                        Description
                    </label>

                    <textarea name="description"
                              id="description"
                              rows="5"
                              style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;resize:vertical;">{{ old('description', $asset->description) }}</textarea>
                </div>

            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;">
                <a href="{{ route('assets.index') }}"
                   style="padding:11px 18px;background:#e5e7eb;color:#374151;text-decoration:none;border-radius:8px;">
                    Cancel
                </a>

                <button type="submit"
                        style="padding:11px 20px;background:#2563eb;color:white;border:none;border-radius:8px;cursor:pointer;">
                    Update Asset
                </button>
            </div>

        </div>
    </form>
</div>
@endsection