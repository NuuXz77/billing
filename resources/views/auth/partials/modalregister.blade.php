{{-- Modal Register Notification --}}
<div x-show="showModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed top-4 right-4 z-50 w-96 max-w-sm">
    
    {{-- Success Modal --}}
    <template x-if="modalType === 'success'">
        <div class="alert alert-success shadow-lg animate-bounce-in">
            <div class="flex items-start w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current flex-shrink-0" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 ml-3">
                    <h3 class="font-bold text-sm">Registrasi Berhasil!</h3>
                    <div class="text-xs mt-1" x-text="modalMessage"></div>
                    <div class="text-xs mt-2 opacity-70">Mengalihkan ke halaman login...</div>
                </div>
                <button @click="showModal = false" class="btn btn-sm btn-circle btn-ghost ml-2">✕</button>
            </div>
            <div class="absolute bottom-0 left-0 h-1 bg-success-content animate-progress"></div>
        </div>
    </template>

    {{-- Error Modal --}}
    <template x-if="modalType === 'error'">
        <div class="alert alert-error shadow-lg animate-shake">
            <div class="flex items-start w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current flex-shrink-0" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 ml-3">
                    <h3 class="font-bold text-sm">Registrasi Gagal!</h3>
                    <div class="text-xs mt-1" x-text="modalMessage"></div>
                    <template x-if="validationErrors.length > 0">
                        <div class="text-xs mt-2 space-y-1 max-h-40 overflow-y-auto">
                            <template x-for="error in validationErrors" :key="error">
                                <div class="opacity-90" x-text="'• ' + error"></div>
                            </template>
                        </div>
                    </template>
                </div>
                <button @click="showModal = false" class="btn btn-sm btn-circle btn-ghost ml-2">✕</button>
            </div>
            <div class="absolute bottom-0 left-0 h-1 bg-error-content animate-progress-slow"></div>
        </div>
    </template>
</div>

{{-- Custom Animations --}}
<style>
    @keyframes bounce-in {
        0% {
            opacity: 0;
            transform: scale(0.3) translateY(-20px);
        }
        50% {
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-5px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(5px);
        }
    }

    @keyframes progress {
        0% {
            width: 100%;
        }
        100% {
            width: 0%;
        }
    }

    @keyframes progress-slow {
        0% {
            width: 100%;
        }
        100% {
            width: 0%;
        }
    }

    .animate-bounce-in {
        animation: bounce-in 0.5s ease-out;
    }

    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }

    .animate-progress {
        animation: progress 2s linear;
    }

    .animate-progress-slow {
        animation: progress-slow 7s linear;
    }

    .alert {
        display: flex;
        padding: 1rem;
        border-radius: 0.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .alert-success {
        background-color: #d1f4e0;
        border: 1px solid #48c774;
        color: #0f5132;
    }
    
    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #dc3545;
        color: #721c24;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        background: transparent;
    }
    
    .btn-ghost:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .btn-circle {
        border-radius: 9999px;
        width: 2rem;
        height: 2rem;
        padding: 0;
    }
</style>
