@extends('layouts.main')

@section('container')
<div class="card shadow mb-4 col-md-6 col-sm-12 p-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="{{ url('jadwal') }}" class="mr-3"><i class="fas fa-arrow-left"></i></a>JADWAL TANGGAL {{ date_format(date_create($jadwal->tanggal), "d F Y") }}
        </h6>
    </div>
    <div class="card-body">
        <div class="font-weight-bolder">
            <div>Nama operator : {{ $jadwal->user->name }}</div>
            <div>Nama Mesin : {{ $jadwal->mesin->nama_mesin }}</div>
            <div>Jam kerja : {{ $jadwal->mulai }} s/d {{ $jadwal->selesai }}</div>
        </div>
        <br>
        <div class="text-center w-100">
            <h2>PROSES MESIN</h2>
        </div>
        <ul class="list-group">
            @foreach($dataProses as $key => $value)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $key+1 }}. {{ $value->nama_proses }}</span>
                <!-- <span class="badge badge-primary badge-pill">14</span> -->
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection