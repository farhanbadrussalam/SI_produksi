@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DATA USER</h6>
    </div>
    <div class="card-body">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-fw fa-plus-circle"></i> Tambah User</button>
        <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@include('users.form')
<script>
    let table_ = false;
    $(function() {
        table_ = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            methode: 'GET',
            ajax: "{{ url('/users/dataAjax') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'level',
                    name: 'level'
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

    function editData(obj) {
        let item = $(obj).data('item');
        console.log(item);
        document.getElementById('update_name').value = item.name;
        document.getElementById('update_email').value = item.email;
        document.getElementById('update_level').value = item.level;
        // document.getElementById('update_name').value = item.password;

        let formEdit = document.getElementById('formUpdate');
        formEdit.action = `{{ url('users') }}/${item.id}`;

        $('#modalEdit').modal('show');
    }

    function deleteThis(id) {
        const validasi = confirm('Are you sure want to delete?');

        if (validasi) {
            $.ajax({
                url: `{{ url('users') }}/${id}`,
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
