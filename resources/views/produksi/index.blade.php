@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DATA PRODUKSI</h6>
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus-circle"></i> Tambah produk</button>
        <table class="table table-bordered table-sm" id="dataTable" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="2" class="align-middle">No</th>
                    <th rowspan="2" class="align-middle">Proses</th>
                    <th rowspan="2" class="align-middle">Jenis kain</th>
                    <th colspan="2" class="text-center">Quantity</th>
                    <th rowspan="2" class="align-middle">Jenis</th>
                    <th rowspan="2" class="align-middle">waktu</th>
                    <th rowspan="2" class="align-middle">Action</th>
                </tr>
                <tr>
                    <th class="text-center">Awal</th>
                    <th class="text-center">Jadi</th>
                </tr>
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
            ajax: "{{ url('/produksi/dataAjax') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_proses',
                    name: 'nama_proses'
                },
                {
                    data: 'jenis_kain',
                    name: 'jenis_kain'
                },
                {
                    data: 'quantity_awal',
                    name: 'quantity_awal'
                },
                {
                    data: 'quantity_jadi',
                    name: 'quantity_jadi'
                },
                {
                    data: 'jenis_proses',
                    name: 'jenis_proses'
                },
                {
                    data: 'waktu_mulai',
                    name: 'waktu_mulai'
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