<?php

namespace App\Livewire\Admin\Transactions;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Products;
use App\Models\Payments;
use Illuminate\Support\Facades\Storage;

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
    
    // Transaction properties untuk modal
    public $selectedTransaction;
    public $transactionId;
    public $subdomainWeb = '';
    public $subdomainServer = '';
    public $adminNotes = '';
    public $rejectReason = '';

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
        $transaction = Transaction::findOrFail($this->transactionId);
        
        // Update status menjadi active dan catat waktu konfirmasi
        $transaction->update([
            'status' => 'active',
            'admin_notes' => $this->adminNotes,
            'confirmed_at' => now(),
            'start_date' => now(),
            'end_date' => $transaction->billing_cycle === 'yearly' 
                ? now()->addYear() 
                : now()->addMonth(),
        ]);
        
        $this->showConfirmAdminModal = false;
        $this->reset(['transactionId', 'adminNotes', 'subdomainWeb', 'subdomainServer']);
        
        session()->flash('message', 'Transaksi berhasil dikonfirmasi dan diaktifkan!');
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
                          $userQuery->where('full_name', 'like', '%' . $this->search . '%');
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
            ->orderBy('user_transaction_number', 'asc')
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
