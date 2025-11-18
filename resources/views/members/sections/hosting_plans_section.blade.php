{{-- Hosting Plans Section --}}
<section id="hosting-plans" class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-16 px-6 relative overflow-hidden" style="padding-top: 88px;">
    {{-- Background Decoration --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

    <div class="container mx-auto max-w-7xl relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Hosting Plans
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Choose the perfect hosting plan for your needs. All plans include free SSL, daily backups, and 24/7 support.
            </p>
        </div>

        <!-- Billing Toggle
        <div class="flex justify-center items-center gap-4 mb-12">
            <span class="text-sm font-medium text-gray-600" id="monthly-label">Monthly</span>
            <button type="button" id="billing-toggle" class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <span class="translate-x-1 inline-block h-6 w-6 transform rounded-full bg-white transition-transform"></span>
            </button>
            <span class="text-sm font-medium text-gray-600" id="yearly-label">Yearly <span class="text-green-600 font-semibold">(Save 20%)</span></span>
        </div> -->

        {{-- Plans Grid --}}
        <div class="grid md:grid-cols-3 gap-8 max-w-7xl mx-auto items-stretch mb-8">
            {{-- Starter Plan --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-blue-200 hover:-translate-y-2 flex flex-col h-full">
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    SAVE 20%
                </div>
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                    <p class="text-gray-600 text-sm">Perfect for personal websites</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-400 text-sm line-through monthly-price hidden">Rp 50.000</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-5xl font-bold text-gray-900 price-amount" data-monthly="50000" data-yearly="40000">50.000</span>
                        <span class="text-gray-600 text-sm price-period">/bln</span>
                    </div>
                    <p class="text-xs text-blue-600 font-semibold yearly-info hidden">Hemat Rp 120.000/tahun</p>
                </div>
                
                <button class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6">
                    Buy Now
                </button>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed price-detail">Dapatkan 12 bulan seharga <span class="font-semibold text-gray-700 yearly-total">Rp480.000</span> (hemat Rp120.000). Biaya perpanjangan Rp50.000/bln.</p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>5 GB SSD Storage</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>50 GB Bandwidth</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>3 Email Accounts</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>1 MySQL Database</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Free SSL Certificate</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Daily Backups</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Pro Plan (Popular) --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col border border-gray-100 hover:border-blue-200 hover:-translate-y-2 h-full">
                {{-- Popular Badge --}}
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2 rounded-full text-xs font-bold shadow-lg">
                    MOST POPULAR
                </div>
                
                {{-- Discount Badge --}}
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    SAVE 20%
                </div>
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Pro</h3>
                    <p class="text-gray-600 text-sm">Best for growing businesses</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-400 text-sm line-through monthly-price hidden">Rp 100.000</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-5xl font-bold text-gray-900 price-amount" data-monthly="100000" data-yearly="80000">100.000</span>
                        <span class="text-gray-600 text-sm price-period">/bln</span>
                    </div>
                    <p class="text-xs text-blue-600 font-semibold yearly-info hidden">Hemat Rp 240.000/tahun</p>
                </div>
                
                <button class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6">
                    Buy Now
                </button>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed price-detail">Dapatkan 12 bulan seharga <span class="font-semibold text-gray-700 yearly-total">Rp960.000</span> (hemat Rp240.000). Biaya perpanjangan Rp100.000/bln.</p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>20 GB SSD Storage</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>200 GB Bandwidth</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>10 Email Accounts</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>5 MySQL Databases</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Free SSL Certificate</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Daily Backups</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Priority Support</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Business Plan --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col border border-gray-100 hover:border-blue-200 hover:-translate-y-2 h-full">
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    SAVE 20%
                </div>
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Business</h3>
                    <p class="text-gray-600 text-sm">For large-scale operations</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-400 text-sm line-through monthly-price hidden">Rp 200.000</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-5xl font-bold text-gray-900 price-amount" data-monthly="200000" data-yearly="160000">200.000</span>
                        <span class="text-gray-600 text-sm price-period">/bln</span>
                    </div>
                    <p class="text-xs text-blue-600 font-semibold yearly-info hidden">Hemat Rp 480.000/tahun</p>
                </div>
                
                <button class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6">
                    Buy Now
                </button>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed price-detail">Dapatkan 12 bulan seharga <span class="font-semibold text-gray-700 yearly-total">Rp1.920.000</span> (hemat Rp480.000). Biaya perpanjangan Rp200.000/bln.</p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>50 GB SSD Storage</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Unlimited Bandwidth</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Unlimited Email Accounts</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Unlimited MySQL Databases</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Free SSL Certificate</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Daily Backups</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>24/7 Priority Support</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Dedicated Resources</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Billing Toggle Script --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('billing-toggle');
        const priceAmounts = document.querySelectorAll('.price-amount');
        const pricePeriods = document.querySelectorAll('.price-period');
        const yearlyInfos = document.querySelectorAll('.yearly-info');
        const monthlyPrices = document.querySelectorAll('.monthly-price');
        let isYearly = false;

        if (toggle) {
            toggle.addEventListener('click', function() {
                isYearly = !isYearly;
                
                // Toggle button appearance
                const toggleButton = toggle.querySelector('span');
                if (isYearly) {
                    toggle.classList.remove('bg-gray-300');
                    toggle.classList.add('bg-blue-600');
                    toggleButton.classList.remove('translate-x-1');
                    toggleButton.classList.add('translate-x-7');
                } else {
                    toggle.classList.remove('bg-blue-600');
                    toggle.classList.add('bg-gray-300');
                    toggleButton.classList.remove('translate-x-7');
                    toggleButton.classList.add('translate-x-1');
                }

                // Update prices
                priceAmounts.forEach(amount => {
                    const monthly = parseInt(amount.dataset.monthly);
                    const yearly = parseInt(amount.dataset.yearly);
                    
                    if (isYearly) {
                        amount.textContent = yearly.toLocaleString('id-ID');
                    } else {
                        amount.textContent = monthly.toLocaleString('id-ID');
                    }
                });

                // Update period text
                pricePeriods.forEach(period => {
                    period.textContent = isYearly ? '/bln (tagihan tahunan)' : '/bln';
                });

                // Show/hide yearly info
                yearlyInfos.forEach(info => {
                    if (isYearly) {
                        info.classList.remove('hidden');
                    } else {
                        info.classList.add('hidden');
                    }
                });

                // Show/hide monthly strikethrough
                monthlyPrices.forEach(price => {
                    if (isYearly) {
                        price.classList.remove('hidden');
                    } else {
                        price.classList.add('hidden');
                    }
                });
            });
        }
    });
</script>
@endpush
