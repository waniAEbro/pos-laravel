<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Materials</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <p>Materials List</p>
            <a href="/materials/create" class="btn btn-primary">Create Material</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Tanggal Stok</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr>
                            <td>{{ $material->tanggal_stok->format('j F Y') }}</td>
                            <td>{{ $material->nama }}</td>
                            <td>{{ $material->stok }}</td>
                            <td class="d-flex">
                                <a href="/materials/{{ $material->id }}/edit"
                                    class="btn btn-outline-warning me-2">Edit</a>

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#danger{{ $material->id }}">
                                    Delete
                                </button>

                                <div class="modal fade text-left" id="danger{{ $material->id }}" tabindex="-1"
                                    aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title white" id="myModalLabel120">
                                                    Delete Material
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
                                                Apakah Anda yakin ingin menghapus material ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <form action="/materials/{{ $material->id }}" method="post">
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
            $("table").DataTable({
                scrollX: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5'
                }, {
                    extend: 'pdfHtml5'
                }]
            });
        </script>
    </x-slot:script>
</x-layout>
