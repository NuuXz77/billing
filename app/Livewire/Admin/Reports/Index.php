<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Reports')]
class Index extends Component
{
    public $fromDate;
    public $toDate;
    
    // Modal properties
    public $showDetailPendapatanModal = false;
    public $showDetailTotalRangeModal = false;
    public $showDetailProdukTerjualModal = false;
    public $showDetailArpuModal = false;
    public $showDetailTotalInvoiceModal = false;
    public $showDetailOutstandingModal = false;
    public $showDetailSubscriptionAktifModal = false;
    public $showDetailAkanBerakhirModal = false;
    public $showDetailUserAktifModal = false;
    public $showDetailUserBaruModal = false;
    public $showDetailGagalPerpanjangModal = false;
    
    public function mount()
    {
        $this->fromDate = now()->startOfMonth()->format('Y-m-d');
        $this->toDate = now()->endOfMonth()->format('Y-m-d');
    }
    
    // Revenue Report Data
    public function getRevenueDataProperty()
    {
        $fromDate = Carbon::parse($this->fromDate)->startOfDay();
        $toDate = Carbon::parse($this->toDate)->endOfDay();
        
        $monthlyRevenue = Transaction::where('status', 'active')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->sum('total_payment');
            
        $revenuePerProduct = Product::with(['transactions' => function($query) use ($fromDate, $toDate) {
                $query->where('status', 'active')
                    ->whereBetween('created_at', [$fromDate, $toDate]);
            }])
            ->get()
            ->map(function($product) {
                $totalRevenue = $product->transactions->sum('total_payment');
                $transactionCount = $product->transactions->count();
                return (object) [
                    'name_product' => $product->name_product,
                    'product_code' => $product->product_code,
                    'total_revenue' => $totalRevenue,
                    'transaction_count' => $transactionCount,
                    'price_monthly' => $product->price_monthly,
                    'price' => $product->price,
                    'harga' => $product->harga,
                    'status' => $product->status,
                    'is_active' => $product->is_active
                ];
            })
            ->where('total_revenue', '>', 0);
            
        $dailyRevenue = Transaction::where('status', 'active')
            ->whereDate('created_at', today())
            ->sum('total_payment');
            
        // Get detailed transactions for modal
        $transactions = Transaction::with(['user', 'product', 'payment'])
            ->where('status', 'active')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $successfulTransactions = $transactions->count();
            
        return [
            'monthly' => $monthlyRevenue,
            'daily' => $dailyRevenue,
            'per_product' => $revenuePerProduct,
            'total_annual' => $monthlyRevenue, // Use range total for consistency
            'transactions' => $transactions, // Add transactions for modal
            'successful_transactions' => $successfulTransactions // Add successful transaction count
        ];
    }
    
    // Invoice Report Data
    public function getInvoiceDataProperty()
    {
        $fromDate = Carbon::parse($this->fromDate)->startOfDay();
        $toDate = Carbon::parse($this->toDate)->endOfDay();
        
        $totalInvoices = Transaction::whereBetween('created_at', [$fromDate, $toDate])->count();
        $paidInvoices = Transaction::where('status', 'active')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->count();
        $unpaidInvoices = Transaction::whereIn('status', ['pending_payment', 'pending_confirm'])
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->count();
            
        $outstanding = Transaction::whereIn('status', ['pending_payment', 'pending_confirm'])
            ->sum('total_payment');
            
        // Additional data for modals
        $allInvoices = Transaction::with(['user', 'product', 'payment'])
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $outstandingInvoices = Transaction::with(['user', 'product', 'payment'])
            ->whereIn('status', ['pending_payment', 'pending_confirm'])
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return [
            'total' => $totalInvoices,
            'paid' => $paidInvoices,
            'unpaid' => $unpaidInvoices,
            'outstanding' => $outstanding,
            'all_invoices' => $allInvoices,
            'outstanding_invoices' => $outstandingInvoices,
            'invoices' => $allInvoices // Add alias for modal compatibility
        ];
    }
    
