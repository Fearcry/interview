<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Project - Dashboard</title>
    <link rel="stylesheet" href="{{ mix('css/dashboard/dashboard.css') }}">
    @toastr_css
    @stack('styles')
</head>

<body>
    @include('dashboard.particles.header')
    <div class="container-fluid">
        <div class="row">
            @include('dashboard.particles.sidebar')
            <main class="ml-auto col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('body')
            </main>
        </div>
    </div>
    @yield('footer')
    <script src="{{ mix('js/dashboard/dashboard.js') }}"></script>
    @toastr_js
    @toastr_render
    @stack('scripts')
</body>

</html>
