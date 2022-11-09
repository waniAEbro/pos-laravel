<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Accounts</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <p>Accounts List</p>
            <a href="/accounts/create" class="btn btn-primary">Create Account</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nama Transaksi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $nomor => $account)
                        <tr>
                            <td>{{ $nomor + 1 }}</td>
                            <td>{{ $account->created_at->format('d F Y') }}</td>
                            <td>{{ $account->nama }}</td>
                            <td>{{ $account->debit }}</td>
                            <td>{{ $account->kredit }}</td>
                            <td>{{ $account->saldo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-slot:script>
        <script>
            document.querySelectorAll("tbody tr").forEach(tr => {
                tr.children[3].innerHTML = convertRupiah(tr.children[3].innerHTML);
                tr.children[4].innerHTML = convertRupiah(tr.children[4].innerHTML);
                tr.children[5].innerHTML = convertRupiah(tr.children[5].innerHTML);
            });

            $("table").DataTable({
                scrollX: true,
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
