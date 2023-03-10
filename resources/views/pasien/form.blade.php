
<div class="modal fade"
    tabindex="-1"
    role="dialog"
    id="modal-form">
    <div class="modal-dialog modal-lg"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                    @csrf
                    @method('post')

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk KTP">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Ketikan Nama">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Ketikan Tempat Lahir">
                            
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" name="tgl_lahir" id="datepicker-basic" placeholder="1987-12-01">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <!-- <select class="form-control"> -->
                                <option value="">Pilih Gender</option>
                                <option value="0">Laki-laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="08xxx">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Enter...."></textarea>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">Batal</button>
                <button type="button"
                    class="btn btn-primary submit">Simpan</button>
            </div>
        </div>
    </div>
</div>

