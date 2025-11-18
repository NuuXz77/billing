{{-- My Profile Section --}}
<section id="my-profile" class="min-h-screen bg-gray-50 py-16 px-6 relative overflow-hidden" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl relative z-10">
        {{-- Header --}}
        <div class="mb-12">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                My Profile
            </h1>
            <p class="text-lg text-gray-600">
                Manage your personal information and security settings.
            </p>
        </div>

        {{-- Profile Photo Card - Full Width --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-8">
            <div class="bg-gray-100 h-32"></div>
            <div class="px-8 pb-8">
                <div class="flex flex-col md:flex-row md:items-end gap-6 -mt-16">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center">
                            <span class="text-4xl font-bold text-gray-900">JD</span>
                        </div>
                        <label for="photo-upload" class="absolute bottom-0 right-0 bg-gray-900 hover:bg-gray-800 text-white p-2 rounded-full shadow-lg cursor-pointer transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </label>
                        <input type="file" id="photo-upload" class="hidden" accept="image/*">
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ auth()->user()->full_name ?? auth()->user()->username }}</h2>
                        <p class="text-gray-600 mb-3">{{ auth()->user()->email }}</p>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Verified Account
                            </span>
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                2FA Enabled
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grid Layout for Cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Left Column --}}
            <div class="space-y-8">
                {{-- Personal Information Card --}}
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Personal Information</h2>
            </div>
            <div class="p-8">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Full Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" value="{{ auth()->user()->full_name ?? auth()->user()->username }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" value="+62 812 3456 7890" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                        </div>

                        {{-- Date of Birth --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Date of Birth
                            </label>
                            <input type="date" value="1995-06-15" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                        </div>

                        {{-- Country --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Country
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                                <option>Indonesia</option>
                                <option>United States</option>
                                <option>United Kingdom</option>
                                <option>Singapore</option>
                            </select>
                        </div>

                        {{-- City --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                City
                            </label>
                            <input type="text" value="Jakarta" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                        </div>
                    </div>

                    {{-- Address --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Address
                        </label>
                        <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">Jl. Sudirman No. 123, Jakarta Pusat</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Change Password Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Change Password</h2>
            </div>
            <div class="p-8">
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Current Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                New Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirm New Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                        </div>
                    </div>

                    {{-- Password Requirements --}}
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Password must contain:</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                At least 8 characters
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                One uppercase letter
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                One number
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                One special character
                            </li>
                        </ul>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-8">
                {{-- Two-Factor Authentication Card --}}
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Two-Factor Authentication</h2>
                        <p class="text-sm text-gray-600 mt-1">Add an extra layer of security to your account</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>
            </div>
            <div class="p-8">
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-green-800 mb-1">2FA is currently enabled</p>
                            <p class="text-sm text-green-700">Your account is protected with two-factor authentication using Google Authenticator.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gray-100 rounded-lg">
                                <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Authenticator App</p>
                                <p class="text-sm text-gray-600">Google Authenticator</p>
                            </div>
                        </div>
                        <button class="text-sm text-gray-900 hover:text-gray-700 font-semibold">
                            View Backup Codes
                        </button>
                    </div>

                    <button class="w-full py-3 border border-red-300 text-red-600 hover:bg-red-50 rounded-xl transition-all font-semibold">
                        Disable 2FA
                    </button>
                </div>
            </div>
        </div>

                {{-- Active Sessions Card --}}
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Active Sessions</h2>
                <p class="text-sm text-gray-600 mt-1">Manage your active sessions across different devices</p>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    {{-- Current Session --}}
                    <div class="border border-green-200 bg-green-50 rounded-xl p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-green-100 rounded-xl">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <p class="font-bold text-gray-900">Windows PC - Chrome</p>
                                        <span class="px-2 py-1 bg-green-200 text-green-800 text-xs font-bold rounded">CURRENT</span>
                                    </div>
                                    <p class="text-sm text-gray-700 mb-1">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Jakarta, Indonesia
                                    </p>
                                    <p class="text-sm text-gray-600">IP: 103.123.45.67</p>
                                    <p class="text-sm text-gray-600">Last active: Just now</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Other Session 1 --}}
                    <div class="border border-gray-200 rounded-xl p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gray-100 rounded-xl">
                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 mb-2">iPhone 14 - Safari</p>
                                    <p class="text-sm text-gray-700 mb-1">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Jakarta, Indonesia
                                    </p>
                                    <p class="text-sm text-gray-600">IP: 103.123.45.68</p>
                                    <p class="text-sm text-gray-600">Last active: 2 hours ago</p>
                                </div>
                            </div>
                            <button class="text-sm text-red-600 hover:text-red-800 font-semibold">
                                Logout
                            </button>
                        </div>
                    </div>

                    {{-- Other Session 2 --}}
                    <div class="border border-gray-200 rounded-xl p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gray-100 rounded-xl">
                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 mb-2">Android - Chrome</p>
                                    <p class="text-sm text-gray-700 mb-1">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Bandung, Indonesia
                                    </p>
                                    <p class="text-sm text-gray-600">IP: 103.123.45.69</p>
                                    <p class="text-sm text-gray-600">Last active: 1 day ago</p>
                                </div>
                            </div>
                            <button class="text-sm text-red-600 hover:text-red-800 font-semibold">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>

                <button class="w-full mt-6 py-3 border border-red-300 text-red-600 hover:bg-red-50 rounded-xl transition-all font-semibold">
                    Logout All Other Sessions
                </button>
            </div>
        </div>
            </div>
        </div>
    </div>
</section>
