<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/svg" href="{{asset('bladewind/images/book-outline.svg')}}">
        <title>{{ config('app.name', 'GradeOnline') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        <!-- Styles -->
        <link href="{{ asset('bladewind/css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('bladewind/js/helpers.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <!-- Scripts -->
        <script src="{{ asset('js/js.js') }}" defer></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['./node_modules/tw-elements/dist/css/index.min.css','./node_modules/tw-elements/dist/js/index.min.js'])

    </head>
    <body class="font-sans antialiased body">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{ $modal }}

        @include('layouts.navigation')
        <div class="main">
            <!-- Page Heading -->
            <header class="header">
                {{ $header }}
            </header>

            <!-- Page Content -->
            <main class="min-w-7xl m-auto">
                {{ $slot }}
            </main>
            <x-flash/>
        </div>





        <!----Font Icon---->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

        <!---Custom File---->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



        <script>
            config={
                enableTime : true,
                dateFormat : "Y-m-d H:i",
            }
            flatpickr("input[type=datetime-local]", config);
        </script>
    </body>
</html>

