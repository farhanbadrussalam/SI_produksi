@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">JADWAL PRODUKSI</h6>
    </div>
    <div class="card-body">
        @if(isset($jadwalKosong))
        <div class="w-100 text-center">
            <h1>ANDA BELUM MEMPUNYAI JADWAL PRODUKSI</h1>
        </div>
        @else
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <a class="btn btn-primary mb-2" href="{{ url('jadwal/create') }}"><i class="fas fa-fw fa-plus-circle"></i> Tambah jadwal</a>
        <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
                <th>No</th>
                <th>Nama operator</th>
                <th>Nama mesin</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Action</th>
            </thead>
            <tbody></tbody>
        </table>
        @endif
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
                    data: 'tanggal',
                    name: 'tanggal'
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
                url: `{{ url('jadwal') }}/${id}`,
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
</script>
@endsection