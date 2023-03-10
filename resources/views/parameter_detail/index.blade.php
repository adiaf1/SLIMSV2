@extends('layouts.app')

@section('title', 'Rule Parameter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">

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

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rule Parameter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('parameter') }}">Parameter</a></div>
                    <div class="breadcrumb-item">Rule Parameter</div>
                </div>
            </div>

            <div class="section-body">                
            <h2 class="section-title">Rule Parameter</h2>
                <div class="card card-primary">
                    <form action="">
                    @csrf
                    <div class="card-header ">
                        <h4>Data Parameter</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Nama Parameter</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->nama}}</label>
                                </div>
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Kode Tes</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->kode_tes}}</label>
                                </div>
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Kode LIS</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->kode_lis}}</label>
                                </div>
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Kode HIS</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->kode_his}}</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Satuan</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->satuan}}</label>
                                </div>
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Metoda</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->metoda}}</label>
                                </div>
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-3 col-form-label lable-master"><b>Digit Koma</b></label>
                                    <label for="kode_rm"
                                        class="col-sm-9 col-form-label lable-master">: {{$parameter->koma}}</label>
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
                            <h4>Daftar Rule Parameter</h4>
                        </div>
                        <div class="card-body">
                            <!-- <form class="form-rule">
                                @csrf                                 -->
                                <div class="buttons">
                                    <!-- <input type="hidden" name="id_parameter" id="id_parameter" value="{{ $parameter->id }}"> -->
                                    <a href="{{url('parameter')}}" 
                                        class="btn btn-icon icon-left btn-info"><i class="fas fa-check-circle"></i>
                                                        Selesai</a>
                                    <button onclick="addRule()"
                                        class="btn btn-icon icon-left btn-success"><i class="fas fa-plus-circle"></i>
                                        Add
                                    </button>
                                </div>
                            <!-- </form> -->
                            <div class="table-responsive">
                            <table class="table table-striped table_rule" id="table-1">
                                <thead>                                 
                                <tr>
                                    <th class="text-center">
                                    #
                                    </th>
                                    <th>Keterangan</th>
                                    <th>Case</th>
                                    <th>Gander</th>
                                    <th>Usia 1</th>
                                    <th>Usia 2</th>
                                    <th>Waktu</th>
                                    <th>Nr1</th>
                                    <th>Range</th>
                                    <th>Nr2</th>
                                    <th>Rujukan</th>
                                    <!-- <th>Kode HIS</th> -->
                                    <!-- <th>Keterangan</th> -->
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
@endsection

@push('scripts')
<script>
    let table;
    $(function () {
        $("body").addClass("sidebar-mini");

        table = $('.table_rule').DataTable();
        table.destroy();        
        table = $('.table_rule').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('parameter_detail.data', $parameter->id) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'ket'},
                {data: 'case'},
                {data: 'gender'},
                {data: 'usia1'},
                {data: 'usia2'},
                {data: 'waktu'},
                {data: 'nr1'},
                {data: 'rangen'},
                {data: 'nr2'},
                {data: 'rujukan'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        // $('.tambah_rule').click(function() {
        //     $.post('{{route('parameter_detail.store')}}',$('.form-rule').serialize())
        //     .done(response => {
        //             iziToast.success({
        //                 position: 'topRight',
        //                 title: 'Success!',
        //                 message: 'Behasil Menambah Data!'
        //             });
        //         table.ajax.reload();
        //     })
        //     .fail(errors => {
        //         // alert('Tidak dapat menyimpan data');
        //             iziToast.warning({
        //                 position: 'topRight',
        //                 title: 'Gagal!',
        //                 message: 'Gagal Menambah Data!'
        //             });
        //         return;
        //     });
        // });

        $(document).on('change', '.rule', function () {
            let id = $(this).data('id');
            var ket = $("input[name='ket"+id+"']").val();
            // var e = document.getElementById("gender"+id);
            var gender = document.getElementById("gender"+id).value;//$("#gender"+id).val();
            var usia1 = $("input[name='usia1"+id+"']").val();
            var usia2 = $("input[name='usia2"+id+"']").val();
            let waktu = document.getElementById("waktu"+id).value;//$("#waktu"+id+" option:selected").data('val');
            let nr1 = $("input[name='nr1"+id+"']").val();
            var rangen = document.getElementById("rangen"+id).value;//$("#rangen"+id+" option:selected").data('val');
            let nr2 = $("input[name='nr2"+id+"']").val();
            
            console.log(nr2);

            $.post(`{{ url('/parameter_detail') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'ket' : ket,
                    'gender' : gender,
                    'usia1' : usia1,
                    'usia2' : usia2,
                    'waktu' : waktu,
                    'nr1' : nr1,
                    'rangen' : rangen,
                    'nr2' : nr2
                })
                .done(response => {
                    iziToast.success({
                        position: 'topRight',
                        title: 'Success!',
                        message: 'Behasil Merubah Rule!'
                    });
                        table.ajax.reload();
                })
                .fail(errors => {
                    // alert('Tidak dapat menyimpan data acc');
                    iziToast.warning({
                        position: 'topRight',
                        title: 'Gagal!',
                        message: 'Gagal merubah Rule!'
                    });
                    return;
                });
        });
    });

    function deleteData(id) {
        url = `{{ url('/parameter_detail') }}/${id}`
        swal({
            title: "Anda aykin?",
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

    function addRule() {
        // url = `{{ url('/parameter_detail') }}/${id}`
        $.get('{{route('parameter_detail.create', $parameter->id)}}')
            .done(response => {
                    iziToast.success({
                        position: 'topRight',
                        title: 'Success!',
                        message: 'Behasil Menambah Data!'
                    });
                table.ajax.reload();
            })
            .fail(errors => {
                // alert('Tidak dapat menyimpan data');
                    iziToast.warning({
                        position: 'topRight',
                        title: 'Gagal!',
                        message: 'Gagal Menambah Data!'
                    });
                return;
            });
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
