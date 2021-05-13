<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Project</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @toastr_css
    @stack('header')
</head>

<body>

    @include('frontend.particles.navbar')
    @yield('body')
    @yield('footer')
    <script src="{{ mix('js/app.js') }}"></script>
    @toastr_js
    @toastr_render
    @stack('scripts')

</body>

</html>
