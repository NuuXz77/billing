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
    
    // Send account properties
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
        $this->adminNotes = '';
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
        
        session()->flash('message', 'Subdomain berhasil disimpan. Silakan lanjutkan konfirmasi final.');
    }
    
    // Method untuk konfirmasi final (langkah 2)
    public function confirmTransaction()
    {
        $this->validate([
            'adminNotes' => 'nullable|string|max:1000',
        ]);

        $transaction = Transaction::findOrFail($this->transactionId);
        $transaction->update([
            'status' => 'active',
            'admin_notes' => $this->adminNotes,
            'confirmed_at' => now(),
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(), // Default 1 bulan
        ]);

        // Refresh transaction data
        $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
        
        $this->showConfirmAdminModal = false;
        
        session()->flash('message', 'Transaksi berhasil dikonfirmasi dan diaktifkan!');
    }
    
    // Method untuk menolak transaksi
    public function rejectTransaction()
    {
        $this->validate([
            'rejectReason' => 'required|string|min:10|max:1000',
        ]);

        $transaction = Transaction::findOrFail($this->transactionId);
        $transaction->update([
            'status' => 'rejected',
            'admin_notes' => $this->rejectReason,
        ]);

        // Refresh transaction data
        $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
        
        $this->showRejectModal = false;
        
        session()->flash('message', 'Transaksi telah ditolak.');
    }

    // Method untuk membuka modal send account server
    public function openSendAccountModal($id)
    {
        $this->selectedTransaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);
        $this->transactionId = $id;
        
        // Set subdomain values from transaction
        $this->subdomainWeb = $this->selectedTransaction->subdomain_web ?? '';
        $this->subdomainServer = $this->selectedTransaction->subdomain_server ?? '';
        
        // Reset form values
        $this->serverUsername = '';
        $this->serverPassword = '';
        $this->additionalMessage = '';
        
        $this->showSendAccountModal = true;
    }

    // Method untuk mengirim email account server
    public function sendAccountEmail()
    {
        $this->validate([
            'serverUsername' => 'required|string|max:255',
            'serverPassword' => 'required|string|max:255',
            'additionalMessage' => 'nullable|string|max:1000',
        ], [
            'serverUsername.required' => 'Username server wajib diisi',
            'serverPassword.required' => 'Password server wajib diisi',
        ]);

        try {
            // Send email
            Mail::to($this->selectedTransaction->user->email)->send(
                new SendAccountServer(
                    $this->selectedTransaction,
                    $this->serverUsername,
                    $this->serverPassword,
                    $this->additionalMessage
                )
            );

            // Update transaction dengan informasi bahwa email sudah dikirim
            $transaction = Transaction::findOrFail($this->transactionId);
            $transaction->update([
                'admin_notes' => ($transaction->admin_notes ? $transaction->admin_notes . "\n\n" : '') . 
                                "Email akun server telah dikirim pada " . now()->format('d F Y H:i') . 
                                " dengan username: {$this->serverUsername}"
            ]);

            // Refresh transaction data
            $this->transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($this->transactionId);
            
            $this->showSendAccountModal = false;
            
            session()->flash('message', 'Email akun server berhasil dikirim ke ' . $this->selectedTransaction->user->email);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.transactions.detail');
    }
}
