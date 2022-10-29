<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Transaksi</li>
    </x-slot:breadcrumb>

    <div class="card">
        <div class="card-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="reseller">Reseller</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="reseller" id="reseller" class="form-select">
                            <option value="" disabled hidden selected>Pelanggan Biasa</option>
                            @foreach ($resellers as $reseller)
                                <option value="{{ $reseller->id }}">{{ $reseller->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="product">Produk <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="product" id="product" class="form-select">
                            <option value="" disabled hidden selected>Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->id . ' - ' . $product->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>Transaksi</p>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table2">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
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
                        <input type="number" class="form-control" value="0" id="total_barang" name="total_barang"
                            disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="total_harga">Total Harga</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" harga="0" id="total_harga"
                            name="total_harga" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="terbayar">Terbayar</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" class="form-control" min="0" value="0" id="terbayar"
                            name="terbayar" oninput="updateDetailTransaksi(this)">
                    </div>

                    <div class="col-md-4">
                        <label for="kembalian">Kembalian</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" kembalian="0" id="kembalian"
                            disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="kekurangan">Kekurangan</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" kekurangan="0" id="kekurangan"
                            name="kekurangan" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button onclick="submitForm()" class="btn btn-primary">Simpan Transaksi</button>
    <x-slot:script>
        <script>
            let transaksi = {};
            let reseller = harga = product = max = kecil = total = undefined;
            let kembalian = document.getElementById("kembalian");
            let kekurangan = document.getElementById("kekurangan");
            const products = @json($products);

            transaksi.reseller_id = null;
            transaksi.products = [];

            $("#reseller").on("change", () => {
                reseller = $("#reseller").val();
                transaksi.reseller_id = $("#reseller").val()
            });

            $("#product").on("change", () => {
                product = products.find(product => product.id == $("#product").val());
                transaksi.products.push({
                    "id": product.id
                });

                kecil = product.materials.map(material => Math.floor(parseInt(material.stok) / parseInt(material.pivot
                    .jumlah)));

                kecil.push(parseInt(product.stok));

                kecil = Math.min(...kecil);

                harga = (reseller) ? product.harga_reseller : product.harga;

                $("#table2 tbody").append(`
                    <tr>
                        <td>${product.id}</td>
                        <td>${product.nama}</td>
                        <td>
                            <input type="number" oninput="updateTable(this)" class="form-control jumlah" value="0" min="0" max="${kecil}" harga=${harga}>
                        </td>
                        <td harga=${harga} class="harga">${convertRupiah(harga)}</td>
                    </tr>
                `);

                $("#product").val("");
                $("#reseller").attr("disabled", true);
            })

            function convertRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('') + ',-';
            }

            function updateTable(element) {
                if (parseInt(element.value) > parseInt(element.getAttribute("max"))) {
                    window.alert("stok produk / stok material tidak mencukupi");
                    element.value = element.getAttribute("max");
                } else if (parseInt(element.value) < 0 || element.value == "") {
                    window.alert("jumlah tidak boleh kurang dari 0");
                    element.value = 0;
                }

                harga = parseInt(element.value) * parseInt(element.getAttribute("harga"))

                element.parentElement.nextElementSibling.innerHTML = convertRupiah(harga);
                element.parentElement.nextElementSibling.setAttribute("harga", harga);

                total = 0;

                document.querySelectorAll("tbody tr").forEach(tr => {
                    total += parseInt(tr.querySelector(".harga").getAttribute("harga"));
                });

                document.querySelector("#total_harga").value = convertRupiah(total);
                document.querySelector("#total_harga").setAttribute("harga", total);

                total = 0;

                document.querySelectorAll("tbody tr").forEach(tr => {
                    total += parseInt(tr.querySelector(".jumlah").value);
                });

                document.querySelector("#total_barang").value = total;
            }

            function updateDetailTransaksi(element) {
                harga = document.getElementById("total_harga").getAttribute("harga");
                total = parseInt(element.value) - parseInt(harga);
                if (document.querySelectorAll("tbody tr").length > 0) {
                    if (total < 0) {
                        kembalian.setAttribute("kembalian", 0);
                        kembalian.value = convertRupiah(0);
                        kekurangan.setAttribute("kekurangan", 0);
                        kekurangan.value = convertRupiah(-total);
                    } else {
                        kekurangan.setAttribute("kekurangan", 0);
                        kekurangan.value = convertRupiah(0);
                        kembalian.setAttribute("kembalian", 0);
                        kembalian.value = convertRupiah(total);

                    }
                }
            }
        </script>
    </x-slot:script>
</x-layout>
