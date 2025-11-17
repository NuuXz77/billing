<!-- Navbar -->
@include('frontend.sections.partials.navbar_section')

{{-- Terms and Conditions Section --}}
<section id="terms-and-conditions" class="bg-white relative">
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
                <h1 class="text-5xl font-bold mb-4">Syarat dan Ketentuan</h1>
                <p class="text-blue-100 text-lg mb-6">
                    Ketentuan penggunaan layanan hosting kami yang harus Anda pahami dan setujui
                </p>
            </div>
        </div>
    </div>

    <!-- Table of Contents -->
    <div class="bg-gray-50 border-b border-gray-200 relative z-10">
        <div class="container mx-auto px-6 py-8 max-w-6xl">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-4">Daftar Isi</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                <a href="javascript:void(0)" onclick="scrollToSection('1'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">1. Penerimaan Ketentuan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('2'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">2. Layanan Hosting</a>
                <a href="javascript:void(0)" onclick="scrollToSection('3'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">3. Akun Pengguna</a>
                <a href="javascript:void(0)" onclick="scrollToSection('4'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">4. Pembayaran & Tagihan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('5'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">5. Kebijakan Penggunaan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('6'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">6. Uptime & SLA</a>
                <a href="javascript:void(0)" onclick="scrollToSection('7'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">7. Backup & Keamanan</a>
                <a href="javascript:void(0)" onclick="scrollToSection('8'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">8. Pembatasan Tanggung Jawab</a>
                <a href="javascript:void(0)" onclick="scrollToSection('9'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">9. Penangguhan & Penghentian</a>
                <a href="javascript:void(0)" onclick="scrollToSection('10'); return false;" class="text-sm text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">10. Perubahan Ketentuan</a>
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
                            Selamat datang di Premium Hosting Service. Syarat dan Ketentuan ini mengatur penggunaan layanan hosting kami. Dengan mendaftar dan menggunakan layanan kami, Anda menyetujui untuk terikat dengan semua ketentuan yang tercantum dalam dokumen ini. Harap membaca dengan seksama sebelum menggunakan layanan kami.
                        </p>
                    </div>
                </section>

                <!-- Section 1 -->
                <section data-section="1" class="mb-12 scroll-mt-24">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">01</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Penerimaan Ketentuan</h2>
                    </div>
                    <div class="pl-16">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Dengan mengakses atau menggunakan layanan hosting kami, Anda menyatakan bahwa:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                            <li>Anda telah membaca, memahami, dan menyetujui semua ketentuan dalam dokumen ini</li>
                            <li>Anda berusia minimal 18 tahun atau telah mencapai usia dewasa menurut hukum yang berlaku</li>
                            <li>Anda memiliki kewenangan hukum untuk mengikatkan diri dalam perjanjian ini</li>
                            <li>Informasi yang Anda berikan adalah akurat, lengkap, dan terkini</li>
                            <li>Anda akan mematuhi semua hukum dan peraturan yang berlaku saat menggunakan layanan kami</li>
                        </ul>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-4">
                            <p class="text-sm text-yellow-800">
                                <strong>Penting:</strong> Jika Anda tidak setuju dengan syarat dan ketentuan ini, harap jangan menggunakan layanan kami.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Section 2 -->
                <section data-section="2" class="mb-12 scroll-mt-24">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">02</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Layanan Hosting</h2>
                    </div>
                    <div class="pl-16">
                        <p class="text-gray-700 mb-4">Kami menyediakan berbagai paket layanan hosting dengan spesifikasi berikut:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="server" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Shared Hosting</h4>
                                        <p class="text-gray-600 text-xs">Server bersama dengan resource yang dibagi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="hard-drive" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">VPS Hosting</h4>
                                        <p class="text-gray-600 text-xs">Virtual Private Server dengan resource dedicated</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="cloud" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Cloud Hosting</h4>
                                        <p class="text-gray-600 text-xs">Hosting berbasis cloud dengan skalabilitas tinggi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i data-lucide="database" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Dedicated Server</h4>
                                        <p class="text-gray-600 text-xs">Server fisik khusus untuk kebutuhan enterprise</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-700 text-sm leading-relaxed">
                                Setiap paket memiliki batasan resource (disk space, bandwidth, CPU, RAM) yang tercantum dalam deskripsi paket. Kami berhak untuk memodifikasi, meningkatkan, atau menghentikan fitur layanan kapan saja dengan pemberitahuan sebelumnya.
                            </p>
                        </div>
                    </div>
                </section>

            <!-- Section 3 -->
            <section data-section="3" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">03</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Akun Pengguna</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Sebagai pengguna layanan, Anda bertanggung jawab untuk:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li><strong>Keamanan Akun:</strong> Menjaga kerahasiaan username dan password Anda</li>
                        <li><strong>Informasi Akurat:</strong> Memberikan dan memperbarui informasi kontak yang valid</li>
                        <li><strong>Aktivitas Akun:</strong> Semua aktivitas yang terjadi melalui akun Anda</li>
                        <li><strong>Pemberitahuan:</strong> Segera melaporkan penggunaan akun yang tidak sah</li>
                        <li><strong>Satu Akun:</strong> Dilarang membuat akun ganda untuk menghindari pembayaran</li>
                        <li><strong>Verifikasi:</strong> Kami berhak meminta dokumen identitas untuk verifikasi</li>
                    </ul>
                </div>
            </section>

            <!-- Section 4 -->
            <section data-section="4" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">04</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Pembayaran dan Tagihan</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Ketentuan pembayaran layanan:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li>Pembayaran dilakukan di muka untuk periode langganan (bulanan, tahunan, atau sesuai paket)</li>
                        <li>Perpanjangan otomatis akan dilakukan kecuali Anda membatalkan sebelum tanggal perpanjangan</li>
                        <li>Harga dapat berubah dengan pemberitahuan minimal 30 hari sebelumnya</li>
                        <li>Pembayaran yang terlambat dapat mengakibatkan penangguhan layanan</li>
                        <li>Tidak ada pengembalian dana untuk pembatalan di tengah periode langganan</li>
                        <li>Garansi uang kembali 30 hari berlaku untuk pelanggan baru (paket tertentu)</li>
                        <li>Biaya setup (jika ada) tidak dapat dikembalikan</li>
                        <li>Pajak yang berlaku akan ditambahkan sesuai regulasi lokal</li>
                    </ul>
                </div>
            </section>

            <!-- Section 5 -->
            <section data-section="5" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">05</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Kebijakan Penggunaan yang Dapat Diterima</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">Anda DILARANG menggunakan layanan untuk:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li><strong>Konten Ilegal:</strong> Menyimpan atau mendistribusikan konten yang melanggar hukum</li>
                        <li><strong>Spam & Phishing:</strong> Mengirim email spam atau melakukan phishing</li>
                        <li><strong>Malware:</strong> Hosting virus, trojan, atau malware lainnya</li>
                        <li><strong>Hacking:</strong> Mencoba mengakses sistem tanpa otorisasi</li>
                        <li><strong>Overload:</strong> Penggunaan CPU/RAM berlebihan yang mengganggu pengguna lain</li>
                        <li><strong>Pornografi:</strong> Konten dewasa atau pornografi (khusus shared hosting)</li>
                        <li><strong>Pelanggaran Hak Cipta:</strong> File bajakan atau konten yang melanggar hak cipta</li>
                        <li><strong>File Sharing Ilegal:</strong> Torrent atau file sharing tanpa izin</li>
                    </ul>
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mt-4">
                        <p class="text-sm text-red-800">
                            <strong>Peringatan:</strong> Pelanggaran kebijakan ini dapat mengakibatkan penangguhan atau penghentian akun tanpa pemberitahuan.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Section 6 -->
            <section data-section="6" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">06</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Uptime dan SLA (Service Level Agreement)</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Kami berkomitmen untuk menyediakan uptime 99.9% untuk layanan hosting. Namun, uptime guarantee tidak berlaku untuk:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li>Pemeliharaan terjadwal yang diumumkan minimal 48 jam sebelumnya</li>
                        <li>Masalah yang disebabkan oleh konten atau skrip Anda</li>
                        <li>Serangan DDoS atau force majeure (bencana alam, perang, dll)</li>
                        <li>Penangguhan layanan karena pelanggaran ketentuan</li>
                        <li>Masalah di luar kontrol kami (ISP, infrastruktur internet global)</li>
                    </ul>
                    <div class="bg-blue-50 rounded-lg p-4 mt-4">
                        <p class="text-sm text-blue-900">
                            <strong>Kompensasi SLA:</strong> Jika uptime di bawah 99.9%, Anda berhak atas kredit layanan proporsional.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Section 7 -->
            <section data-section="7" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">07</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Backup dan Keamanan Data</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Meskipun kami melakukan backup rutin server, <strong>Anda tetap bertanggung jawab</strong> untuk membuat backup data Anda sendiri. Ketentuan backup:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li>Backup otomatis server dilakukan untuk disaster recovery, bukan untuk restore file individual</li>
                        <li>Kami tidak menjamin ketersediaan atau kelengkapan backup</li>
                        <li>Restore dari backup dapat dikenakan biaya tambahan</li>
                        <li>Anda disarankan menggunakan layanan backup pribadi atau plugin backup</li>
                        <li>Kami tidak bertanggung jawab atas kehilangan data akibat kelalaian Anda</li>
                        <li>Layanan backup premium tersedia dengan biaya tambahan</li>
                    </ul>
                </div>
            </section>

            <!-- Section 8 -->
            <section data-section="8" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">08</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Pembatasan Tanggung Jawab</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Dalam batas maksimum yang diizinkan oleh hukum, kami TIDAK bertanggung jawab atas:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li>Kehilangan data, profit, atau pendapatan akibat penggunaan layanan</li>
                        <li>Kerusakan tidak langsung, insidental, atau konsekuensial</li>
                        <li>Konten yang Anda upload atau publish melalui layanan</li>
                        <li>Pelanggaran hukum yang dilakukan oleh pengguna</li>
                        <li>Kerentanan keamanan pada skrip atau aplikasi pihak ketiga</li>
                        <li>Gangguan layanan di luar kontrol kami</li>
                    </ul>
                    <div class="bg-gray-100 rounded-lg p-4 mt-4">
                        <p class="text-sm text-gray-800">
                            <strong>Total tanggung jawab kami</strong> terbatas pada jumlah yang telah Anda bayarkan untuk layanan dalam 12 bulan terakhir.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Section 9 -->
            <section data-section="9" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">09</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Penangguhan dan Penghentian Layanan</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Kami berhak menangguhkan atau menghentikan layanan Anda dalam kondisi berikut:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                        <li><strong>Pembayaran Tertunggak:</strong> Keterlambatan pembayaran lebih dari 7 hari</li>
                        <li><strong>Pelanggaran TOS:</strong> Melanggar syarat dan ketentuan layanan</li>
                        <li><strong>Aktivitas Mencurigakan:</strong> Terdeteksi aktivitas malware atau hacking</li>
                        <li><strong>Overload Server:</strong> Penggunaan resource berlebihan yang mengganggu pengguna lain</li>
                        <li><strong>Spam Complaint:</strong> Laporan spam dari ISP atau pihak ketiga</li>
                        <li><strong>Permintaan Hukum:</strong> Perintah dari pihak berwenang</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Anda dapat membatalkan layanan kapan saja melalui panel kontrol. Pembatalan akan berlaku di akhir periode billing berjalan.
                    </p>
                </div>
            </section>

            <!-- Section 10 -->
            <section data-section="10" class="mb-12 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">10</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Perubahan Syarat dan Ketentuan</h2>
                </div>
                <div class="pl-16">
                    <p class="text-gray-700 leading-relaxed">
                        Kami berhak mengubah Syarat dan Ketentuan ini kapan saja. Perubahan material akan diberitahukan melalui email atau notifikasi di panel kontrol minimal 30 hari sebelum berlaku. Dengan terus menggunakan layanan setelah perubahan berlaku, Anda dianggap menyetujui ketentuan yang diperbarui. Jika Anda tidak setuju dengan perubahan, Anda dapat membatalkan layanan sebelum tanggal efektif perubahan.
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
                        Jika Anda memiliki pertanyaan atau kekhawatiran tentang Syarat dan Ketentuan ini, silakan hubungi kami melalui:
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
                        <strong class="text-gray-900">Dengan mendaftar dan menggunakan layanan kami, Anda mengakui bahwa Anda telah membaca, memahami, dan menyetujui semua Syarat dan Ketentuan yang tercantum dalam dokumen ini. Perjanjian ini mengikat secara hukum antara Anda dan Premium Hosting Service.</strong>
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