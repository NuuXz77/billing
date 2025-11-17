{{-- Account Settings Section --}}
<section id="account-settings" class="min-h-screen bg-gray-50 py-16 px-6 relative overflow-hidden" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl relative z-10">
        {{-- Header --}}
        <div class="mb-12">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Account Settings
            </h1>
            <p class="text-lg text-gray-600">
                Manage your preferences, notifications, and security settings.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-8">

        {{-- Notification Settings Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Notification Settings</h2>
                <p class="text-sm text-gray-600 mt-1">Choose how you want to receive notifications</p>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    {{-- Email Notifications --}}
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email Notifications
                        </h3>
                        <div class="space-y-3 ml-7">
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Invoice reminders</span>
                                <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Payment confirmations</span>
                                <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Service renewals</span>
                                <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Promotional emails</span>
                                <input type="checkbox" class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Newsletter</span>
                                <input type="checkbox" class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                        </div>
                    </div>

                    {{-- System Notifications --}}
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            System Notifications
                        </h3>
                        <div class="space-y-3 ml-7">
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Security alerts</span>
                                <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">New login detected</span>
                                <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                                <span class="text-gray-700 font-medium">Support ticket updates</span>
                                <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 mt-6">
                    <button type="button" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                        Reset to Default
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold">
                        Save Preferences
                    </button>
                </div>
            </div>
        </div>

        {{-- Language & Currency Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Language & Currency</h2>
                <p class="text-sm text-gray-600 mt-1">Set your preferred language and currency</p>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Language --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Language
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                            <option>🇬🇧 English (US)</option>
                            <option>🇮🇩 Bahasa Indonesia</option>
                            <option>🇯🇵 日本語 (Japanese)</option>
                            <option>🇨🇳 中文 (Chinese)</option>
                            <option>🇰🇷 한국어 (Korean)</option>
                        </select>
                    </div>

                    {{-- Currency --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Currency
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                            <option>IDR - Indonesian Rupiah (Rp)</option>
                            <option>USD - US Dollar ($)</option>
                            <option>EUR - Euro (€)</option>
                            <option>GBP - British Pound (£)</option>
                            <option>SGD - Singapore Dollar (S$)</option>
                            <option>JPY - Japanese Yen (¥)</option>
                        </select>
                    </div>

                    {{-- Timezone --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Timezone
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all">
                            <option>(GMT+7) Jakarta, Bangkok</option>
                            <option>(GMT+8) Singapore, Hong Kong</option>
                            <option>(GMT+9) Tokyo, Seoul</option>
                            <option>(GMT+0) London</option>
                            <option>(GMT-5) New York</option>
                            <option>(GMT-8) Los Angeles</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 mt-6">
                    <button type="button" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
            </div>

            <div class="space-y-8">
        {{-- Login Activity Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Login Activity Logs</h2>
                <p class="text-sm text-gray-600 mt-1">Recent login attempts and account access history</p>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    {{-- Successful Login --}}
                    <div class="flex items-start gap-4 p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-bold text-gray-800">Successful Login</p>
                                <span class="text-xs text-gray-500">Just now</span>
                            </div>
                            <p class="text-sm text-gray-700">Windows PC - Chrome</p>
                            <p class="text-sm text-gray-600">IP: 103.123.45.67 • Jakarta, Indonesia</p>
                        </div>
                    </div>

                    {{-- Successful Login 2 --}}
                    <div class="flex items-start gap-4 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="p-2 bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-bold text-gray-800">Successful Login</p>
                                <span class="text-xs text-gray-500">2 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-700">iPhone 14 - Safari</p>
                            <p class="text-sm text-gray-600">IP: 103.123.45.68 • Jakarta, Indonesia</p>
                        </div>
                    </div>

                    {{-- Failed Login Attempt --}}
                    <div class="flex items-start gap-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <div class="p-2 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-bold text-red-800">Failed Login Attempt</p>
                                <span class="text-xs text-gray-500">1 day ago</span>
                            </div>
                            <p class="text-sm text-red-700">Unknown Device - Chrome</p>
                            <p class="text-sm text-red-600">IP: 192.168.1.100 • Unknown Location</p>
                            <p class="text-xs text-red-600 mt-1">Reason: Incorrect password</p>
                        </div>
                    </div>

                    {{-- Successful Login 3 --}}
                    <div class="flex items-start gap-4 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="p-2 bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-bold text-gray-800">Successful Login</p>
                                <span class="text-xs text-gray-500">2 days ago</span>
                            </div>
                            <p class="text-sm text-gray-700">Android - Chrome</p>
                            <p class="text-sm text-gray-600">IP: 103.123.45.69 • Bandung, Indonesia</p>
                        </div>
                    </div>

                    {{-- Password Changed --}}
                    <div class="flex items-start gap-4 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="p-2 bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-bold text-gray-900">Password Changed</p>
                                <span class="text-xs text-gray-500">3 days ago</span>
                            </div>
                            <p class="text-sm text-gray-700">Windows PC - Chrome</p>
                            <p class="text-sm text-gray-600">IP: 103.123.45.67 • Jakarta, Indonesia</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-center">
                    <button class="text-gray-900 hover:text-gray-700 font-semibold text-sm">
                        View Full History
                    </button>
                </div>
            </div>
        </div>

        {{-- Privacy & Security Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Privacy & Security</h2>
                <p class="text-sm text-gray-600 mt-1">Manage your privacy and data settings</p>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                        <div>
                            <p class="text-gray-900 font-semibold">Show online status</p>
                            <p class="text-sm text-gray-600">Let others see when you're online</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                        <div>
                            <p class="text-gray-900 font-semibold">Activity status</p>
                            <p class="text-sm text-gray-600">Share when you're active on the platform</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                        <div>
                            <p class="text-gray-900 font-semibold">Data collection for analytics</p>
                            <p class="text-sm text-gray-600">Help us improve by sharing usage data</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-400">
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 mt-6">
                    <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
            </div>
        </div>

        {{-- Danger Zone Card --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-red-200">
            <div class="p-6 border-b border-red-200 bg-red-50">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-red-800 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Danger Zone
                </h2>
                <p class="text-sm text-red-700 mt-1">Irreversible actions. Please proceed with caution.</p>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl">
                        <div>
                            <p class="text-gray-900 font-semibold">Export Account Data</p>
                            <p class="text-sm text-gray-600">Download all your data in JSON format</p>
                        </div>
                        <button class="px-4 py-2 border border-gray-900 text-gray-900 hover:bg-gray-50 rounded-lg transition-all font-semibold text-sm">
                            Download
                        </button>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-yellow-300 bg-yellow-50 rounded-xl">
                        <div>
                            <p class="text-gray-800 font-semibold">Deactivate Account</p>
                            <p class="text-sm text-gray-600">Temporarily disable your account</p>
                        </div>
                        <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-all font-semibold text-sm">
                            Deactivate
                        </button>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-red-300 bg-red-50 rounded-xl">
                        <div>
                            <p class="text-red-800 font-semibold">Delete Account</p>
                            <p class="text-sm text-red-700">Permanently delete your account and all data</p>
                        </div>
                        <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all font-semibold text-sm">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
