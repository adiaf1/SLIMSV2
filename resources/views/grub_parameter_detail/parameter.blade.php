<div class="modal fade bd-example-modal-lg"
    tabindex="-1"
    role="dialog"
    id="modal-form">
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
                <!-- <form class="form-parameter">
                    @csrf -->
                <div class="table-responsive">
                    <!-- <input type="hidden" name="id_grub" id="id_grub" value="{{$grub->id}}"> -->
                    <table class="table table-striped table-parameter" id="table-3">
                        <thead>                                 
                            <tr>
                                <!-- <th class="text-center">
                                    #
                                </th> -->
                                <th class="text-center" width="5%">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox"
                                            data-checkboxes="parameter"
                                            data-checkbox-role="dad"
                                            class="custom-control-input head_parameter"
                                            id="parameter">
                                        <label for="parameter"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Kode Tes</th>
                                <th>Nama</th>
                                <th>Kode LIS</th>
                                <th>Satuan</th>
                                <th>Kode HIS</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- </form> -->
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