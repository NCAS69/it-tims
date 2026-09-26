@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div style="max-width:600px;">

    <h1 style="margin-bottom:6px;">Change Password</h1>

    <p style="color:#6b7280;margin-top:0;margin-bottom:24px;">
        Change your IT-TIMS account password.
    </p>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:14px;border-radius:8px;margin-bottom:20px;">
            <ul style="margin:0 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update-password') }}" method="POST">

        @csrf
        @method('PUT')

        <div style="background:white;padding:24px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);">

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    Current Password
                </label>

                <input
                    type="password"
                    name="current_password"
                    required
                    style="width:100%;padding:11px;border:1px solid #d1d5db;border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:600;margin-bottom:7px;">
                    New Password
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
                    Confirm New Password
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
                style="padding:11px 18px;background:#2563eb;color:white;border:0;border-radius:8px;cursor:pointer;"
            >
                Change Password
            </button>

        </div>

    </form>

</div>

@endsection