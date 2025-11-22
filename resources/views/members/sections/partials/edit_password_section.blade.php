{{-- Change Password Section --}}
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Change Password</h2>
    </div>
    <div class="p-8">
        <form id="password-form" class="space-y-6" x-data="passwordHandler()" @submit.prevent="handlePasswordUpdate">
            @csrf
            
            {{-- Current Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Current Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input :type="showCurrentPassword ? 'text' : 'password'" name="current_password" required 
                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all"
                           :class="!editMode && 'bg-gray-50'" 
                           :readonly="!editMode"
                           placeholder="Enter your current password">
                    <button type="button" @click="showCurrentPassword = !showCurrentPassword" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            :disabled="!editMode">
                        <svg x-show="!showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- New Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        New Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input :type="showNewPassword ? 'text' : 'password'" name="new_password" required 
                               @input="validatePassword"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all"
                               :class="!editMode && 'bg-gray-50'" 
                               :readonly="!editMode"
                               placeholder="Enter new password"
                               minlength="8">
                        <button type="button" @click="showNewPassword = !showNewPassword" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                :disabled="!editMode">
                            <svg x-show="!showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Confirm New Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Confirm New Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input :type="showConfirmPassword ? 'text' : 'password'" name="new_password_confirmation" required 
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all"
                               :class="!editMode && 'bg-gray-50'" 
                               :readonly="!editMode"
                               placeholder="Confirm new password"
                               minlength="8">
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                :disabled="!editMode">
                            <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Password Requirements --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4" x-show="editMode">
                <p class="text-sm font-semibold text-gray-700 mb-2">Password must contain:</p>
                <ul class="space-y-1 text-sm">
                    <li class="flex items-center gap-2" :class="passwordValidation.minLength ? 'text-green-600' : 'text-gray-600'">
                        <svg class="w-4 h-4" :class="passwordValidation.minLength ? 'text-green-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        At least 8 characters
                    </li>
                    <li class="flex items-center gap-2" :class="passwordValidation.hasUpperCase ? 'text-green-600' : 'text-gray-600'">
                        <svg class="w-4 h-4" :class="passwordValidation.hasUpperCase ? 'text-green-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        One uppercase letter
                    </li>
                    <li class="flex items-center gap-2" :class="passwordValidation.hasLowerCase ? 'text-green-600' : 'text-gray-600'">
                        <svg class="w-4 h-4" :class="passwordValidation.hasLowerCase ? 'text-green-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        One lowercase letter
                    </li>
                    <li class="flex items-center gap-2" :class="passwordValidation.hasNumber ? 'text-green-600' : 'text-gray-600'">
                        <svg class="w-4 h-4" :class="passwordValidation.hasNumber ? 'text-green-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        One number
                    </li>
                    <li class="flex items-center gap-2" :class="passwordValidation.hasSpecialChar ? 'text-green-600' : 'text-gray-600'">
                        <svg class="w-4 h-4" :class="passwordValidation.hasSpecialChar ? 'text-green-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        One special character (!@#$%^&*)
                    </li>
                </ul>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                {{-- Edit Button (shown when not in edit mode) --}}
                <button type="button" @click="editMode = true" x-show="!editMode" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Change Password
                </button>

                {{-- Cancel & Save Buttons (shown when in edit mode) --}}
                <template x-if="editMode">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="cancelEdit()" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold flex items-center gap-2" :disabled="loading">
                            <span x-show="!loading">Update Password</span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Updating...
                            </span>
                        </button>
                    </div>
                </template>
            </div>
        </form>
    </div>
</div>

{{-- Password Update Modal --}}
@include('members.sections.partials.partials_2.modal_password')
