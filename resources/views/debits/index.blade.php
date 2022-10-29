<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Penjualan</li>
    </x-slot:breadcrumb>
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
                            <td>{{ $debit->reseller_id ? $debit->reseller->nama : 'Pembeli Biasa' }}</td>
                            <td>{{ $debit->user->name }}</td>
                            <td>
                                @foreach ($debit->products->nama as $index => $nama)
                                    {{ $nama . ($index != $debit->products->count() - 1) ? ', ' : '' }}
                                @endforeach
                            </td>
                            <td>{{ $debit->total_barang }}</td>
                            <td>{{ $debit->total_harga }}</td>
                            <td>{{ $debit->terbayar }}</td>
                            <td>{{ $debit->kekurangan }}</td>
                            <td class="d-flex">
                                <a href="/categories/{{ $category->id }}/edit"
                                    class="btn btn-outline-warning me-2">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
