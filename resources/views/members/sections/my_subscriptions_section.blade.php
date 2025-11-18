{{-- My Subscriptions Section --}}
<section id="my-subscriptions" class="min-h-screen bg-gray-50 py-8" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                My Subscriptions
            </h1>
            <p class="text-lg text-gray-600">
                Manage your active hosting subscriptions and services.
            </p>
        </div>

        {{-- Subscriptions List --}}
        <div class="space-y-6">
            {{-- Active Subscription --}}
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        {{-- Left: Plan Info --}}
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gray-100 rounded-lg">
                                    <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 mb-2">Pro Hosting Plan</h3>
                                    <div class="flex flex-wrap items-center gap-3 mb-3">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Active
                                        </span>
                                        <span class="text-sm text-gray-600 font-medium">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Yearly Billing
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-500">Price</p>
                                            <p class="font-bold text-gray-900">Rp 960.000/year</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Renewal Date</p>
                                            <p class="font-bold text-gray-900">Dec 15, 2025</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Domain</p>
                                            <p class="font-bold text-gray-900">mywebsite.com</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Auto-Renew</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <button type="button" class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-900 transition-colors">
                                                    <span class="translate-x-6 inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                                </button>
                                                <span class="text-gray-900 font-semibold text-xs">ON</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Actions --}}
                        <div class="flex flex-col gap-3 lg:min-w-[200px]">
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200">
                                Manage Hosting
                            </button>
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200">
                                Renew Now
                            </button>
                            <button class="border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200">
                                Upgrade Plan
                            </button>
                            <button class="border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200">
                                Cancel Subscription
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Subscription --}}
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-300">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gray-100 rounded-lg">
                                    <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 mb-2">Starter Hosting Plan</h3>
                                    <div class="flex flex-wrap items-center gap-3 mb-3">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Pending Payment
                                        </span>
                                        <span class="text-sm text-gray-600 font-medium">Monthly Billing</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-500">Price</p>
                                            <p class="font-bold text-gray-900">Rp 50.000/month</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Order Date</p>
                                            <p class="font-bold text-gray-900">Nov 10, 2025</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Domain</p>
                                            <p class="font-bold text-gray-900">testsite.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 lg:min-w-[200px]">
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200">
                                Complete Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
