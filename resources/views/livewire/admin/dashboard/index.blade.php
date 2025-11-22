<div>
    {{-- grid 4 stat --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="card-title text-lg">Total Member</h2>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-sm bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <p class="text-3xl font-bold">{{ number_format($totalMembers) }}</p>
                    <div class="flex items-center gap-2">
                        <div class="badge badge-success badge-soft badge-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            +{{ $totalMembers > 0 ? '12' : '0' }}%
                        </div>
                        <p class="text-sm text-slate-500">dari bulan lalu</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="card-title text-lg">Langganan Aktif</h2>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-sm bg-success/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <p class="text-3xl font-bold">{{ number_format($activeSubscriptions) }}</p>
                    <div class="flex items-center gap-2">
                        <div class="badge {{ $activeSubscriptions > 0 ? 'badge-success' : 'badge-warning' }} badge-soft badge-sm">
                            {{ $activeSubscriptions > 0 ? 'Aktif' : 'Kosong' }}
                        </div>
                        <p class="text-sm text-slate-500">langganan berjalan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="card-title text-lg">Pendapatan</h2>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-sm bg-warning/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <p class="text-3xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-2">
                        <div class="badge badge-success badge-soft badge-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            Total
                        </div>
                        <p class="text-sm text-slate-500">pendapatan aktif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="card-title text-lg">Faktur Tertunda</h2>
                    <div class="w-12 h-12 rounded-xl {{ $pendingInvoices > 0 ? 'bg-error/10' : 'bg-neutral/10' }} flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $pendingInvoices > 0 ? 'text-error' : 'text-neutral' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            @if($pendingInvoices > 0)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            @endif
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <p class="text-3xl font-bold">{{ number_format($pendingInvoices) }}</p>
                    <div class="flex items-center gap-2">
                        <div class="badge {{ $pendingInvoices > 0 ? 'badge-error' : 'badge-primary' }} badge-soft badge-sm">
                            @if($pendingInvoices > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Tertunda
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Bersih
                            @endif
                        </div>
                        <p class="text-sm text-slate-500">faktur menunggu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- grid chart --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">
        <div class="lg:col-span-2 card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Chart Pendapatan</h2>
                <p class="text-base-content/60">Grafik pendapatan dari transaksi aktif.</p>
                <div id="chart"></div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body col-span-2">
                <h2 class="card-title">Langganan Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Produk</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions as $index => $transaction)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $transaction->user->full_name }}</td>
                                <td>{{ $transaction->product->name_product }}</td>
                                <td>
                                    <span class="badge badge-soft badge-success">{{ ucfirst($transaction->status) }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500">Belum ada langganan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- grid  table hosting & subs --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Paket Hosting Terpopuler</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($popularProducts as $index => $product)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $product->name_product }}</td>
                                <td>Rp{{ number_format($product->price_monthly, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-soft badge-primary">{{ $product->transactions_count }} transaksi</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500">Belum ada data produk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Ringkasan Langganan Aktif</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Produk</th>
                                <th>Berakhir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions->take(4) as $transaction)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12 bg-primary text-white flex items-center justify-center">
                                                {{ strtoupper(substr($transaction->user->full_name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $transaction->user->full_name }}</div>
                                            <div class="text-sm opacity-50">{{ $transaction->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $transaction->product->name_product }}
                                    <br />
                                    <span class="badge badge-ghost badge-sm">{{ ucfirst($transaction->billing_cycle) }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($transaction->end_date)->format('d M Y') }}</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500">Belum ada langganan aktif</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- grid untuk table recent-payment --}}
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Pembayaran Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>User</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPayments as $index => $payment)
                            <tr class="hover:bg-base-200">
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $payment->transaction_code }}</td>
                                <td>{{ $payment->user->full_name }}</td>
                                <td>{{ $payment->product->name_product }}</td>
                                <td>Rp{{ number_format($payment->total_payment, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusClass = match($payment->status) {
                                            'active' => 'badge-soft badge-success',
                                            'pending_payment' => 'badge-soft badge-warning',
                                            'pending_confirm' => 'badge-soft badge-info',
                                            'rejected' => 'badge-soft badge-error',
                                            default => 'badge-soft badge-ghost'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span>
                                </td>
                                <td>{{ $payment->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500">Belum ada pembayaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- grid untuk table system alert / notif --}}
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Peringatan & Pemberitahuan Sistem</h2>
                <div class="space-y-2">
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Total {{ $totalMembers }} member terdaftar dalam sistem</span>
                    </div>
                    @if($pendingInvoices > 0)
                    <div class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
                        <span>{{ $pendingInvoices }} faktur menunggu pembayaran atau konfirmasi</span>
                    </div>
                    @endif
                    @if($activeSubscriptions > 0)
                    <div class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ $activeSubscriptions }} langganan aktif sedang berjalan</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Pendapatan',
                data: [{{ $totalRevenue > 0 ? $totalRevenue/10000 : 30 }}, 40, 35, 50, 49, 60, 70, 91, {{ $totalRevenue > 0 ? $totalRevenue/8000 : 125 }}]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep']
            },
            yaxis: {
                title: {
                    text: 'Rupiah (x1000)'
                }
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</div>
