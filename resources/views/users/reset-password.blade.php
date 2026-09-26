@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div style="max-width:600px;">

    <h1 style="margin-bottom:6px;">Reset Password</h1>

    <p style="color:#6b7280;margin-top:0;margin-bottom:24px;">
        Reset password for
        <strong>{{ $user->name }}</strong>
        ({{ $user->username }})
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

    <form
        action="{{ route('users.reset-password.update', $user) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div style="background:white;padding:24px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);">

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
                style="padding:11px 18px;background:#f59e0b;color:white;border:0;border-radius:8px;cursor:pointer;"
            >
                Reset Password
            </button>

            <a
                href="{{ route('users.index') }}"
                style="margin-left:8px;padding:11px 18px;background:#e5e7eb;color:#374151;text-decoration:none;border-radius:8px;"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection