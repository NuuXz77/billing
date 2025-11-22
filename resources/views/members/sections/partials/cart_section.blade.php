{{-- Keranjang Section --}}
<section id="cart" class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-20 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        <!-- Logo di kiri atas -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 hover:opacity-80 transition-opacity duration-300">
                <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="Hoci" class="h-12 w-auto">
                <span class="font-['Source_Sans_Pro'] text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Hoci</span>
            </a>
        </div>
        
        <h1 class="text-4xl font-bold mb-10 text-gray-900">Keranjang Anda</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Premium Web Hosting Section -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800" id="product-name">Premium Web Hosting</h2>
                    
                    <!-- Durasi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-3 text-sm">Durasi</label>
                        <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                            <div class="relative w-full md:w-[200px] md:flex-shrink-0">
                                <select id="duration-select" class="w-full border border-gray-300 rounded-lg px-4 py-3 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 cursor-pointer">
                                    <option value="1" selected>1 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4 md:ml-auto w-full md:w-auto">
                                <div id="savings-badge" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-full font-semibold text-xs sm:text-sm shadow-md whitespace-nowrap">
                                    HEMAT RP0
                                </div>
                                <div class="text-left sm:text-right w-full sm:w-auto">
                                    <div id="display-price" class="text-2xl sm:text-3xl font-bold text-gray-900">Rp0/bln</div>
                                    <div id="original-price-display" class="text-sm text-gray-400 line-through"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Info -->
                    <div class="mb-6 mt-3">
                        <p class="text-sm text-gray-500" id="renewal-info">Biaya perpanjangan akan ditampilkan setelah memilih durasi.</p>
                    </div>

                    <!-- Free Domain Notice -->
                    <div id="free-notice" class="bg-gradient-to-r from-blue-50 to-emerald-50 border-l-4 border-blue-400 p-4 rounded-lg hidden">
                        <p class="text-gray-700 text-sm">
                            <span id="free-notice-text"></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 h-fit sticky top-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800 pb-4 border-b border-gray-100">Daftar pesanan</h2>
                    
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-5 text-base" id="summary-product-name">Premium Web Hosting</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 text-sm" id="package-duration">Paket 12 bulan</span>
                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-400 line-through text-xs" id="package-original-price">Rp0</span>
                                        <span class="font-bold text-gray-900 ml-2" id="package-discounted-price">Rp0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="free-months-row" class="flex justify-between items-start hidden">
                                <span class="text-gray-600 text-sm" id="free-months-text">Gratis 0 Bulan</span>
                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-400 line-through text-xs" id="free-months-value">Rp0</span>
                                        <span class="font-bold text-gray-900 ml-2">Rp0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="domain-row" class="flex justify-between items-start hidden">
                                <span class="text-gray-600 text-sm inline-flex items-center">
                                    Nama Domain
                                    <span class="inline-flex items-center ml-1.5 cursor-pointer">
                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                            <path d="M12 16v-4M12 8h.01" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </span>
                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-400 line-through text-xs">Rp259.900</span>
                                        <span class="font-bold text-gray-900 ml-2">Rp0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="domain-privacy-row" class="flex justify-between items-start hidden">
                                <span class="text-gray-600 text-sm">Proteksi Privasi Domain WHOIS</span>
                                <span class="font-bold text-gray-900">Rp0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tax Section -->
                    <div class="border-t border-gray-100 pt-5 mb-5">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-gray-600 text-sm">Pajak</span>
                            <span class="text-gray-600 font-medium">-</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">(Dihitung setelah informasi penagihan)</p>
                    </div>

                    <!-- Subtotal -->
                    <div class="border-t border-gray-100 pt-5 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-800">Subtotal</span>
                            <div class="text-right">
                                <div>
                                    <span class="text-gray-400 line-through text-sm" id="subtotal-original">Rp0</span>
                                    <span class="text-2xl font-bold text-gray-900 ml-2" id="subtotal-discounted">Rp0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button onclick="window.history.back()" class="flex-1 bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 flex items-center justify-center min-h-[44px]">
                            Kembali
                        </button>
                        <button type="button" id="checkout-btn" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-xl transition duration-200 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 flex items-center justify-center">
                            Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Include modals and scripts needed for pay now modal --}}
