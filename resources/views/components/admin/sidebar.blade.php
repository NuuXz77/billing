<div>
    {{-- SIDEBAR --}}
    <aside @mouseenter="if(!sidebarOpen) hoverOpen = true"
        @mouseleave="hoverOpen = false; sessionStorage.removeItem('hoverOpen')"
        :class="{
            'w-20': !sidebarOpen && !hoverOpen,
            'w-64': sidebarOpen || hoverOpen,
            '-translate-x-full': !sidebarOpen && !hoverOpen,
            'translate-x-0': sidebarOpen || hoverOpen
        }"
        class="fixed lg:sticky left-0 top-0 z-40 h-screen bg-base-100 border-r border-base-300 transition-all duration-300 ease-in-out overflow-y-auto no-scrollbar lg:translate-x-0">

        {{-- Brand/Logo --}}
        <div class="h-16 flex items-center justify-center gap-3 px-4 border-b border-base-300">
            <a href="{{ route('admin-dashboard') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity duration-300">
                <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="Hoci" class="h-10 w-auto">
                <span x-show="sidebarOpen || hoverOpen" x-transition
                    class="text-xl font-bold whitespace-nowrap">{{ config('app.name', 'Hoci') }}</span>
            </a>
        </div>

        @if (auth()->user()->role === 'admin')
            {{-- Sidebar Content (static HTML, no JSON) --}}
            <nav class="p-4">
                <ul class="menu menu-sm lg:menu-md px-0 gap-1 w-full">
                    <!-- Dashboard -->
                    <li>
                        <a href="/admin/dashboard" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/dashboard') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Dashboard' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>

                    <!-- Users with submenu -->
                    <li x-data="{ open: {{ request()->is('admin/users*') ? 'true' : 'false' }} }" x-effect="if(!sidebarOpen && !hoverOpen) open = false">
                        <a x-show="!sidebarOpen && !hoverOpen" href="/admin/users" wire:navigate
                            class="flex items-center justify-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/users*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            data-tip="Users">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </a>
                        <button x-show="sidebarOpen || hoverOpen" @click="open = !open"
                            class="w-full flex items-center justify-between gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/users*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="font-medium whitespace-nowrap">Users</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'rotate-180' : ''"
                                class="h-4 w-4 transition-transform" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-collapse class="ml-6 mt-1 space-y-1 border-l border-base-300 pl-3">
                            <li>
                                <a href="/admin/users" wire:navigate
                                    class="flex items-center gap-2 py-2 px-3 rounded-lg transition-all duration-200 text-sm {{ request()->is('admin/users') ? 'bg-primary/20 text-primary font-semibold' : 'hover:bg-primary/10 hover:text-primary' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Manage Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/users/profiles" wire:navigate
                                    class="flex items-center gap-2 py-2 px-3 rounded-lg transition-all duration-200 text-sm {{ request()->is('admin/users/profiles*') ? 'bg-primary/20 text-primary font-semibold' : 'hover:bg-primary/10 hover:text-primary' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>User Profiles</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Products -->
                    <li>
                        <a href="/admin/products" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/products*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Products' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Products</span>
                        </a>
                    </li> 

                    <!-- Subscriptions
                    <li>
                        <a href="/admin/subscriptions" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/subscriptions*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Subscriptions' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Subscriptions</span>
                        </a>
                    </li> -->

                    <!-- Subdomains 
                    <li>
                        <a href="/admin/subdomains" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/subdomains*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Subdomains' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Subdomains</span>
                        </a>
                    </li> -->

                    <!-- Invoices 
                    <li>
                        <a href="/admin/invoices" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/invoices*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Invoices' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Invoices</span>
                        </a>
                    </li> -->

                    <!-- Payments -->
                    <li>
                        <a href="/admin/payments" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/payments*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Payments' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Payments</span>
                        </a>
                    </li>

                    <!-- Transactions -->
                    <li>
                        <a href="/admin/transactions" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/transactions*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Transactions' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2 6a2 2 0 012-2h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm2 0v8h16V6H4zm6 4a2 2 0 114 0 2 2 0 01-4 0zm-4 0a1 1 0 112 0 1 1 0 01-2 0zm10 0a1 1 0 112 0 1 1 0 01-2 0z" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Transactions</span>
                        </a>
                    </li>

                    <!-- Reports -->
                    <li>
                        <a href="/admin/reports" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/reports*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Reports' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Reports</span>
                        </a>
                    </li>

                    <!-- System Settings -->
                    <li>
                        <a href="/admin/settings" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('admin/settings*') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Settings' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        @else
            <nav class="p-4">
                <ul class="menu menu-sm lg:menu-md px-0 gap-1 w-full">
                    <!-- Dashboard -->
                    <li>
                        <a href="/dashboard" wire:navigate
                            :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                            class="flex items-center gap-3 py-3 px-4 rounded-lg transition-all duration-200 {{ request()->is('dashboard') ? 'bg-primary text-primary-content border-primary/30' : 'hover:bg-primary/10 hover:text-primary border-transparent hover:border-primary/20' }} border tooltip tooltip-right"
                            :data-tip="!sidebarOpen && !hoverOpen ? 'Dashboard' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span x-show="sidebarOpen || hoverOpen" x-transition
                                class="font-medium whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif
    </aside>

    {{-- Overlay (Mobile) --}}
    <div x-show="sidebarOpen || hoverOpen" @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"></div>
</div>
