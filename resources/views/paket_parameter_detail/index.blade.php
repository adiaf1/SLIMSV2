@extends('layouts.app')

@section('title', 'Paket Detail Parameter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/modules/prism/prism.css')}}">

    <style>
        #form_pasien{
            margin-bottom :6px;
        }
        /* .lable-master{
            padding-right:0px;
            padding-left:0px;
        } */
    </style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
                <h1>Paket Detail Parameter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('paket_parameter') }}">Paket Parameter</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
        </div>

        <div class="section-body">                
            <h2 class="section-title">Paket Detail Parameter</h2>
            <div class="card card-primary">
                <form action="">
                    @csrf
                    <div class="card-header ">
                        <h4>Data Paket Parameter</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Nama</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$paket->nama}}</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Kode HIS</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$paket->kode_his}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card  card-warning">
                        <div class="card-header">
                            <h4>Daftar Parameter</h4>
                        </div>
                        <div class="card-body">
                            <!-- <form class="form-rule">
                                @csrf                                 -->
                                <div class="buttons">
                                    <a href="{{url('paket_parameter')}}" 
                                        class="btn btn-icon icon-left btn-info"><i class="fas fa-check-circle"></i> Selesai</a>
                                    <button onclick="formParameter()" class="btn btn-icon icon-left btn-success" ><i class="fas fa-plus-circle"></i> Add</button>
                                    <button onclick="deleteSelected('{{ route('paket_parameter_detail.delete_selected') }}')" class="btn btn-icon icon-left btn-danger"><i class="fa fa-trash"></i> Delete Selected</button>
                                </div>
                            <!-- </form> -->
                            
                            <!-- <form class="form-detail">
                            @csrf -->
                            <div class="table-responsive">
                            <input type="hidden" name="id_paket" id="id_paket" value="{{$paket->id}}">
                                <table class="table table-striped table_paket_detail" id="table-3">
                                    <thead>                                 
                                    <tr>
                                        <th class="text-center" width="5%">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" name="select_all_detail"
                                                    data-checkboxes="detail"
                                                    data-checkbox-role="dad"
                                                    class="custom-control-input head_detail"
                                                    id="detail">
                                                <label for="detail"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                        #
                                        </th>
                                        <th>Kode Tes</th>
                                        <th>Nama Parameter</th>
                                        <th>Kode LIS</th>
                                        <th>Satuan</th>
                                        <th>Kode HIS</th>
                                        <th><i class="fas fa-cog"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@includeIf('paket_parameter_detail.parameter')
@endsection

@push('scripts')
<script>
    let table, table_parameter;
    $(function () {   
        table = $('.table_paket_detail').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('paket_parameter_detail.data', $paket->id) }}',
            },
            columns: [
                {data: 'check', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_tes'},
                {data: 'nama'},
                {data: 'kode_lis'},
                {data: 'satuan'},
                {data: 'kode_his'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
        // table_parameter = $('.table-parameter').DataTable();
        // table_parameter.destroy();        
        table_parameter = $('.table-parameter').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('paket_parameter_detail.data_parameter') }}',
            },
            columns: [
                {data: 'check', searchable: false, sortable: false},
                {data: 'kode_tes'},
                {data: 'nama'},
                {data: 'kode_lis'},
                {data: 'satuan'},
                {data: 'kode_his'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

    });
    
    function formParameter() {
        $(".head_parameter").prop('checked',false);
        $(".parameter").prop('checked',false);
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Daftar Parameter');
    }

    function deleteData(id) {
        url = `{{ url('/paket_parameter_detail') }}/${id}`
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

    function addParameter(id) {
        let kode = "{{$paket->id}}";
        url = `{{ url('/paket_parameter_detail/add_parameter') }}/${kode}/${id}`;

        $.get(url)
        .done((response) => {
            $('#modal-form').modal('hide');
            iziToast.success({
                position: 'topRight',
                title: 'Success!',
                message: 'Data berhasil ditambahkan!'
            });
            table.ajax.reload();
        })
        .fail((errors) => {
            // alert('Tidak dapat menyimpan data');
            iziToast.error({
                position: 'topRight',
                title: 'Gagal!',
                message: 'Tidak dapat menambhkan data!'
            });
            return;
        });
    }

    function addSelected(url) {
        var allParameter = [];  
		$(".parameter:checked").each(function() {  
			allParameter.push($(this).attr('data-id'));
		});

        if (allParameter.length>1) {
                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'post',
                    'id_paket': '{{$paket->id}}',
                    'id_parameter' : allParameter
                })
                .done(response => {
                    iziToast.success({
                        position: 'topRight',
                        title: 'Success!',
                        message: 'Data berhasil ditambahkan!'
                    });
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                })
                .fail(errors => {
                    // alert('Tidak dapat menyimpan data');                    
                    iziToast.error({
                        position: 'topRight',
                        title: 'Gagal!',
                        message: 'Tidak menyimpan data!'
                    });
                    return;
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

    function deleteSelected(url) {
        // console.log($('input:checked').length);
        var allVals = [];  
		$(".detail:checked").each(function() {  
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
                        'id_detail' : allVals
                    })
                    .done((response) => {
                        iziToast.success({
                            position: 'topRight',
                            title: 'Success!',
                            message: 'Behasil Hapus Data!'
                        });
                        $(".head_detail").prop('checked',false);
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
    <script src="{{asset('assets/modules/prism/prism.js')}}"></script>
    <!-- <script src="{{ asset('library/prismjs/prism.js') }}"></script> -->

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
    
    <script src="{{asset('assets/js/page/modules-toastr.js')}}"></script>
    <script src="{{asset('assets/js/page/modules-sweetalert.js')}}"></script>

    <script src="{{asset('assets/js/page/bootstrap-modal.js')}}"></script>
    <!-- <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script> -->
@endpush
