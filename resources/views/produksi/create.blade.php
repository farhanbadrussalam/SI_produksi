@extends('layouts.main')

@section('container')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
<script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<div class="card shadow mb-4 col-md-9 col-sm-12 p-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="{{ url('produksi') }}" class="mr-3"><i class="fas fa-arrow-left"></i></a>TAMBAH PRODUKSI
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ url('produksi') }}" method="post">
            @csrf
            <div class="form-row mb-2">
                <div class="col-md-6">
                    <label for="proses">Proses</label>
                    <select name="proses" id="proses" class="selectpicker show-tick form-control @error('proses') is-invalid @enderror" data-live-search="true" title="Select Proses">
                        @foreach($dataProses as $key)
                        @if(old('proses') == $key->id)
                        <option value="{{ $key->id }}" selected>{{ $key->nama_proses }}</option>
                        @else
                        <option value="{{ $key->id }}">{{ $key->nama_proses }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('proses')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="jenis_kain">Jenis Kain</label>
                    <select name="jenis_kain" id="jenis_kain" class="selectpicker show-tick form-control @error('jenis_kain') is-invalid @enderror" data-live-search="true" title="Jenis Kain">
                        @foreach($dataKain as $key)
                        @if(old('jenis_kain') == $key->id)
                        <option value="{{ $key->id }}" selected>{{ $key->nama_kain }}</option>
                        @else
                        <option value="{{ $key->id }}">{{ $key->nama_kain }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('jenis_kain')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-md-6">
                    <label for="warna">Warna</label>
                    <input type="text" name="warna" id="warna" value="{{ old('warna') }}" class="form-control @error('warna') is-invalid @enderror">
                    @error('warna')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="jenis_proses">Jenis Proses</label>
                    <select name="jenis_proses" id="jenis_proses" class="form-control @error('jenis_proses') is-invalid @enderror">
                        <option value="Bagus">Bagus</option>
                        <option value="Jelek" @if(old('jenis_proses')=='Jelek' ) selected @endif>Jelek</option>
                    </select>
                    @error('jenis_proses')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-md-6">
                    <label for="quantity_awal">Quantity Awal</label>
                    <div class="input-group">
                        <input type="number" name="quantity_awal" value="{{ old('quantity_awal') }}" id="quantity_awal" class="form-control @error('quantity_awal') is-invalid @enderror">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Meter</div>
                        </div>
                        @error('quantity_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="quantity_jadi">Quantity Jadi</label>
                    <div class="input-group">
                        <input type="number" name="quantity_jadi" value="{{ old('quantity_jadi') }}" id="quantity_jadi" class="form-control @error('quantity_jadi') is-invalid @enderror">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Meter</div>
                        </div>
                        @error('quantity_jadi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-md-3">
                    <label for="waktu_mulai">Mulai</label>
                    <input type="time" value="{{ old('waktu_mulai') }}" value="{{ old('waktu_mulai') }}" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai" id="waktu_mulai">
                    @error('waktu_mulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="waktu_selesai">Selesai</label>
                    <input type="time" value="{{ old('waktu_selesai') }}" value="{{ old('waktu_selesai') }}" class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai" id="waktu_selesai">
                    @error('waktu_selesai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-md-12">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-warning" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>
@endsection