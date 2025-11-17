{{-- Paket Harga --}}
<section id="pricing" class="bg-gradient-to-b from-gray-50 to-white py-20 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto max-w-7xl px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-5 py-2.5 rounded-full text-sm font-semibold mb-6 shadow-sm">
                <i data-lucide="tag" class="w-4 h-4"></i>
                <span>Harga Spesial - Diskon Hingga 86%</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">
                Jangan lewatkan promo <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Black Friday</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Paket hosting dengan harga terbaik. Gratis domain, SSL, dan email profesional</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-7xl mx-auto items-stretch">
            {{-- Single Plan --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-blue-200 hover:-translate-y-2 flex flex-col h-full">
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    DISKON 86%
                </div>
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Single</h3>
                    <p class="text-gray-600 text-sm">Cocok untuk entrepreneur</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-400 text-sm line-through">Rp 89.900</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-5xl font-bold text-gray-900">12.900</span>
                        <span class="text-gray-600 text-sm">/bln</span>
                    </div>
                </div>
                
                <a href="{{ route('cart') }}" class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6 inline-block text-center">
                    Pilih paket
                </a>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed">Dapatkan 48 bulan seharga <span class="font-semibold text-gray-700">Rp619.200</span> (harga normal Rp4.315.200). Biaya perpanjangan Rp54.900/bln.</p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Buat 1 situs web</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>10 GB SSD Storage</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>~10.000 Pengunjung/Bulan</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Gratis SSL Selamanya</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Email Support 24/7</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Gratis Domain 1 Tahun</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Premium Plan (Popular) --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col border border-gray-100 hover:border-blue-200 hover:-translate-y-2 h-full">
                {{-- Popular Badge --}}
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2 rounded-full text-xs font-bold shadow-lg">
                    TERPOPULER
                </div>
                
                {{-- Discount Badge --}}
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    DISKON 80%
                </div>
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Premium</h3>
                    <p class="text-gray-600 text-sm">Segala yang dibutuhkan untuk buat website</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-400 text-sm line-through">Rp 119.900</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-5xl font-bold text-gray-900">23.900</span>
                        <span class="text-gray-600 text-sm">/bln</span>
                    </div>
                    <p class="text-xs text-blue-600 font-semibold">+2 bulan gratis</p>
                </div>
                
                <a href="{{ route('cart') }}" class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6 inline-block text-center">
                    Pilih paket
                </a>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed">Dapatkan 48 bulan seharga <span class="font-semibold text-gray-700">Rp1.147.200</span> (harga normal Rp5.755.200). Biaya perpanjangan Rp84.900/bln.</p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Buat hingga 3 website</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>20 GB SSD storage untuk menyimpan file</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>2 mailbox per website - gratis 1 tahun</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Domain gratis selama 1 tahun</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Situs WordPress Anda, kami yang urus</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Kelola website lebih efektif dengan WordPress Command line</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span class="font-semibold text-gray-800">Semua bonus di paket Single, plus:</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Business Plan --}}
            <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col border border-gray-100 hover:border-blue-200 hover:-translate-y-2 h-full">
                <div class="absolute top-6 right-6 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    DISKON 70%
                </div>
                
                <div class="mb-6 h-[56px] flex flex-col justify-start">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Business</h3>
                    <p class="text-gray-600 text-sm">Lebih banyak tool dan resource untuk berkembang</p>
                </div>
                
                <div class="mb-6 h-[115px] flex flex-col justify-start">
                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-gray-400 text-sm line-through">Rp 129.900</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-gray-700 text-sm font-medium">Rp</span>
                        <span class="text-5xl font-bold text-gray-900">38.900</span>
                        <span class="text-gray-600 text-sm">/bln</span>
                    </div>
                    <p class="text-xs text-blue-600 font-semibold">+2 bulan gratis</p>
                </div>
                
                <a href="{{ route('cart') }}" class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 mb-6 inline-block text-center">
                    Pilih paket
                </a>
                
                <div>
                    <p class="text-xs text-gray-500 mb-5 leading-relaxed">Dapatkan 48 bulan seharga <span class="font-semibold text-gray-700">Rp1.867.200</span> (harga normal Rp6.235.200). Biaya perpanjangan Rp121.900/bln.</p>
                    
                    <ul class="space-y-3 text-xs text-gray-700 mb-5">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Buat hingga 50 website</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>50 GB NVMe storage tercepat di dunia</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>5 mailbox per website - gratis 1 tahun</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Backup harian dan sesuai kebutuhan untuk mencegah kehilangan data</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>Buat situs ecommerce dengan AI</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span>AI agent untuk WordPress GRATIS</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                            <span class="font-semibold text-gray-800">Semua bonus di paket Premium, plus:</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
