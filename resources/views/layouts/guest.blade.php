<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #621d62 0%, #000 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        @yield('content')
    </div>

    @stack('scripts')
    
    <script>
        // Inicializar ícones Lucide
        lucide.createIcons();
    </script>
</body>
</html>
