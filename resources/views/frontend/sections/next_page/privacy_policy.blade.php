<!-- Navbar -->
@include('frontend.sections.partials.navbar_section')

{{-- Privacy Policy Section --}}
<section id="privacy-policy" class="bg-white relative">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>

    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white py-16 mt-20 relative z-10">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="max-w-3xl">
                <h1 class="text-5xl font-bold mb-4">Kebijakan Privasi</h1>
                <p class="text-blue-100 text-lg mb-6">
                    Komitmen kami dalam melindungi privasi dan data pribadi Anda
                </p>
            </div>
        </div>
    </div>

    <!-- Table of Contents -->
    <div class="bg-gray-50 border-b border-gray-200 relative z-10">
        <div class="container mx-auto px-6 py-8 max-w-6xl">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-4">Daftar Isi</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                <a href="javascript:void(0)" onclick="scrollToSection('1'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">1. Informasi yang Kami Kumpulkan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('2'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">2. Penggunaan Informasi</a>
                <a href="javascript:void(0)" onclick="scrollToSection('3'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">3. Berbagi Informasi</a>
                <a href="javascript:void(0)" onclick="scrollToSection('4'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">4. Keamanan Data</a>
                <a href="javascript:void(0)" onclick="scrollToSection('5'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">5. Cookie & Pelacakan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('6'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">6. Retensi Data</a>
                <a href="javascript:void(0)" onclick="scrollToSection('7'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">7. Hak Pengguna</a>
                <a href="javascript:void(0)" onclick="scrollToSection('8'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">8. Privasi Anak-anak</a>
                <a href="javascript:void(0)" onclick="scrollToSection('9'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">9. Transfer Internasional</a>
                <a href="javascript:void(0)" onclick="scrollToSection('10'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">10. Perubahan Kebijakan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('11'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">11. Hubungi Kami</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12 max-w-6xl relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Content -->
            <div class="lg:col-span-3">
                <!-- Introduction -->
                <section class="mb-12">
                    <div class="prose prose-blue max-w-none">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Selamat datang di Premium Hosting Service. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan melindungi informasi pribadi Anda. Dengan menggunakan layanan kami, Anda menyetujui praktik yang dijelaskan dalam kebijakan ini.
                        </p>
                    </div>
                </section>

                <!-- Section 1 -->
                <section data-section="1" class="mb-12 scroll-mt-24">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">01</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Informasi yang Kami Kumpulkan</h2>
                    </div>
                    <div class="space-y-6 pl-16">
                        <div class="bg-white border border-gray-200 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                <i data-lucide="user" class="w-5 h-5 text-blue-600"></i>
                                Informasi Pribadi
                            </h3>
                            <p class="text-gray-700 mb-3">Kami mengumpulkan informasi pribadi yang Anda berikan secara langsung, termasuk:</p>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Nama lengkap
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Alamat email
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Nomor telepon
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Alamat fisik/penagihan
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Informasi pembayaran
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Informasi domain
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                <i data-lucide="monitor" class="w-5 h-5 text-blue-600"></i>
                                Informasi Teknis
                            </h3>
                            <p class="text-gray-700 mb-3">Kami secara otomatis mengumpulkan informasi teknis, seperti:</p>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Alamat IP
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Jenis & versi browser
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Sistem operasi
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Data log server
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Cookie & pelacakan
                                </li>
                                <li class="flex items-center text-gray-700 text-sm">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Informasi penggunaan
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Section 2 -->
                <section data-section="2" class="mb-12 scroll-mt-24">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">02</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Penggunaan Informasi</h2>
                    </div>
                    <div class="pl-16">
                        <p class="text-gray-700 mb-4">Kami menggunakan informasi yang dikumpulkan untuk tujuan berikut:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Penyediaan Layanan</h4>
                                        <p class="text-gray-600 text-xs">Menyediakan, mengoperasikan, dan memelihara layanan hosting</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="credit-card" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Pemrosesan Pembayaran</h4>
                                        <p class="text-gray-600 text-xs">Memproses transaksi dan mengelola akun Anda</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="bell" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Notifikasi Penting</h4>
                                        <p class="text-gray-600 text-xs">Mengirim update teknis dan peringatan keamanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="headphones" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Dukungan Pelanggan</h4>
                                        <p class="text-gray-600 text-xs">Menanggapi pertanyaan dan permintaan bantuan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="bar-chart" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Analisis & Peningkatan</h4>
                                        <p class="text-gray-600 text-xs">Memantau dan meningkatkan kualitas layanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="shield" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Keamanan</h4>
                                        <p class="text-gray-600 text-xs">Mendeteksi dan mencegah masalah keamanan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <!-- Section 3 -->
            <section data-section="3" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">03</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Berbagi Informasi</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Kami tidak menjual atau menyewakan informasi pribadi Anda. Kami dapat membagikan informasi Anda dalam situasi berikut:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li><strong>Penyedia Layanan Pihak Ketiga:</strong> Kami dapat berbagi informasi dengan vendor dan penyedia layanan yang membantu kami mengoperasikan bisnis (gateway pembayaran, penyedia infrastruktur, layanan email)</li>
                        <li><strong>Registrar Domain:</strong> Informasi kontak untuk pendaftaran domain dibagikan dengan registrar domain sesuai kebijakan ICANN/WHOIS</li>
                        <li><strong>Kepatuhan Hukum:</strong> Ketika diwajibkan oleh hukum atau perintah pengadilan</li>
                        <li><strong>Perlindungan Hak:</strong> Untuk melindungi hak, properti, atau keamanan kami dan pengguna lainnya</li>
                        <li><strong>Transaksi Bisnis:</strong> Dalam hal merger, akuisisi, atau penjualan aset</li>
                        <li><strong>Dengan Persetujuan Anda:</strong> Ketika Anda memberikan izin eksplisit</li>
                    </ul>
                </div>
            </section>

            <!-- Section 4 -->
            <section data-section="4" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">04</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Keamanan Data</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi Anda, termasuk:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li>Enkripsi SSL/TLS untuk transmisi data</li>
                        <li>Firewall dan sistem deteksi intrusi</li>
                        <li>Kontrol akses berbasis peran</li>
                        <li>Backup data secara berkala</li>
                        <li>Pemantauan keamanan 24/7</li>
                        <li>Pelatihan keamanan untuk karyawan</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Meskipun kami berusaha melindungi data Anda, tidak ada metode transmisi melalui internet atau penyimpanan elektronik yang 100% aman. Kami tidak dapat menjamin keamanan absolut.
                    </p>
                </div>
            </section>

            <!-- Section 5 -->
            <section data-section="5" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">05</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Cookie dan Teknologi Pelacakan</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Kami menggunakan cookie dan teknologi pelacakan serupa untuk:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li>Mengingat preferensi dan pengaturan Anda</li>
                        <li>Memahami bagaimana Anda menggunakan layanan kami</li>
                        <li>Meningkatkan keamanan akun</li>
                        <li>Menyediakan konten yang dipersonalisasi</li>
                        <li>Menganalisis kinerja layanan</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Anda dapat mengatur browser Anda untuk menolak semua atau beberapa cookie. Namun, beberapa fitur layanan kami mungkin tidak berfungsi dengan baik tanpa cookie.
                    </p>
                </div>
            </section>

            <!-- Section 6 -->
            <section data-section="6" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">06</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Retensi Data</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed">
                        Kami menyimpan informasi pribadi Anda selama akun Anda aktif atau selama diperlukan untuk menyediakan layanan. Kami juga menyimpan dan menggunakan informasi Anda untuk mematuhi kewajiban hukum, menyelesaikan perselisihan, dan menegakkan perjanjian kami. Setelah periode retensi berakhir atau permintaan penghapusan disetujui, kami akan menghapus atau menganonimkan informasi Anda secara aman.
                    </p>
                </div>
            </section>

            <!-- Section 7 -->
            <section data-section="7" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">07</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Hak Pengguna</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Anda memiliki hak untuk:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li><strong>Akses:</strong> Meminta salinan informasi pribadi yang kami simpan tentang Anda</li>
                        <li><strong>Koreksi:</strong> Memperbarui atau memperbaiki informasi yang tidak akurat</li>
                        <li><strong>Penghapusan:</strong> Meminta penghapusan informasi pribadi Anda (dengan batasan tertentu)</li>
                        <li><strong>Pembatasan:</strong> Membatasi pemrosesan informasi Anda</li>
                        <li><strong>Portabilitas:</strong> Menerima data Anda dalam format yang dapat dibaca mesin</li>
                        <li><strong>Keberatan:</strong> Menolak pemrosesan data untuk tujuan tertentu</li>
                        <li><strong>Penarikan Persetujuan:</strong> Menarik persetujuan kapan saja untuk pemrosesan berdasarkan persetujuan</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Untuk menggunakan hak-hak ini, silakan hubungi kami melalui informasi kontak yang tersedia di bawah.
                    </p>
                </div>
            </section>

            <!-- Section 8 -->
            <section data-section="8" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">08</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Privasi Anak-anak</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed">
                        Layanan kami tidak ditujukan untuk anak-anak di bawah usia 18 tahun. Kami tidak dengan sengaja mengumpulkan informasi pribadi dari anak-anak di bawah 18 tahun. Jika Anda mengetahui bahwa seorang anak telah memberikan informasi pribadi kepada kami, silakan hubungi kami dan kami akan mengambil langkah untuk menghapus informasi tersebut.
                    </p>
                </div>
            </section>

            <!-- Section 9 -->
            <section data-section="9" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">09</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Transfer Data Internasional</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed">
                        Informasi Anda dapat ditransfer ke dan dipelihara di komputer yang berlokasi di luar negara atau yurisdiksi Anda, di mana undang-undang perlindungan data mungkin berbeda. Dengan menggunakan layanan kami, Anda menyetujui transfer tersebut. Kami akan mengambil langkah-langkah yang wajar untuk memastikan bahwa data Anda diperlakukan dengan aman sesuai dengan Kebijakan Privasi ini.
                    </p>
                </div>
            </section>

            <!-- Section 10 -->
            <section data-section="10" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">10</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Perubahan Kebijakan Privasi</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed">
                        Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan dengan memposting kebijakan baru di halaman ini dan memperbarui tanggal "Terakhir diperbarui" di bagian atas. Untuk perubahan material, kami akan memberikan pemberitahuan yang lebih menonjol (termasuk melalui email). Anda disarankan untuk meninjau Kebijakan Privasi ini secara berkala untuk setiap perubahan.
                    </p>
                </div>
            </section>

            <!-- Section 11 -->
            <section data-section="11" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">11</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Hubungi Kami</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Jika Anda memiliki pertanyaan atau kekhawatiran tentang Kebijakan Privasi ini atau praktik privasi kami, silakan hubungi kami melalui:
                    </p>
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i data-lucide="mail" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Email</p>
                                    <a href="mailto:privacy@hostingservice.com" class="text-blue-600 hover:underline text-sm">privacy@hostingservice.com</a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-lucide="phone" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Telepon</p>
                                    <a href="tel:+628001234567" class="text-blue-600 hover:underline text-sm">+62 800-123-4567</a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-lucide="map-pin" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Alamat</p>
                                    <p class="text-gray-700 text-sm">Jl. Hosting Raya No. 123<br>Jakarta 12345, Indonesia</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-lucide="clock" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Jam Operasional</p>
                                    <p class="text-gray-700 text-sm">Senin - Jumat: 09:00 - 18:00 WIB<br>Sabtu - Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Acceptance -->
            <section class="mt-10 pt-8 border-t border-gray-200">
                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-600">
                    <p class="text-gray-700 leading-relaxed">
                        <strong class="text-gray-900">Dengan menggunakan layanan kami, Anda mengakui bahwa Anda telah membaca dan memahami Kebijakan Privasi ini dan menyetujui pengumpulan, penggunaan, dan pengungkapan informasi Anda sebagaimana dijelaskan di sini.</strong>
                    </p>
                </div>
            </section>
        </div>
    </div>
</section>

<!-- Footer -->
@include('frontend.sections.partials.footer_section')

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
    
    // Smooth scroll function without changing URL
    function scrollToSection(sectionNum) {
        const element = document.querySelector('[data-section="' + sectionNum + '"]');
        if (element) {
            const offset = 96;
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }
</script>