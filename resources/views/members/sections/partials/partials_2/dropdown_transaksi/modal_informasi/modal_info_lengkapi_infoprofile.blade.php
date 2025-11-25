{{-- Modal Info Lengkapi Profile --}}
<div id="incompleteProfileModal" class="hidden fixed inset-0 bg-gradient-to-br from-black/60 to-black/80 backdrop-blur-md z-[99999] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full transform transition-all duration-300 scale-95 opacity-0 overflow-hidden" id="incompleteProfileModalContent" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div class="px-6 py-5 relative overflow-hidden bg-gradient-to-br from-amber-400 via-yellow-500 to-orange-500">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
            </div>
            <div class="flex items-center gap-4 relative z-10">
                <div class="flex-shrink-0 bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">
                        Profil Belum Lengkap
                    </h3>
                </div>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="px-6 py-6 bg-gradient-to-br from-gray-50 to-white">
            <div class="mb-4">
                <p class="text-gray-700 leading-relaxed text-[15px] mb-4">
                    Untuk pengalaman terbaik dan keamanan akun Anda, mohon lengkapi informasi profil berikut:
                </p>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-4">
                    <p class="text-sm font-semibold text-yellow-800 mb-2">Data yang perlu dilengkapi:</p>
                    <ul class="space-y-2" id="incompleteFieldsList">
                        {{-- Will be populated by JavaScript --}}
                    </ul>
                </div>

                <div class="flex items-start gap-3 text-sm text-gray-600 bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>Profil yang lengkap membantu kami memberikan layanan yang lebih baik dan mempercepat proses verifikasi transaksi Anda.</p>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-end gap-3">
            <button onclick="closeIncompleteProfileModal()" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200 font-semibold text-gray-900">
                Nanti Saja
            </button>
            <button onclick="goToProfile()" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Lengkapi Sekarang
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
    function showIncompleteProfileModal(incompleteFields) {
        const modal = document.getElementById('incompleteProfileModal');
        const modalContent = document.getElementById('incompleteProfileModalContent');
        const fieldsList = document.getElementById('incompleteFieldsList');

        // Clear previous list
        fieldsList.innerHTML = '';

        // Populate incomplete fields list
        const fieldLabels = {
            phone: 'Nomor Telepon',
            address: 'Alamat Lengkap',
            city: 'Kota',
            province: 'Provinsi',
            country: 'Negara',
            pos_code: 'Kode Pos',
            district: 'Kecamatan'
        };

        incompleteFields.forEach(field => {
            const li = document.createElement('li');
            li.className = 'flex items-center gap-2 text-yellow-700';
            li.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                ${fieldLabels[field] || field}
            `;
            fieldsList.appendChild(li);
        });

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Animate modal
        setTimeout(() => {
            modalContent.classList.remove('modal-hide');
            modalContent.classList.add('modal-show');
        }, 10);
    }

    function closeIncompleteProfileModal() {
        const modal = document.getElementById('incompleteProfileModal');
        const modalContent = document.getElementById('incompleteProfileModalContent');
        
        modalContent.classList.remove('modal-show');
        modalContent.classList.add('modal-hide');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            modalContent.classList.remove('modal-hide');
        }, 300);
    }

    function goToProfile() {
        window.location.href = '/members/profile';
    }

    // Close on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('incompleteProfileModal');
            if (!modal.classList.contains('hidden')) {
                closeIncompleteProfileModal();
            }
        }
    });

    // Auto-check profile completeness on page load (only on dashboard)
    document.addEventListener('DOMContentLoaded', function() {
        // Check if we're on dashboard
        const currentPage = window.location.pathname;

        if (currentPage === '/dashboard') {
            // Get user data (passed from backend)
            const userData = @json(auth()->user());
            
            // Define required fields
            const requiredFields = ['phone', 'address', 'city', 'province', 'country', 'pos_code'];
            const incompleteFields = [];

            // Check which fields are empty
            requiredFields.forEach(field => {
                if (!userData[field] || userData[field].trim() === '') {
                    incompleteFields.push(field);
                }
            });

            // Show modal if there are incomplete fields
            if (incompleteFields.length > 0) {
                setTimeout(() => {
                    showIncompleteProfileModal(incompleteFields);
                }, 1000); // Show after 1 second delay
            }
        }
    });

    // Function to check profile completeness (can be called from other pages)
    function checkProfileCompleteness() {
        const userData = @json(auth()->user());
        const requiredFields = ['phone', 'address', 'city', 'province', 'country', 'pos_code'];
        const incompleteFields = [];

        requiredFields.forEach(field => {
            if (!userData[field] || userData[field].trim() === '') {
                incompleteFields.push(field);
            }
        });

        return incompleteFields;
    }

    // Make function globally accessible
    window.checkProfileCompleteness = checkProfileCompleteness;
    window.showIncompleteProfileModal = showIncompleteProfileModal;
</script>
