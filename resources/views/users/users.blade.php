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

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Stack untuk styles tambahan dari child views --}}
    @stack('styles')
</head>
<body class="min-screen font-sans antialiased bg-base-200">
    {{-- Top Navbar --}}
    @include('users.sections.partials.navbar_section')
    
    {{-- Content Sections --}}
    @if(!isset($section))
        @include('users.sections.dashboard_section')
    @elseif($section === 'hosting-plans')
        @include('users.sections.hosting_plans_section')
    @elseif($section === 'my-subscriptions')
        @include('users.sections.my_subscriptions_section')
    @elseif($section === 'manage-hosting')
        @include('users.sections.manage_hosting_section')
    @elseif($section === 'my-subdomains')
        @include('users.sections.my_subdomains_section')
    @elseif($section === 'dns-settings')
        @include('users.sections.dns_settings_section')
    @elseif($section === 'invoices')
        @include('users.sections.invoices_section')
    @elseif($section === 'transaction-history')
        @include('users.sections.transaction_history_section')
    @elseif($section === 'my-profile')
        @include('users.sections.my_profile_section')
    @elseif($section === 'account-settings')
        @include('users.sections.account_settings_section')
    @elseif($section === 'live-chat')
        @include('users.sections.live_chat_section')
    @endif
    
    {{--  TOAST area --}}
    <x-toast />
    
    {{-- Stack untuk scripts tambahan dari child views --}}
    @stack('scripts')
</body>
</html>
