{{-- Dashboard Section --}}
<section id="dashboard" class="min-h-screen bg-gray-50 py-8" style="padding-top: 88px;">
    <div class="container mx-auto px-6 max-w-7xl">
        {{-- A. Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        Welcome back, <span class="text-primary">{{ auth()->user()->full_name ?? auth()->user()->username }}</span>
                    </h1>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">{{ now('Asia/Jakarta')->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>

        {{-- B. Quick Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Active Hosting Plans --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-1">Active Hosting Plans</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-bold text-gray-900">1</p>
                    <span class="text-sm text-green-600 font-medium">active plan</span>
                </div>
            </div>

            {{-- Available Subdomains --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-1">Available Subdomains</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-bold text-gray-900">3</p>
                    <span class="text-sm text-gray-500 font-medium">created</span>
                </div>
            </div>

            {{-- Pending Invoices --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-1">Pending Invoices</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-bold text-gray-900">1</p>
                    <span class="text-sm text-orange-600 font-medium">unpaid</span>
                </div>
            </div>

            {{-- Support Tickets --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-1">Support Tickets</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-bold text-gray-900">0</p>
                    <span class="text-sm text-green-600 font-medium">open</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left Column: Resource Usage + Quick Actions --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- C. Resource Usage --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Resource Usage
                    </h2>

                    <div class="space-y-6">
                        {{-- Disk Usage --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Disk Usage</span>
                                <span class="text-sm font-semibold text-gray-900">4.2 GB / 10 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-gray-900 h-2 rounded-full transition-all duration-300" style="width: 42%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">42% used</p>
                        </div>

                        {{-- Bandwidth Usage --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Bandwidth Usage</span>
                                <span class="text-sm font-semibold text-gray-900">125 GB / 500 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-gray-900 h-2 rounded-full transition-all duration-300" style="width: 25%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">25% used</p>
                        </div>

                        {{-- CPU Usage --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">CPU Usage</span>
                                <span class="text-sm font-semibold text-gray-900">18%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-gray-900 h-2 rounded-full transition-all duration-300" style="width: 18%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Low usage</p>
                        </div>

                        {{-- RAM Usage --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">RAM Usage</span>
                                <span class="text-sm font-semibold text-gray-900">512 MB / 2 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-gray-900 h-2 rounded-full transition-all duration-300" style="width: 25%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">25% used</p>
                        </div>
                    </div>
                </div>

                {{-- D. Quick Actions --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Quick Actions
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Create Subdomain --}}
                        <a href="#" class="group flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all duration-200">
                            <div class="p-3 bg-gray-100 rounded-lg group-hover:bg-gray-900 transition-colors">
                                <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Create Subdomain</h3>
                                <p class="text-xs text-gray-500">Add new subdomain</p>
                            </div>
                        </a>

                        {{-- Go to Hosting Panel --}}
                        <a href="#" class="group flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all duration-200">
                            <div class="p-3 bg-gray-100 rounded-lg group-hover:bg-gray-900 transition-colors">
                                <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Hosting Panel</h3>
                                <p class="text-xs text-gray-500">Manage your hosting</p>
                            </div>
                        </a>

                        {{-- View Invoice --}}
                        <a href="#" class="group flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all duration-200">
                            <div class="p-3 bg-gray-100 rounded-lg group-hover:bg-gray-900 transition-colors">
                                <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">View Invoice</h3>
                                <p class="text-xs text-gray-500">Check pending payments</p>
                            </div>
                        </a>

                        {{-- Open Support Ticket --}}
                        <a href="#" class="group flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all duration-200">
                            <div class="p-3 bg-gray-100 rounded-lg group-hover:bg-gray-900 transition-colors">
                                <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Support Ticket</h3>
                                <p class="text-xs text-gray-500">Get help from support</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Column: Recent Activity --}}
            <div class="lg:col-span-1">
                {{-- E. Recent Activity Logs --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 sticky top-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Recent Activity
                    </h2>

                    <div class="space-y-4">
                        {{-- Activity Item 1 --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Created subdomain</p>
                                <p class="text-xs text-gray-500">app.yourdomain.com</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </div>

                        {{-- Activity Item 2 --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Paid invoice</p>
                                <p class="text-xs text-gray-500">Invoice #1234 - Rp1.147.200</p>
                                <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                            </div>
                        </div>

                        {{-- Activity Item 3 --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Updated profile</p>
                                <p class="text-xs text-gray-500">Changed email address</p>
                                <p class="text-xs text-gray-400 mt-1">3 days ago</p>
                            </div>
                        </div>

                        {{-- Activity Item 4 --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Received invoice</p>
                                <p class="text-xs text-gray-500">Renewal reminder</p>
                                <p class="text-xs text-gray-400 mt-1">5 days ago</p>
                            </div>
                        </div>

                        {{-- Activity Item 5 --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Hosting plan activated</p>
                                <p class="text-xs text-gray-500">Premium Web Hosting</p>
                                <p class="text-xs text-gray-400 mt-1">1 week ago</p>
                            </div>
                        </div>
                    </div>

                    {{-- View All Button --}}
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="#" class="block text-center text-sm font-semibold text-gray-900 hover:text-gray-700 transition-colors">
                            View All Activity →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
