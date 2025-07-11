<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'TransGest')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    @yield('scripts')

    <body class="d-flex flex-column min-vh-100">

        @include('partials.header')

        @hasSection('header')
            <header class="container mt-4 mb-4">
                @yield('header')
            </header>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <main class="container flex-fill">
            @yield('content')
        </main>

        @auth
            @php
                $role = Auth::user()->role->name ?? null;
            @endphp

            @if($role === 'admin' || $role === 'client')
                @include('partials.footer')
            @endif
        @endauth

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
