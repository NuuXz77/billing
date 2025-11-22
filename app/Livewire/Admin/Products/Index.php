<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Products;
use App\Models\Transaction;

#[Layout('components.layouts.app')]
#[Title('Products Management')]
class Index extends Component
{
    use WithPagination;

    // Filter & Search
    public $search = '';
    public $statusFilter = '';
    public $priceRange = '';
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
    public $productId;
    public $product_code = '';
    public $name_product = '';
    public $domain_included = false;
    public $ssh_access = false;
    public $email_feature = false;
    public $database_feature = false;
    public $ssl_included = false;
    public $storage = '';
    public $price_monthly = '';
    public $description = '';
    public $status = true;

    // Detail View
    public $detailProduct;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPriceRange()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->generateProductCode();
        $this->showCreateModal = true;
    }

    public function openEditModal($id)
    {
        $product = Products::findOrFail($id);
        $this->productId = $product->id;
        $this->product_code = $product->product_code;
        $this->name_product = $product->name_product;
        $this->domain_included = $product->domain_included;
        $this->ssh_access = $product->ssh_access;
        $this->email_feature = $product->email_feature;
        $this->database_feature = $product->database_feature;
        $this->ssl_included = $product->ssl_included;
        $this->storage = $product->storage;
        $this->price_monthly = $product->price_monthly;
        $this->description = $product->description;
        $this->status = $product->status;
        
        $this->showEditModal = true;
    }

    public function openDetailModal($id)
    {
        $this->detailProduct = Products::with(['transactions' => function($query) {
            $query->with('user')->latest()->take(5);
        }])
        ->withCount('transactions')
        ->findOrFail($id);
        
        $this->showDetailModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->productId = $id;
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
            'productId', 'product_code', 'name_product', 'domain_included', 
            'ssh_access', 'email_feature', 'database_feature', 'ssl_included',
            'storage', 'price_monthly', 'description', 'status'
        ]);
        $this->resetValidation();
    }

    public function createProduct()
    {
        $validated = $this->validate([
            'product_code' => 'required|string|max:255|unique:products,product_code',
            'name_product' => 'required|string|max:255',
            'domain_included' => 'boolean',
            'ssh_access' => 'boolean',
            'email_feature' => 'boolean',
            'database_feature' => 'boolean',
            'ssl_included' => 'boolean',
            'storage' => 'required|string|max:255',
            'price_monthly' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Convert string to boolean
        $validated['status'] = (bool) $validated['status'];

        Products::create($validated);

        $this->toastMessage = 'Produk berhasil ditambahkan';
        $this->toastType = 'success';
        $this->closeModal();
    }

    public function updateProduct()
    {
        $product = Products::findOrFail($this->productId);

        $validated = $this->validate([
            'product_code' => 'required|string|max:255|unique:products,product_code,' . $this->productId,
            'name_product' => 'required|string|max:255',
            'domain_included' => 'boolean',
            'ssh_access' => 'boolean',
            'email_feature' => 'boolean',
            'database_feature' => 'boolean',
            'ssl_included' => 'boolean',
            'storage' => 'required|max:255',
            'price_monthly' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Convert string to boolean
        $validated['status'] = (bool) $validated['status'];

        $product->update($validated);

        $this->toastMessage = 'Produk berhasil diperbarui';
        $this->toastType = 'success';
        $this->closeModal();
    }

    public function deleteProduct()
    {
        $product = Products::find($this->productId);
        
        if ($product) {
            // Check if product has active transactions
            $activeTransactions = $product->transactions()->where('status', 'active')->count();
            
            if ($activeTransactions > 0) {
                $this->toastMessage = 'Tidak dapat menghapus produk yang memiliki transaksi aktif';
                $this->toastType = 'error';
            } else {
                $product->delete();
                $this->toastMessage = 'Produk berhasil dihapus';
                $this->toastType = 'success';
            }
        }

        $this->closeModal();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'priceRange']);
        $this->resetPage();
    }

    public function generateProductCode()
    {
        // Get the latest product code
        $lastProduct = Products::orderBy('id', 'desc')->first();
        
        if ($lastProduct && $lastProduct->product_code) {
            // Extract number from last product code (assuming format like HST-001, PRD-001, etc.)
            preg_match('/(\w+)-(\d+)/', $lastProduct->product_code, $matches);
            
            if (count($matches) >= 3) {
                $prefix = $matches[1];
                $number = (int)$matches[2] + 1;
                $this->product_code = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
            } else {
                // Fallback if format doesn't match
                $this->product_code = 'HST-001';
            }
        } else {
            // First product
            $this->product_code = 'HST-001';
        }
    }

    public function render()
    {
        $products = Products::query()
            ->withCount('transactions')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name_product', 'like', '%' . $this->search . '%')
                        ->orWhere('product_code', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->priceRange, function ($query) {
                switch ($this->priceRange) {
                    case '0-50000':
                        $query->where('price_monthly', '<', 50000);
                        break;
                    case '50000-100000':
                        $query->whereBetween('price_monthly', [50000, 100000]);
                        break;
                    case '100000-200000':
                        $query->whereBetween('price_monthly', [100000, 200000]);
                        break;
                    case '200000-up':
                        $query->where('price_monthly', '>', 200000);
                        break;
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Add last sale date for each product using a separate query
        $products->getCollection()->transform(function ($product) {
            $lastTransaction = \App\Models\Transaction::where('product_id', $product->id)
                ->latest('created_at')
                ->first(['created_at']);
            $product->last_sale_date = $lastTransaction?->created_at;
            return $product;
        });

        return view('livewire.admin.products.index', [
            'products' => $products
        ]);
    }
}
