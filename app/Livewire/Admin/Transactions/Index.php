<?php

namespace App\Livewire\Admin\Transactions;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Products;
use App\Models\Payments;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.app')]
#[Title('Transactions Management')]
class Index extends Component
{
    use WithPagination;

    // Properties untuk modal dan state
    public $showConfirmSubdomainModal = false;
    public $showConfirmAdminModal = false; 
    public $showRejectModal = false;
    
    // Filter properties
    public $search = '';
    public $statusFilter = '';
    public $productFilter = '';
    public $paymentFilter = '';
    public $perPage = 10;
    
    // Sorting properties
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Transaction properties untuk modal
    public $selectedTransaction;
    public $transactionId;
    public $subdomainWeb = '';
    public $subdomainServer = '';
    public $adminNotes = '';
    public $rejectReason = '';
    
    // Server credentials untuk email
    public $serverUsername = '';
    public $serverPassword = '';
    public $additionalMessage = '';

    // Mount method untuk handle filter dari dashboard
    public function mount()
    {
        // Cek apakah ada filter status dari session (dari dashboard)
        if (session()->has('transaction_filter_status')) {
            $this->statusFilter = session('transaction_filter_status');
            
            // Hapus session setelah digunakan
            session()->forget('transaction_filter_status');
        }
    }

    // Reset pagination ketika filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    
    public function updatingProductFilter()
    {
        $this->resetPage();
    }
    
    public function updatingPaymentFilter()
    {
        $this->resetPage();
    }
    
    // Method untuk sorting
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    // Method untuk melihat detail (menggunakan wire:navigate untuk SPA experience)
    public function viewDetail($id)
    {
        // Tidak perlu method ini karena kita akan menggunakan wire:navigate langsung di view
        // Method ini bisa dihapus atau dibiarkan kosong
    }
    
