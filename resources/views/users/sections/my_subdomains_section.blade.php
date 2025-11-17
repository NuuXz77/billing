{{-- My Subdomains Section --}}
<section id="my-subdomains" class="min-h-screen bg-gray-50 py-8" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                My Subdomains
            </h1>
            <p class="text-lg text-gray-600">
                Manage your subdomains, SSL certificates, and redirects.
            </p>
        </div>

        {{-- Create New Subdomain Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-8">
            <div class="border-b border-gray-200 p-6">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Subdomain
                </h2>
            </div>
            <div class="p-8">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Subdomain Name --}}
                        <div>
                            <label for="subdomain" class="block text-sm font-semibold text-gray-700 mb-2">
                                Subdomain Name *
                            </label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="subdomain" name="subdomain" placeholder="blog" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                                <span class="text-gray-600 font-medium">.mywebsite.com</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Enter subdomain name without domain</p>
                        </div>

                        {{-- Choose Folder --}}
                        <div>
                            <label for="folder" class="block text-sm font-semibold text-gray-700 mb-2">
                                Folder Path *
                            </label>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500">public_html/</span>
                                <input type="text" id="folder" name="folder" placeholder="blog" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-200 transition-all">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Folder will be created if doesn't exist</p>
                        </div>
                    </div>

                    {{-- Auto-create SSL Checkbox --}}
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <input type="checkbox" id="auto_ssl" name="auto_ssl" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-500">
                        <label for="auto_ssl" class="text-sm font-medium text-gray-700 cursor-pointer flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Automatically create free SSL certificate (Recommended)
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Create Subdomain
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Subdomains List --}}
        <div class="space-y-6">
            {{-- Subdomain Card 1 --}}
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        {{-- Left: Subdomain Info --}}
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="p-3 bg-gray-100 rounded-lg">
                                    <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 mb-2">
                                        blog.mywebsite.com
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-3 mb-4">
                                        {{-- DNS Status --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            DNS Active
                                        </span>
                                        {{-- SSL Status --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            SSL Enabled
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Details Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Folder Location</p>
                                    <p class="font-mono font-semibold text-gray-900">public_html/blog</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Created Date</p>
                                    <p class="font-semibold text-gray-900">Oct 15, 2025</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Redirect Status</p>
                                    <p class="font-semibold text-gray-900">No Redirect</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Action Buttons --}}
                        <div class="flex flex-col gap-2 lg:min-w-[180px]">
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit Folder Path
                            </button>
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Manage SSL
                            </button>
                            <button class="border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Set Redirect
                            </button>
                            <button class="border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Subdomain Card 2 (with redirect) --}}
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        {{-- Left: Subdomain Info --}}
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="p-3 bg-gray-100 rounded-lg">
                                    <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900 mb-2">
                                        shop.mywebsite.com
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-3 mb-4">
                                        {{-- DNS Status --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            DNS Active
                                        </span>
                                        {{-- SSL Status --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            SSL Disabled
                                        </span>
                                        {{-- Redirect Badge --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Redirected
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Details Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Folder Location</p>
                                    <p class="font-mono font-semibold text-gray-900">public_html/shop</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Created Date</p>
                                    <p class="font-semibold text-gray-900">Nov 1, 2025</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-500 mb-1">Redirect To</p>
                                    <p class="font-semibold text-gray-900 text-xs break-all">https://newstore.com</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Action Buttons --}}
                        <div class="flex flex-col gap-2 lg:min-w-[180px]">
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit Folder Path
                            </button>
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Enable SSL
                            </button>
                            <button class="border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit Redirect
                            </button>
                            <button class="border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Subdomain Card 3 --}}
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        {{-- Left: Subdomain Info --}}
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="p-3 bg-gray-100 rounded-lg">
                                    <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-800 mb-2">
                                        api.mywebsite.com
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-3 mb-4">
                                        {{-- DNS Status --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            DNS Active
                                        </span>
                                        {{-- SSL Status --}}
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            SSL Enabled
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Details Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Folder Location</p>
                                    <p class="font-mono font-semibold text-gray-900">public_html/api</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Created Date</p>
                                    <p class="font-semibold text-gray-900">Sep 20, 2025</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500 mb-1">Redirect Status</p>
                                    <p class="font-semibold text-gray-900">No Redirect</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Action Buttons --}}
                        <div class="flex flex-col gap-2 lg:min-w-[180px]">
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit Folder Path
                            </button>
                            <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Manage SSL
                            </button>
                            <button class="border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Set Redirect
                            </button>
                            <button class="border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
