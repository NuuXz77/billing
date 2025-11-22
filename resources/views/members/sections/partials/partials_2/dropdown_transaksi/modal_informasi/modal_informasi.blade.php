{{-- Modal Informasi untuk Notifikasi --}}
<div id="infoModal" class="hidden fixed inset-0 bg-gradient-to-br from-black/60 to-black/80 backdrop-blur-md z-[99999] flex items-center justify-center p-4" onclick="if(event.target === this) closeInfoModal()">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0 overflow-hidden" id="infoModalContent" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div id="infoModalHeader" class="px-6 py-5 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
            </div>
            <div class="flex items-center gap-4 relative z-10">
                <div id="infoModalIcon" class="flex-shrink-0 bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    {{-- Icon will be injected by JS --}}
                </div>
                <div>
                    <h3 id="infoModalTitle" class="text-xl font-bold text-white">
                        {{-- Title will be injected by JS --}}
                    </h3>
                </div>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="px-6 py-6 bg-gradient-to-br from-gray-50 to-white">
            <p id="infoModalMessage" class="text-gray-700 leading-relaxed text-[15px]">
                {{-- Message will be injected by JS --}}
            </p>
        </div>

        {{-- Modal Footer --}}
        <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-end">
            <button onclick="closeInfoModal()" class="px-8 py-3 bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-black text-white rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95">
                OK
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes modalShow {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes modalHide {
        0% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        100% {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
    }

    .modal-show {
        animation: modalShow 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .modal-hide {
        animation: modalHide 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
</style>

<script>
    function showInfoModal(type, title, message) {
        const modal = document.getElementById('infoModal');
        const modalContent = document.getElementById('infoModalContent');
        const modalHeader = document.getElementById('infoModalHeader');
        const modalIcon = document.getElementById('infoModalIcon');
        const modalTitle = document.getElementById('infoModalTitle');
        const modalMessage = document.getElementById('infoModalMessage');

        // Define modal styles based on type
        const types = {
            error: {
                headerBg: 'bg-gradient-to-br from-red-500 via-red-600 to-red-700',
                icon: '<svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                title: title || 'Error'
            },
            warning: {
                headerBg: 'bg-gradient-to-br from-amber-400 via-yellow-500 to-orange-500',
                icon: '<svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                title: title || 'Peringatan'
            },
            success: {
                headerBg: 'bg-gradient-to-br from-emerald-500 via-green-600 to-teal-600',
                icon: '<svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                title: title || 'Berhasil'
            },
            info: {
                headerBg: 'bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600',
                icon: '<svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                title: title || 'Informasi'
            }
        };

        const config = types[type] || types.info;

        // Remove previous header classes and animations
        modalHeader.className = 'px-6 py-5 relative overflow-hidden ' + config.headerBg;
        modalIcon.innerHTML = config.icon;
        modalTitle.textContent = config.title;
        modalMessage.textContent = message;

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Animate modal
        setTimeout(() => {
            modalContent.classList.remove('modal-hide');
            modalContent.classList.add('modal-show');
        }, 10);
    }

    function closeInfoModal() {
        const modal = document.getElementById('infoModal');
        const modalContent = document.getElementById('infoModalContent');
        
        modalContent.classList.remove('modal-show');
        modalContent.classList.add('modal-hide');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            modalContent.classList.remove('modal-hide');
        }, 300);
    }

    // Close on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('infoModal');
            if (!modal.classList.contains('hidden')) {
                closeInfoModal();
            }
        }
    });
</script>
