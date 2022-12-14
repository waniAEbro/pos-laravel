<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Tokoku</title>

    <link rel="stylesheet" href="/assets/extensions/choices.js/public/assets/styles/choices.css" />
    <link rel="stylesheet" href="/assets/css/main/app.css">
    <link rel="stylesheet" href="/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/shared/iconly.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css" />
</head>

<body>
    <div id="app">
        <x-sidebar>{{ $title }}</x-sidebar>
        <div id="main">
            <x-navbar></x-navbar>
            <div class="page-heading">
                <x-heading>
                    <x-slot:title>
                        {{ $title }}
                    </x-slot:title>
                    {{ $breadcrumb }}
                </x-heading>
                <div class="section">
                    {{ $slot }}
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/pages/dashboard.js"></script>
    <script src="/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="/assets/js/pages/form-element-select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
        integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
    <script>
        function convertRupiah(angka) {
            let rupiah = '';
            let angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('') + ',-';
        }

        document.querySelectorAll(".saldo").forEach(saldo => saldo.innerHTML = "Saldo : " + convertRupiah(parseInt(
            {{ $saldo }})));

        document.querySelectorAll("input[type=number]").forEach(input => {
            input.addEventListener("focus", (element) => {
                if (element.target.value == 0) {
                    element.target.value = ""
                }
            })
        })

        document.querySelectorAll("input[type=number]").forEach(input => {
            input.addEventListener("blur", (element) => {
                if (element.target.value == "") {
                    element.target.value = 0
                }
            })
        })
    </script>
    {{ $script ?? '' }}
</body>

</html>
