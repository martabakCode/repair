<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">



    @stack('styles')
    <style>
        .sidebar-dark-primary {
            background-color: #dc3545; /* Red background color */
            color: white; /* Text color */
        }

        .sidebar-dark-primary .nav-link {
            color: white !important; /* Change text color of navigation links */
        }

        .sidebar-dark-primary .brand-link {
            color: white !important; /* Change text color of navigation links */
            border-bottom: 1px solid white;
        }

        .sidebar-dark-primary .nav-link:hover,
        .sidebar-dark-primary .nav-link.active {
            background-color: #c82333 !important; /* Darker red for active and hover states */
            color: white !important; /* Text color on hover or active */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                    </div>
                    <!-- Breadcrumbs -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    @include('layouts.partials.footer')
</div>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>
