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
            @forelse(\App\Models\Product::active()->orderBy('price_monthly', 'asc')->get() as $index => $product)
            {{-- Plan Card --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-blue-200 hover:-translate-y-2 flex flex-col h-full">
                {{-- Popular Badge (untuk produk kedua) --}}
                @if($index === 1)
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2 rounded-full text-xs font-bold shadow-lg">
                    MOST POPULAR
                </div>
                @endif
                
                {{-- Discount Badge --}}
                @if($product->discount_percentage > 0)
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    SAVE {{ $product->discount_percentage }}%
                </div>
                @endif
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name_product }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 30) }}</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    {{-- Harga Asli (Coret) --}}
                    @if($product->price_original && $product->price_original > $product->price_monthly)
                    <div class="flex items-baseline gap-1 mb-1">
                        <span class="text-gray-400 text-sm">Rp</span>
                        <span class="text-gray-400 text-sm line-through">{{ number_format($product->price_original, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    {{-- Harga Setelah Diskon --}}
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-4xl font-bold text-gray-900 price-amount" data-monthly="{{ $product->price_monthly }}" data-yearly="{{ $product->price_monthly * 0.8 }}">{{ number_format($product->price_monthly, 0, ',', '.') }}</span>
                        <span class="text-gray-600 text-sm price-period">/bln</span>
                    </div>
                    
                    {{-- Free Months Badge --}}
                    @if($product->free_months > 0)
                    <p class="text-xs text-blue-600 font-semibold">+{{ $product->free_months }} bulan gratis</p>
                    @endif
                </div>
                
                <button 
                    onclick="buyNow({{ $product->id }}, '{{ $product->product_code }}', '{{ $product->name_product }}', {{ $product->price_monthly }}, {{ $product->price_original ?? 0 }}, {{ $product->discount_percentage }}, {{ $product->free_months }})"
                    class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6 cursor-pointer">
                    Buy Now
                </button>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed price-detail">
                        Dapatkan 12 bulan seharga 
                        <span class="font-semibold text-gray-700 yearly-total">Rp{{ number_format($product->price_monthly * 12 * 0.8, 0, ',', '.') }}</span> 
                        (hemat Rp{{ number_format($product->price_monthly * 12 * 0.2, 0, ',', '.') }}). 
                        Biaya perpanjangan Rp{{ number_format($product->price_monthly, 0, ',', '.') }}/bln.
                    </p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        {{-- Storage --}}
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $product->storage }} GB SSD Storage</span>
                        </li>
                        
                        {{-- Bandwidth --}}
                        @if($product->bandwidth)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $product->bandwidth }} Bandwidth</span>
                        </li>
                        @endif
                        
                        {{-- Domain --}}
                        @if($product->domain_included)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Free Domain Included</span>
                        </li>
                        @endif
                        
                        {{-- Email --}}
                        @if($product->email_feature)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Email Accounts</span>
                        </li>
                        @endif
                        
                        {{-- Database --}}
                        @if($product->database_feature)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>MySQL Database</span>
                        </li>
                        @endif
                        
                        {{-- SSL --}}
                        @if($product->ssl_included)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Free SSL Certificate</span>
                        </li>
                        @endif
                        
                        {{-- SSH Access --}}
                        @if($product->ssh_access)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>SSH Access</span>
                        </li>
                        @endif
                        
                        {{-- Daily Backups (default feature) --}}
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Daily Backups</span>
                        </li>
                        
                        {{-- 24/7 Support (default feature) --}}
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>24/7 Support</span>
                        </li>
                    </ul>
                </div>
            </div>
            @empty
            {{-- No Products Available --}}
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-gray-600 text-lg font-semibold mb-2">No Hosting Plans Available</p>
                <p class="text-gray-500 text-sm">Please check back later for available hosting plans.</p>
            </div>
            @endforelse
        </div>
    </div>
    </div>
</section>

{{-- Billing Toggle Script --}}
@push('scripts')
<script>
    // Function untuk redirect ke halaman cart dengan data produk
    function buyNow(productId, productCode, productName, priceMonthly, priceOriginal, discountPercentage, freeMonths) {
        // Simpan data produk ke sessionStorage
        const selectedPlan = {
            id: productId,
            product_code: productCode,
            name: productName,
            price_monthly: priceMonthly,
            price_original: priceOriginal,
            discount_percentage: discountPercentage,
            free_months: freeMonths,
            selected_at: new Date().toISOString()
        };
        
        sessionStorage.setItem('selectedHostingPlan', JSON.stringify(selectedPlan));
        
        // Redirect ke halaman cart
        window.location.href = '{{ route("members.cart") }}';
    }

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
