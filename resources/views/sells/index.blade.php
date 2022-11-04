<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Penjualan</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <label>Bulan</label>
                </div>
                <div class="col-lg-8"><input type="month" class="form-control" onchange="cariSells(this)"></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <label>Laba Kotor</label>
                </div>
                <div class="col-lg-8 form-group">
                    <input type="text" class="form-control" id="laba_kotor" value="Rp. 0,-" readonly>
                </div>
                <div class="col-lg-4">
                    <label>Laba Bersih</label>
                </div>
                <div class="col-lg-8 form-group">
                    <input type="text" class="form-control" id="laba_bersih" value="Rp. 0,-" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>List Data Penjualan</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Penjual</th>
                        <th>Nama Barang</th>
                        <th>Total Barang</th>
                        <th>Total Harga</th>
                        <th>Terbayar</th>
                        <th>Kekurangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($debits as $debit)
                        <tr>
                            <td>{{ $debit->created_at->format('j F Y') }}</td>
                            <td>{{ $debit->reseller_id ? $debit->reseller->nama . ' (reseller)' : $debit->nama_pelanggan . ' (biasa)' }}
                            </td>
                            <td>{{ $debit->user->name }}</td>
                            <td>
                                @foreach ($debit->products as $index => $product)
                                    {{ $index < $debit->products->count() - 1 ? $product->nama . ', ' : $product->nama }}
                                @endforeach
                            </td>
                            <td>{{ $debit->total_barang }}</td>
                            <td>{{ $debit->total_harga }}</td>
                            <td>{{ $debit->terbayar }}</td>
                            <td>{{ $debit->kekurangan }}</td>
                            <td class="d-flex">
                                <a href="/sells/{{ $debit->id }}" class="btn btn-outline-primary me-2">Detail</a>
                                @if (intval($debit->kekurangan) > 0)
                                    <a href="/sells/{{ $debit->id }}/edit"
                                        class="btn btn-outline-warning me-2">Bayar
                                        Kekurangan</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-slot:script>
        <script>
            $("table").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }, {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }]
            });

            function cariSells(element) {
                window.location.href = '/sells?month=' + element.value.split("-")[1] + '&year=' + element.value.split('-')[0];
            }

            const sells = @json($debits);
            let laba_kotor = laba_bersih = 0;

            sells.forEach(sell => {
                laba_kotor += sell.total_harga;
                laba_bersih += sell.laba_bersih;
            });

            document.getElementById('laba_kotor').value = convertRupiah(laba_kotor);
            document.getElementById('laba_bersih').value = convertRupiah(laba_bersih);

            let tr = document.querySelectorAll('tbody tr');

            tr.forEach(tr => {
                if (tr.children[0].getAttribute("class") != "dataTables-empty") {
                    tr.querySelector("td:nth-child(6)").innerHTML = convertRupiah(tr.querySelector("td:nth-child(6)")
                        .innerHTML);
                    tr.querySelector("td:nth-child(7)").innerHTML = convertRupiah(tr.querySelector("td:nth-child(7)")
                        .innerHTML);
                    tr.querySelector("td:nth-child(8)").innerHTML = convertRupiah(tr.querySelector("td:nth-child(8)")
                        .innerHTML);
                }
            });

            document.querySelector('#total_saldo').innerHTML = convertRupiah(document.querySelector('#total_saldo')
                .innerHTML);
            document.querySelector('#saldo_tunai').innerHTML = convertRupiah(document.querySelector('#saldo_tunai')
                .innerHTML);
        </script>
    </x-slot:script>
</x-layout>