    // Method untuk konfirmasi subdomain (step 1)
    public function openConfirmSubdomainModal($id)
    {
        $this->selectedTransaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);
        $this->transactionId = $id;
        $this->subdomainWeb = '';
        $this->subdomainServer = '';
        $this->showConfirmSubdomainModal = true;
    }
    
    // Method untuk save subdomain dan lanjut ke konfirmasi admin
    public function saveSubdomain()
    {
        $this->validate([
            'subdomainWeb' => 'required|string|max:255',
            'subdomainServer' => 'required|string|max:255',
        ], [
            'subdomainWeb.required' => 'Subdomain web wajib diisi',
            'subdomainServer.required' => 'Subdomain server wajib diisi',
        ]);
        
        // Update transaction dengan subdomain data
        $transaction = Transaction::findOrFail($this->transactionId);
        $transaction->update([
            'subdomain_web' => $this->subdomainWeb,
            'subdomain_server' => $this->subdomainServer,
        ]);
        
        $this->showConfirmSubdomainModal = false;
        $this->showConfirmAdminModal = true;
        
        session()->flash('message', 'Subdomain berhasil disimpan, silakan lanjutkan konfirmasi!');
    }
    
    // Method untuk konfirmasi akhir oleh admin
    public function confirmTransaction()
    {
        // Validate input
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
            
            \Log::info('=== KONFIRMASI TRANSAKSI DARI INDEX ===', [
                'transaction_id' => $this->transactionId,
                'transaction_code' => $transaction->transaction_code,
                'user_email' => $transaction->user->email,
            ]);
            
            // Update status menjadi active dan catat waktu konfirmasi
            $transaction->update([
                'status' => 'active',
                'admin_notes' => $this->additionalMessage,
                'confirmed_at' => now(),
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonth()->toDateString(),
            ]);
            
            // Kirim email akun server
            \Log::info('Mengirim email akun server ke: ' . $transaction->user->email);
            
            \Mail::to($transaction->user->email)->send(
                new \App\Mail\SendAccountServer(
                    $transaction,
                    $this->serverUsername,
                    $this->serverPassword,
                    $this->additionalMessage,
                    $this->additionalMessage
                )
            );
            
            \Log::info('Email berhasil dikirim!');
            
            // Update admin notes dengan info email
            $transaction->update([
                'admin_notes' => ($this->additionalMessage ? $this->additionalMessage . "\n\n" : '') . 
                                "✅ Email akun server berhasil dikirim pada " . now()->format('d F Y H:i:s') . 
                                "\n📧 Dikirim ke: {$transaction->user->email}" .
                                "\n👤 Username: {$this->serverUsername}" .
                                "\n🔑 Password: {$this->serverPassword}" .
                                "\n🌐 Subdomain Web: {$transaction->subdomain_web}" .
                                "\n🖥️ Subdomain Server: {$transaction->subdomain_server}"
            ]);
            
            $this->showConfirmAdminModal = false;
            $this->reset(['transactionId', 'serverUsername', 'serverPassword', 'additionalMessage', 'subdomainWeb', 'subdomainServer']);
            
            session()->flash('message', "✅ Transaksi {$transaction->transaction_code} berhasil dikonfirmasi dan email telah dikirim ke {$transaction->user->email}!");
            
        } catch (\Exception $e) {
            \Log::error('Error konfirmasi transaksi: ' . $e->getMessage());
            session()->flash('error', 'Gagal mengkonfirmasi transaksi: ' . $e->getMessage());
        }
    }
    
    // Method untuk reject transaction
    public function openRejectModal($id)
    {
        $this->selectedTransaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);
        $this->transactionId = $id;
        $this->rejectReason = '';
        $this->showRejectModal = true;
    }
    
    // Method untuk reject transaction
    public function rejectTransaction()
    {
        $this->validate([
            'rejectReason' => 'required|string|min:10',
        ], [
            'rejectReason.required' => 'Alasan penolakan wajib diisi',
            'rejectReason.min' => 'Alasan penolakan minimal 10 karakter',
        ]);
        
        $transaction = Transaction::findOrFail($this->transactionId);
        $transaction->update([
            'status' => 'rejected',
            'admin_notes' => $this->rejectReason,
        ]);
        
        $this->showRejectModal = false;
        $this->reset(['transactionId', 'rejectReason']);
        
        session()->flash('message', 'Transaksi berhasil ditolak!');
    }
    
    // Method untuk delete transaction (hanya untuk pending_payment dan active)
    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Hapus file bukti pembayaran jika ada
        if ($transaction->payment_proof) {
            Storage::disk('public')->delete('payment-proofs/' . $transaction->payment_proof);
        }
        
        $transaction->delete();
        
        session()->flash('message', 'Transaksi berhasil dihapus!');
    }
    
    // Method untuk clear filters
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter', 'productFilter', 'paymentFilter']);
    }

    // Computed properties untuk stats
    public function getTotalTransactionsProperty()
    {
        return Transaction::count();
    }

    public function getNewTransactionsTodayProperty()
    {
        return Transaction::whereDate('created_at', today())->count();
    }

    public function getTotalRevenueProperty()
    {
        return Transaction::where('status', 'active')->sum('total_payment');
    }

    public function getPendingConfirmationsProperty()
    {
        return Transaction::where('status', 'pending_confirm')->count();
    }

    public function getActiveServicesProperty()
    {
        return Transaction::where('status', 'active')->count();
    }

    public function getTodayTransactionsProperty()
    {
        return Transaction::whereDate('created_at', today())->count();
    }

    public function getMonthlyTransactionsProperty()
    {
        return Transaction::whereMonth('created_at', now()->month)
                         ->whereYear('created_at', now()->year)
                         ->count();
    }

    public function getPendingPaymentsProperty()
    {
        return Transaction::where('status', 'pending_payment')->count();
    }

    public function getRejectedTransactionsProperty()
    {
        return Transaction::whereIn('status', ['rejected', 'canceled'])->count();
    }

    public function getSuccessRateProperty()
    {
        $total = Transaction::count();
        if ($total === 0) return 0;
        
        $successful = Transaction::where('status', 'active')->count();
        return round(($successful / $total) * 100, 1);
    }

    public function render()
    {
        $transactions = Transaction::with(['user', 'product', 'payment'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('transaction_code', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($userQuery) {
                          $userQuery->where('full_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('email', 'like', '%' . $this->search . '%')
                                    ->orWhere('username', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('product', function ($productQuery) {
                          $productQuery->where('name_product', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->productFilter, function ($query) {
                $query->where('product_id', $this->productFilter);
            })
            ->when($this->paymentFilter, function ($query) {
                $query->where('payment_id', $this->paymentFilter);
            })
            ->when($this->sortField, function ($query) {
                if ($this->sortField === 'user_name') {
                    $query->join('users', 'transactions.user_id', '=', 'users.id')
                          ->orderBy('users.full_name', $this->sortDirection)
                          ->select('transactions.*');
                } elseif ($this->sortField === 'product_name') {
                    $query->join('products', 'transactions.product_id', '=', 'products.id')
                          ->orderBy('products.name_product', $this->sortDirection)
                          ->select('transactions.*');
                } elseif ($this->sortField === 'payment_method') {
                    $query->join('payments', 'transactions.payment_id', '=', 'payments.id')
                          ->orderBy('payments.payment_method', $this->sortDirection)
                          ->select('transactions.*');
                } else {
                    $query->orderBy($this->sortField, $this->sortDirection);
                }
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate($this->perPage);

        $products = Products::where('status', 1)->get();
        $payments = Payments::where('status', 'active')->get();

        // Data untuk stats cards
        $stats = [
            'totalTransactions' => $this->totalTransactions,
            'newTransactionsToday' => $this->newTransactionsToday,
            'totalRevenue' => $this->totalRevenue,
            'pendingConfirmations' => $this->pendingConfirmations,
            'activeServices' => $this->activeServices,
            'todayTransactions' => $this->todayTransactions,
            'monthlyTransactions' => $this->monthlyTransactions,
            'pendingPayments' => $this->pendingPayments,
            'rejectedTransactions' => $this->rejectedTransactions,
            'successRate' => $this->successRate,
        ];

        return view('livewire.admin.transactions.index', 
            compact('transactions', 'products', 'payments') + $stats
        );
    }
}
