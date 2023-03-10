@extends('layouts.app')

@section('title', 'Data Pasien')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>DataTables</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Modules</a></div>
                    <div class="breadcrumb-item">DataTables</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Pasien</h2>
                <div class="buttons">
                    <a href="#"
                        class="btn btn-icon icon-left btn-primary" onclick="addForm('{{ route('pasien.store') }}')" ><i class="fas fa-user-plus"></i>
                        Add Pasien</a>
                    <a href="#" 
                        class="btn btn-icon icon-left btn-info"><i class="fas fa-info-circle"></i>
                                        Info</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-warning"><i
                                            class="fas fa-exclamation-triangle"></i> Warning</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Danger</a>
                    <a href="#"
                        class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>
                                        Success</a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card  card-primary">
                        <div class="card-header">
                            <h4>Daftar Pasien</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table_pasien" id="table-1">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@includeIf('pasien.form')
@endsection
@push('scripts')
<script>
    let table;
    $(function () {
        // console.log('Cek');
        // document.body.setAttribute('data-sidebar-size', 'sm');
        table = $('.table_pasien').DataTable();
        table.destroy();        
        table = $('.table_pasien').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength : 5,
            autoWidth: false,
            lengthMenu: [5, 20, 50, 100],
            ajax: "{{route('pasien.data')}}",
            columns: [
                // {data: 'select_all', searchable: false, sortable: false},
                // {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_rm', sortable: false,
                    render: function (dataField) { 
                        return '<span class="badge badge-success">'+dataField+'</span>';
                        // <span class="badge badge-success">Success</span>
                    }   
                },
                // {data: 'kode_his'},
                {data: 'nik'},
                {data: 'nama'},
                {data: 'tgl_lahir'},
                {data: 'jenis_kelamin', searchable: false,},
                {data: 'no_hp'},
                {data: 'alamat', searchable: false,},
                {data: 'aksi', searchable: false, sortable: false,
                    render: function (dataField) { 
                        // var url = `{{ route("pasien.update", '+dataField+') }}`;
                        return '<div class="btn-group">'+
                            '<button onclick="editForm('+dataField+')" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-edit"></i></button>'+
                            '<button onclick="deleteData('+dataField+')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></button>'+
                            // '<button type="button" onclick="editForm('+dataField+')" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>'+
                            // '<button type="button" onclick="deleteData('+dataField+')" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>'+
                        '</div>'; 
                    }
                },
            ]
        });

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
        console.log('Cek');
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Form Registrasi pasien');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }

    function editForm(id) {
        // console.log('id');
        // console.log(id);
        url = `{{ url('/pasien') }}/${id}`;
        console.log(url);
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Grub Parameter');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nik]').focus();

        $.get(url)
            .done((response) => {
                // console.log(response.kode_his);
                $('#modal-form [name=nik]').val(response.nik);
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=tempat_lahir]').val(response.tempat_lahir);
                $('#modal-form [name=tgl_lahir]').val(response.tgl_lahir);
                $('#modal-form [name=jenis_kelamin]').val(response.jenis_kelamin);
                $('#modal-form [name=no_hp]').val(response.no_hp);
                $('#modal-form [name=alamat]').val(response.alamat);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function deleteData(id) {
        url = `{{ url('/pasien') }}/${id}`
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
</script>

    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>

    <script src="{{asset('assets/js/page/modules-ion-icons.js')}}"></script>
    <script src="{{asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
    <script src="{{asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>

  <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>

    <script src="{{asset('assets/js/page/modules-toastr.js')}}"></script>
    <script src="{{asset('assets/js/page/modules-sweetalert.js')}}"></script>
@endpush