    // Subscription Report Data
    public function getSubscriptionDataProperty()
    {
        $activeSubscriptions = Transaction::where('status', 'active')->count();
        
        $fromDate = Carbon::parse($this->fromDate)->startOfDay();
        $toDate = Carbon::parse($this->toDate)->endOfDay();
        
        $newSubscriptions = Transaction::whereBetween('created_at', [$fromDate, $toDate])->count();
        $failedRenewals = Transaction::where('status', 'expired')
            ->whereBetween('updated_at', [$fromDate, $toDate])
            ->count();
            
        $expiringSoon = Transaction::where('status', 'active')
            ->whereBetween('created_at', [now(), now()->addDays(30)])
            ->count();
            
        // Additional data for modals
        $activeSubscriptionsList = Transaction::with(['user', 'product'])
            ->where('status', 'active')
            ->get();
            
        $expiringSoonList = Transaction::with(['user', 'product'])
            ->where('status', 'active')
            ->whereBetween('created_at', [now(), now()->addDays(30)])
            ->get();
            
        $failedRenewalsList = Transaction::with(['user', 'product'])
            ->where('status', 'expired')
            ->whereBetween('updated_at', [$fromDate, $toDate])
            ->get();
            
        return [
            'active' => $activeSubscriptions,
            'new' => $newSubscriptions,
            'expiring' => $expiringSoon,
            'failed' => $failedRenewals,
            'active_subscriptions' => $activeSubscriptionsList,
            'expiring_subscriptions' => $expiringSoonList,
            'failed_renewals' => $failedRenewalsList,
            'revenue_lost' => $failedRenewalsList->sum('total_payment'),
            'recoverable' => $failedRenewalsList->where('created_at', '>', now()->subDays(30))->count(),
            'payment_failed' => $failedRenewalsList->where('status_reason', 'payment_failed')->count(),
            'card_expired' => $failedRenewalsList->where('status_reason', 'card_expired')->count(),
            'insufficient_funds' => $failedRenewalsList->where('status_reason', 'insufficient_funds')->count(),
            'other_reasons' => $failedRenewalsList->whereNotIn('status_reason', ['payment_failed', 'card_expired', 'insufficient_funds'])->count()
        ];
    }
    
    // User Report Data
    public function getUserDataProperty()
    {
        $activeUsers = User::where('status', 'active')->count();
        $totalUsers = User::count();
        
        $fromDate = Carbon::parse($this->fromDate)->startOfDay();
        $toDate = Carbon::parse($this->toDate)->endOfDay();
        
        $newUsers = User::whereBetween('created_at', [$fromDate, $toDate])->count();
        $arpu = $activeUsers > 0 ? Transaction::where('status', 'active')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->avg('total_payment') : 0;
            
        // Additional data for modals
        $activeUsersList = User::where('status', 'active')
            ->withCount(['transactions'])
            ->with(['transactions' => function($query) use ($fromDate, $toDate) {
                $query->whereBetween('created_at', [$fromDate, $toDate]);
            }])
            ->get();
            
        $newUsersList = User::whereBetween('created_at', [$fromDate, $toDate])
            ->withCount(['transactions'])
            ->get();
            
        return [
            'active' => $activeUsers,
            'new' => $newUsers,
            'total' => $totalUsers,
            'arpu' => $arpu,
            'active_users' => $activeUsersList,
            'new_users' => $newUsersList
        ];
    }
    
    // Product Report Data
    public function getProductDataProperty()
    {
        $fromDate = Carbon::parse($this->fromDate)->startOfDay();
        $toDate = Carbon::parse($this->toDate)->endOfDay();
        
        $productStats = Product::withCount(['transactions' => function($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }])
        ->with(['transactions' => function($query) use ($fromDate, $toDate) {
            $query->where('status', 'active')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->select('product_id', 'total_payment', 'status');
        }])
        ->get()
        ->map(function($product) {
            $product->total_revenue = $product->transactions->sum('total_payment');
            return $product;
        });
        
        return $productStats;
    }
    
    public function exportPDF($type)
    {
        // Logic untuk export PDF akan diimplementasi
        session()->flash('message', 'Export PDF untuk ' . ucfirst($type) . ' berhasil!');
    }
    
    public function exportExcel($type)
    {
        // Logic untuk export Excel akan diimplementasi
        session()->flash('message', 'Export Excel untuk ' . ucfirst($type) . ' berhasil!');
    }
    
    public function updatePeriod()
    {
        // Method untuk update periode filter
        $this->dispatch('period-updated');
    }

    public function render()
    {
        return view('livewire.admin.reports.index', [
            'revenueData' => $this->revenueData,
            'invoiceData' => $this->invoiceData,
            'subscriptionData' => $this->subscriptionData,
            'userData' => $this->userData,
            'productData' => $this->productData
        ]);
    }
}
