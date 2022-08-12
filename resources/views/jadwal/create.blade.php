@extends('layouts.main')

@section('container')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
<script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<div class="card shadow mb-4 col-md-9 col-sm-12 p-0">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="{{ url('jadwal') }}" class="mr-3"><i class="fas fa-arrow-left"></i></a>Tambah jadwal
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ url('jadwal') }}" method="post">
            @csrf
            <div class="form-row mb-2">
                <div class="col-md-4">
                    <label for="operator">Nama Operator</label>
                    <select name="operator" id="operator" class="selectpicker show-tick form-control @error('operator') is-invalid @enderror" data-live-search="true" title="Select Operator">
                        @foreach($dataOperator as $key => $value)
                        @if(old('operator') == $value->id)
                        <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                        @else
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('operator')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="mesin">Mesin</label>
                    <select name="mesin" id="mesin" onchange="selectMesin(this)" class="selectpicker show-tick form-control @error('mesin') is-invalid @enderror" data-live-search="true" title="Select Mesin">
                        @foreach($dataMesin as $key)
                        <option value="{{ $key->id }}">{{ $key->nama_mesin }}</option>
                        @endforeach
                    </select>
                    @error('mesin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="proses_mesin">Proses</label>
                    <select name="proses_mesin[]" id="proses_mesin" class="selectpicker show-tick form-control @error('proses_mesin') is-invalid @enderror" multiple data-live-search="true" title="Proses mesin" data-actions-box="true">
                    </select>
                    @error('proses_mesin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-md-4">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" value="{{ old('mulai', now()->format('Y-m-d')) }}" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal">
                    @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="mulai">Mulai</label>
                    <input type="time" value="{{ old('mulai') }}" class="form-control @error('mulai') is-invalid @enderror" name="mulai" id="mulai">
                    @error('mulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="selesai">Selesai</label>
                    <input type="time" value="{{ old('selesai') }}" class="form-control @error('selesai') is-invalid @enderror" name="selesai" id="selesai">
                    @error('selesai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-warning" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>
<script>
    function selectMesin(obj) {
        const mesin = obj.value;
        const proses = <?= json_encode($dataProses) ?>;

        let dataProses = proses.filter((d) => d.mesin_id == mesin);

        let select = '';
        for (const row of dataProses) {
            select += `<option value="${row.id}">${row.nama_proses}</option>`;
        }

        document.getElementById('proses_mesin').innerHTML = select;
        $('#proses_mesin').selectpicker('refresh')
    }
</script>
@endsection