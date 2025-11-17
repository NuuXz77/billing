<div x-data="{ show: @entangle('showModal') }">
    {{-- Logout Confirmation Modal --}}
    <dialog :open="show" class="modal" :class="{ 'modal-open': show }">
        <div class="modal-box max-w-md">
            {{-- Header --}}
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-error/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-error" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Confirm Logout</h3>
                    <p class="text-sm text-base-content/60">Are you sure you want to sign out?</p>
                </div>
            </div>

            {{-- Message --}}
            <div class="bg-base-200 rounded-lg p-4 mb-6">
                <p class="text-sm">
                    <span class="font-semibold">{{ auth()->user()->full_name }}</span>
                    <br>
                    <span class="text-base-content/60">{{ auth()->user()->email }}</span>
                </p>
            </div>

            {{-- Actions --}}
            <div class="modal-action justify-between">
                <button wire:click="cancelLogout" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </button>
                <button wire:click="logout" class="btn btn-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </div>
        </div>

        {{-- Backdrop --}}
        <div class="modal-backdrop" @click="$wire.cancelLogout()"></div>
    </dialog>
</div>