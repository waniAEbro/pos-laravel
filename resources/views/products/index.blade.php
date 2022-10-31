<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Products</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <p>Products List</p>
            <a href="/products/create" class="btn btn-primary">Create Product</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Biaya Produksi</th>
                        <th>Harga</th>
                        <th>Harga Reseller</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->category->nama }}</td>
                            <td>{{ $product->biaya_produksi }}</td>
                            <td>{{ $product->harga }}</td>
                            <td>{{ $product->harga_reseller }}</td>
                            <td>{{ $product->stok }}</td>
                            <td class="d-flex">
                                <a href="/products/{{ $product->id }}/edit"
                                    class="btn btn-outline-warning me-2">Edit</a>

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#danger{{ $product->id }}">
                                    Delete
                                </button>

                                <div class="modal fade text-left" id="danger{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title white" id="myModalLabel120">
                                                    Delete Product
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6"
                                                            y2="18"></line>
                                                        <line x1="6" y1="6" x2="18"
                                                            y2="18"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus produk ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <form action="/products/{{ $product->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type=submit" class="btn btn-danger ml-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-slot:script>
        <script>
            let tr = document.querySelectorAll('tbody tr');

            tr.forEach(tr => {
                if (tr.children[0].getAttribute("class") != "dataTables-empty") {
                    tr.querySelector("td:nth-child(4)").innerHTML = convertRupiah(tr.querySelector("td:nth-child(4)")
                        .innerHTML);
                    tr.querySelector("td:nth-child(5)").innerHTML = convertRupiah(tr.querySelector("td:nth-child(5)")
                        .innerHTML);
                    tr.querySelector("td:nth-child(6)").innerHTML = convertRupiah(tr.querySelector("td:nth-child(6)")
                        .innerHTML);
                }
            })
        </script>
    </x-slot:script>
</x-layout>
