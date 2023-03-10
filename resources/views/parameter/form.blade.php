
<div class="modal fade"
    tabindex="-1"
    role="dialog"
    id="modal-form">
    <div class="modal-dialog modal-lg"
        role="document">
        <form method="post">
                @csrf
                @method('post')
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
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" placeholder="Nama">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Kode Tes</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="kode_tes" placeholder="0">
                        </div>
                        
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Kode LIS</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="kode_lis" placeholder="Kode LIS">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="satuan" placeholder="Satuan">
                        </div>
                        
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Digit Koma</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="koma" placeholder="0">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Rujukan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="rujukan" placeholder="Rujukan">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Metoda</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="metoda" placeholder="Metoda">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Case</label>
                        <div class="col-sm-10">
                            <!-- <input type="text" class="form-control" name="case" placeholder="Case"> -->
                                    <select name="case" class="form-control selectric">
                                        <option value="">Pilih Case</option>
                                        <option value="0">General</option>
                                        <option value="1">Gender</option>
                                        <option value="2">Age</option>
                                        <option value="3">Gender & Age</option>
                                    </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Kode HIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kode_his" placeholder="Kode HIS">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="keterangan" placeholder="Keterangan...."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="button"
                        class="btn btn-primary submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

