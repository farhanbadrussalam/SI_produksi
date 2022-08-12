<!-- Modal tambah -->
<div class="modal fade" id="modalTambah" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambah">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('users') }}">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label for="level">Level</label>
                        <select class="form-control" name="level" id="level" required>
                            <option value="" hidden="">== Pilih Level ==</option>
                            <option value="1">Manager</option>
                            <option value="2">Admin Produksi</option>
                            <option value="3">Operator</option>
                            <option value="4">PPIC</option>
                        </select>
                    </div>



                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="modalEdit" data-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="#" id="formUpdate">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="update_name" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="update_email" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label for="level">Level</label>
                        <select class="form-control" name="level" id="update_level" required>
                            <option value="1">Manager</option>
                            <option value="2">Admin Produksi</option>
                            <option value="3">Operator</option>
                            <option value="4">PPIC</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
