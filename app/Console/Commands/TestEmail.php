<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration and send test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'test@example.com';
        
        $this->info('🧪 Testing email configuration...');
        $this->info('📧 Sending test email to: ' . $email);
        
        // Display current email config
        $this->table(['Config', 'Value'], [
            ['MAIL_MAILER', config('mail.default')],
            ['MAIL_HOST', config('mail.mailers.smtp.host')],
            ['MAIL_PORT', config('mail.mailers.smtp.port')],
            ['MAIL_USERNAME', config('mail.mailers.smtp.username')],
            ['MAIL_ENCRYPTION', config('mail.mailers.smtp.encryption')],
            ['MAIL_FROM_ADDRESS', config('mail.from.address')],
            ['MAIL_FROM_NAME', config('mail.from.name')],   
        ]);
        
        try {
            // Temporarily set SSL context for this email only
            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ]
            ]);

            Mail::raw('🎉 TEST EMAIL berhasil! Konfigurasi email sudah benar. Waktu: ' . now()->format('d F Y H:i:s'), function ($message) use ($email) {
                $message->to($email)
                       ->subject('🧪 Test Email dari ' . config('app.name') . ' - ' . now()->format('H:i:s'));
            });
            
            $this->info('✅ Email berhasil dikirim!');
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('❌ Email gagal dikirim!');
            $this->error('Error: ' . $e->getMessage());
            $this->error('File: ' . $e->getFile() . ':' . $e->getLine());
            return Command::FAILURE;
        }
    }
}
