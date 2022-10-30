<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Penjualan</li>
    </x-slot:breadcrumb>

    <div class="card">
        <div class="card-header">
            <p>
                Detail Saldo
            </p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>Saldo</h6>
                </div>
                <div class="col-md-8">
                    <p id="saldo_tunai">{{ $saldo->saldo_tunai }}</p>
                </div>
                <div class="col-md-4">
                    <h6>Total Saldo <small>(termasuk piutang / kekurangan)</small></h6>
                </div>
                <div class="col-md-8">
                    <p id="total_saldo">{{ $saldo->total_saldo }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>List Penjualan</p>
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
                            <td>{{ $debit->reseller_id ? $debit->reseller->nama : 'Pelanggan Biasa' }}</td>
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
                                <a href="/debits/{{ $debit->id }}/edit"
                                    class="btn btn-outline-warning me-2">Edit</a>
                                <a href="/debits/{{ $debit->id }}" class="btn btn-outline-primary me-2">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-slot:script>
        <script>
            function convertRupiah(angka) {
                let rupiah = '';
                let angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('') + ',-';
            }

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
