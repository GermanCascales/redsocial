<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans bg-gray-background dark:bg-slate-900 text-gray-900 dark:text-white text-sm antialiased">
        <x-jet-banner />

        <div class="min-h-screen">
            @livewire('navigation-menu')

            @livewire('notification-bar')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if (session('error_alert'))
                <x-alert :from-redirect="true" alert-message="{{ session('error_alert') }}" type="error" />
            @elseif (session('ok_alert'))
                <x-alert :from-redirect="true" alert-message="{{ session('ok_alert') }}"/>
            @endif

            <!-- Page Content -->
            <main class="container mx-auto max-w-custom my-4">
                {{ $slot }}          
            </main>
        </div>

        @stack('modals')

        @stack('scripts')

        @livewireScripts
    </body>
</html>
