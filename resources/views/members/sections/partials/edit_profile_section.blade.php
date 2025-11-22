{{-- Edit Profile Section --}}
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">Personal Information</h2>
    </div>
    <div class="p-8">
        <form id="profile-form" class="space-y-6" x-data="profileHandler()" @submit.prevent="handleProfileUpdate">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Full Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="full_name" value="{{ auth()->user()->full_name }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>

                {{-- Username --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" value="{{ auth()->user()->username }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all bg-gray-50" readonly>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all bg-gray-50" readonly>
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
                    <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="e.g., +62 812 3456 7890" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>

                {{-- Company Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Company Name
                    </label>
                    <input type="text" name="company_name" value="{{ auth()->user()->company_name ?? '' }}" placeholder="Optional" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>

                {{-- Country --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Country
                    </label>
                    <select name="country" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :disabled="!editMode">
                        <option value="">Select Country</option>
                        <option value="Indonesia" {{ auth()->user()->country == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="United States" {{ auth()->user()->country == 'United States' ? 'selected' : '' }}>United States</option>
                        <option value="United Kingdom" {{ auth()->user()->country == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                        <option value="Singapore" {{ auth()->user()->country == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                        <option value="Malaysia" {{ auth()->user()->country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                    </select>
                </div>

                {{-- Province --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Province
                    </label>
                    <input type="text" name="province" value="{{ auth()->user()->province ?? '' }}" placeholder="e.g., DKI Jakarta" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>

                {{-- City --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        City
                    </label>
                    <input type="text" name="city" value="{{ auth()->user()->city ?? '' }}" placeholder="e.g., Jakarta" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>

                {{-- District --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        District
                    </label>
                    <input type="text" name="district" value="{{ auth()->user()->district ?? '' }}" placeholder="e.g., Menteng" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>

                {{-- Postal Code --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Postal Code
                    </label>
                    <input type="text" name="pos_code" value="{{ auth()->user()->pos_code ?? '' }}" placeholder="e.g., 10310" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">
                </div>
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Address
                </label>
                <textarea name="address" rows="3" placeholder="Enter your full address" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" :class="!editMode && 'bg-gray-50'" :readonly="!editMode">{{ auth()->user()->address ?? '' }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                {{-- Edit Button (shown when not in edit mode) --}}
                <button type="button" @click="editMode = true" x-show="!editMode" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Profile
                </button>

                {{-- Cancel & Save Buttons (shown when in edit mode) --}}
                <template x-if="editMode">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="editMode = false; location.reload()" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold flex items-center gap-2" :disabled="loading">
                            <span x-show="!loading">Save Changes</span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </template>
            </div>
        </form>
    </div>
</div>

{{-- Profile Update Modal --}}
@include('members.sections.partials.partials_2.modal_profile')
