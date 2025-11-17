{{-- Manage Hosting Section --}}
<section id="manage-hosting" class="min-h-screen bg-gray-50 py-8" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                Manage Hosting
            </h1>
            <p class="text-lg text-gray-600">
                Access your hosting control panel and manage your resources.
            </p>
        </div>

        {{-- Quick Access Panel --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="border-b border-gray-200 p-6">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 mb-1">Pro Hosting Plan</h2>
                <p class="text-gray-600">mywebsite.com</p>
            </div>
            <div class="p-8">
                {{-- Control Panel Access --}}
                <div class="mb-10">
                    <h3 class="font-['Source_Sans_Pro'] text-xl font-semibold text-gray-900 mb-4">Control Panel Access</h3>
                    <a href="#" class="inline-flex items-center gap-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Open cPanel
                    </a>
                </div>

                {{-- Resource Usage Detail --}}
                <div class="mb-10">
                    <h3 class="font-['Source_Sans_Pro'] text-xl font-semibold text-gray-900 mb-6">Resource Usage</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Disk Usage --}}
                        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-semibold text-gray-900">Disk Storage</span>
                                <span class="text-sm font-medium text-gray-600">8.4 GB / 20 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 42%"></div>
                            </div>
                            <p class="text-sm text-gray-600">42% used</p>
                        </div>

                        {{-- Bandwidth --}}
                        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-semibold text-gray-900">Bandwidth</span>
                                <span class="text-sm font-medium text-gray-600">50 GB / 200 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 25%"></div>
                            </div>
                            <p class="text-sm text-gray-600">25% used</p>
                        </div>

                        {{-- CPU Usage --}}
                        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-semibold text-gray-900">CPU Usage</span>
                                <span class="text-sm font-medium text-gray-600">18%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 18%"></div>
                            </div>
                            <p class="text-sm text-gray-600">Low usage</p>
                        </div>

                        {{-- Memory Usage --}}
                        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-semibold text-gray-900">Memory (RAM)</span>
                                <span class="text-sm font-medium text-gray-600">512 MB / 2 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 25%"></div>
                            </div>
                            <p class="text-sm text-gray-600">25% used</p>
                        </div>
                    </div>
                </div>

                {{-- Quick Management Tools --}}
                <div>
                    <h3 class="font-['Source_Sans_Pro'] text-xl font-semibold text-gray-900 mb-6">Management Tools</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        {{-- File Manager --}}
                        <a href="#" class="group p-6 bg-white border border-gray-200 hover:border-gray-900 rounded-lg transition-all duration-200 hover:shadow-sm">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-3 bg-gray-100 group-hover:bg-gray-900 rounded-lg mb-4 transition-colors">
                                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">File Manager</h4>
                                <p class="text-sm text-gray-600">Manage your files</p>
                            </div>
                        </a>

                        {{-- Database Manager --}}
                        <a href="#" class="group p-6 bg-white border border-gray-200 hover:border-gray-900 rounded-lg transition-all duration-200 hover:shadow-sm">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-3 bg-gray-100 group-hover:bg-gray-900 rounded-lg mb-4 transition-colors">
                                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Database Manager</h4>
                                <p class="text-sm text-gray-600">Manage databases</p>
                            </div>
                        </a>

                        {{-- SSL Manager --}}
                        <a href="#" class="group p-6 bg-white border border-gray-200 hover:border-gray-900 rounded-lg transition-all duration-200 hover:shadow-sm">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-3 bg-gray-100 group-hover:bg-gray-900 rounded-lg mb-4 transition-colors">
                                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">SSL Manager</h4>
                                <p class="text-sm text-gray-600">Manage SSL certificates</p>
                            </div>
                        </a>

                        {{-- Email Manager --}}
                        <a href="#" class="group p-6 bg-white border border-gray-200 hover:border-gray-900 rounded-lg transition-all duration-200 hover:shadow-sm">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-3 bg-gray-100 group-hover:bg-gray-900 rounded-lg mb-4 transition-colors">
                                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Email Manager</h4>
                                <p class="text-sm text-gray-600">Manage email accounts</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
