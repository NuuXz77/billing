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
    @if ($toastMessage)
        <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            x-transition>
            @if ($toastType === 'success')
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @else
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @endif
        </div>
    @endif

    {{-- Modern Table Card --}}
    <div class="card bg-base-100 border border-base-300">
        <div class="card-body">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="card-title text-2xl">Daftar Pengguna</h2>
                    <p class="text-slate-600">Kelola dan pantau aktivitas pengguna</p>
                </div>
                <div class="badge badge-neutral badge-soft">{{ $users->total() }} Total</div>
            </div>

            {{-- Clean Filters & Actions Bar --}}
            <div class="card p-5 bg-base-100 border border-base-300">
                {{-- Main Controls Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">
                    {{-- Search Field --}}
                    <div class="col-span-1 lg:col-span-6">
                        <label class="input w-full">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                    stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </g>
                            </svg>
                            <input type="search" class="grow" wire:model.live.debounce.300ms="search"
                                placeholder="Search" />
                        </label>
                    </div>

                    {{-- Role Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="roleFilter" class="select w-full">
                            <option value="">Semua Role</option>
                            <option value="admin">Admin</option>
                            <option value="member">Member</option>
                        </select>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="statusFilter" class="select w-full">
                            <option value="">Semua Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-span-1 lg:col-span-2 flex gap-2">
                        <div class="grid grid-cols-2 gap-2 w-full">
                            <button wire:click="openCreateModal" class="btn btn-primary w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-ghost w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </div>
                                <ul tabindex="0"
                                    class="dropdown-content menu rounded-box z-50 w-52 p-2 shadow-xl bg-base-100 border border-base-300">
                                    <li><a
                                            class="rounded-lg px-3 py-2 hover:text-neutral hover:bg-neutral/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Export Data
                                        </a></li>
                                    <li><a
                                            class="rounded-lg px-3 py-2 hover:text-success hover:bg-success/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                            </svg>
                                            Import Data
                                        </a></li>
                                    <div class="divider my-1"></div>
                                    <li><a
                                            class="rounded-lg px-3 py-2 hover:text-warning hover:bg-warning/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Refresh Data
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Active Filters Display --}}
                @if ($search || $roleFilter || $statusFilter)
                    <div class="mt-4 pt-4 border-t border-base-300">
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-sm font-medium text-slate-600 mr-2">Filter aktif:</span>
                            @if ($search)
                                <div
                                    class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    "{{ $search }}"
                                    <button wire:click="$set('search', '')"
                                        class="hover:bg-blue-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if ($roleFilter)
                                <div
                                    class="inline-flex items-center gap-2 bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    {{ ucfirst($roleFilter) }}
                                    <button wire:click="$set('roleFilter', '')"
                                        class="hover:bg-purple-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if ($statusFilter)
                                <div
                                    class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ ucfirst($statusFilter) }}
                                    <button wire:click="$set('statusFilter', '')"
                                        class="hover:bg-green-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <button wire:click="resetFilters"
                                class="inline-flex items-center gap-1 text-red-600 hover:bg-red-50 px-3 py-1 rounded-full text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset semua
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Modern Table --}}
            <div class="overflow-x-auto card p-5 bg-base-100 border border-base-300">
                <table class="table table-hover w-full">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="font-semibold text-center w-16">No</th>
                            <th class="font-semibold min-w-[250px]">Pengguna</th>
                            <th class="font-semibold text-center min-w-[140px]">Role & Status</th>
                            <th class="font-semibold text-center min-w-[150px]">Transaksi</th>
                            <th class="font-semibold text-center min-w-[150px]">Aktivitas</th>
                            <th class="font-semibold text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr class="hover transition-colors hover:bg-base-200">
                                {{-- Number --}}
                                <td class="font-mono text-sm text-center font-semibold">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                                </td>

                                {{-- User Info --}}
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12 rounded-xl shadow-sm">
                                                @if ($user->foto_profile)
                                                    <img src="{{ asset($user->foto_profile) }}"
                                                        alt="{{ $user->full_name }}" class="rounded-xl">
                                                @else
                                                    <div
                                                        class="bg-base-300 w-full h-full flex items-center justify-center font-bold text-lg rounded-xl shadow-sm">
                                                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-semibold text-primary truncate">{{ $user->full_name }}
                                            </div>
                                            <div class="text-sm">{{ $user->email }}</div>
                                            <div class="text-xs text-neutral">{{ $user->user_code }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Role & Status --}}
                                <td class="text-center">
                                    <div class="flex flex-col gap-2 items-center">
                                        @if ($user->role === 'admin')
                                            <span class="badge badge-primary badge-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                                Admin
                                            </span>
                                        @else
                                            <span class="badge badge-ghost badge-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                Member
                                            </span>
                                        @endif

                                        @if ($user->status === 'active')
                                            <div class="badge badge-soft badge-success">
                                                <div aria-label="status" class="status status-success"></div> Active
                                            </div>
                                        @elseif($user->status === 'inactive')
                                            <div class="badge badge-soft badge-warning">
                                                <div aria-label="status" class="status status-success"></div> Inactive
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Transaction Info --}}
                                <td class="text-center">
                                    <div class="flex flex-col gap-1 items-center">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <span class="font-semibold">{{ $user->transactions_count ?? 0 }}</span>
                                            <span class="text-xs">transaksi</span>
                                        </div>
                                        @if (isset($user->last_transaction_date) && $user->last_transaction_date)
                                            <div class="text-xs text-slate-400">
                                                Terakhir:
                                                {{ \Carbon\Carbon::parse($user->last_transaction_date)->format('d M Y') }}
                                            </div>
                                        @else
                                            <div class="text-xs text-slate-400">Belum ada transaksi</div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Activity Info --}}
                                <td class="text-center">
                                    <div class="flex flex-col gap-1 items-center">
                                        {{-- Online Status --}}
                                        <div class="flex items-center gap-2">
                                            @php
                                                $isOnline =
                                                    $user->last_active && $user->last_active->diffInMinutes(now()) <= 5 && $user->status === 'active';
                                            @endphp
                                            @if ($isOnline)
                                                <div class="inline-grid *:[grid-area:1/1]">
                                                    <div class="status status-success animate-ping"></div>
                                                    <div class="status status-success"></div>
                                                </div>
                                                <span class="text-xs font-medium text-success">Online</span>
                                            @else
                                                <div class="inline-grid *:[grid-area:1/1]">
                                                    <div class="status status-error"></div>
                                                </div>
                                                <span class="text-xs font-medium text-error">Offline</span>
                                            @endif
                                        </div>

                                        {{-- Last Active --}}
                                        @if ($user->last_active)
                                            <div class="text-xs text-slate-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $user->last_active->diffForHumans() }}
                                            </div>
                                        @else
                                            <div class="text-xs text-slate-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Belum pernah login
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Actions Dropdown --}}
                                <td>
                                    <div class="flex justify-center">
                                        @php
                                            // Determine if this is one of the last rows to show dropdown upward
                                            $totalUsers = $users->count();
                                            $currentIndex = $loop->index;
                                            $isLastRows = $totalUsers - $currentIndex <= 3; // Last 3 rows
                                        @endphp
                                        <div class="dropdown dropdown-end {{ $isLastRows ? 'dropdown-top' : '' }}">
                                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </div>
                                            <ul tabindex="0"
                                                class="dropdown-content menu rounded-box z-50 w-52 p-2 shadow-xl bg-base-100 border border-base-300 {{ $isLastRows ? 'mb-2' : 'mt-2' }}">
                                                <li>
                                                    <button wire:click="openDetailModal({{ $user->id }})"
                                                        class="text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Lihat Detail
                                                    </button>
                                                </li>
                                                <li>
                                                    <button wire:click="openEditModal({{ $user->id }})"
                                                        class="text-warning hover:bg-warning/10 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit Data
                                                    </button>
                                                </li>
                                                @if ($user->id !== auth()->id())
                                                    <li>
                                                        <button wire:click="openDeleteModal({{ $user->id }})"
                                                            class="text-error hover:bg-error/10 rounded-lg transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Hapus User
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <div
                                            class=">
                                            <p class="font-semibold">
                                            Tidak ada pengguna ditemukan</p>
                                            <p class="text-sm">Coba ubah filter atau tambahkan pengguna baru</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Custom Pagination --}}
            <div class="mt-6">
                <x-pagination.custom :paginator="$users" :showingText="true"
                    showingFormat="Menampilkan {from} - {to} dari {total} pengguna" size="default" />
            </div>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('livewire.admin.users.modals.create')
    @include('livewire.admin.users.modals.edit')
    @include('livewire.admin.users.modals.detail')
    @include('livewire.admin.users.modals.delete')
</div>
