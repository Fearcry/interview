<!DOCTYPE html>
<html lang="en" class="login-html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Project - Dashboard</title>
    <link rel="stylesheet" href="{{ mix('css/dashboard/dashboard.css') }}">
    @toastr_css
    @stack('header')
</head>

<body class="login-body">


    @yield('body')
    @yield('footer')
    <script src="{{ mix('js/dashboard/dashboard.js') }}"></script>
    @toastr_js
    @toastr_render
    @stack('scripts')
</body>

</html>
