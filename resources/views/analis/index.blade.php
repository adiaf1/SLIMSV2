@extends('layouts.app')

@section('title', 'Analis')

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
                <h1>Analis</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master</a></div>
                    <div class="breadcrumb-item">Analis</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Analis</h2>
                <div class="buttons">
                    <button class="btn btn-icon icon-left btn-primary" onclick="addForm('{{ route('analis.store') }}')" ><i class="fas fa-user-plus"></i> Add analis</button>
                    <button onclick="deleteSelected('{{ route('analis.delete_selected') }}')" class="btn btn-icon icon-left btn-danger"><i class="fa fa-trash"></i> Delete Selected</button>
                    
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card  card-primary">
                        <div class="card-header">
                            <h4>Daftar Analis</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table_analis" id="table-3">
                                <thead>                                 
                                <tr>
                                    <th class="text-center" width="5%">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="select_all_analis"
                                                data-checkboxes="analis"
                                                data-checkbox-role="dad"
                                                class="custom-control-input head_analis"
                                                id="analis">
                                            <label for="analis"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                    #
                                    </th>
                                    <th>Nama</th>
                                    <th>Kode HIS</th>
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
@includeIf('analis.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function () {     
            table = $('.table_analis').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                    ajax: {
                        url: '{{ route('analis.data') }}',
                    },
                columns: [
                    {data: 'check', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'nama'},
                    {data: 'kode_his'},
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
            $('#modal-form .modal-title').text('Form Analis');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
        }

        function deleteData(id) {
            url = `{{ url('/analis') }}/${id}`
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
            url = `{{ url('/analis') }}/${id}`;
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Analis');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama]').focus();

            $.get(url)
                .done((response) => {
                    // console.log(response.kode_his);
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=asal]').val(response.asal);
                    $('#modal-form [name=kode_his]').val(response.kode_his);
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
            $(".analis:checked").each(function() {  
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
                            'id_analis' : allVals
                        })
                        .done((response) => {
                            iziToast.success({
                                position: 'topRight',
                                title: 'Success!',
                                message: 'Behasil Hapus Data!'
                            });
                            $(".head_analis").prop('checked',false);
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
