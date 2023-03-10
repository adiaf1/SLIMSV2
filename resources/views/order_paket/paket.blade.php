
<div class="modal fade"
    tabindex="-1"
    role="dialog"
    id="modal-paket">
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paket" id="table-2">
                        <thead>                                 
                            <tr>
                                <th class="text-center" width="5%">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="select_all_paket"
                                            data-checkboxes="paket"
                                            data-checkbox-role="dad"
                                            class="custom-control-input head_paket"
                                            id="paket">
                                        <label for="paket"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Kode HIS</th>
                                <th>Parameter / Paket Pemeriksaan</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">Batal</button>
                <button type="button"
                    onclick="addSelected()"
                    class="btn btn-primary submit">Add Selected</button>
            </div>
        </div>
    </div>
</div>

