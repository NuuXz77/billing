{{-- Navbar --}}
<nav class="fixed top-0 left-0 right-0 flex justify-between items-center py-4 px-8 lg:px-20 bg-white shadow-sm z-50 border-b border-gray-200">
    <a href="{{ route('home') }}" class="flex items-center gap-3 hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="Hoci Logo" class="h-10 w-auto">
        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Hoci</span>
    </a>

    <ul class="hidden md:flex gap-8 text-gray-600 font-medium">
        <li><a href="{{ route('home') }}" class="nav-link relative hover:text-blue-600 transition-colors duration-300 py-2 group">
            Home
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
        </a></li>
        <li><a href="{{ route('features') }}" class="nav-link relative hover:text-blue-600 transition-colors duration-300 py-2 group">
            Fitur
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
        </a></li>
        <li><a href="{{ route('pricing') }}" class="nav-link relative hover:text-blue-600 transition-colors duration-300 py-2 group">
            Product
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
        </a></li>
    </ul>

    <a href="{{ route('login') }}" class="hidden md:inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 hover:shadow-lg hover:scale-105 transition-all duration-300 shadow-md">
        <i data-lucide="user-plus" class="w-4 h-4"></i>
        <span>Masuk</span>
    </a>

    <button class="md:hidden text-3xl text-blue-600 hover:text-blue-700 hover:scale-110 transition-all duration-300" id="mobile-menu-btn">
        <i data-lucide="menu" class="w-8 h-8"></i>
    </button>
</nav>

{{-- Scroll Spy Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        function activateNavLink() {
            let current = '';
            
            // Detect current section by scroll position
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                if (window.scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            // Update URL without page reload
            if (current) {
                const newUrl = '/' + current;
                if (window.location.pathname !== newUrl) {
                    window.history.pushState({section: current}, '', newUrl);
                }
            }

            navLinks.forEach(link => {
                link.classList.remove('active');
                link.querySelector('span').classList.remove('!w-full');
                
                // Get section name from current scroll position
                const href = link.getAttribute('href');
                const sectionName = href.split('/').pop() || 'home';
                
                if (sectionName === current) {
                    link.classList.add('active');
                    link.querySelector('span').classList.add('!w-full');
                }
            });
        }

        window.addEventListener('scroll', activateNavLink);
        activateNavLink(); // Run on page load
    });
</script>

<style>
    .nav-link.active {
        color: #2563eb; /* text-blue-600 */
        font-weight: 600;
    }
</style>
