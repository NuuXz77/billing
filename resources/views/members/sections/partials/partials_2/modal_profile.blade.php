{{-- Profile Update Modal Notification --}}
<div x-show="showModal" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
    
    {{-- Modal Content --}}
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100">
            
            {{-- Success Modal --}}
            <div x-show="modalType === 'success'" class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4 animate-bounce-in">
                    <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Profile Updated!</h3>
                <p class="text-gray-600 mb-6" x-text="modalMessage"></p>
                <div class="relative h-1 bg-gray-200 rounded-full overflow-hidden">
                    <div class="absolute top-0 left-0 h-full bg-green-600 animate-progress"></div>
                </div>
            </div>

            {{-- Error Modal --}}
            <div x-show="modalType === 'error'" class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4 animate-shake">
                    <svg class="h-10 w-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Update Failed</h3>
                <p class="text-gray-600 mb-4" x-text="modalMessage"></p>
                
                {{-- Validation Errors --}}
                <div x-show="validationErrors.length > 0" class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 text-left">
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1 max-h-40 overflow-y-auto">
                        <template x-for="error in validationErrors" :key="error">
                            <li x-text="error"></li>
                        </template>
                    </ul>
                </div>

                <button @click="showModal = false" class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all">
                    Close
                </button>
                
                <div class="relative h-1 bg-gray-200 rounded-full overflow-hidden mt-4">
                    <div class="absolute top-0 left-0 h-full bg-red-600 animate-progress-error"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    
    @keyframes bounce-in {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    
    @keyframes progress {
        from { width: 0%; }
        to { width: 100%; }
    }
    
    @keyframes progress-error {
        from { width: 0%; }
        to { width: 100%; }
    }
    
    .animate-bounce-in {
        animation: bounce-in 0.5s ease-out;
    }
    
    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }
    
    .animate-progress {
        animation: progress 2s linear forwards;
    }
    
    .animate-progress-error {
        animation: progress-error 5s linear forwards;
    }
</style>

<script>
    function profileHandler() {
        return {
            editMode: false,
            showModal: false,
            modalType: '',
            modalMessage: '',
            validationErrors: [],
            loading: false,

            async handleProfileUpdate(event) {
                this.loading = true;
                this.validationErrors = [];
                
                const form = event.target;
                const formData = new FormData(form);

                try {
                    const response = await fetch('{{ route("profile.update") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();
                    this.loading = false;

                    if (data.success) {
                        this.modalType = 'success';
                        this.modalMessage = data.message;
                        this.showModal = true;

                        // Auto close and reload after 2 seconds
                        setTimeout(() => {
                            this.showModal = false;
                            location.reload();
                        }, 2000);
                    } else {
                        this.showError(data.message, data.errors);
                    }
                } catch (error) {
                    this.loading = false;
                    this.showError('An unexpected error occurred. Please try again.');
                    console.error('Profile update error:', error);
                }
            },

            showError(message, errors = null) {
                this.modalType = 'error';
                this.modalMessage = message;
                
                if (errors) {
                    this.validationErrors = Object.values(errors).flat();
                }
                
                this.showModal = true;

                // Auto close after 5 seconds
                setTimeout(() => {
                    this.showModal = false;
                }, 5000);
            }
        }
    }
</script>
