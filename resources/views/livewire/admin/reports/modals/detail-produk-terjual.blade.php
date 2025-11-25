{{-- Detail Produk Terjual Modal --}}
<input type="checkbox" wire:model="showDetailProdukTerjualModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-secondary/15 text-secondary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    Detail Produk Terjual
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap produk yang terjual untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailProdukTerjualModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="stat bg-secondary/10 rounded-lg border border-secondary/20">
                <div class="stat-title text-secondary">Total Produk Terjual</div>
                <div class="stat-value text-secondary text-2xl">
                    {{ $revenueData['per_product']->count() ?? 0 }}
                </div>
                <div class="stat-desc text-secondary">Jenis produk</div>
            </div>

            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Total Penjualan</div>
                <div class="stat-value text-primary text-2xl">
                    {{ $revenueData['per_product']->sum('total_transactions') ?? $revenueData['per_product']->sum('transaction_count') ?? 0 }}
                </div>
                <div class="stat-desc text-success">Unit terjual</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Produk Terlaris</div>
                <div class="stat-value text-info text-lg">
                    {{ $revenueData['per_product']->first()->name_product ?? 'N/A' }}
                </div>
                <div class="stat-desc text-info">Penjualan tertinggi</div>
            </div>
        </div>

        {{-- Product Sales Chart --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Grafik Penjualan Produk</h4>
                    <div class="flex gap-2">
                        <div class="badge badge-primary badge-outline badge-sm">Line Chart</div>
                        <div class="badge badge-secondary badge-outline badge-sm">Revenue Tracking</div>
                    </div>
                </div>
                <div id="productSalesChart" class="h-80"></div>
            </div>
        </div>

        {{-- Chart Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Prepare data for chart
                const products = @json($revenueData['per_product'] ?? []);
                
                // Create series data for line chart
                const categories = [];
                const revenueData = [];
                const transactionData = [];
                
                products.forEach((product, index) => {
                    categories.push(product.name_product || `Product ${index + 1}`);
                    revenueData.push(parseInt(product.total_revenue || 0));
                    transactionData.push(parseInt(product.transaction_count || 0));
                });

                // Chart configuration
                const options = {
                    series: [
                        {
                            name: 'Total Pendapatan',
                            type: 'line',
                            data: revenueData
                        },
                        {
                            name: 'Unit Terjual',
                            type: 'line',
                            data: transactionData
                        }
                    ],
                    chart: {
                        height: 320,
                        type: 'line',
                        toolbar: {
                            show: true,
                            tools: {
                                download: true,
                                selection: true,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            }
                        },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        }
                    },
                    colors: ['#10b981', '#3b82f6'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: [3, 3],
                        curve: 'smooth'
                    },
                    title: {
                        text: 'Trend Penjualan Produk',
                        align: 'left',
                        style: {
                            fontSize: '16px',
                            fontWeight: 600,
                            color: '#374151'
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb',
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        size: 6,
                        colors: ['#ffffff'],
                        strokeColors: ['#10b981', '#3b82f6'],
                        strokeWidth: 3,
                        hover: {
                            size: 8
                        }
                    },
                    xaxis: {
                        categories: categories,
                        title: {
                            text: 'Produk',
                            style: {
                                color: '#6b7280',
                                fontSize: '12px',
                                fontWeight: 500
                            }
                        },
                        labels: {
                            style: {
                                colors: '#6b7280',
                                fontSize: '11px'
                            },
                            rotate: -45,
                            maxHeight: 60
                        }
                    },
                    yaxis: [
                        {
                            title: {
                                text: 'Total Pendapatan (Rp)',
                                style: {
                                    color: '#10b981',
                                    fontSize: '12px',
                                    fontWeight: 500
                                }
                            },
                            labels: {
                                style: {
                                    colors: '#10b981',
                                    fontSize: '11px'
                                },
                                formatter: function (val) {
                                    return new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0
                                    }).format(val);
                                }
                            }
                        },
                        {
                            opposite: true,
                            title: {
                                text: 'Unit Terjual',
                                style: {
                                    color: '#3b82f6',
                                    fontSize: '12px',
                                    fontWeight: 500
                                }
                            },
                            labels: {
                                style: {
                                    colors: '#3b82f6',
                                    fontSize: '11px'
                                }
                            }
                        }
                    ],
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        floating: true,
                        offsetY: -25,
                        offsetX: -5,
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 5
                        }
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: [
                            {
                                formatter: function (y) {
                                    if (typeof y !== "undefined") {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0
                                        }).format(y);
                                    }
                                    return y;
                                }
                            },
                            {
                                formatter: function (y) {
                                    if (typeof y !== "undefined") {
                                        return y + " unit";
                                    }
                                    return y;
                                }
                            }
                        ]
                    }
                };

                // Render chart
                const chart = new ApexCharts(document.querySelector("#productSalesChart"), options);
                chart.render();

                // Update chart when modal is shown
                const modal = document.querySelector('input[wire\\:model="showDetailProdukTerjualModal"]');
                if (modal) {
                    const observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.type === 'attributes' && mutation.attributeName === 'checked') {
                                if (modal.checked) {
                                    setTimeout(() => {
                                        chart.updateOptions(options);
                                    }, 300);
                                }
                            }
                        });
                    });
                    observer.observe(modal, { attributes: true });
                }
            });
        </script>

        {{-- Product Sales Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Detail Penjualan Per Produk</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('produk-terjual-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('produk-terjual-detail')" class="btn btn-outline btn-success btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-hover w-full">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="font-semibold">#</th>
                                <th class="font-semibold">Produk</th>
                                <th class="font-semibold text-center">Unit Terjual</th>
                                <th class="font-semibold text-center">Harga</th>
                                <th class="font-semibold text-center">Total Pendapatan</th>
                                <th class="font-semibold text-center">Status</th>
                                <th class="font-semibold text-center">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($revenueData && isset($revenueData['per_product']))
                                @forelse($revenueData['per_product'] as $index => $product)
                                    @php
                                        $totalRevenue = $revenueData['per_product']->sum('total_revenue') ?? 1;
                                        $productRevenue = $product->total_revenue ?? 0;
                                        $percentage = $totalRevenue > 0 ? ($productRevenue / $totalRevenue) * 100 : 0;
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div>
                                                <div class="font-semibold text-sm">{{ $product->name_product }}</div>
                                                <div class="text-xs text-base-content/60">{{ $product->product_code ?? 'N/A' }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-primary badge-soft badge-sm">
                                                {{ $product->total_transactions ?? $product->transaction_count ?? 0 }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="font-medium">
                                                Rp {{ number_format($product->price_monthly ?? $product->price ?? $product->harga ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="font-bold text-success">
                                                Rp {{ number_format($product->total_revenue ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ ($product->status ?? $product->is_active ?? 'active') == 'active' ? 'badge-success' : 'badge-error' }} badge-soft badge-sm">
                                                {{ ($product->status ?? $product->is_active ?? 'active') == 'active' ? 'Active' : 'Inactive' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <div class="text-sm font-medium text-right w-12">{{ number_format($percentage, 1) }}%</div>
                                                <div class="w-20 bg-base-300 rounded-full h-3">
                                                    <div class="bg-primary from-secondary to-primary h-3 rounded-full transition-all duration-500" 
                                                         style="width: {{ min($percentage, 100) }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada data produk terjual untuk periode ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-8">
                                        <p class="text-slate-500">Data tidak tersedia</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop" @click="$wire.set('showDetailProdukTerjualModal', false)"></div>
</div>