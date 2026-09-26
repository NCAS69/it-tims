<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'IT-TIMS')
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #111827;
            color: white;
            padding: 24px 16px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 28px;
            padding: 0 10px;
        }

        .brand small {
            display: block;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 4px;
            font-weight: normal;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1f2937;
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                padding: 20px;
            }
        }

        @media (max-width: 600px) {
            .app-wrapper {
                display: block;
            }

            .sidebar {
                width: 100%;
            }

            .main-content {
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="app-wrapper">

    <aside class="sidebar">

        <div class="brand">
            IT-TIMS
            <small>IT Tower Inspection & Maintenance System</small>
        </div>

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('sites.index') }}">
            Sites
        </a>

        <a href="{{ route('towers.index') }}">
            Towers
        </a>

        <a href="{{ route('assets.index') }}">
            Assets
        </a>

        <a href="{{ route('inspections.create') }}">
            New Inspection
        </a>

        <a href="{{ route('inspections.index') }}">
            Inspection History
        </a>

        <a href="{{ route('findings.index') }}">
            Findings
        </a>

        <a href="{{ route('work-orders.index') }}">
            Work Orders
        </a>

        <a href="{{ route('maintenance.index') }}">
            Maintenance History
        </a>
        <a href="{{ route('users.index') }}">
    Users
</a>

<form action="{{ route('logout') }}" method="POST" style="margin-top:20px;">
    @csrf

    <button type="submit"
        style="
            width:100%;
            padding:11px 12px;
            border:none;
            background:#dc2626;
            color:white;
            border-radius:8px;
            font-size:14px;
            cursor:pointer;
            text-align:left;
        ">
        Logout
    </button>
</form>

    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</div>

@stack('scripts')

</body>
</html>