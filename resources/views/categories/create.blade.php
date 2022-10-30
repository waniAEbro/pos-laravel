<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
        <li class="breadcrumb-item">Create Category</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo->saldo_tunai }}</x-slot:saldo>
    <x-slot:total_saldo>{{ $saldo->total_saldo }}</x-slot:total_saldo>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Create Category</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="/categories" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Kategori <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                    placeholder="Kiloan" required>
                                @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
</x-layout>
