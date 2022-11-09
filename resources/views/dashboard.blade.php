<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldProfile"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Reseller</h6>
                            <h6 class="font-extrabold mb-0">{{ $jumlah_reseller }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon green mb-2">
                                <i class="bi-basket3-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Produk</h6>
                            <h6 class="font-extrabold mb-0">{{ $jumlah_produk }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p>Products Terlaris</p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->nama }}</td>
                                    <td>{{ $product->category->nama }}</td>
                                    <td>{{ $product->terjual }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Laba Kotor Tahun {{ date('Y') }}</h4>
                </div>
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script>
            let array = [];
            let sell = undefined;
            const sells = @json($sells);
            for (let i = 1; i <= 12; i++) {
                sell = sells.find(sell => sell.month == i);
                if (sell) {
                    array.push(parseInt(sell.total_harga))
                } else {
                    array.push(0)
                }
            }
            var barOptions = {
                series: [{
                    name: "Net Profit",
                    data: array,
                }],
                chart: {
                    type: "bar",
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                },
                yaxis: {
                    title: {
                        text: "Laba Kotor",
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
            };

            var bar = new ApexCharts(document.querySelector("#chart"), barOptions);
            bar.render();
        </script>
    </x-slot:script>
</x-layout>
