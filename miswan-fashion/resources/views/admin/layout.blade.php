<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Control Panel') - SijaWorld</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/ecommerce/dist/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css') }}" />

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f6f9;
        }
        .admin-sidebar {
            min-height: 100vh;
            background-color: #1e293b;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .admin-sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            font-weight: 500;
            border-radius: 6px;
            margin: 4px 10px;
            transition: all 0.2s;
        }
        .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active {
            color: #fff;
            background-color: #334155;
        }
        .admin-sidebar .nav-link i {
            width: 24px;
        }
        .admin-main-content {
            margin-left: 250px;
            padding: 25px;
            min-height: 100vh;
        }
        .admin-topbar {
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 25px;
            margin: -25px -25px 25px -25px;
        }
    </style>
    @stack('styles')
</head>
<body>
    @php
        $currentAdmin = Auth::guard('admin')->user();
    @endphp

    <!-- Sidebar -->
    <aside class="admin-sidebar shadow">
        <div class="p-3 text-center border-bottom border-secondary mb-3">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">
                <h5 class="font-weight-bold m-0"><img src="https://www.sijaworld.com/core/public/storage/images/l4WGlogo.png" alt="SijaWorld Logo" style="max-height: 30px;"></h5>
            </a>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer"></i> Dashboard
                </a>
            </li>

            @if($currentAdmin && $currentAdmin->hasPermission('manage_orders'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="fa fa-shopping-cart"></i> Manage Orders
                </a>
            </li>
            @endif

            @if($currentAdmin && $currentAdmin->hasPermission('manage_products'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="fa fa-cube"></i> Products Catalog
                </a>
            </li>
            @endif

            @if($currentAdmin && $currentAdmin->hasPermission('manage_categories'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-folder-open"></i> Categories
                </a>
            </li>
            @endif

            @if($currentAdmin && $currentAdmin->hasPermission('manage_sliders'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}" href="{{ route('admin.sliders.index') }}">
                    <i class="fa fa-picture-o"></i> Sliders & Banners
                </a>
            </li>
            @endif

            @if($currentAdmin && $currentAdmin->hasPermission('manage_settings'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="fa fa-cogs"></i> General Settings
                </a>
            </li>
            @endif

            @if($currentAdmin && $currentAdmin->hasPermission('manage_admins'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fa fa-users-cog"></i> Admin Staff & Roles
                </a>
            </li>
            @endif

            <li class="nav-item mt-4">
                <a class="nav-link text-info" href="{{ url('/') }}" target="_blank">
                    <i class="fa fa-external-link"></i> Visit Website
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-main-content">
        <!-- Topbar -->
        <header class="admin-topbar d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-dark">@yield('page_title', 'Dashboard')</h5>
            <div class="d-flex align-items-center">
                <span class="mr-3 text-dark small">
                    <i class="fa fa-user-circle text-primary mr-1"></i>
                    <strong>{{ $currentAdmin->name ?? 'Administrator' }}</strong>
                    @if($currentAdmin && $currentAdmin->isSuperAdmin())
                        <span class="badge badge-primary ml-1">Superadmin</span>
                    @else
                        <span class="badge badge-info ml-1">Sub-Admin</span>
                    @endif
                </span>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-sign-out"></i> Logout</button>
                </form>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle mr-1"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
            </div>
        @endif

        @yield('admin_content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/vendor_assets/cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
