@extends('layouts.app')

@section('title', 'Users')

@section('content')

@php
    $isAdmin = auth()->check()
        && auth()->user()->username === 'admin';
@endphp

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="margin:0 0 6px;">User Management</h1>

        <p style="margin:0;color:#6b7280;">
            Manage IT-TIMS users
        </p>
    </div>

    <div style="display:flex;gap:10px;">

        <a href="{{ route('users.change-password') }}"
           style="padding:10px 16px;background:#2563eb;color:white;text-decoration:none;border-radius:8px;">
            Change My Password
        </a>

        @if ($isAdmin)
            <a href="{{ route('users.create') }}"
               style="padding:10px 16px;background:#16a34a;color:white;text-decoration:none;border-radius:8px;">
                + Add User
            </a>
        @endif

    </div>
</div>

@if (session('success'))
    <div style="background:#dcfce7;color:#166534;padding:14px 16px;border-radius:8px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:14px 16px;border-radius:8px;margin-bottom:20px;">
        <ul style="margin:0 0 0 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="background:white;border-radius:12px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,.06);overflow-x:auto;">

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:1px solid #e5e7eb;text-align:left;">
                <th style="padding:12px;">Name</th>
                <th style="padding:12px;">Username</th>
                <th style="padding:12px;">Email</th>
                <th style="padding:12px;">Role</th>
                <th style="padding:12px;">Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach ($users as $user)

            <tr style="border-bottom:1px solid #f3f4f6;">

                <td style="padding:12px;">
                    <strong>{{ $user->name }}</strong>

                    @if ($user->username === auth()->user()->username)
                        <span style="margin-left:6px;color:#2563eb;font-size:11px;">
                            (You)
                        </span>
                    @endif
                </td>

                <td style="padding:12px;">
                    {{ $user->username }}
                </td>

                <td style="padding:12px;">
                    {{ $user->email }}
                </td>

                <td style="padding:12px;">

                    @if ($user->role === 'supervisor')

                        <span style="
                            display:inline-block;
                            padding:5px 10px;
                            border-radius:999px;
                            background:#dbeafe;
                            color:#1d4ed8;
                            font-size:12px;
                        ">
                            Supervisor
                        </span>

                    @else

                        <span style="
                            display:inline-block;
                            padding:5px 10px;
                            border-radius:999px;
                            background:#f3f4f6;
                            color:#374151;
                            font-size:12px;
                        ">
                            Inspector
                        </span>

                    @endif

                </td>

                <td style="padding:12px;">

                    @if ($isAdmin)

                        <a href="{{ route('users.edit', $user) }}"
                           style="display:inline-block;padding:7px 11px;background:#2563eb;color:white;text-decoration:none;border-radius:6px;font-size:13px;">
                            Edit
                        </a>

                        <a href="{{ route('users.reset-password', $user) }}"
                           style="display:inline-block;padding:7px 11px;background:#f59e0b;color:white;text-decoration:none;border-radius:6px;font-size:13px;margin-left:5px;">
                            Reset Password
                        </a>

                    @else

                        <span style="color:#9ca3af;font-size:13px;">
                            No management access
                        </span>

                    @endif

                </td>

            </tr>

        @endforeach

        </tbody>
    </table>

</div>

@endsection