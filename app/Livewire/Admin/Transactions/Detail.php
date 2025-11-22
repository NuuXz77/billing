<?php

namespace App\Livewire\Admin\Transactions;

use Livewire\Component;
use App\Models\Transaction;
use App\Mail\SendAccountServer;
use Illuminate\Support\Facades\Mail;

class Detail extends Component
{
    public $transaction;
    public $transactionId;
    
    // Toast notification properties
    public $toastMessage = '';
    public $toastType = 'info'; // success, error, info
    
    // Modal states
    public $showConfirmSubdomainModal = false;
    public $showConfirmAdminModal = false;
    public $showRejectModal = false;
    public $showSendAccountModal = false;
    
    // Form properties
    public $selectedTransaction;
    public $subdomainWeb = '';
    public $subdomainServer = '';
    public $adminNotes = '';
    public $rejectReason = '';
    public $serverUsername = '';
    public $serverPassword = '';
    public $additionalMessage = '';

    public function mount($transactionId = null)
    {
        // Jika transactionId tidak ada, coba ambil dari parameter route
        if (!$transactionId) {
            $transactionId = request()->route('transactionId');
        }
        
        $this->transactionId = $transactionId;
        $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($transactionId);
    }
    
    // Method untuk membuka modal konfirmasi subdomain
    public function openConfirmSubdomainModal($id)
    {
        $this->selectedTransaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);
        $this->transactionId = $id;
        $this->subdomainWeb = $this->selectedTransaction->subdomain_web ?? '';
        $this->subdomainServer = $this->selectedTransaction->subdomain_server ?? '';
        $this->showConfirmSubdomainModal = true;
    }
    
    // Method untuk membuka modal konfirmasi admin
    public function openConfirmAdminModal($id)
    {
        $this->selectedTransaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);
        $this->transactionId = $id;
        $this->additionalMessage = '';
        $this->serverUsername = '';
        $this->serverPassword = '';
        $this->showConfirmAdminModal = true;
    }
    
    // Method untuk membuka modal reject
    public function openRejectModal($id)
    {
        $this->selectedTransaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);
        $this->transactionId = $id;
        $this->rejectReason = '';
        $this->showRejectModal = true;
    }
    
    // Method untuk menyimpan subdomain (langkah 1)
    public function saveSubdomain()
    {
        $this->validate([
            'subdomainWeb' => 'required|string|max:255',
            'subdomainServer' => 'required|string|max:255',
        ]);

        try {
            $transaction = Transaction::findOrFail($this->transactionId);
            $transaction->update([
                'subdomain_web' => $this->subdomainWeb,
                'subdomain_server' => $this->subdomainServer,
            ]);

            // Refresh transaction data
            $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
            
            $this->showConfirmSubdomainModal = false;
            
            // Otomatis buka modal konfirmasi admin
            $this->openConfirmAdminModal($this->transactionId);
            
            // Set toast notification
            $this->toastMessage = 'Subdomain berhasil disimpan. Silakan lengkapi informasi akun server.';
            $this->toastType = 'success';
            
        } catch (\Exception $e) {
            $this->toastMessage = 'Gagal menyimpan subdomain: ' . $e->getMessage();
            $this->toastType = 'error';
        }
    }
    
    // Method untuk konfirmasi final (langkah 2)
    public function confirmTransaction()
    {
        // Log untuk cek apakah method terpanggil
        \Log::info('🔥 METHOD confirmTransaction() DIPANGGIL!', [
            'serverUsername' => $this->serverUsername,
            'serverPassword' => $this->serverPassword,
            'additionalMessage' => $this->additionalMessage,
        ]);

        $this->validate([
            'serverUsername' => 'required|string|max:255',
            'serverPassword' => 'required|string|max:255',
            'additionalMessage' => 'nullable|string|max:1000',
        ], [
            'serverUsername.required' => 'Username server wajib diisi',
            'serverPassword.required' => 'Password server wajib diisi',
        ]);

        try {
            $transaction = Transaction::findOrFail($this->transactionId);
            
            // Log untuk debugging
            \Log::info('=== MULAI PROSES KONFIRMASI TRANSAKSI ===', [
                'transaction_id' => $this->transactionId,
                'transaction_code' => $transaction->transaction_code,
                'user_email' => $transaction->user->email,
                'server_username' => $this->serverUsername,
                'subdomain_web' => $transaction->subdomain_web,
                'subdomain_server' => $transaction->subdomain_server
            ]);
            
            // Update status transaksi
            $transaction->update([
                'status' => 'active',
                'admin_notes' => $this->additionalMessage,
                'confirmed_at' => now(),
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonth()->toDateString(), // Default 1 bulan
            ]);
            
            \Log::info('Transaksi berhasil diupdate ke status active', [
                'transaction_id' => $transaction->id,
                'status' => $transaction->status
            ]);

            // Test koneksi email sebelum kirim
            \Log::info('=== KONFIGURASI EMAIL ===', [
                'mail_mailer' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_username' => config('mail.mailers.smtp.username'),
                'mail_encryption' => config('mail.mailers.smtp.encryption'),
                'mail_from_address' => config('mail.from.address'),
                'mail_from_name' => config('mail.from.name')
            ]);

            // Kirim email akun server otomatis
            \Log::info('Memulai pengiriman email...', [
                'recipient' => $transaction->user->email
            ]);
            
            $emailData = [
                'transaction' => $transaction,
                'serverUsername' => $this->serverUsername,
                'serverPassword' => $this->serverPassword,
                'additionalMessage' => $this->additionalMessage,
                'adminNotes' => $this->additionalMessage
            ];
            
            \Log::info('Data email yang akan dikirim:', $emailData);
            
            // EXACT COPY SSL approach dari TestEmail command yang working
            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ]
            ]);

            // Kirim email dengan exact approach dari TestEmail
            Mail::to($transaction->user->email)->send(
                new SendAccountServer(
                    $transaction,
                    $this->serverUsername,
                    $this->serverPassword,
                    $this->additionalMessage,
                    $this->additionalMessage
                )
            );
            
            \Log::info('EMAIL BERHASIL DIKIRIM!', [
                'recipient' => $transaction->user->email,
                'subject' => 'Akun Server Anda - ' . $transaction->transaction_code
            ]);

            // Update admin notes dengan info email dikirim
            $transaction->update([
                'admin_notes' => ($this->additionalMessage ? $this->additionalMessage . "\n\n" : '') . 
                                "✅ Email akun server berhasil dikirim pada " . now()->format('d F Y H:i:s') . 
                                "\n📧 Dikirim ke: {$transaction->user->email}" .
                                "\n👤 Username: {$this->serverUsername}" .
                                "\n🔑 Password: {$this->serverPassword}" .
                                "\n🌐 Subdomain Web: {$transaction->subdomain_web}" .
                                "\n🖥️ Subdomain Server: {$transaction->subdomain_server}"
            ]);

            // Refresh transaction data
            $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
            
            $this->showConfirmAdminModal = false;
            
            // Set toast notification sukses dengan detail
            $this->toastMessage = "✅ SUKSES! Transaksi {$transaction->transaction_code} dikonfirmasi dan email akun server telah dikirim ke {$transaction->user->email}. Username: {$this->serverUsername}";
            $this->toastType = 'success';
            
            \Log::info('=== PROSES KONFIRMASI SELESAI ===');
            
        } catch (\Exception $e) {
            // Log error detail
            \Log::error('❌ GAGAL MENGIRIM EMAIL!', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'error_trace' => $e->getTraceAsString(),
                'transaction_id' => $this->transactionId,
                'user_email' => $transaction->user->email ?? 'unknown'
            ]);
            
            // Set toast notification error dengan detail
            $this->toastMessage = '❌ GAGAL! Error: ' . $e->getMessage() . ' | File: ' . basename($e->getFile()) . ':' . $e->getLine();
            $this->toastType = 'error';
        }
    }
    
    // Method untuk menolak transaksi
    public function rejectTransaction()
    {
        $this->validate([
            'rejectReason' => 'required|string|min:10|max:1000',
        ]);

        try {
            $transaction = Transaction::findOrFail($this->transactionId);
            $transaction->update([
                'status' => 'rejected',
                'admin_notes' => $this->rejectReason,
            ]);

            // Refresh transaction data
            $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
            
            $this->showRejectModal = false;
            
            // Set toast notification
            $this->toastMessage = 'Transaksi telah berhasil ditolak.';
            $this->toastType = 'success';
            
        } catch (\Exception $e) {
            $this->toastMessage = 'Gagal menolak transaksi: ' . $e->getMessage();
            $this->toastType = 'error';
        }
    }

    // Method untuk clear toast notification (optional)
    public function clearToast()
    {
        $this->toastMessage = '';
        $this->toastType = 'info';
    }
    
    // Method untuk test email (debugging purpose)
    public function testEmail()
    {
        try {
            \Log::info('🧪 Testing email configuration...');
            
            $transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
            \Log::info('📧 Sending test email to: ' . $transaction->user->email);
            
            // Log konfigurasi email (sama kayak $this->table di command)
            // \Log::info('EMAIL CONFIG TABLE:', [
            //     'MAIL_MAILER' => config('mail.default'),
            //     'MAIL_HOST' => config('mail.mailers.smtp.host'),
            //     'MAIL_PORT' => config('mail.mailers.smtp.port'),
            //     'MAIL_USERNAME' => config('mail.mailers.smtp.username'),
            //     'MAIL_ENCRYPTION' => config('mail.mailers.smtp.encryption'),
            //     'MAIL_FROM_ADDRESS' => config('mail.from.address'),
            //     'MAIL_FROM_NAME' => config('mail.from.name')
            // ]);
            
            // Temporarily set SSL context for this email only (EXACT COPY dari TestEmail)

            // EXACT COPY dari TestEmail command
            Mail::raw('🎉 TEST EMAIL berhasil! Konfigurasi email sudah benar. Waktu: ' . now()->format('d F Y H:i:s'), function ($message) use ($transaction) {
                $message->to($transaction->user->email)
                       ->subject('🧪 Test Email dari ' . config('app.name') . ' - ' . now()->format('H:i:s'));
            });
            
            \Log::info('✅ Email berhasil dikirim!');
            
            $this->toastMessage = "✅ TEST EMAIL berhasil dikirim ke {$transaction->user->email}! Cek inbox/spam folder.";
            $this->toastType = 'success';
            
        } catch (\Exception $e) {
            \Log::error('❌ Email gagal dikirim!');
            \Log::error('Error: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile() . ':' . $e->getLine());
            
            $this->toastMessage = '❌ TEST EMAIL GAGAL: ' . $e->getMessage();
            $this->toastType = 'error';
        }
    }

    public function render()
    {
        return view('livewire.admin.transactions.detail');
    }
}
