<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item"><a href="/accounts">Accounts</a></li>
        <li class="breadcrumb-item">Create Account</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Create Account</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="/accounts" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Transaksi <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" class="form-control" name="nama"
                                    placeholder="Modal Awal" required>
                            </div>
                            <div class="col-md-4">
                                <label>Debit <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="debit" min="0" value="0" class="form-control"
                                    name="debit" placeholder="1000000" required>
                            </div>
                            <div class="col-md-4">
                                <label>Kredit <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="kredit" min="0" value="0" class="form-control"
                                    name="kredit" placeholder="500000" required>
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
