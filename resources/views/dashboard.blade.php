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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $quantity_awal }} Meter</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $quantity_jadi }} Meter</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->level == 1)
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
                    @foreach($operator as $key => $value)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td class="text-center">{{ $value->bagus }}</td>
                        <td class="text-center">{{ $value->jelek }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection