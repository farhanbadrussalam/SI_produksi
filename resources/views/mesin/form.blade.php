<!-- Modal tambah -->
<div class="modal fade" id="modalTambah" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambah">Tambah Mesin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('mesin') }}">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="nama_mesin">Nama mesin</label>
                        <input type="text" name="nama_mesin" id="nama_mesin" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="prosesMesin">Proses mesin</label>
                        <button class="btn btn-primary btn-sm ml-2" onclick="tambahProses()" type="button"><i class="fas fa-fw fa-plus-circle"></i> proses</button>
                        <div id="formProses" class="mt-1">
                            <input type="text" class="form-control form-control-sm" placeholder="Masukkan proses" name="proses_mesin[]" id="prosesMesin" required>

                        </div>
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
                <h5 class="modal-title" id="modalEdit">Edit mesin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="#" id="formUpdate">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="update_name">Nama mesin</label>
                        <input type="text" name="nama_mesin" id="update_name" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="prosesMesin_update">Proses mesin</label>
                        <button class="btn btn-primary btn-sm ml-2" onclick="tambahProses_update()" type="button"><i class="fas fa-fw fa-plus-circle"></i> proses</button>
                        <input type="text" class="form-control form-control-sm mt-1" placeholder="Masukkan proses" name="proses_mesin[]" id="prosesMesin_update" required>
                        <div id="formProses_update" class="mt-1">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal lihat -->
<div class="modal fade" id="modalLihat" data-keyboard="false" tabindex="-1" aria-labelledby="modalLihat" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLihat">Proses mesin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="prosesView">

                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function tambahProses() {
        let parent = document.createElement('div');
        parent.className = 'input-group mt-1';
        parent.innerHTML = `
                                <input type="text" class="form-control form-control-sm" placeholder="Masukkan proses" name="proses_mesin[]">
                                <div class="input-group-prepend">
                                    <span class="btn btn-danger btn-sm" onclick="hapusProses(this)">Hapus</span>
                                </div>
                            `;
        document.getElementById('formProses').appendChild(parent);
    }

    function tambahProses_update(value) {
        let parent = document.createElement('div');
        parent.className = 'input-group mt-1';
        parent.innerHTML = `
                                <input type="text" class="form-control form-control-sm" value="${value ? value : ''}" placeholder="Masukkan proses" name="proses_mesin[]">
                                <div class="input-group-prepend">
                                    <span class="btn btn-danger btn-sm" onclick="hapusProses(this)">Hapus</span>
                                </div>
                            `;
        document.getElementById('formProses_update').appendChild(parent);
    }

    function hapusProses(obj) {
        $(obj).parent().parent().remove();
    }
</script>