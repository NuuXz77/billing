{{-- resources/views/landing.blade.php --}}
<x-layouts.guest>
    {{-- Tambahkan CDN Lucide Icons --}}
    @push('styles')
    <style>
        /* Custom icon styles untuk kompatibilitas */
        .icon { display: inline-block; width: 1em; height: 1em; vertical-align: -0.125em; }
        
        /* Scroll animations */
        section {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        section.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Privacy, Terms & Cart: Override to show immediately */
        section#privacy-policy,
        section#terms-and-conditions,
        section#cart {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        
        .animate-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        
        .animate-card.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Stagger animation for cards */
        .animate-card:nth-child(1) { transition-delay: 0.1s; }
        .animate-card:nth-child(2) { transition-delay: 0.2s; }
        .animate-card:nth-child(3) { transition-delay: 0.3s; }
        .animate-card:nth-child(4) { transition-delay: 0.4s; }
        .animate-card:nth-child(5) { transition-delay: 0.5s; }
        .animate-card:nth-child(6) { transition-delay: 0.6s; }
        
        /* Hero animation on page load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-animate {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .hero-animate-delay-1 {
            animation: fadeInUp 0.8s ease-out 0.2s forwards;
            opacity: 0;
        }
        
        .hero-animate-delay-2 {
            animation: fadeInUp 0.8s ease-out 0.4s forwards;
            opacity: 0;
        }
        
        /* Float animation for chat button */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
    @endpush
    
    @push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
        
        // Function to open chat modal
        function openChatModal() {
            const chatModal = document.getElementById('chatbotModal');
            const chatButton = document.getElementById('chatButton');
            if (chatModal && chatButton) {
                chatModal.classList.remove('hidden');
                chatButton.classList.add('hidden');
            }
        }
        
        // Intersection Observer for scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const animateOnScroll = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe all sections and cards
            document.querySelectorAll('section, .animate-card').forEach(el => {
                // Skip observing Privacy Policy, Terms and Cart sections
                if (el.id === 'privacy-policy' || el.id === 'terms-and-conditions' || el.id === 'cart') {
                    // Force show these sections immediately
                    el.classList.add('show');
                    return;
                }
                animateOnScroll.observe(el);
            });

            // Auto-scroll to section if scrollTo parameter exists
            @if(isset($scrollTo) && $scrollTo)
                setTimeout(() => {
                    const targetSection = document.getElementById('{{ $scrollTo }}');
                    if (targetSection) {
                        targetSection.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 300); // Small delay to ensure page is fully loaded
            @endif
        });
    </script>
    @endpush

    <div class="bg-gray-50 text-gray-800">
        {{-- Include All Sections --}}
        @if(isset($showCart) && $showCart)
            {{-- Show Cart Page (without navbar) --}}
            @include('frontend.sections.next_page.cart_section')
            @include('frontend.sections.partials.footer_section')
        @elseif(isset($showPrivacyPolicy) && $showPrivacyPolicy)
            {{-- Show Privacy Policy Page (with navbar and footer) --}}
            @include('frontend.sections.next_page.privacy_policy')
        @elseif(isset($showTermsAndConditions) && $showTermsAndConditions)
            {{-- Show Terms and Conditions Page (with navbar and footer) --}}
            @include('frontend.sections.next_page.terms_and_conditions')
        @else
            {{-- Show Landing Page --}}
            @include('frontend.sections.partials.navbar_section')
            @include('frontend.sections.hero_section')
            <!--
            @include('frontend.sections.trusted_by_section')
            -->
            @include('frontend.sections.features_section')
            @include('frontend.sections.pricing_section')
            @include('frontend.sections.testimonials_section')
            <!--
            @include('frontend.sections.faq_section')
            -->
            @include('frontend.sections.cta_section')
            @include('frontend.sections.partials.footer_section')
        @endif
    </div>
</x-layouts.guest>