<div id="newTransactionModalsContainer"></div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data produk dari sessionStorage
        const selectedPlanData = sessionStorage.getItem('selectedHostingPlan');
        
        if (!selectedPlanData) {
            console.warn('Tidak ada produk yang dipilih. Redirect ke hosting plans.');
            // Optional: redirect jika tidak ada data
            // window.location.href = '/members?section=hosting-plans';
            return;
        }
        
        const plan = JSON.parse(selectedPlanData);
        let selectedDuration = 1; // Default 1 bulan
        
        // Update nama produk
        document.getElementById('product-name').textContent = plan.name;
        document.getElementById('summary-product-name').textContent = plan.name;
        
        // Function untuk format rupiah
        function formatRupiah(amount) {
            return 'Rp' + Math.round(amount).toLocaleString('id-ID');
        }
        
        // Function untuk update semua harga berdasarkan durasi
        function updatePrices(duration) {
            const priceMonthly = parseFloat(plan.price_monthly);
            const priceOriginal = parseFloat(plan.price_original) || priceMonthly;
            const freeMonths = parseInt(plan.free_months) || 0;
            const discountPercentage = parseInt(plan.discount_percentage) || 0;
            
            // Hitung total untuk durasi yang dipilih
            const totalDiscounted = priceMonthly * duration;
            const totalOriginal = priceOriginal * duration;
            const savings = totalOriginal - totalDiscounted;
            
            // Update display harga per bulan
            document.getElementById('display-price').textContent = formatRupiah(priceMonthly) + '/bln';
            if (priceOriginal > priceMonthly) {
                document.getElementById('original-price-display').textContent = formatRupiah(priceOriginal) + '/bln';
            } else {
                document.getElementById('original-price-display').textContent = '';
            }
            
            // Update savings badge
            if (savings > 0) {
                document.getElementById('savings-badge').textContent = 'HEMAT ' + formatRupiah(savings);
            } else {
                document.getElementById('savings-badge').textContent = 'DISKON ' + discountPercentage + '%';
            }
            
            // Update renewal info
            document.getElementById('renewal-info').textContent = 
                `Total pembayaran: ${formatRupiah(totalDiscounted)} untuk ${duration} bulan. Biaya perpanjangan ${formatRupiah(priceMonthly)}/bln.`;
            
            // Update free notice
            const freeNotice = document.getElementById('free-notice');
            const freeNoticeText = document.getElementById('free-notice-text');
            let noticeMessages = [];
            
            if (freeMonths > 0) {
                noticeMessages.push(`<span class="font-semibold">${freeMonths} bulan GRATIS</span>`);
            }
            
            // Cek apakah ada domain gratis (dari data produk, bisa ditambahkan field domain_included)
            // Untuk sekarang, kita asumsikan domain gratis untuk durasi >= 12 bulan
            if (duration >= 12) {
                noticeMessages.push(`domain <span class="font-semibold">GRATIS</span>`);
            }
            
            if (noticeMessages.length > 0) {
                freeNoticeText.innerHTML = 'Selamat! Anda dapat ' + noticeMessages.join(' dan ') + ' di paket ini.';
                freeNotice.classList.remove('hidden');
            } else {
                freeNotice.classList.add('hidden');
            }
            
            // Update order summary
            document.getElementById('package-duration').textContent = `Paket ${duration} bulan`;
            document.getElementById('package-original-price').textContent = formatRupiah(totalOriginal);
            document.getElementById('package-discounted-price').textContent = formatRupiah(totalDiscounted);
            
            // Update free months row
            const freeMonthsRow = document.getElementById('free-months-row');
            if (freeMonths > 0) {
                document.getElementById('free-months-text').textContent = `Gratis ${freeMonths} Bulan`;
                document.getElementById('free-months-value').textContent = formatRupiah(priceMonthly * freeMonths);
                freeMonthsRow.classList.remove('hidden');
            } else {
                freeMonthsRow.classList.add('hidden');
            }
            
            // Show/hide domain rows (untuk durasi >= 12 bulan)
            const domainRow = document.getElementById('domain-row');
            const domainPrivacyRow = document.getElementById('domain-privacy-row');
            if (duration >= 12) {
                domainRow.classList.remove('hidden');
                domainPrivacyRow.classList.remove('hidden');
            } else {
                domainRow.classList.add('hidden');
                domainPrivacyRow.classList.add('hidden');
            }
            
            // Update subtotal
            const subtotalOriginal = totalOriginal + (freeMonths > 0 ? priceMonthly * freeMonths : 0);
            const subtotalDiscounted = totalDiscounted; // Free months tidak dikenakan biaya
            
            document.getElementById('subtotal-original').textContent = formatRupiah(subtotalOriginal);
            document.getElementById('subtotal-discounted').textContent = formatRupiah(subtotalDiscounted);
        }
        
        // Event listener untuk perubahan durasi
        document.getElementById('duration-select').addEventListener('change', function() {
            const duration = parseInt(this.value) || 12;
            selectedDuration = duration;
            updatePrices(duration);
        });
        
        // Initial update dengan durasi default (12 bulan)
        updatePrices(selectedDuration);
        
        // Handle checkout button click
        document.getElementById('checkout-btn').addEventListener('click', function() {
            const button = this;
            
            // Ambil data dari sessionStorage
            const selectedPlanData = sessionStorage.getItem('selectedHostingPlan');
            if (!selectedPlanData) {
                alert('Data produk tidak ditemukan. Silakan pilih paket lagi.');
                window.location.href = '/hosting/plans';
                return;
            }
            
            const plan = JSON.parse(selectedPlanData);
            const duration = parseInt(document.getElementById('duration-select').value);
            const priceMonthly = parseFloat(plan.price_monthly);
            const totalPayment = priceMonthly * duration;
            
            // Cari product_id - bisa dari field id, product_id, atau product_code
            const productId = plan.id || plan.product_id || null;
            
            // Debug log
            console.log('Checkout Data:', {
                product_id: productId,
                duration: duration,
                total_payment: totalPayment,
                billing_cycle: duration + ' bulan',
                plan: plan
            });
            
            // Validasi product_id ada
            if (!productId) {
                alert('ID Produk tidak ditemukan. Silakan pilih paket lagi.');
                window.location.href = '/hosting/plans';
                return;
            }
            
            // Disable button
            button.disabled = true;
            button.innerHTML = `
                <svg class="inline-block animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;
            
            // Send checkout request
            fetch('{{ route("members.checkout") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    duration: duration,
                    total_payment: totalPayment,
                    billing_cycle: duration + ' bulan'
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.json().then(err => {
                        console.error('Server error:', err);
                        throw new Error(err.message || 'Network response was not ok');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log('Transaction created:', data.transaction);
                    
                    // Fetch and inject pay now modal from server
                    fetch(`/members/transaction-modal/${data.transaction.id}`)
                        .then(response => response.text())
                        .then(html => {
                            const container = document.getElementById('newTransactionModalsContainer');
                            container.innerHTML = html;
                            
                            // Execute scripts that were injected
                            const scripts = container.querySelectorAll('script');
                            scripts.forEach(script => {
                                const newScript = document.createElement('script');
                                if (script.src) {
                                    newScript.src = script.src;
                                } else {
                                    newScript.textContent = script.textContent;
                                }
                                document.body.appendChild(newScript);
                            });
                            
                            // Wait a bit then open modal
                            setTimeout(() => {
                                const modalId = 'payNowModal-' + data.transaction.id;
                                const modal = document.getElementById(modalId);
                                if (modal) {
                                    modal.classList.remove('hidden');
                                    document.body.style.overflow = 'hidden';
                                }
                            }, 300);
                        });
                } else {
                    alert(data.message || 'Terjadi kesalahan saat membuat transaksi');
                    button.disabled = false;
                    button.textContent = 'Lanjutkan';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                button.disabled = false;
                button.textContent = 'Lanjutkan';
            });
        });
    });
</script>
@endpush
