{{-- Invoices Section --}}
<section id="invoices" class="min-h-screen bg-gray-50 py-16 px-6 relative overflow-hidden" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl relative z-10">
        {{-- Header --}}
        <div class="mb-12">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Invoices
            </h1>
            <p class="text-lg text-gray-600">
                View and manage your billing invoices. Download or pay outstanding invoices.
            </p>
        </div>

        {{-- Invoice Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Invoices</p>
                        <p class="text-3xl font-bold text-gray-900">12</p>
                    </div>
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Paid</p>
                        <p class="text-3xl font-bold text-gray-900">9</p>
                    </div>
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Unpaid</p>
                        <p class="text-3xl font-bold text-red-600">2</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-lg">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Pending</p>
                        <p class="text-3xl font-bold text-gray-600">1</p>
                    </div>
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Invoices Table --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200" style="overflow: visible;">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Invoice List</h2>
                <div class="flex items-center gap-3">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 text-sm">
                        <option value="all">All Status</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
            
            <div class="overflow-x-auto" style="overflow-y: visible;">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Invoice ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Issued</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Due Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        {{-- Unpaid Invoice --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-gray-900">#INV-2025-011</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">Hosting Pro – 1 Year</p>
                                    <p class="text-sm text-gray-500">Annual subscription renewal</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900">Rp 960.000</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Nov 10, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-semibold">Nov 20, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Unpaid
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-inv-011')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-inv-011" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 transition-colors duration-200 font-semibold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                Pay Now
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Pending Invoice --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-gray-900">#INV-2025-010</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">Domain Registration</p>
                                    <p class="text-sm text-gray-500">mywebsite.com - 1 year</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900">Rp 150.000</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Nov 5, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Nov 12, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-inv-010')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-inv-010" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Paid Invoice --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-gray-900">#INV-2025-009</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">Hosting Pro – 1 Month</p>
                                    <p class="text-sm text-gray-500">Monthly subscription</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900">Rp 100.000</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Oct 15, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Oct 22, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-inv-009')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-inv-009" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Paid Invoice 2 --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-gray-900">#INV-2025-008</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">SSL Certificate</p>
                                    <p class="text-sm text-gray-500">Wildcard SSL - 1 year</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900">Rp 500.000</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Oct 1, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Oct 8, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-inv-008')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-inv-008" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Paid Invoice 3 --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-gray-900">#INV-2025-007</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">Hosting Starter – 1 Month</p>
                                    <p class="text-sm text-gray-500">Monthly subscription</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900">Rp 50.000</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sep 15, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sep 22, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-inv-007')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-inv-007" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-6 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-600">Showing 1 to 5 of 12 invoices</p>
                <div class="flex items-center gap-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                        Previous
                    </button>
                    <button class="px-4 py-2 bg-gray-900 text-white rounded-lg font-medium text-sm">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">3</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                        Next
                    </button>
                </div>
            </div>
        </div>

        {{-- Invoice Detail Modal (Hidden by default, shown when View is clicked) --}}
        <div id="invoice-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-6">
            <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                {{-- Invoice Header --}}
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">INVOICE</h2>
                            <p class="text-gray-600">#INV-2025-009</p>
                        </div>
                        <img src="{{ asset('img/logo/BillHostify_Ilustration.svg') }}" alt="BillHostify" class="h-12">
                    </div>
                    <div class="grid grid-cols-2 gap-6 text-sm">
                        <div>
                            <p class="text-gray-600 mb-1">Date Issued</p>
                            <p class="font-semibold text-gray-900">Oct 15, 2025</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Due Date</p>
                            <p class="font-semibold text-gray-900">Oct 22, 2025</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    {{-- Billing Details --}}
                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-3">Bill To:</h3>
                            <p class="text-gray-900 font-semibold">{{ auth()->user()->full_name ?? auth()->user()->username }}</p>
                            <p class="text-gray-600 text-sm">{{ auth()->user()->email }}</p>
                            <p class="text-gray-600 text-sm mt-2">Jakarta, Indonesia</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-3">From:</h3>
                            <p class="text-gray-900 font-semibold">BillHostify</p>
                            <p class="text-gray-600 text-sm">support@billhostify.com</p>
                            <p class="text-gray-600 text-sm mt-2">www.billhostify.com</p>
                        </div>
                    </div>

                    {{-- Invoice Items --}}
                    <div class="mb-8">
                        <table class="w-full">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-left py-3 text-gray-900 font-semibold">Description</th>
                                    <th class="text-right py-3 text-gray-900 font-semibold">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="py-4">
                                        <p class="font-semibold text-gray-900">Hosting Pro – 1 Month</p>
                                        <p class="text-sm text-gray-500">Monthly subscription</p>
                                        <p class="text-sm text-gray-500">Period: Oct 15 - Nov 15, 2025</p>
                                    </td>
                                    <td class="py-4 text-right font-semibold text-gray-900">Rp 100.000</td>
                                </tr>
                            </tbody>
                            <tfoot class="border-t border-gray-200">
                                <tr>
                                    <td class="py-4 text-right font-bold text-gray-900 text-lg">Total:</td>
                                    <td class="py-4 text-right font-bold text-gray-900 text-xl">Rp 100.000</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Payment Information --}}
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Payment Information
                        </h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600 mb-1">Payment Method</p>
                                <p class="font-semibold text-gray-900">Bank Transfer (BCA)</p>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Payment Status</p>
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                    Paid
                                </span>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Paid Date</p>
                                <p class="font-semibold text-gray-900">Oct 16, 2025 14:30</p>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Payment Reference</p>
                                <p class="font-mono font-semibold text-gray-900 text-xs">PAY-2025-10-16-123456</p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-3">
                        <button onclick="document.getElementById('invoice-modal').classList.add('hidden')" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                            Close
                        </button>
                        <button class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function toggleDropdown(event, dropdownId) {
        event.stopPropagation();
        
        // Close all other dropdowns
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            if (dropdown.id !== dropdownId) {
                dropdown.classList.add('hidden');
            }
        });
        
        const dropdown = document.getElementById(dropdownId);
        const button = event.currentTarget;
        
        if (dropdown.classList.contains('hidden')) {
            // Show dropdown
            dropdown.classList.remove('hidden');
            
            // Calculate position
            const buttonRect = button.getBoundingClientRect();
            const dropdownWidth = 192; // w-48 = 12rem = 192px
            
            // Position dropdown
            dropdown.style.top = (buttonRect.bottom + 5) + 'px';
            dropdown.style.left = (buttonRect.left - dropdownWidth + buttonRect.width) + 'px';
        } else {
            dropdown.classList.add('hidden');
        }
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleDropdown"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
    
    // Close dropdown on scroll
    window.addEventListener('scroll', function() {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }, true);
</script>
@endpush
