@extends('layouts.main')

@section('container')
<div class="card shadow mb-4 col-md-7 col-sm-12 p-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DATA MESIN</h6>
    </div>
    <div class="card-body">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-fw fa-plus-circle"></i> Tambah mesin</button>
        <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
                <th>No</th>
                <th>Name Mesin</th>
                <th>Action</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@include('mesin.form')
<script>
    let table_ = false;
    $(function() {
        table_ = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            methode: 'GET',
            ajax: "{{ url('/mesin/dataAjax') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_mesin',
                    name: 'nama_mesin'
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

    function lihatData(obj) {
        let item = $(obj).data('item');
        let html = '';
        for (const [i, iterator] of item.proses_mesin.entries()) {
            html += `<li class="list-group-item">${i+1}. ${iterator.nama_proses}</li>`;
        }
        document.getElementById('prosesView').innerHTML = html;
        $('#modalLihat').modal('show');
    }

    function editData(obj) {
        let item = $(obj).data('item');

        document.getElementById('formProses_update').innerHTML = '';
        document.getElementById('prosesMesin_update').value = '';
        document.getElementById('update_name').value = item.nama_mesin;
        for (const [i, iterator] of item.proses_mesin.entries()) {
            if (i == 0) {
                document.getElementById('prosesMesin_update').value = iterator.nama_proses;
            } else {
                tambahProses_update(iterator.nama_proses);
            }
        }
        let formEdit = document.getElementById('formUpdate');
        formEdit.action = `{{ url('mesin') }}/${item.id}`;

        $('#modalEdit').modal('show');
    }

    function deleteThis(id) {
        const validasi = confirm('Are you sure want to delete?');

        if (validasi) {
            $.ajax({
                url: `{{ url('mesin') }}/${id}`,
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