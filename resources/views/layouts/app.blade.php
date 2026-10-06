<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('layouts.theme-init')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-ink">
        <a href="#main-content" class="rf-skip">Skip to content</a>
        <div class="min-h-screen bg-surface-soft">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-surface border-b border-line">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main id="main-content" tabindex="-1">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
