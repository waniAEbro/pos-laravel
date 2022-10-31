<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item"><a href="/materials">Materials</a></li>
        <li class="breadcrumb-item">Edit Material</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Material</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="/materials/{{ $material->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Material <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" class="form-control" name="nama"
                                    value="{{ $material->nama }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Stok <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" min="0" id="stok" class="form-control" name="stok"
                                    value="{{ $material->stok }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Tanggal Stok <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_stok" class="form-control" name="tanggal_stok"
                                    value="{{ $material->tanggal_stok }}" required>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    Reset
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
            document.getElementById("tanggal_stok").valueAsDate = new Date();
        </script>
    </x-slot:script>
</x-layout>
