<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
</head>
<body class="min-h-screen bg-gray-50">
<!-- Header with navbar -->
@include('layouts.partials.header')

<!-- Main content -->
<main class="container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer -->
@include('layouts.partials.footer')

<!-- Scripts -->
@vite('resources/js/app.js')
</body>
</html>
