{{-- Detail User Modal --}}
<input type="checkbox" wire:model="showDetailModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-3xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold">Detail User</h3>
                <p class="text-sm text-neutral mt-1">Informasi lengkap pengguna</p>
            </div>
            <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        @if($detailUser)
            <div class="space-y-6">
                {{-- Profile Section --}}
                <div class="flex flex-col items-center text-center p-6 bg-base-200 rounded-xl">
                    <div class="avatar mb-4">
                        <div class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            @if($detailUser->foto_profile)
                                <img src="{{ Storage::url($detailUser->foto_profile) }}" alt="{{ $detailUser->full_name }}">
                            @else
                                <div class="bg-primary text-primary-content w-full h-full flex items-center justify-center text-3xl font-bold">
                                    {{ strtoupper(substr($detailUser->full_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <h4 class="text-xl font-bold">{{ $detailUser->full_name }}</h4>
                    <p class="text-sm text-base-content/60 font-mono">{{ $detailUser->user_code }}</p>
                    <div class="flex gap-2 mt-3">
                        @if($detailUser->role === 'admin')
                            <span class="badge badge-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Admin
                            </span>
                        @else
                            <span class="badge badge-ghost">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Member
                            </span>
                        @endif
                        @if($detailUser->status === 'active')
                            <span class="badge badge-success badge-soft">
                                <div class="status status-success mr-1"></div>
                                Active
                            </span>
                        @elseif($detailUser->status === 'inactive')
                            <span class="badge badge-warning badge-soft">
                                <div class="status status-warning mr-1"></div>
                                Inactive
                            </span>
                        @else
                            <span class="badge badge-error badge-soft">
                                <div class="status status-error mr-1"></div>
                                Suspended
                            </span>
                        @endif
                    </div>
                </div>

                {{-- User Information --}}
                <div>
                    <h5 class="text-lg font-semibold mb-4">Informasi Dasar</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-base-100 border border-base-300 rounded-lg">
                            <p class="text-sm text-base-content/60 mb-1">Username</p>
                            <p class="font-semibold">{{ $detailUser->username ?? '-' }}</p>
                        </div>
                        <div class="p-4 bg-base-100 border border-base-300 rounded-lg">
                            <p class="text-sm text-base-content/60 mb-1">Email</p>
                            <p class="font-semibold break-all">{{ $detailUser->email }}</p>
                        </div>
                        <div class="p-4 bg-base-100 border border-base-300 rounded-lg">
                            <p class="text-sm text-base-content/60 mb-1">Bergabung</p>
                            <p class="font-semibold">{{ $detailUser->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="p-4 bg-base-100 border border-base-300 rounded-lg">
                            <p class="text-sm text-base-content/60 mb-1">Terakhir Diperbarui</p>
                            <p class="font-semibold">{{ $detailUser->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Activity Information --}}
                <div>
                    <h5 class="text-lg font-semibold mb-4">Aktivitas</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-base-100 border border-base-300 rounded-lg">
                            <p class="text-sm text-base-content/60 mb-1">Status Online</p>
                            @php
                                $isOnline = $detailUser->last_active && $detailUser->last_active->diffInMinutes(now()) <= 5;
                            @endphp
                            @if($isOnline)
                                <div class="flex items-center gap-2">
                                    <div class="inline-grid *:[grid-area:1/1]">
                                        <div class="status status-success animate-ping"></div>
                                        <div class="status status-success"></div>
                                    </div>
                                    <span class="font-semibold text-success">Online</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <div class="inline-grid *:[grid-area:1/1]">
                                        <div class="status status-error"></div>
                                    </div>
                                    <span class="font-semibold text-base-content/60">Offline</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 bg-base-100 border border-base-300 rounded-lg">
                            <p class="text-sm text-base-content/60 mb-1">Terakhir Aktif</p>
                            <p class="font-semibold">
                                {{ $detailUser->last_active ? $detailUser->last_active->diffForHumans() : 'Belum pernah login' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Modal Actions --}}
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-base-300">
            <button type="button" wire:click="closeModal" class="btn btn-outline btn-neutral">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Tutup
            </button>
        </div>
    </div>
    <label class="modal-backdrop" wire:click="closeModal"></label>
</div>
