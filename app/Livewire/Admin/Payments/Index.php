<?php

namespace App\Livewire\Admin\Payments;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Payments;
use App\Models\Transaction;

#[Layout('components.layouts.app')]
#[Title('Payments Management')]
class Index extends Component
{
    use WithPagination;

    // Filter & Search
    public $search = '';
    public $statusFilter = '';
    public $methodFilter = '';
    public $perPage = 10;

    // Modal States
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDetailModal = false;
    public $showDeleteModal = false;

    // Toast Notification
    public $toastMessage = '';
    public $toastType = ''; // 'success' or 'error'

    // Form Fields
    public $paymentId;
    public $payment_code = '';
    public $payment_method = '';
    public $payment_bank = '';
    public $payment_account_name = '';
    public $payment_account_number = '';
    public $status = 'active';

    // Detail View
    public $detailPayment;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingMethodFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->generatePaymentCode();
        $this->showCreateModal = true;
    }

    public function openEditModal($id)
    {
        $payment = Payments::findOrFail($id);
        $this->paymentId = $payment->id;
        $this->payment_code = $payment->payment_code;
        $this->payment_method = $payment->payment_method;
        $this->payment_bank = $payment->payment_bank;
        $this->payment_account_name = $payment->payment_account_name;
        $this->payment_account_number = $payment->payment_account_number;
        $this->status = $payment->status;
        
        $this->showEditModal = true;
    }

    public function openDetailModal($id)
    {
        $this->detailPayment = Payments::with(['transactions' => function($query) {
            $query->with('user')->latest()->take(5);
        }])
        ->withCount('transactions')
        ->findOrFail($id);
        
        $this->showDetailModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->paymentId = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showDetailModal = false;
        $this->showDeleteModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'paymentId', 'payment_code', 'payment_method', 'payment_bank',
            'payment_account_name', 'payment_account_number', 'status'
        ]);
        $this->resetValidation();
    }

    public function createPayment()
    {
        $validated = $this->validate([
            'payment_code' => 'required|string|max:255|unique:payments,payment_code',
            'payment_method' => 'required|string|max:255',
            'payment_bank' => 'required|string|max:255',
            'payment_account_name' => 'required|string|max:255',
            'payment_account_number' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Payments::create($validated);

        $this->toastMessage = 'Metode pembayaran berhasil ditambahkan';
        $this->toastType = 'success';
        $this->closeModal();
    }

    public function updatePayment()
    {
        $payment = Payments::findOrFail($this->paymentId);

        $validated = $this->validate([
            'payment_code' => 'required|string|max:255|unique:payments,payment_code,' . $this->paymentId,
            'payment_method' => 'required|string|max:255',
            'payment_bank' => 'required|string|max:255',
            'payment_account_name' => 'required|string|max:255',
            'payment_account_number' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $payment->update($validated);

        $this->toastMessage = 'Metode pembayaran berhasil diperbarui';
        $this->toastType = 'success';
        $this->closeModal();
    }

    public function deletePayment()
    {
        $payment = Payments::find($this->paymentId);
        
        if ($payment) {
            // Check if payment has active transactions
            $activeTransactions = $payment->transactions()->where('status', 'active')->count();
            
            if ($activeTransactions > 0) {
                $this->toastMessage = 'Tidak dapat menghapus metode pembayaran yang memiliki transaksi aktif';
                $this->toastType = 'error';
            } else {
                $payment->delete();
                $this->toastMessage = 'Metode pembayaran berhasil dihapus';
                $this->toastType = 'success';
            }
        }

        $this->closeModal();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'methodFilter']);
        $this->resetPage();
    }

    public function generatePaymentCode()
    {
        // Get the latest payment code
        $lastPayment = Payments::orderBy('id', 'desc')->first();
        
        if ($lastPayment && $lastPayment->payment_code) {
            // Extract number from last payment code (assuming format like PAY-001, etc.)
            preg_match('/(\w+)-(\d+)/', $lastPayment->payment_code, $matches);
            
            if (count($matches) >= 3) {
                $prefix = $matches[1];
                $number = (int)$matches[2] + 1;
                $this->payment_code = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
            } else {
                // Fallback if format doesn't match
                $this->payment_code = 'PAY-001';
            }
        } else {
            // First payment
            $this->payment_code = 'PAY-001';
        }
    }

    public function render()
    {
        $payments = Payments::query()
            ->withCount('transactions')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('payment_method', 'like', '%' . $this->search . '%')
                        ->orWhere('payment_code', 'like', '%' . $this->search . '%')
                        ->orWhere('payment_bank', 'like', '%' . $this->search . '%')
                        ->orWhere('payment_account_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== '', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->methodFilter, function ($query) {
                $query->where('payment_method', $this->methodFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Add last transaction date for each payment using a separate query
        $payments->getCollection()->transform(function ($payment) {
            $lastTransaction = \App\Models\Transaction::where('payment_id', $payment->id)
                ->latest('created_at')
                ->first(['created_at']);
            $payment->last_transaction_date = $lastTransaction?->created_at;
            return $payment;
        });

        return view('livewire.admin.payments.index', [
            'payments' => $payments
        ]);
    }
}
