<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Server</title>
    
    <!-- Google Fonts - Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fa;
            font-family: 'Source Sans Pro', Arial, sans-serif;
            color: #1d1d1d;
            line-height: 1.5;
        }

        .email-wrapper {
            width: 100%;
            padding: 30px 0;
            background: #f5f7fa;
        }

        .email-card {
            width: 640px;
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e6e9ef;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            padding: 40px 30px 0;
        }

        .header-logo-container {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            vertical-align: middle;
        }

        .header-logo-container img {
            width: 60px;
            height: auto;
        }

        .header-texts {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            line-height: 1.2;
            margin-left: 4px;
        }

        .header-hoci {
            font-size: 28px;
            font-weight: 700;
            color: #0a76dd;
            line-height: 1.1;
        }

        .header-italic {
            font-size: 14px;
            font-style: italic;
            color: #555;
            margin-top: 4px;
            text-align: center;
            width: 100%;
        }

        .divider {
            width: 100%;
            border-bottom: 1px solid #e5e8ee;
            margin: 32px 0;
        }

        .header-title {
            font-size: 26px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 6px;
            color: #0a76dd;
        }

        .header-subtitle {
            font-size: 15px;
            color: #666;
            text-align: center;
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 19px;
            font-weight: 600;
            padding-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #0a76dd;
            margin-top: 24px;
        }

        .grid {
            width: 100%;
            display: table;
            border-spacing: 0;
            margin-bottom: 28px;
        }

        .grid-column {
            width: 50%;
            padding: 0 6px;
            display: table-cell;
            vertical-align: top;
        }

        .card {
            background: #f8faff;
            border: 1px solid #d9e2ff;
            border-radius: 8px;
            padding: 16px;
            font-size: 15px;
            height: 100%;
            box-sizing: border-box;
        }

        .card-title {
            font-size: 12px;
            font-weight: 700;
            color: #555;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-value {
            margin-bottom: 12px;
            font-weight: 500;
            color: #333;
        }

        .button {
            display: inline-block;
            background: #0a76dd;
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .button:hover {
            background: #0968c4;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            border: 1px solid #cfd3d7;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 6px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background: #fff;
            font-family: 'Courier New', monospace;
            color: #333;
        }

        .warning {
            background: #fff4f4;
            border-left: 4px solid #ff4d4d;
            padding: 12px 14px;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 18px;
            color: #c53030;
        }

        .footer {
            background: #f9fafc;
            text-align: center;
            padding: 20px;
            color: #888;
            font-size: 13px;
            border-top: 1px solid #e6e9ef;
        }

        .additional-message {
            background: #edf2f7;
            border-left: 4px solid #4299e1;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .greeting {
            margin-bottom: 25px;
            font-size: 15px;
            color: #444;
        }

        .support-info {
            font-size: 15px;
            color: #444;
            line-height: 1.8;
        }

        .support-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .support-icon {
            color: #666;
            width: 20px;
            margin-right: 8px;
            text-align: center;
        }

        .support-label {
            min-width: 130px;
            font-weight: 600;
        }

        .support-value {
            margin-left: 8px;
        }

        @media (max-width: 640px) {
            .email-card {
                width: 100%;
                border-radius: 0;
            }
            
            .grid {
                display: block;
            }
            
            .grid-column {
                width: 100%;
                display: block;
                padding: 0;
                margin-bottom: 12px;
            }
            
            .header {
                padding: 30px 20px 0;
            }
            
            div[style*="padding:0 34px 32px"] {
                padding: 0 20px 32px !important;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-card">
            <!-- Header -->
            <div class="header">
                <!-- Logo + App Name -->
                <div class="header-logo-container">
                    <img src="{{ asset('img/logo/Hoci_Ilustration.svg') }}" alt="Logo" />
                    <div class="header-texts">
                        <span class="header-hoci">{{ config('app.name', 'Billing System') }}</span>
                    </div>
                </div>
                
                <!-- Website URL -->
                <div class="header-italic">
                    <a href="{{ config('app.url', 'https://example.com') }}" style="color: #0a76dd; text-decoration: none;">{{ config('app.url', 'https://example.com') }}</a>
                </div>

                <!-- Divider -->
                <div class="divider"></div>
            </div>

            <div style="padding:0 34px 32px;">
                <!-- Greeting -->
                <div class="greeting">
                    <h2 style="margin: 0 0 8px 0; color: #333;">Halo, {{ $transaction->user->full_name }}!</h2>
                    <p style="margin: 0;">Selamat! Transaksi Anda telah disetujui dan akun server Anda telah berhasil dibuat. Berikut adalah informasi lengkap untuk mengakses layanan hosting Anda.</p>
                </div>

                <!-- Judul & Subtitle Center -->
                <div class="header-title">Akun Server Anda Siap</div>
                <div class="header-subtitle">Informasi lengkap akses server Anda</div>

                <!-- Informasi Transaksi -->
                <div class="section-title">
                    <i class="fas fa-file-invoice-dollar" style="color:#0a76dd;"></i> Informasi Transaksi
                </div>

                <div class="grid">
                    <div class="grid-column">
                        <div class="card">
                            <div class="card-title">Kode Invoice</div>
                            <div class="card-value">{{ $transaction->transaction_code }}</div>
                            <div class="card-title">Tipe Layanan</div>
                            <div class="card-value">{{ $transaction->product->name_product }}</div>
                        </div>
                    </div>
                    <div class="grid-column">
                        <div class="card">
                            <div class="card-title">Tanggal Aktif</div>
                            <div class="card-value">{{ \Carbon\Carbon::parse($transaction->start_date)->format('d F Y') }}</div>
                            <div class="card-title">Tanggal Berakhir</div>
                            <div class="card-value">{{ \Carbon\Carbon::parse($transaction->end_date)->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Subdomain -->
                <div class="section-title">
                    <i class="fas fa-globe" style="color:#0a76dd;"></i> Informasi Subdomain
                </div>

                <div class="grid">
                    <div class="grid-column">
                        <div class="card">
                            <div class="card-title">Website Tampilan</div>
                            <div class="card-value">{{ $transaction->subdomain_web }}</div>
                            <a href="https://{{ $transaction->subdomain_web }}" class="button" style="color:white;" target="_blank">Buka Website</a>
                        </div>
                    </div>
                    <div class="grid-column">
                        <div class="card">
                            <div class="card-title">Server Management</div>
                            <div class="card-value">{{ $transaction->subdomain_server }}</div>
                            <a href="https://{{ $transaction->subdomain_server }}" class="button" style="color:white;" target="_blank">Kelola Server</a>
                        </div>
                    </div>
                </div>

                <!-- Kredensial Login -->
                <div class="section-title">
                    <i class="fas fa-key" style="color:#0a76dd;"></i> Kredensial Login Server
                </div>

                <div class="card">
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <div style="flex:1; min-width:48%;">
                            <div class="card-title">USERNAME</div>
                            <input type="text" value="{{ $serverUsername }}" readonly class="input-field" />
                        </div>
                        <div style="flex:1; min-width:48%;">
                            <div class="card-title">PASSWORD</div>
                            <input type="text" value="{{ $serverPassword }}" readonly class="input-field" />
                        </div>
                    </div>
                </div>

                <div class="warning">
                    <strong>Catatan :</strong> Jangan berikan kredensial ini kepada siapa pun.
                </div>

                <!-- Additional Message -->
                @if($additionalMessage)
                <div class="additional-message">
                    <h4 style="margin: 0 0 10px 0; color: #2b6cb0;">💬 Pesan Khusus dari Admin:</h4>
                    <p style="margin: 0; white-space: pre-line;">{{ $additionalMessage }}</p>
                </div>
                @endif

                <!-- Admin Notes -->
                @if($adminNotes)
                <div class="additional-message">
                    <h4 style="margin: 0 0 10px 0; color: #2b6cb0;">📝 Catatan Admin:</h4>
                    <p style="margin: 0; white-space: pre-line;">{{ $adminNotes }}</p>
                </div>
                @endif

                <!-- Bantuan -->
                <div class="section-title" style="margin-top:28px;">
                    <i class="fas fa-life-ring" style="color:#0a76dd;"></i> Bantuan
                </div>
                <div class="support-info">
                    Jika Anda membutuhkan bantuan, silakan hubungi kami:<br /><br />
                    <div class="support-item">
                        <i class="fas fa-envelope support-icon"></i>
                        <b class="support-label">Email</b>
                        <span class="support-value">:</span>
                        <a href="mailto:{{ config('mail.support_email', 'support@company.com') }}" style="color:#0a76dd; text-decoration: none;">{{ config('mail.support_email', 'support@company.com') }}</a>
                    </div>
                    <div class="support-item">
                        <i class="fab fa-whatsapp support-icon"></i>
                        <b class="support-label">WhatsApp</b>
                        <span class="support-value">:</span>
                        <a href="https://wa.me/{{ config('app.whatsapp_support', '+6281234567890') }}" style="color:#0a76dd; text-decoration: none;">{{ config('app.whatsapp_support', '+62 812-3456-7890') }}</a>
                    </div>
                    <div class="support-item">
                        <i class="fas fa-clock support-icon"></i>
                        <b class="support-label">Jam Operasional</b>
                        <span class="support-value">:</span>
                        <span>Senin - Jumat, 09:00 - 18:00 WIB</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                Terima kasih telah mempercayai layanan kami.<br />
                <b>Tim Support {{ config('app.name', 'Billing System') }}</b>
            </div>
        </div>
    </div>
</body>
</html>