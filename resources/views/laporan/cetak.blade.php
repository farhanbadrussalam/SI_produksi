<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        .header {
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            line-height: .1cm;
            margin-bottom: 1em;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .table th {
            border: 1 solid black;
            font-weight: bold;
            background-color: #e1e1e1;
        }

        .table td {
            border: 1 solid black;
            padding-left: 5px;
            padding-right: 5px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>PRODUKSI - DEPT.FINISHING</h2>
        <hr>
    </div>
    <!--Tabel Data Sekolah -->
    <table class="table">
        <thead>
            <tr class="align-middle">
                <th rowspan="2" width="1%" class="text-center">No</th>
                <th rowspan="2" width="40%">Nama Operator</th>
                <th rowspan="2" class="text-center">Mesin</th>
                <th colspan="2" class="text-center">Quantity</th>
                <th colspan="2" class="text-center">Jenis Proses</th>
            </tr>
            <tr class="text-center">
                <th>Awal</th>
                <th>Jadi</th>
                <th>Bagus</th>
                <th>Jelek</th>
            </tr>
        </thead>
        <tbody id="tbody_sekolah">
            @foreach($operator as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->nama_mesin }}</td>
                <td>{{ $value->quantityAwal }} Meter</td>
                <td>{{ $value->quantityJadi }} Meter</td>
                <td>{{ $value->bagus }} Meter</td>
                <td>{{ $value->jelek }} Meter</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>