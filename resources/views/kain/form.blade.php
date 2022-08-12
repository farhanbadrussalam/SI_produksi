<!-- Modal tambah -->
<div class="modal fade" id="modalTambah" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambah">Tambah Kain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('kain') }}">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="nama_kain">Nama kain</label>
                        <input type="text" name="nama_kain" id="nama_kain" class="form-control" required>
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
                <h5 class="modal-title" id="modalEdit">Edit kain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="#" id="formUpdate">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="update_name">Nama kain</label>
                        <input type="text" name="nama_kain" id="update_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>