{{-- CTA Akhir --}}
<section id="cta" class="bg-gradient-to-b from-gray-50 to-white py-28 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto max-w-7xl px-8 lg:px-20 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-blue-100 px-5 py-2.5 rounded-full text-sm font-medium text-blue-700 mb-8">
            <i data-lucide="rocket" class="w-4 h-4"></i>
            <span>Mulai Hari Ini</span>
        </div>
        
        <h2 class="text-4xl md:text-6xl font-bold mb-8 leading-tight text-gray-900">
            Bangun Website Profesional <br class="hidden md:block"/>Anda Sekarang
        </h2>
        
        <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
            Mulai hanya dengan Rp19.900/bulan dan nikmati performa terbaik dengan uptime 99.9% guarantee.
        </p>
        
        <div class="flex flex-wrap justify-center gap-6 mb-20">
            <a href="{{ route('pricing') }}" class="inline-flex items-center gap-3 bg-blue-600 text-white font-semibold px-10 py-5 rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-xl hover:scale-105 text-lg">
                <i data-lucide="check-check" class="w-6 h-6"></i>
                <span>Mulai Sekarang</span>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center gap-3 bg-white text-gray-900 font-semibold px-10 py-5 rounded-xl hover:bg-gray-100 transition-all duration-300 border-2 border-gray-200 text-lg shadow-lg cursor-pointer">
                <i data-lucide="message-circle" class="w-6 h-6"></i>
                <span>Hubungi Kami</span>
            </a>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:shadow-xl transition-all duration-300">
                <i data-lucide="shield-check" class="w-12 h-12 mb-4 text-blue-600"></i>
                <h3 class="font-bold text-2xl mb-3 text-gray-900">99.9% Uptime</h3>
                <p class="text-gray-600">Jaminan website selalu online</p>
            </div>
            <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:shadow-xl transition-all duration-300">
                <i data-lucide="clock" class="w-12 h-12 mb-4 text-blue-600"></i>
                <h3 class="font-bold text-2xl mb-3 text-gray-900">24/7 Support</h3>
                <p class="text-gray-600">Tim siap membantu kapanpun</p>
            </div>
            <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:shadow-xl transition-all duration-300">
                <i data-lucide="badge-dollar-sign" class="w-12 h-12 mb-4 text-blue-600"></i>
                <h3 class="font-bold text-2xl mb-3 text-gray-900">30 Hari Garansi</h3>
                <p class="text-gray-600">Uang kembali tanpa ribet</p>
            </div>
        </div>
    </div>
</section>
