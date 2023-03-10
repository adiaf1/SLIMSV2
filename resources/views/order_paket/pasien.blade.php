<div class="modal fade bd-example-modal-lg"
    tabindex="-1"
    role="dialog"
    id="modal-pasien">
    <div class="modal-dialog modal-lg"
        style="min-width:80%;"
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
                    <table class="table table-striped table_pasien" id="table-3">
                        <thead>
                        <tr>
                            <!-- <th class="text-center">
                            #
                            </th> -->
                            <th>Kode RM</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th><i class="fas fa-cog"></th>
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
                    onclick="addSelected('{{ route('grub_parameter_detail.selected') }}')"
                    class="btn btn-primary submit">Add Selected</button>
            </div>
        </div>
    </div>
</div>