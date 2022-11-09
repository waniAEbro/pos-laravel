<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Transaksi</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-header">
            <h5>Data Diri {{ $debit->reseller ? 'Reseller' : 'Pelanggan Biasa' }}</h5>
        </div>
        <div class="card-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="reseller">Nama Reseller</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input name="reseller" id="reseller" class="form-control"
                            value="{{ $debit->reseller ? $debit->reseller->nama : $debit->nama_pelanggan }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="reseller">Alamat</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input name="alamt" id="alamt" class="form-control"
                            value="{{ $debit->reseller ? $debit->reseller->alamat : $debit->alamat }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="reseller">Nomor Telepon</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input name="nomor" id="nomor" class="form-control"
                            value="{{ $debit->reseller ? $debit->reseller->nomor : $debit->nomor }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>Transaksi</p>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped" id="table2">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($debit->products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->category->nama }}</td>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->pivot->jumlah }}</td>
                            <td>{{ $product->pivot->harga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>Detail Transaksi</p>
        </div>
        <div class="card-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="total_barang">Total Barang</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" class="form-control" value="{{ $debit->total_barang }}" id="total_barang"
                            name="total_barang" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="total_harga">Total Harga</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" harga="{{ $debit->total_harga }}"
                            id="total_harga" name="total_harga" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="terbayar">Terbayar</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" terbayar="{{ $debit->terbayar }}"
                            id="terbayar" name="terbayar" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="kekurangan">Kekurangan</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-"
                            kekurangan="{{ $debit->kekurangan }}" id="kekurangan" name="kekurangan" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="/sells" class="btn btn-primary">Kembali</a>

    <x-slot:script>
        <script>
            $(document).ready(function() {
                let total_harga = $('#total_harga').attr('harga');
                let terbayar = $('#terbayar').attr('terbayar');
                let kekurangan = $('#kekurangan').attr('kekurangan');

                $('#total_harga').val(convertRupiah(total_harga));
                $('#terbayar').val(convertRupiah(terbayar));
                $('#kekurangan').val(convertRupiah(kekurangan));
            });
        </script>
    </x-slot:script>
</x-layout>
