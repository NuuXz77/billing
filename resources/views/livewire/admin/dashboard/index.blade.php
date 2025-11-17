<div>
    {{-- grid 4 stat --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title text-gray-300">Total Member</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">42</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-success badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            5%
                        </div>
                        <p class="text-base-300">Minggu ini</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title text-gray-300">Langganan Aktif</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">42</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-success badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            5%
                        </div>
                        <p class="text-base-300">Minggu ini</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title text-gray-300">Pendapatan</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">Rp10.000</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-error badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            5%
                        </div>
                        <p class="text-base-300">Minggu ini</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h2 class="card-title text-gray-300">Faktur Tertunda</h2>
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-bold">39</p>
                    <div class="flex items-center gap-1">
                        <div class="badge badge-success badge-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            5%
                        </div>
                        <p class="text-base-300">Minggu ini</p>
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
                <p class="text-base-content/60">This section will display recent user activities.</p>
                <div id="chart"></div>
            </div>
        </div>
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body col-span-2">
                <h2 class="card-title">Langganan Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
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
                <h2 class="card-title">Paket Hosting Terbaik</h2>
                {{-- <p class="text-base-content/60">This section will display recent user activities.</p> --}}
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
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
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Hart Hagerty</div>
                                            <div class="text-sm opacity-50">United States</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Zemlak, Daniel and Leannon
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                                </td>
                                <td>Purple</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Brice Swyre</div>
                                            <div class="text-sm opacity-50">China</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Carroll Group
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                                </td>
                                <td>Red</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Marjy Ferencz</div>
                                            <div class="text-sm opacity-50">Russia</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Rowe-Schoen
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                                </td>
                                <td>Crimson</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            <!-- row 4 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Yancy Tear</div>
                                            <div class="text-sm opacity-50">Brazil</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Wyman-Ledner
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Community Outreach Specialist</span>
                                </td>
                                <td>Indigo</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
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
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr class="hover:bg-base-300">
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
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
                <h2 class="card-title">Peringatan & Pemberitahuan Sistem (Log)</h2>
                <p class="text-base-content/60">This section spans the full width of the dashboard.</p>
            </div>
        </div>
    </div>

    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
</div>
