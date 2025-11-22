<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Informasi Akun Server</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            margin-bottom: 25px;
        }
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .info-card h3 {
            margin: 0 0 15px 0;
            color: #2d3748;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .info-card h3:before {
            content: "🔗";
            margin-right: 8px;
        }
        .server-info h3:before {
            content: "🖥️";
        }
        .credentials-info h3:before {
            content: "🔐";
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        .info-item {
            background: white;
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #667eea;
        }
        .info-item label {
            font-weight: 600;
            color: #4a5568;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 5px;
        }
        .info-item .value {
            font-size: 16px;
            color: #2d3748;
            font-weight: 500;
            word-break: break-all;
        }
        .credentials .value {
            font-family: 'Courier New', monospace;
            background: #f7fafc;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }
        .link-button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 8px 8px 8px 0;
            transition: background-color 0.3s;
        }
        .link-button:hover {
            background: #5a67d8;
        }
        .link-button.server {
            background: #48bb78;
        }
        .link-button.server:hover {
            background: #38a169;
        }
        .warning {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            color: #c53030;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .warning strong {
            display: block;
            margin-bottom: 5px;
        }
        .additional-message {
            background: #edf2f7;
            border-left: 4px solid #4299e1;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .footer {
            background: #2d3748;
            color: #cbd5e0;
            padding: 25px;
            text-align: center;
            font-size: 14px;
        }
        .footer p {
            margin: 5px 0;
        }
        .transaction-info {
            background: #e6fffa;
            border: 1px solid #81e6d9;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .container {
                padding: 10px;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-wrapper">
            {{-- Header --}}
            <div class="header">
                <h1>🚀 Akun Server Anda Siap!</h1>
                <p>Informasi akses lengkap untuk layanan hosting Anda</p>
            </div>

            {{-- Content --}}
            <div class="content">
                <div class="greeting">
                    <h2>Halo, {{ $transaction->user->full_name }}!</h2>
                    <p>Selamat! Transaksi Anda telah disetujui dan akun server Anda telah berhasil dibuat. Berikut adalah informasi lengkap untuk mengakses layanan hosting Anda.</p>
                </div>

                {{-- Transaction Info --}}
                <div class="transaction-info">
                    <h3 style="margin: 0 0 10px 0; color: #234e52;">📄 Informasi Transaksi</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 14px;">
                        <div><strong>Kode Transaksi:</strong> {{ $transaction->transaction_code }}</div>
                        <div><strong>Produk:</strong> {{ $transaction->product->name_product }}</div>
                        <div><strong>Tanggal Aktif:</strong> {{ \Carbon\Carbon::parse($transaction->start_date)->format('d F Y') }}</div>
                        <div><strong>Berlaku Sampai:</strong> {{ \Carbon\Carbon::parse($transaction->end_date)->format('d F Y') }}</div>
                    </div>
                </div>

                {{-- Subdomain Information --}}
                <div class="info-card">
                    <h3>Informasi Subdomain Anda</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Website (Tampilan)</label>
                            <div class="value">{{ $transaction->subdomain_web }}</div>
                            <div style="margin-top: 10px;">
                                <a href="https://{{ $transaction->subdomain_web }}" class="link-button" target="_blank">
                                    🌐 Buka Website
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Server Management</label>
                            <div class="value">{{ $transaction->subdomain_server }}</div>
                            <div style="margin-top: 10px;">
                                <a href="https://{{ $transaction->subdomain_server }}" class="link-button server" target="_blank">
                                    ⚙️ Akses Server
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Login Credentials --}}
                <div class="info-card credentials-info">
                    <h3>Kredensial Login Server</h3>
                    <div class="info-grid">
                        <div class="info-item credentials">
                            <label>Username</label>
                            <div class="value">{{ $serverUsername }}</div>
                        </div>
                        <div class="info-item credentials">
                            <label>Password</label>
                            <div class="value">{{ $serverPassword }}</div>
                        </div>
                    </div>
                </div>

                {{-- Security Warning --}}
                <div class="warning">
                    <strong>⚠️ Penting untuk Keamanan:</strong>
                    <ul style="margin: 10px 0 0 20px; padding: 0;">
                        <li>Jangan bagikan informasi login ini kepada siapa pun</li>
                        <li>Segera ganti password setelah login pertama kali</li>
                        <li>Gunakan password yang kuat dan unik</li>
                        <li>Aktifkan autentikasi dua faktor jika tersedia</li>
                    </ul>
                </div>

                {{-- Additional Message --}}
                @if($additionalMessage)
                <div class="additional-message">
                    <h4 style="margin: 0 0 10px 0; color: #2b6cb0;">💬 Pesan Khusus dari Admin:</h4>
                    <p style="margin: 0; white-space: pre-line;">{{ $additionalMessage }}</p>
                </div>
                @endif

                {{-- Admin Notes --}}
                @if($adminNotes)
                <div class="additional-message">
                    <h4 style="margin: 0 0 10px 0; color: #2b6cb0;">📝 Catatan Admin:</h4>
                    <p style="margin: 0; white-space: pre-line;">{{ $adminNotes }}</p>
                </div>
                @endif

                {{-- Support Information --}}
                <div class="info-card">
                    <h3 style="margin: 0 0 15px 0;">📞 Butuh Bantuan?</h3>
                    <p style="margin: 0;">Jika Anda mengalami kesulitan atau memiliki pertanyaan, jangan ragu untuk menghubungi tim support kami:</p>
                    <div style="margin-top: 15px;">
                        <div><strong>Email Support:</strong> {{ config('mail.support_email', 'support@company.com') }}</div>
                        <div><strong>WhatsApp:</strong> {{ config('app.whatsapp_support', '+62 812-3456-7890') }}</div>
                        <div><strong>Jam Operasional:</strong> Senin - Jumat, 09:00 - 18:00 WIB</div>
                    </div>
                </div>

                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: center;">
                    <p><strong>Terima kasih telah mempercayai layanan kami!</strong></p>
                    <p>Tim {{ config('app.name', 'Billing System') }}</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="footer">
                <p><strong>{{ config('app.name', 'Billing System') }}</strong></p>
                <p>Email ini dikirim secara otomatis, mohon jangan membalas email ini.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Billing System') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
