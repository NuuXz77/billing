{{-- Detail User Modal --}}
<input type="checkbox" wire:model="showDetailModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-3xl">
        <h3 class="text-lg font-bold mb-4">Detail User</h3>
        
        @if($detailUser)
            <div class="space-y-4">
                {{-- Profile Photo --}}
                <div class="flex justify-center mb-6">
                    <div class="avatar">
                        <div class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            @if($detailUser->foto_profile)
                                <img src="{{ Storage::url($detailUser->foto_profile) }}" alt="{{ $detailUser->full_name }}">
                            @else
                                <div class="bg-primary text-primary-content w-full h-full flex items-center justify-center text-3xl font-bold">
                                    {{ substr($detailUser->full_name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- User Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-base-content/60">User Code</p>
                        <p class="font-semibold">{{ $detailUser->user_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Nama Lengkap</p>
                        <p class="font-semibold">{{ $detailUser->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Username</p>
                        <p class="font-semibold">{{ $detailUser->username ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Email</p>
                        <p class="font-semibold">{{ $detailUser->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Role</p>
                        <p>
                            @if($detailUser->role === 'admin')
                                <span class="badge badge-primary">Admin</span>
                            @else
                                <span class="badge badge-ghost">Member</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Status</p>
                        <p>
                            @if($detailUser->status === 'active')
                                <span class="badge badge-success">Active</span>
                            @elseif($detailUser->status === 'inactive')
                                <span class="badge badge-warning">Inactive</span>
                            @else
                                <span class="badge badge-error">Suspended</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">No. Telepon</p>
                        <p class="font-semibold">{{ $detailUser->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Perusahaan</p>
                        <p class="font-semibold">{{ $detailUser->company_name ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-base-content/60">Alamat</p>
                        <p class="font-semibold">{{ $detailUser->address ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Kecamatan</p>
                        <p class="font-semibold">{{ $detailUser->district ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Kota</p>
                        <p class="font-semibold">{{ $detailUser->city ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Provinsi</p>
                        <p class="font-semibold">{{ $detailUser->province ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Kode Pos</p>
                        <p class="font-semibold">{{ $detailUser->pos_code ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Negara</p>
                        <p class="font-semibold">{{ $detailUser->country ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Terakhir Aktif</p>
                        <p class="font-semibold">{{ $detailUser->last_active ? $detailUser->last_active->diffForHumans() : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Bergabung</p>
                        <p class="font-semibold">{{ $detailUser->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Terakhir Diperbarui</p>
                        <p class="font-semibold">{{ $detailUser->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal-action">
            <button type="button" wire:click="closeModal" class="btn">Tutup</button>
        </div>
    </div>
    <label class="modal-backdrop" wire:click="closeModal"></label>
</div>
