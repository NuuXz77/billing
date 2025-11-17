{{-- Hero Section --}}
<section id="home" class="bg-gradient-to-b from-gray-50 to-white min-h-screen flex items-center justify-center pt-26 pb-12 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto max-w-7xl px-6 lg:px-16 relative z-10">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            {{-- Left Content --}}
            <div class="hero-animate">
                <h1 class="text-4xl md:text-5xl lg:text-5xl xl:text-6xl font-extrabold leading-tight mb-5 text-gray-900">
                    Tingkatkan Performa <span class="text-blue-600">Digital</span> Anda dengan <span class="text-blue-600">Hoci</span>
                </h1>
                
                <p class="text-base md:text-lg text-gray-600 leading-relaxed mb-6 max-w-lg">
                    <span class="font-bold text-blue-600">Hosting</span> cepat, stabil, dan aman dengan <span class="font-bold text-blue-600">teknologi cloud</span> terkini. Solusi sempurna untuk <span class="font-bold text-blue-600">website modern</span> Anda
                </p>
                
                <div class="flex flex-wrap gap-3 mb-8">
                    <a href="{{ route('pricing') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white font-bold px-7 py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-xl hover:scale-105">
                        <i data-lucide="rocket" class="w-4 h-4"></i>
                        <span>Mulai Sekarang</span>
                    </a>
                    <a href="{{ route('features') }}" class="inline-flex items-center gap-2 bg-transparent border-2 border-gray-900 text-gray-900 font-bold px-7 py-3 rounded-lg hover:bg-gray-900 hover:text-white transition-all duration-300">
                        <i data-lucide="play-circle" class="w-4 h-4"></i>
                        <span>Lihat Fitur</span>
                    </a>
                </div>
            </div>

            {{-- Right Image --}}
            <div class="hero-animate-delay-1 relative hidden lg:flex items-center justify-end pr-8">
                {{-- Hero Image --}}
                <img src="{{ asset('img/hero_img.svg') }}" alt="Hosting Illustration" class="w-full max-w-sm h-auto animate-float drop-shadow-xl">
                
                {{-- Decorative blur --}}
                <div class="absolute top-0 right-0 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl -z-10"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl -z-10"></div>
            </div>
        </div>
    </div>
</section>
