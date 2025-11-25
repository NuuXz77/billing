<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

#[Layout('components.layouts.app')]
#[Title('Users Management')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    // Filter & Search
    public $search = '';
    public $roleFilter = '';
    public $statusFilter = '';
    public $perPage = 10;
    
    // Sorting properties
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Modal States
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDetailModal = false;
    public $showDeleteModal = false;

    // Toast Notification
    public $toastMessage = '';
    public $toastType = ''; // 'success' or 'error'

    // Form Fields
    public $userId;
    public $full_name = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'member';
    public $status = 'active';
    public $phone = '';
    public $address = '';
    public $district = '';
    public $city = '';
    public $province = '';
    public $pos_code = '';
    public $country = 'Indonesia';
    public $company_name = '';
    public $foto_profile;
    public $currentFotoProfile = '';

    // Detail View
    public $detailUser;

    // Mount method untuk handle filter dari dashboard
    public function mount()
    {
        // Cek apakah ada filter status dari session (dari dashboard)
        if (session()->has('user_filter_status')) {
            $this->statusFilter = session('user_filter_status');
            
            // Hapus session setelah digunakan
            session()->forget('user_filter_status');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
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

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function openEditModal($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->full_name = $user->full_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->district = $user->district;
        $this->city = $user->city;
        $this->province = $user->province;
        $this->pos_code = $user->pos_code;
        $this->country = $user->country ?? 'Indonesia';
        $this->company_name = $user->company_name;
        $this->currentFotoProfile = $user->foto_profile;
        
        $this->showEditModal = true;
    }

    public function openDetailModal($id)
    {
        $this->detailUser = User::findOrFail($id);
        $this->showDetailModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->userId = $id;
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
            'userId', 'full_name', 'username', 'email', 'password', 'password_confirmation',
            'role', 'status', 'phone', 'address', 'district', 'city', 'province',
            'pos_code', 'country', 'company_name', 'foto_profile', 'currentFotoProfile'
        ]);
        $this->resetValidation();
    }

    public function createUser()
    {
        $validated = $this->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
            'role' => 'required|in:admin,member',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $validated['user_code'] = 'MBR-' . strtoupper(uniqid());
        $validated['password'] = Hash::make($validated['password']);
        $validated['last_active'] = now();

        User::create($validated);

        $this->toastMessage = 'User berhasil ditambahkan';
        $this->toastType = 'success';
        $this->closeModal();
    }

    public function updateUser()
    {
        $user = User::findOrFail($this->userId);

        $validated = $this->validate([
            'full_name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'role' => 'required|in:admin,member',
            'status' => 'required|in:active,inactive,suspended',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'pos_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
            'company_name' => 'nullable|string|max:255',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle foto profile upload
        if ($this->foto_profile) {
            // Delete old photo
            if ($user->foto_profile && Storage::exists('public/' . $user->foto_profile)) {
                Storage::delete('public/' . $user->foto_profile);
            }

            $filename = time() . '_' . $this->foto_profile->getClientOriginalName();
            $this->foto_profile->storeAs('public/profiles', $filename);
            $validated['foto_profile'] = 'profiles/' . $filename;
        }

        // Update password only if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        $this->toastMessage = 'User berhasil diperbarui';
        $this->toastType = 'success';
        $this->closeModal();
    }

    public function deleteUser()
    {
        $user = User::find($this->userId);
        
        if ($user && $user->id !== auth()->id()) {
            // Delete foto profile if exists
            if ($user->foto_profile && Storage::exists('public/' . $user->foto_profile)) {
                Storage::delete('public/' . $user->foto_profile);
            }
            
            $user->delete();
            $this->toastMessage = 'User berhasil dihapus';
            $this->toastType = 'success';
        } else {
            $this->toastMessage = 'Tidak dapat menghapus akun sendiri';
            $this->toastType = 'error';
        }

        $this->closeModal();
    }

    public function render()
    {
        $users = User::query()
            ->withCount('transactions')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('username', 'like', '%' . $this->search . '%')
                        ->orWhere('user_code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->where('role', $this->roleFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->sortField, function ($query) {
                if ($this->sortField === 'transactions_count') {
                    $query->orderBy('transactions_count', $this->sortDirection);
                } else {
                    $query->orderBy($this->sortField, $this->sortDirection);
                }
            }, function ($query) {
                $query->orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
                      ->orderBy('created_at', 'desc');
            })
            ->paginate($this->perPage);

        // Add last transaction date for each user using a separate query
        $users->getCollection()->transform(function ($user) {
            $lastTransaction = \App\Models\Transaction::where('user_id', $user->id)
                ->latest('created_at')
                ->first(['created_at']);
            $user->last_transaction_date = $lastTransaction?->created_at;
            return $user;
        });

        return view('livewire.admin.users.index', [
            'users' => $users
        ]);
    }

    public function generatePassword()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $this->password = substr(str_shuffle($chars), 0, 12);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'roleFilter', 'statusFilter']);
        // atau
        $this->search = '';
        $this->roleFilter = '';
        $this->statusFilter = '';
    }
}
