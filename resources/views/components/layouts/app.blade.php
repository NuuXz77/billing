<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ theme: localStorage.getItem('theme') || 'light' }" :data-theme="theme" x-init="$watch('theme', value => localStorage.setItem('theme', value))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Livewire Navigate Loading Bar */
        [x-cloak] {
            display: none !important;
        }

        .livewire-progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: oklch(45% 0.24 277.023);
            /* primary color */
            z-index: 9999;
            transition: width 0.3s ease;
            box-shadow: 0 0 10px oklch(45% 0.24 277.023);
        }
    </style>

    @livewireStyles
</head>

<body class="min-h-screen font-sans antialiased bg-base-200" x-data="{ 
        sidebarOpen: localStorage.getItem('sidebarOpen') === 'false' ? false : true,
        hoverOpen: sessionStorage.getItem('hoverOpen') === 'true' ? true : false,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        }
    }" x-init="$watch('hoverOpen', value => sessionStorage.setItem('hoverOpen', value))">
    {{-- MAIN LAYOUT WITH SIDEBAR --}}
    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <x-admin.sidebar />
        
        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col min-w-0 transition-all duration-300">
            <x-admin.navbar/>
            <div class="flex-1 p-4 md:p-6 lg:p-8">
                <div class="w-full mx-auto">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
    
    <script>
        // Livewire Navigate Loading Indicator
        document.addEventListener('livewire:navigate', () => {
            const loadingBar = document.createElement('div');
            loadingBar.className = 'livewire-progress-bar';
            loadingBar.style.width = '0%';
            document.body.appendChild(loadingBar);
            
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 30;
                if (progress > 90) progress = 90;
                loadingBar.style.width = progress + '%';
            }, 200);
            
            document.addEventListener('livewire:navigated', () => {
                clearInterval(interval);
                loadingBar.style.width = '100%';
                setTimeout(() => loadingBar.remove(), 300);
            }, { once: true });
        });
    </script>

</body>

</html>
