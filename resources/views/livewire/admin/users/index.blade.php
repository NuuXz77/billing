<div>
    {{-- breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-">Manajemen Users</h1>
            <p class="text-base-content/60">Kelola semua pengguna di sistem</p>
        </div>
        <div>
            <div class="breadcrumbs text-sm">
                <ul>
                    <li>
                        @if (auth()->user()->role === 'admin')
                            <a href="/admin/dashboard" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Beranda
                            </a>
                        @else
                            <a href="/dashboard" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Beranda
                            </a>
                        @endif
                        <a>

                        </a>
                    </li>
                    <li>
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-4 w-4 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                </path>
                            </svg>
                            Users
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{-- Success/Error Messages --}}
    {{-- @if (session()->has('success'))
        <div class="alert alert-success mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif --}}
        {{-- Toast Notification --}}
    @if($toastMessage)
        <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
            @if($toastType === 'success')
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @else
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @endif
        </div>
    @endif

    {{-- Table Card --}}
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            {{-- Filters & Actions Bar --}}
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                {{-- Search --}}
                <div class="flex-1">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Cari nama, email, username..." class="input input-bordered w-full">
                </div>

                {{-- Role Filter --}}
                <div class="w-full md:w-40">
                    <select wire:model.live="roleFilter" class="select select-bordered w-full">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                </div>

                {{-- Status Filter --}}
                <div class="w-full md:w-40">
                    <select wire:model.live="statusFilter" class="select select-bordered w-full">
                        <option value="">Semua Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>

                {{-- Add User Button --}}
                <div>
                    <button wire:click="openCreateModal" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah User
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="bg-base-200">Foto</th>
                            <th class="bg-base-200">Nama Lengkap</th>
                            <th class="bg-base-200">Email</th>
                            <th class="bg-base-200">Username</th>
                            <th class="bg-base-200">Role</th>
                            <th class="bg-base-200">Status</th>
                            <th class="bg-base-200">Bergabung</th>
                            <th class="bg-base-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr wire:key="user-{{ $user->id }}">
                                {{-- Foto Profile --}}
                                <td>
                                    <div class="avatar">
                                        <div class="w-10 h-10 rounded-full">
                                            @if ($user->foto_profile)
                                                <img src="{{ Storage::url($user->foto_profile) }}"
                                                    alt="{{ $user->full_name }}">
                                            @else
                                                <div
                                                    class="bg-primary text-primary-content w-full h-full flex items-center justify-center font-semibold">
                                                    {{ substr($user->full_name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Full Name --}}
                                <td>
                                    <div class="font-semibold">{{ $user->full_name }}</div>
                                    <div class="text-sm text-base-content/60">{{ $user->user_code }}</div>
                                </td>

                                {{-- Email --}}
                                <td>{{ $user->email }}</td>

                                {{-- Username --}}
                                <td>{{ $user->username ?? '-' }}</td>

                                {{-- Role Badge --}}
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge badge-primary">Admin</span>
                                    @else
                                        <span class="badge badge-ghost">Member</span>
                                    @endif
                                </td>

                                {{-- Status Badge --}}
                                <td>
                                    @if ($user->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($user->status === 'inactive')
                                        <span class="badge badge-warning">Inactive</span>
                                    @else
                                        <span class="badge badge-error">Suspended</span>
                                    @endif
                                </td>

                                {{-- Created At --}}
                                <td>
                                    <div class="text-sm">{{ $user->created_at->format('d M, Y') }}</div>
                                    <div class="text-xs text-base-content/60">{{ $user->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td>
                                    <div class="flex gap-2 justify-center">
                                        {{-- View --}}
                                        <button wire:click="openDetailModal({{ $user->id }})" 
                                            class="btn btn-ghost btn-sm" title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        {{-- Edit --}}
                                        <button wire:click="openEditModal({{ $user->id }})" 
                                            class="btn btn-ghost btn-sm" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>

                                        {{-- Delete --}}
                                        @if ($user->id !== auth()->id())
                                            <button wire:click="openDeleteModal({{ $user->id }})"
                                                class="btn btn-ghost btn-sm text-error" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-base-content/60">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 opacity-50"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p>Tidak ada data user</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('livewire.admin.users.modals.create')
    @include('livewire.admin.users.modals.edit')
    @include('livewire.admin.users.modals.detail')
    @include('livewire.admin.users.modals.delete')
</div>
