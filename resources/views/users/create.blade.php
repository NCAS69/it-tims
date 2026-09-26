@extends('layouts.app')

@section('title', 'Add User')

@section('content')

<div style="max-width:700px;">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 6px;">Add User</h1>

            <p style="margin:0;color:#6b7280;">
                Add new IT-TIMS user
            </p>
        </div>

        <a href="{{ route('users.index') }}"
           style="padding:10px 16px;background:#6b7280;color:white;text-decoration:none;border-radius:8px;">
            ← Back
        </a>
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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div style="background:white;padding:24px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);">

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Role
                </label>

                <select
                    name="role"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
                    <option value="inspector"
                        {{ old('role', 'inspector') === 'inspector' ? 'selected' : '' }}>
                        Inspector
                    </option>

                    <option value="supervisor"
                        {{ old('role') === 'supervisor' ? 'selected' : '' }}>
                        Supervisor
                    </option>
                </select>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <button
                type="submit"
                style="padding:11px 20px;background:#16a34a;color:white;border:0;border-radius:8px;cursor:pointer;"
            >
                Add User
            </button>

        </div>
    </form>

</div>

@endsection