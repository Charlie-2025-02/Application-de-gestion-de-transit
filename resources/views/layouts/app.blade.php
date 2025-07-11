<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'TransGest')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    @yield('scripts')

    <body class="d-flex flex-column min-vh-100" style="background-color: #ffffff;">

        @auth
            @php
                $role = Auth::user()->role->name ?? null;
            @endphp

            @if($role === 'client')
                @include('partials.header')

            @elseif ($role != 'client')
                @include('partials.header1')

            @endif
        @else
            @include('partials.header1')
        @endauth

        @hasSection('header1')
            <header class="container mt-4 mb-4">
                @yield('header1')
            </header>
        @endif


        <main class="container flex-fill">
            @yield('content')
        </main>

        @php
            $role = Auth::user()->role->name ?? null;
        @endphp

        @auth


            @if($role === 'client')
                @include('partials.footer')
            @elseif(($role != 'client') || ($role != 'admin'))
                @include('partials.footer1')
            @elseif ($role === 'admin' && request()->routeIs('apropos'))
                @include('partials.footer1')
            @elseif ($role === 'admin' && !request()->routeIs('apropos'))
                @include('partials.footer')
            @elseif ($role === 'admin' && request()->routeIs('accueil'))
                @include('partials.footer')
            @elseif ($role === 'admin' && request()->routeIs('auth.login'))
                @include('partials.footer1')
            @endif
        @endauth

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
