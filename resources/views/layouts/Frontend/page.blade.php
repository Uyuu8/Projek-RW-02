<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Website RW')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- STYLE --}}
    @include('layouts.Frontend.style')

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        /* Wrapper full tinggi layar */
        #wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        /* HEADER & FOOTER spacing */
        header {
            width: 100%;
        }

        footer {
            width: 100%;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<div id="wrapper">

    {{-- ================= HEADER ================= --}}
    <header>
        @include('frontend.content.header')
    </header>

    {{-- ================= MAIN CONTENT ================= --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer>
        @include('frontend.content.footer')
    </footer>

</div>

{{-- SCRIPT --}}
@include('layouts.Frontend.scripts')
@stack('scripts')

</body>
</html>
