<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item"><a href="/sells">Sells</a></li>
        <li class="breadcrumb-item">Bayar Kekurangan</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Bayar Kekurangan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" id="update" action="/sells/{{ $sell->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nominal Kekurangan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" value="{{ $sell->kekurangan }}" id="kekurangan"
                                    class="form-control" kekurangan="{{ $sell->kekurangan }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Nominal Yang Dibayarkan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" min="0" value="0" name="terbayar" id="terbayar"
                                    class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Kembalian</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control" id="kembalian" value="0" kembalian="0"
                                    disabled>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button onclick="Submit()" type="button" class="btn btn-primary me-1 mb-1">
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
            document.getElementById("kekurangan").value = convertRupiah(document.getElementById("kekurangan").getAttribute(
                "kekurangan"));

            document.getElementById("kembalian").value = convertRupiah(document.getElementById("kembalian").getAttribute(
                "kembalian"));

            document.getElementById("terbayar").addEventListener("input", function(element) {
                let terbayar = parseInt(element.target.value);
                let kekurangan = parseInt(document.getElementById("kekurangan").getAttribute("kekurangan"));
                let kembalian = terbayar - kekurangan;

                if (kembalian < 0 || isNaN(kembalian)) {
                    kembalian = 0;
                }

                document.getElementById("kembalian").value = convertRupiah(kembalian);
            });

            function Submit() {
                let terbayar = parseInt(document.getElementById("terbayar").value);
                let kekurangan = parseInt(document.getElementById("kekurangan").getAttribute("kekurangan"));

                if (terbayar < kekurangan) {
                    let warning = confirm("Nominal yang dibayarkan masih kurang dari hutang, anda ingin melanjutkan ?");
                    if (warning) {
                        document.querySelector("#update").submit();
                    }
                } else {
                    document.getElementById("terbayar").value = kekurangan;
                    document.querySelector("#update").submit();
                }
            }
        </script>
    </x-slot:script>
</x-layout>
