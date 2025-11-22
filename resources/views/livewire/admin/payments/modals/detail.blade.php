{{-- Detail Payment Modal --}}
<input type="checkbox" wire:model="showDetailModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto no-scrollbar">
        @if ($detailPayment)
            {{-- Modal Header --}}
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
                <div>
                    <h3 class="text-xl font-bold">Detail Metode Pembayaran</h3>
                    <p class="text-sm text-neutral mt-1">Informasi lengkap metode pembayaran</p>
                </div>
                <button @click="$wire.set('showDetailModal', false)" class="btn btn-sm btn-circle btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Payment Info Card --}}
                <div class="col-span-2">
                    <div class="card bg-gradient-to-r from-primary/10 to-primary/5 border border-primary/20">
                        <div class="card-body">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-2xl font-bold text-primary mb-1">{{ $detailPayment->payment_method }}</h4>
                                    <p class="text-sm text-neutral mb-3">{{ $detailPayment->payment_code }}</p>
                                    
                                    <div class="flex items-center gap-4 mb-4">
                                        @if($detailPayment->status === 'active')
                                            <div class="badge badge-soft badge-success">
                                                <div class="status status-success mr-1"></div>
                                                Aktif
                                            </div>
                                        @else
                                            <div class="badge badge-soft badge-error">
                                                <div class="status status-error mr-1"></div>
                                                Tidak Aktif
                                            </div>
                                        @endif
                                        <div class="flex items-center gap-2 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                            <span class="font-semibold">{{ $detailPayment->transactions_count ?? 0 }} Transaksi</span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-neutral">Bank/Provider:</span>
                                            <p class="font-semibold">{{ $detailPayment->payment_bank }}</p>
                                        </div>
                                        <div>
                                            <span class="text-neutral">Nama Akun:</span>
                                            <p class="font-semibold">{{ $detailPayment->payment_account_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Account Information --}}
                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h5 class="card-title text-lg mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Informasi Akun
                        </h5>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-neutral">Nomor Rekening/Akun:</label>
                                <p class="font-mono text-lg font-semibold bg-base-200 p-2 rounded">{{ $detailPayment->payment_account_number }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-neutral">Nama Pemilik:</label>
                                <p class="font-semibold">{{ $detailPayment->payment_account_name }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-neutral">Bank/Provider:</label>
                                <p class="font-semibold">{{ $detailPayment->payment_bank }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Transaction Statistics --}}
                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h5 class="card-title text-lg mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Statistik Transaksi
                        </h5>
                        
                        <div class="stats stats-vertical shadow">
                            <div class="stat">
                                <div class="stat-title">Total Transaksi</div>
                                <div class="stat-value text-primary">{{ $detailPayment->transactions_count ?? 0 }}</div>
                                <div class="stat-desc">Semua transaksi</div>
                            </div>
                            
                            <div class="stat">
                                <div class="stat-title">Dibuat</div>
                                <div class="stat-value text-xs">{{ $detailPayment->created_at->format('d M Y') }}</div>
                                <div class="stat-desc">{{ $detailPayment->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Transactions --}}
                @if($detailPayment->transactions && $detailPayment->transactions->count() > 0)
                    <div class="col-span-2">
                        <div class="card bg-base-100 border border-base-300">
                            <div class="card-body">
                                <h5 class="card-title text-lg mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Transaksi Terbaru
                                </h5>
                                
                                <div class="overflow-x-auto">
                                    <table class="table table-hover w-full">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detailPayment->transactions->take(5) as $transaction)
                                                <tr>
                                                    <td>
                                                        <div class="flex items-center gap-3">
                                                            <div class="avatar placeholder">
                                                                <div class="bg-neutral text-neutral-content rounded-full w-8 h-8">
                                                                    <span class="text-xs">{{ substr($transaction->user->name ?? 'U', 0, 1) }}</span>
                                                                </div>
                                                            </div>
                                                            <span class="font-medium">{{ $transaction->user->name ?? 'Unknown User' }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="font-mono">Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}</td>
                                                    <td>
                                                        @switch($transaction->status)
                                                            @case('completed')
                                                                <div class="badge badge-success badge-sm">Selesai</div>
                                                                @break
                                                            @case('pending')
                                                                <div class="badge badge-warning badge-sm">Pending</div>
                                                                @break
                                                            @case('failed')
                                                                <div class="badge badge-error badge-sm">Gagal</div>
                                                                @break
                                                            @default
                                                                <div class="badge badge-neutral badge-sm">{{ $transaction->status }}</div>
                                                        @endswitch
                                                    </td>
                                                    <td class="text-sm text-neutral">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($detailPayment->transactions_count > 5)
                                    <div class="text-center mt-4">
                                        <div class="text-sm text-neutral">Dan {{ $detailPayment->transactions_count - 5 }} transaksi lainnya...</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-span-2">
                        <div class="card bg-base-100 border border-base-300">
                            <div class="card-body">
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    <p class="font-semibold text-slate-600">Belum ada transaksi</p>
                                    <p class="text-sm text-slate-400">Metode pembayaran ini belum pernah digunakan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action pt-6 border-t border-base-300">
                <button type="button" @click="$wire.set('showDetailModal', false)" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Tutup
                </button>
                <button wire:click="openEditModal({{ $detailPayment->id }})" class="btn btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Metode
                </button>
            </div>
        @endif
    </div>
    <label class="modal-backdrop" @click="$wire.set('showDetailModal', false)">Close</label>
</div>