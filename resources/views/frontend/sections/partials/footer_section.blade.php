{{-- Footer --}}
<footer class="bg-white border-t border-gray-200">
    <div class="container mx-auto max-w-7xl px-8 lg:px-20 py-20">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
            <div class="space-y-5">
                <a href="{{ route('home') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity duration-300 w-fit">
                    <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="Hoci" class="h-10 w-auto">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent" style="font-family: 'Source Sans Pro', sans-serif;">Hoci</span>
                </a>
                <p class="text-base leading-relaxed text-gray-600">Solusi hosting terpercaya untuk bisnis Anda dengan teknologi terdepan dan support terbaik.</p>
                <!-- Social Media
                 <div class="flex gap-4 pt-2">
                    <a href="#" class="w-12 h-12 bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                        <i data-lucide="linkedin" class="w-5 h-5"></i>
                    </a>
                </div> -->
            </div>
            
            <div>
                <h4 class="text-gray-900 font-bold mb-6 text-lg">Produk</h4>
                <ul class="space-y-3 text-base">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Web Hosting
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>VPS Hosting
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Cloud Hosting
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Domain
                    </a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-gray-900 font-bold mb-6 text-lg">Perusahaan</h4>
                <ul class="space-y-3 text-base">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Tentang Kami
                    </a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Blog
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Karir
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Kontak
                    </a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-gray-900 font-bold mb-6 text-lg">Support</h4>
                <ul class="space-y-3 text-base">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Knowledge Base
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Tutorial
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>FAQ
                    </a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-blue-500"></i>Status Server
                    </a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-base text-gray-600">&copy; {{ date('Y') }} Hoci. Semua hak dilindungi undang-undang.</p>
            <div class="flex gap-8 text-base">
                <a href="{{ route('privacy-policy') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="{{ route('terms-and-conditions') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating animation style -->
<style>
    @keyframes float {
        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-6px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>

<!-- Chat Button -->
<div id="chatButton" class="fixed bottom-8 right-8 z-50 transition-all duration-300">
    <button onclick="openChatModal()"
        class="group flex items-center bg-gray-900 text-white rounded-full shadow-2xl hover:bg-blue-600 transition duration-300 overflow-hidden relative animate-float">
        <!-- Glow ring -->
        <div
            class="absolute inset-0 rounded-full bg-blue-600/40 blur-xl opacity-0 group-hover:opacity-100 transition duration-500">
        </div>

        <!-- Mobile: hanya icon -->
        <div class="w-14 h-14 flex items-center justify-center md:hidden relative z-10">
            <img src="https://img.icons8.com/?size=100&id=Z1n6MSkfdSgd&format=png&color=ffffff" alt="Chat Icon"
                class="w-7 h-7 animate-pulse" />
        </div>

        <!-- Desktop: icon + text -->
        <div class="hidden md:flex items-center px-4 py-3 gap-3 relative z-10">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center animate-pulse">
                <img src="https://img.icons8.com/?size=100&id=Z1n6MSkfdSgd&format=png&color=ffffff" alt="Chat Icon"
                    class="w-6 h-6" />
            </div>
            <div class="pr-2 text-left">
                <div class="text-sm font-semibold group-hover:text-white transition">Chat with us</div>
                <div class="text-[10px] opacity-80 group-hover:opacity-100 transition">We're here to help</div>
            </div>
        </div>

        <!-- Pulse effect -->
        <span class="absolute inset-0 rounded-full bg-white/20 animate-ping opacity-10"></span>
    </button>
</div>

<!-- Include Chat Modal -->
@include('frontend.sections.partials.modal_chat_bot')
@include('frontend.sections.partials.modalinformasitextkosong')
