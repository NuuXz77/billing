<div>
    {{-- grid 4 stat --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Total Member</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">{{ number_format($totalMembers) }}</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-success badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            +{{ $totalMembers > 0 ? '100' : '0' }}%
                        </div>
                        <p class="text-neutral">Total</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Langganan Aktif</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">{{ number_format($activeSubscriptions) }}</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-success badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            {{ $activeSubscriptions > 0 ? 'Active' : 'None' }}
                        </div>
                        <p class="text-neutral">Status</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Pendapatan</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-success badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            Total
                        </div>
                        <p class="text-neutral">Aktif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Faktur Tertunda</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">{{ number_format($pendingInvoices) }}</p>
                    <div class="flex items-center gap-1">
                        <div class="badge {{ $pendingInvoices > 0 ? 'badge-warning' : 'badge-success' }} badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $pendingInvoices > 0 ? 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z' : 'M5 10l7-7m0 0l7 7m-7-7v18' }}" />
                            </svg>
                            {{ $pendingInvoices > 0 ? 'Pending' : 'Clear' }}
                        </div>
                        <p class="text-neutral">Status</p>
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
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->product->name_product }}</td>
                                <td>
                                    <span class="badge badge-success">{{ ucfirst($transaction->status) }}</span>
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
                                    <span class="badge badge-primary">{{ $product->transactions_count }} transaksi</span>
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
                                                {{ strtoupper(substr($transaction->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $transaction->user->name }}</div>
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
                                            'active' => 'badge-success',
                                            'pending_payment' => 'badge-warning',
                                            'pending_confirm' => 'badge-info',
                                            'rejected' => 'badge-error',
                                            default => 'badge-ghost'
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
