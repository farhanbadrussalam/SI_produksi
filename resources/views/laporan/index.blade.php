@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">LAPORAN PRODUKSI</h6>
    </div>
    <div class="card-body">
        <div class="w-100 text-center">
            <a href="{{ url('laporan/cetak') }}" class="btn btn-warning">Cetak Laporan</a>
        </div>
        <!-- <details open>
            <summary class="fw-bold h4">Kain</summary>
            <table class="w-100 table table-bordered table-sm">
                <thead>
                    <tr class="align-middle">
                        <th rowspan="2" width="1%" class="text-center">No</th>
                        <th rowspan="2" width="60%">Jenis Kain</th>
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
                <tbody id="tbody_dataKain"></tbody>
            </table>
        </details> -->
        <details open>
            <summary class="fw-bold h4">Operator</summary>
            <table class="w-100 table table-bordered table-sm">
                <thead>
                    <tr class="align-middle">
                        <th rowspan="2" width="1%" class="text-center">No</th>
                        <th rowspan="2" width="50%">Nama Operator</th>
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
                <tbody id="tbody_dataKain">
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
        </details>
    </div>
</div>
@endsection