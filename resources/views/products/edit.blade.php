<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item"><a href="/products">Products</a></li>
        <li class="breadcrumb-item">Create Product</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Create Product</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="/products/{{ $product->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" class="form-control" name="nama"
                                    value="{{ $product->nama }}" required>
                            </div>

                            <div class="col-md-4">
                                <label>Kategori <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="category" id="category" class="form-select choices" required>
                                    <option value="" selected disabled hidden>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Biaya Produksi <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="biaya_produksi" class="form-control" name="biaya_produksi"
                                    value="{{ $product->biaya_produksi }}" required>
                            </div>

                            <div class="col-md-4">
                                <label>Harga Jual <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="harga" min="0" class="form-control" name="harga"
                                    value="{{ $product->harga }}" required>
                            </div>

                            <div class="col-md-4">
                                <label>Harga Reseller <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="harga_reseller" min="0" class="form-control"
                                    name="harga_reseller" value="{{ $product->harga_reseller }}" required>
                            </div>

                            <div class="col-md-4">
                                <label>Stok <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="stok" min="0" class="form-control" name="stok"
                                    value="{{ $product->stok }}" disabled>
                            </div>

                            <div class="col form-group">
                                <table class="table form">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>jumlah</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script>
            let material = @json($materials);

            function initialRow() {
                let select = document.createElement("select");
                let option = undefined;
                material.forEach(materi => {
                    option = document.createElement("option");
                    option.value = materi.id;
                    option.text = materi.nama;
                    select.appendChild(option);
                });
                $(".table.form tbody").append(`
                            <tr>
                                <td>
                                    <select name="materials[]" class="form-select">
                                        <option value="" disabled selected>Pilih Material</option>
                                        ${select.innerHTML}
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="0" onfocus="this.value = this.value == 0 ? '' : this.value" onblur="this.value = this.value == '' ? 0 : this.value"  value="0" name="jumlah[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" onclick="tambahRow(this)" class="btn btn-success">Tambah Bahan</button>
                                </td>
                            </tr>
        `);
            };

            function tambahRow(element) {
                let select = document.createElement("select");
                let option = undefined;
                material.forEach(materi => {
                    option = document.createElement("option");
                    option.value = materi.id;
                    option.text = materi.nama;
                    select.appendChild(option);
                });
                $(element).parent().parent().parent().append(`
                            <tr>
                                <td>
                                    <select name="materials[]" class="form-select">
                                        <option value="" disabled selected>Pilih Material</option>
                                        ${select.innerHTML}
                                    </select>
                                </td>
                                <td>
                                    <input type="number" onfocus="this.value = this.value == 0 ? '' : this.value" onblur="this.value = this.value == '' ? 0 : this.value"  min="0" value="0" name="jumlah[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" onclick="tambahRow(this)" class="btn btn-success">Tambah Bahan</button>
                                </td>
                            </tr>
        `);
            };

            (function() {
                let materials = @json($product->materials);
                materials.forEach(materi => {
                    initialRow();
                    let row = $(".table.form tbody tr:last");
                    row.find("[name='materials[]']").val(materi.id);
                    row.find("[name='jumlah[]']").val(materi.pivot.jumlah);
                });
                if (materials.length == 0) {
                    initialRow();
                }
            })();
        </script>
    </x-slot:script>
</x-layout>
