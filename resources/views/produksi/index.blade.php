@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DATA PRODUKSI</h6>
    </div>
    <div class="card-body">
        @if(isset($jadwal))
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if($proses != 0)
        <a class="btn btn-primary mb-2" href="{{ url('produksi/create') }}"><i class="fas fa-fw fa-plus-circle"></i> Tambah produk</a>
        @endif
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
        @else
        <div class="w-100 text-center">
            <h1>ANDA BELUM MEMPUNYAI JADWAL PRODUKSI</h1>
        </div>
        @endif
    </div>
</div>
<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Nama Proses</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="namaproses"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Jenis Kain</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="jenisKain"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Quantity Awal</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="quantityawal"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Quantity Jadi</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="quantityjadi"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Jenis</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="jenis"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Waktu</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="waktu_view"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <label class="fw-bold">Keterangan</label>
                        <label class="fw-bold">:</label>
                    </div>
                    <div class="col-md-8">
                        <span id="keterangan"></span>
                    </div>
                </div>
            </div>
        </div>
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

    function deleteThis(id) {
        const validasi = confirm('Are you sure want to delete?');

        if (validasi) {
            $.ajax({
                url: `{{ url('produksi') }}/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert(data);
                    table_.ajax.reload();
                }
            })
        }
    }

    function showInfo(obj) {
        const item = $(obj).data('item');
        document.getElementById('namaproses').innerHTML = item.nama_proses;
        document.getElementById('jenisKain').innerHTML = item.kain.nama_kain;
        document.getElementById('quantityawal').innerHTML = item.quantity_awal;
        document.getElementById('quantityjadi').innerHTML = item.quantity_jadi;
        document.getElementById('jenis').innerHTML = item.jenis_proses;
        document.getElementById('waktu_view').innerHTML = item.waktu_mulai + " s/d " + item.waktu_selesai;
        document.getElementById('keterangan').innerHTML = item.keterangan;

        $('#modalInfo').modal('show');
    }
</script>
@endsection