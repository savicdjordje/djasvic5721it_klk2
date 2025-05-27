{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="{{ asset('custom_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('custom_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
</head>
<body id="page-top">

    <div id="wrapper">
        @include('components.admin-sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.admin-topbar')

                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto text-center">
                    <span>Copyright &copy; AutoLak {{ date('Y') }}</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('custom_admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('custom_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('custom_admin/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
