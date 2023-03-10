
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
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Asal</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="asal" id="asal" placeholder="Asal">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Kode HIS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_his" id="kode_his" placeholder="Kode HIS">
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

