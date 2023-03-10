@extends('layouts.app')

@section('title', 'Grub Parameter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Grub Parameter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master</a></div>
                    <div class="breadcrumb-item">Grub Parameter</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Grub Parameter</h2>
                <div class="buttons">
                    <a href="#"
                        class="btn btn-icon icon-left btn-primary" onclick="addForm('{{ route('grub_parameter.store') }}')" ><i class="fas fa-user-plus"></i>
                        Add Grub</a>
                    <button onclick="deleteSelected('{{ route('grub_parameter.delete_selected') }}')" class="btn btn-icon icon-left btn-danger"><i class="fa fa-trash"></i> Delete Selected</button>
                    <a href="#" 
                        class="btn btn-icon icon-left btn-info"><i class="fas fa-info-circle"></i>
                                        Info</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-warning"><i
                                            class="fas fa-exclamation-triangle"></i> Warning</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>
                                        Success</a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card  card-primary">
                        <div class="card-header">
                            <h4>Daftar Grub Parameter</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table_grub" id="table-3">
                                <thead>                                 
                                <tr>
                                    <th class="text-center" width="5%">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="select_all_grub"
                                                data-checkboxes="grub"
                                                data-checkbox-role="dad"
                                                class="custom-control-input head_grub"
                                                id="grub">
                                            <label for="grub"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                    #
                                    </th>
                                    <th>Grub 1</th>
                                    <th>Grub 2</th>
                                    <th>Grub 3</th>
                                    <th><i class="fas fa-cog"></th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@includeIf('grub_parameter.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function () {
            // table = $('.table_grub').DataTable();
            // table.destroy();        
            table = $('.table_grub').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                    ajax: {
                        url: '{{ route('grub_parameter.data') }}',
                    },
                columns: [
                    {data: 'check', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'grub1'},
                    {data: 'grub2'},
                    {data: 'grub3'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

            $('.submit').click(function() {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    iziToast.success({
                        position: 'topRight',
                        title: 'Success!',
                        message: 'Data berhasil disimpan!'
                    });
                    table.ajax.reload();
                })
                .fail((errors) => {
                    iziToast.error({
                        position: 'topRight',
                        title: 'Gagal!',
                        message: 'Tidak dapat menyimpan data!'
                    });
                    return;
                });
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Form Grub Parameter');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
        }

        function deleteData(id) {
            url = `{{ url('/grub_parameter') }}/${id}`
            swal({
                title: "Anda yakin?",
                text: "Untuk Mengahapus data!",
                icon: "warning",    
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {                    
                        iziToast.success({
                            position: 'topRight',
                            title: 'Success!',
                            message: 'Behasil Hapus Data!'
                        });
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        // alert('Tidak dapat menghapus data');
                        iziToast.warning({
                            position: 'topRight',
                            title: 'Gagal!',
                            message: 'Gagal Hapus Data!'
                        });
                        return;
                    });
                } else {
                    // swal("Batal Hapus!");
                    iziToast.warning({
                        position: 'topRight',
                        title: 'Batal!',
                        message: 'Batal Hapus Data!'
                    });
                }
            });
        }

        function editForm(id) {
            url = `{{ url('/grub_parameter') }}/${id}`;
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Grub Parameter');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nik]').focus();

            $.get(url)
                .done((response) => {
                    // console.log(response.kode_his);
                    $('#modal-form [name=grub1]').val(response.grub1);
                    $('#modal-form [name=grub2]').val(response.grub2);
                    $('#modal-form [name=grub3]').val(response.grub3);
                })
                .fail((errors) => {
                    iziToast.warning({
                        position: 'topRight',
                        title: 'Warining!',
                        message: 'Tidak Dapat Menampilkan Data!'
                    });
                    return;
                });
        }

        function deleteSelected(url) {
            // console.log($('input:checked').length);
            var allVals = [];  
            $(".grub:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length>1) {
                swal({
                    title: "Anda yakin?",
                    text: "Untuk Mengahapus data!",
                    icon: "warning",    
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post(url, {
                            '_token': $('[name=csrf-token]').attr('content'),
                            '_method': 'post',
                            'id_grub' : allVals
                        })
                        .done((response) => {
                            iziToast.success({
                                position: 'topRight',
                                title: 'Success!',
                                message: 'Behasil Hapus Data!'
                            });
                            $(".head_grub").prop('checked',false);
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            // alert('Tidak dapat menghapus data');
                            iziToast.warning({
                                position: 'topRight',
                                title: 'Gagal!',
                                message: 'Gagal Hapus Data!'
                            });
                            return;
                        });
                    } else {
                        // swal("Batal Hapus!");
                        iziToast.warning({
                            position: 'topRight',
                            title: 'Batal!',
                            message: 'Batal Hapus Data!'
                        });
                    }
                });
            } else {
                // alert('Silahkan Pilih Parameter');
                iziToast.error({
                    position: 'topRight',
                    title: 'Warning!',
                    message: 'Silahkan Pilih Parameter lebih dari 1!'
                });
                return;
            }
        }
    </script>
    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
    
    <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
    <script src="{{asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
    
    <script src="{{asset('assets/js/page/modules-toastr.js')}}"></script>
    <script src="{{asset('assets/js/page/modules-sweetalert.js')}}"></script>
@endpush
