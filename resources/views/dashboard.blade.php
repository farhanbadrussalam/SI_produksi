@extends('layouts.main')

@section('container')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Kain Awal</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">1000 Meter</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kain Jadi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">800 Meter</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List data operator</h6>
            </div>
            <div class="card-body">
                <table class="w-100">
                    <tr>
                        <th width="5%">No</th>
                        <th width="60%">Nama Operator</th>
                        <th>Kain bagus (Meter)</th>
                        <th>Kain Jelek (Meter)</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Rahmi Agustina</td>
                        <td class="text-center">10</td>
                        <td class="text-center">3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Cici Mahendra</td>
                        <td class="text-center">200</td>
                        <td class="text-center">46</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Zelda Prasasta</td>
                        <td class="text-center">400</td>
                        <td class="text-center">66</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kenes Hastuti</td>
                        <td class="text-center">400</td>
                        <td class="text-center">100</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Makara Yulianti</td>
                        <td class="text-center">300</td>
                        <td class="text-center">66</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Lantar Nasyidah</td>
                        <td class="text-center">309</td>
                        <td class="text-center">90</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Elisa Sirait</td>
                        <td class="text-center">200</td>
                        <td class="text-center">200</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Luis Mandasari</td>
                        <td class="text-center">40</td>
                        <td class="text-center">2</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection