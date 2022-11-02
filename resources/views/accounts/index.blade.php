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
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Nama Transaksi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
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
                tr.children[1].innerHTML = convertRupiah(tr.children[1].innerHTML);
                tr.children[2].innerHTML = convertRupiah(tr.children[2].innerHTML);
                tr.children[3].innerHTML = convertRupiah(tr.children[3].innerHTML);
            });

            $("table").DataTable({
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
