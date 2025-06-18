<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Backoffice')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        @if (!request()->routeIs('home'))
            <div class="d-flex align-item-center justify-content-end py-3">
                <a href="{{ route('home') }}" class="btn btn-outline-dark shadow-sm rounded-pill px-4">
                    🏠 Home
                </a>
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>
