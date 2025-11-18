{{-- DNS Settings Section --}}
<section id="dns-settings" class="min-h-screen bg-gray-50 py-16 px-6 relative overflow-hidden" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl relative z-10">
        {{-- Header --}}
        <div class="mb-12">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                DNS Settings
            </h1>
            <p class="text-lg text-gray-600">
                Manage DNS records for your domain. Changes may take up to 24-48 hours to propagate.
            </p>
        </div>

        {{-- Domain Selector --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-8 p-6">
            <label for="domain-select" class="block text-sm font-semibold text-gray-700 mb-3">
                Select Domain
            </label>
            <select id="domain-select" class="w-full md:w-96 px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all font-medium">
                <option value="mywebsite.com">mywebsite.com</option>
                <option value="blog.mywebsite.com">blog.mywebsite.com</option>
                <option value="shop.mywebsite.com">shop.mywebsite.com</option>
                <option value="api.mywebsite.com">api.mywebsite.com</option>
            </select>
        </div>

        {{-- Add New Record Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New DNS Record
                </h2>
            </div>
            <div class="p-8">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        {{-- Record Type --}}
                        <div>
                            <label for="record-type" class="block text-sm font-semibold text-gray-700 mb-2">
                                Record Type *
                            </label>
                            <select id="record-type" name="record_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                                <option value="A">A Record</option>
                                <option value="AAAA">AAAA Record</option>
                                <option value="CNAME">CNAME Record</option>
                                <option value="MX">MX Record</option>
                                <option value="TXT">TXT Record</option>
                                <option value="NS">NS Record</option>
                                <option value="SRV">SRV Record</option>
                            </select>
                        </div>

                        {{-- Name/Host --}}
                        <div>
                            <label for="record-name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Name/Host *
                            </label>
                            <input type="text" id="record-name" name="record_name" placeholder="@" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                            <p class="text-xs text-gray-500 mt-1">Use @ for root domain</p>
                        </div>

                        {{-- Value --}}
                        <div>
                            <label for="record-value" class="block text-sm font-semibold text-gray-700 mb-2">
                                Value/Target *
                            </label>
                            <input type="text" id="record-value" name="record_value" placeholder="192.168.1.1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                        </div>

                        {{-- TTL --}}
                        <div>
                            <label for="record-ttl" class="block text-sm font-semibold text-gray-700 mb-2">
                                TTL (seconds)
                            </label>
                            <input type="number" id="record-ttl" name="record_ttl" value="3600" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                        </div>
                    </div>

                    {{-- Priority (for MX/SRV) --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label for="record-priority" class="block text-sm font-semibold text-gray-700 mb-2">
                                Priority (MX/SRV only)
                            </label>
                            <input type="number" id="record-priority" name="record_priority" value="10" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add DNS Record
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DNS Records List --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200" style="overflow: visible;">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Current DNS Records</h2>
            </div>
            
            <div class="overflow-x-auto" style="overflow-y: visible;">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name/Host</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Value/Target</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">TTL</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        {{-- A Record --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                    A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-900">@</td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-900">192.168.1.100</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">3600</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-a1')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-a1" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Record
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete Record
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- CNAME Record --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                    CNAME
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-900">www</td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-900">mywebsite.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">3600</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-cname')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-cname" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Record
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete Record
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- MX Record --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                    MX
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-900">@</td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-900">mail.mywebsite.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">3600</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded">
                                    10
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-mx')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-mx" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Record
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete Record
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- TXT Record --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                    TXT
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-900">@</td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-900 max-w-xs truncate" title="v=spf1 include:_spf.google.com ~all">
                                v=spf1 include:_spf.google.com ~all
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">3600</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-txt')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-txt" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Record
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete Record
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Another A Record --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                    A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-900">mail</td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-900">192.168.1.101</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">3600</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-a2')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-a2" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Record
                                            </button>
                                            <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete Record
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- DNS Propagation Checker --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mt-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    DNS Propagation Checker
                </h2>
            </div>
            <div class="p-8">
                <p class="text-gray-600 mb-6">
                    Check if your DNS changes have propagated worldwide. This tool queries multiple DNS servers globally.
                </p>
                <div class="flex gap-4">
                    <input type="text" placeholder="Enter domain name" value="mywebsite.com" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                    <select class="px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                        <option value="A">A Record</option>
                        <option value="AAAA">AAAA Record</option>
                        <option value="CNAME">CNAME</option>
                        <option value="MX">MX Record</option>
                        <option value="TXT">TXT Record</option>
                    </select>
                    <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        Check Now
                    </button>
                </div>

                {{-- Sample Results (shown after check) --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold text-gray-900">USA (East)</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-900 font-bold text-sm">Propagated</span>
                            </div>
                        </div>
                        <p class="text-xs font-mono text-gray-600">192.168.1.100</p>
                    </div>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold text-gray-900">Europe</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-900 font-bold text-sm">Propagated</span>
                            </div>
                        </div>
                        <p class="text-xs font-mono text-gray-600">192.168.1.100</p>
                    </div>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold text-gray-900">Asia Pacific</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-600 font-bold text-sm">Pending</span>
                            </div>
                        </div>
                        <p class="text-xs font-mono text-gray-600">Old IP: 192.168.1.99</p>
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
        const button = event.currentTarget;
        const dropdown = document.getElementById(dropdownId);
        
        // Close all other dropdowns
        document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
            if (d.id !== dropdownId) {
                d.classList.add('hidden');
            }
        });
        
        // Toggle current dropdown
        const isHidden = dropdown.classList.contains('hidden');
        
        if (isHidden) {
            // Calculate position
            const rect = button.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + 5) + 'px';
            dropdown.style.left = (rect.left - 192 + rect.width) + 'px'; // 192px = w-48
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
        dropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    });
    
    // Reposition dropdown on scroll
    window.addEventListener('scroll', function() {
        const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
        dropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }, true);
</script>
@endpush
