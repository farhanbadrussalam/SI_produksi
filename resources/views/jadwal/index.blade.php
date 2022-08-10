@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">JADWAL PRODUKSI</h6>
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus-circle"></i> Tambah jadwal</button>
        <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
                <th>No</th>
                <th>Nama operator</th>
                <th>Nama mesin</th>
                <th>Waktu</th>
                <th>Action</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script>
    let table_ = false;
    $(function() {
        table_ = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            methode: 'GET',
            ajax: "{{ url('/jadwal/dataAjax') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_opp',
                    name: 'nama_opp'
                },
                {
                    data: 'nama_mesin',
                    name: 'nama_mesin'
                },
                {
                    data: 'waktu',
                    name: 'waktu'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        })

    })
</script>
@endsection