<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Article Management System')</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="icon" type="image/x-icon" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="build/assets/css/custom.css"> 
 
    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

</head>
<body>

    @include('includes.navbar')


    <main class="container">
        @include('includes.messages')
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Article Hub. Built with Laravel & Bootstrap.</p>
        </div>
    </footer>

        @yield('scripts')
</body>
</html>