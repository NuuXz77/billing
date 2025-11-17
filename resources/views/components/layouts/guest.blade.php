<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('img/logo/Hoci_Logo.svg') }}">

    {{-- Google Fonts - Source Sans Pro --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Stack untuk styles tambahan dari child views --}}
    @stack('styles')
</head>
<body class="min-screen font-sans antialiased bg-base-200">
        {{-- The `$slot` goes here --}}
            {{ $slot }}
    {{--  TOAST area --}}
    <x-toast />
    
    {{-- Stack untuk scripts tambahan dari child views --}}
    @stack('scripts')
</body>
</html>
