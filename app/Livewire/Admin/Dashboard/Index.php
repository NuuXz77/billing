<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Products;
use App\Models\Payments;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
#[Title('Beranda')]
class Index extends Component
{
    public $totalMembers;
    public $activeSubscriptions;
    public $totalRevenue;
    public $pendingInvoices;
    public $recentTransactions;
    public $popularProducts;
    public $recentPayments;
    
    public function mount()
    {
        $this->loadDashboardData();
    }
    
    public function loadDashboardData()
    {
        // Total Members (only users with user_code starting with "MBRHOCI")
        $this->totalMembers = User::where('user_code', 'like', 'MBRHOCI%')->count();
        
        // Active Subscriptions
        $this->activeSubscriptions = Transaction::where('status', 'active')
                                                ->whereDate('end_date', '>', now())
                                                ->count();
        
        // Total Revenue (from active transactions)
        $this->totalRevenue = Transaction::where('status', 'active')->sum('total_payment');
        
        // Pending Invoices
        $this->pendingInvoices = Transaction::whereIn('status', ['pending_payment'])->count();
        
        // Recent Transactions (latest 5 active subscriptions with user info)
        $this->recentTransactions = Transaction::with(['user', 'product'])
                                              ->where('status', 'active')
                                              ->latest()
                                              ->take(5)
                                              ->get();
        
        // Popular Products (top 3 based on transaction count)
        $this->popularProducts = Products::withCount('transactions')
                                        ->orderBy('transactions_count', 'desc')
                                        ->take(3)
                                        ->get();
        
        // Recent Payments (latest 5 transactions with payment proof)
        $this->recentPayments = Transaction::with(['user', 'product', 'payment'])
                                          ->whereIn('status', ['active', 'pending_confirm'])
                                          ->latest()
                                          ->take(5)
                                          ->get();
    }
    
    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
    
    // Navigation Methods dengan Filter
    public function navigateToUsers()
    {
        // Set session untuk filter status active member di halaman users
        session(['user_filter_status' => 'active']);
        return $this->redirect('/admin/users', navigate: true);
    }
    
    public function navigateToPayments()
    {
        return $this->redirect('/admin/payments', navigate: true);
    }
    
    public function navigateToTransactions($status = null)
    {
        if ($status) {
            // Set session untuk filter status di halaman transactions
            if ($status === 'pending') {
                // Untuk pending, gunakan pending_confirm karena itu yang biasanya butuh tindakan admin
                session(['transaction_filter_status' => 'pending_payment']);
            } else {
                session(['transaction_filter_status' => $status]);
            }
        }
        return $this->redirect('/admin/transactions', navigate: true);
    }
}
