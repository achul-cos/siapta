<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ config('app.name') ?? 'SiapTA' }}</title>
    </head>
    <body class="bg-background antialiased min-h-screen" x-data="{ sidebarOpen: true }" x-init="window.addEventListener('sidebar-toggled', e => sidebarOpen = e.detail)">      
        {{ $slot }}
    </body>
</html>
