@extends('layouts.app')

@section('title', 'Parameter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/ionicons/css/ionicons.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">

@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Parameter Pemeriksaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master</a></div>
                    <div class="breadcrumb-item">Parameter</div>
                </div>
            </div>

            <div class="section-body">      
                <h2 class="section-title">Parameter</h2>
                <div class="buttons">
                    <a href="#"
                        class="btn btn-icon icon-left btn-primary" onclick="addForm('{{ route('parameter.store') }}')" ><i class="fas fa-plus-circle"></i>
                        Add Parameter</a>
                    <!-- <a href="#" 
                        class="btn btn-icon icon-left btn-info" id="toastr-3"><i class="fas fa-info-circle"></i>
                                        Info</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-warning"><i
                                            class="fas fa-exclamation-triangle"></i> Warning</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Danger</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>
                                        Success</a> -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card  card-primary">
                        <div class="card-header">
                            <h4>Daftar Parameter</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table_parameter" id="table-1">
                                <thead>                                 
                                <tr>
                                    <th class="text-center">
                                    #
                                    </th>
                                    <th>Kode</th>
                                    <th>Grub1</th>
                                    <th>Grub2</th>
                                    <th>Grub3</th>
                                    <th>Nama</th>
                                    <th>Kode LIS</th>
                                    <th>Satuan</th>
                                    <th>Rujukan</th>
                                    <th>Metoda</th>
                                    <th>Case</th>
                                    <th>Kode HIS</th>
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
@includeIf('parameter.form')
@endsection

@push('scripts')
<script>
    let table;
    $(function () {
        $("body").addClass("sidebar-mini");

        table = $('.table_parameter').DataTable();
        table.destroy();        
        table = $('.table_parameter').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('parameter.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_tes'},
                {data: 'grub1'},
                {data: 'grub2'},
                {data: 'grub3'},
                {data: 'nama'},
                {data: 'kode_lis'},
                {data: 'satuan'},
                {data: 'rujukan'},
                {data: 'metoda'},
                {data: 'case'},
                {data: 'kode_his'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        // $('#modal-form').validator().on('submit', function (e) {
            // if (! e.preventDefault()) {
            //     console.log('submit');
            //     $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
            //         .done((response) => {
            //             $('#modal-form').modal('hide');
            //             table.ajax.reload();
            //         })
            //         .fail((errors) => {
            //             alert('Tidak dapat menyimpan data');
            //             return;
            //         });
            // }
        // });

        $('.submit').click(function() {
            // console.log('submit');
            // iziToast.show({
            //     title: 'Hello World!',
            //     message: 'I am a basic toast message!'
            // });
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
                    // alert('Tidak dapat menyimpan data');
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
        // console.log('Cek');
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Parameter');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }

    function deleteData(id) {
        url = `{{ url('/parameter') }}/${id}`
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
        console.log(id);
        url = `{{ url('/parameter') }}/${id}`;
        console.log(url);
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Parameter');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nik]').focus();

        $.get(url)
            .done((response) => {
                // console.log(response.kode_his);
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=kode_tes]').val(response.kode_tes);
                $('#modal-form [name=kode_lis]').val(response.kode_lis);
                $('#modal-form [name=satuan]').val(response.satuan);
                $('#modal-form [name=koma]').val(response.koma);
                $('#modal-form [name=rujukan]').val(response.rujukan);
                $('#modal-form [name=metoda]').val(response.metoda);
                $('#modal-form [name=case]').val(response.case);
                $('#modal-form [name=kode_his]').val(response.kode_his);
                $('#modal-form [name=keterangan]').val(response.keterangan);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
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
