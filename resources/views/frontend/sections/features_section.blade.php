{{-- Fitur Utama --}}
<section id="features" class="bg-gradient-to-b from-gray-50 to-white py-24 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto max-w-7xl px-8 lg:px-20 relative z-10">
        <div class="text-center mb-20">
            <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-5 py-2.5 rounded-full text-sm font-semibold mb-6 shadow-sm">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Fitur Premium Terlengkap</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-gray-900">Kenapa Memilih Kami?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Fitur lengkap dan powerful untuk membuat website Anda berjalan dengan optimal</p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Illustration --}}
            <div class="relative">
                <div class="text-center">
                    <img src="{{ asset('img/why_ilustration.svg') }}" alt="Why Choose Us" class="w-full max-w-3xl mx-auto h-auto object-contain rounded-2xl animate-float">
                </div>
            </div>

            {{-- Right Side: Features Grid --}}
            <div class="space-y-8">
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4">
                        <i data-lucide="zap" class="w-7 h-7 text-blue-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-900">LiteSpeed Cache</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Kecepatan loading 40x lebih cepat dengan teknologi LiteSpeed terbaru.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <i data-lucide="shield-check" class="w-7 h-7 text-green-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-900">SSL Gratis Selamanya</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Keamanan HTTPS untuk semua website Anda tanpa biaya tambahan.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <i data-lucide="headphones" class="w-7 h-7 text-purple-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-900">Support Expert 24/7</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Tim support berpengalaman siap membantu kapan saja Anda butuhkan.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <i data-lucide="database" class="w-7 h-7 text-orange-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-900">Backup Otomatis</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Data Anda di-backup otomatis setiap hari untuk keamanan maksimal.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <i data-lucide="globe" class="w-7 h-7 text-red-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-900">CDN Global</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Konten Anda dimuat dari server terdekat untuk performa optimal.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <i data-lucide="mail" class="w-7 h-7 text-indigo-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-900">Email Professional</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Buat email bisnis dengan domain Anda sendiri yang terlihat profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
