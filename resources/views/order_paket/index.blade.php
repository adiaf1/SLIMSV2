@extends('layouts.app')

@section('title', 'Order Paket Pemeriksaan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
    <style>
        #form_pasien{
            margin-bottom :6px;
        }
    </style>
@endpush

@section('main')
<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Order Paket Pemeriksaan</h1>
            </div>

            <div class="section-body">
                <div class="card card-primary">
                    <form action="">
                    @csrf
                    <div class="card-header ">
                        <h4>Data Pasien</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row" id="form_pasien">
                            <label for="kode_rm"
                                class="col-sm-2 col-form-label text-right">Nomor RM</label>
                            <div class="col-sm-4" >
                                <div class="input-group" >
                                    <input type="text"
                                        class="form-control"
                                        id="kode_rm"
                                        name="kode_rm"
                                        value="{{$pasien->kode_rm ?? ''}}"
                                        placeholder="Nomor RM" disabled>
                                    <div class="input-group-append">
                                        <button onclick="pasien()" class="btn btn-info btn-flat btn-sm" type="button"><i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <label for="kode_lab"
                                class="col-sm-2 col-form-label text-right">Nomor Lab</label>
                            <div class="col-sm-4" >
                                <input type="text"
                                    class="form-control"
                                    id="kode_lab"
                                    name="kode_lab"
                                    value="{{$transaksi_lab->no_lab ?? ''}}" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="form_pasien" >
                            <label for="nik"
                                class="col-sm-2 col-form-label text-right">NIK</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control form-control-sm"
                                    id="nik"
                                    name="nik"
                                        value="{{$pasien->nik ?? ''}}"
                                    placeholder="NIK" disabled>
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien" >
                            <label for="nama"
                                class="col-sm-2 col-form-label text-right">Nama</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control "
                                    id="nama"
                                    name="nama"
                                    value="{{$pasien->nama ?? ''}}"
                                    placeholder="Nama" disabled>
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien">
                            <label for="tgl_lahir"
                                class="col-sm-2 col-form-label text-right">Tanggal Lahir</label>
                            <div class="col-sm-4" >
                                <input type="text"
                                    class="form-control "
                                    id="tgl_lahir"
                                    name="tgl_lahir"
                                    value="{{$pasien->tgl_lahir ?? ''}}"
                                    placeholder="Tanggal Lahir" disabled>
                            </div>
                            <label for="sex"
                                class="col-sm-2 col-form-label text-right">Gender</label>
                            <div class="col-sm-4" >
                                <!-- <input type="text"
                                    class="form-control "
                                    id="gender"
                                    name="gender"
                                    placeholder="Gender" disabled> -->

                                <select id="gender" name="gender" class="form-control  selectric" disabled>
                                    <option value="">Pilih Gender</option>
                                    <option value="0">Laki-Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien" >
                            <label for="usia"
                                class="col-sm-2 col-form-label text-right">Usia</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control "
                                    id="usia"
                                    name="usia"
                                    value="{{$transaksi_lab->usia_tahun}} Tahun, {{$transaksi_lab->usia_bulan}} Bulan, {{$transaksi_lab->usia_hari}} Hari."
                                    placeholder="Usia" disabled>
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien">
                            <label for="ruangan"
                                class="col-sm-2 col-form-label text-right">Ruangan</label>
                            <div class="col-sm-4" >
                                <input type="text"
                                    class="form-control "
                                    id="ruangan"
                                    name="ruangan"
                                    placeholder="Ruangan">
                            </div>
                            <label for="penjamin"
                                class="col-sm-2 col-form-label text-right">Penjamin</label>
                            <div class="col-sm-4" >
                                <input type="text"
                                    class="form-control "
                                    id="penjamin"
                                    name="penjamin"
                                    placeholder="Penjamin">
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien" >
                            <label for="klinik"
                                class="col-sm-2 col-form-label text-right">Klinik</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control "
                                    id="klinik"
                                    name="klinik"
                                    placeholder="Klinik">
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien" >
                            <label for="doketer_pengirim"
                                class="col-sm-2 col-form-label text-right">Dokter Pengirim</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control "
                                    id="doketer_pengirim"
                                    name="doketer_pengirim"
                                    placeholder="Dokter Pengirim">
                            </div>
                        </div>
                        <div class="form-group row" id="form_pasien" >
                            <label for="asal"
                                class="col-sm-2 col-form-label text-right">Asal</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control "
                                    id="asal"
                                    name="asal"
                                    placeholder="Asal">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-warning">
                        <div class="card-header">
                            <h4>Detail Order Pemeriksaan</h4>
                        </div>
                        <div class="card-body">
                            
                        <div class="buttons">
                                <button
                                    class="btn btn-icon icon-left btn-primary" onclick="addPaket()" ><i class="fas fa-plus-circle"></i>
                                    Paket/Parameter</button>
                                <button
                                    class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash-alt"></i> Delete Select</button>
                                <button 
                                    class="btn btn-icon icon-left btn-info"><i class="fas fa-check"></i> Order Selesai</button>
                                <button
                                    class="btn btn-icon icon-left btn-warning"><i class="fas fa-window-close"></i> Batal Order</button>
                                <button type="button"
                                    class="btn btn-primary btn-icon icon-left">
                                    <i class="fas fa-plane"></i> Notifications
                                    <span class="badge badge-transparent">4</span>
                                </button>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-detail_paket" id="table-2">
                                <thead>                                 
                                <tr>
                                    <th class="text-center">
                                    #
                                    </th>
                                    <th>Kode HIS</th>
                                    <th>Parameter / Paket Pemeriksaan</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                                </thead>
                                <tbody>           
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@includeIf('order_paket.paket')
@includeIf('order_paket.pasien')
@endsection

@push('scripts')
    <script>
        let table, table_pasien, table_paket;
        $(function () {
            $('#gender').val("{{$pasien->jenis_kelamin ?? ''}}");
            table = $('.table-detail_paket').DataTable();

            table_pasien = $('.table_pasien').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength : 5,
                autoWidth: false,
                lengthMenu: [5, 20, 50, 100],
                ajax: "{{route('order_paket.pasien')}}",
                columns: [
                    {data: 'kode_rm'},
                    {data: 'nik'},
                    {data: 'nama'},
                    {data: 'tgl_lahir'},
                    {data: 'jenis_kelamin', searchable: false,},
                    {data: 'no_hp'},
                    {data: 'alamat', searchable: false,},
                    {data: 'aksi', searchable: false, sortable: false,
                        render: function (dataField) { 
                            return '<div class="btn-group">'+
                                '<button onclick="pilihPasien('+dataField+')" class="btn btn-icon btn-sm btn-success"><i class="fas fa-check"></i></button>'+
                            '</div>'; 
                        }
                    },
                ]
            });

            table_paket = $('.table-paket').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{route('order_paket.paket')}}",
                columns: [
                    {data: 'check', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_his'},
                    {data: 'nama'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });
        });

        function addPaket() {
            $('#modal-paket').modal('show');
            $('#modal-paket .modal-title').text('Form Paket / Parameter Pemeriksaan');

            $('#modal-paket form')[0].reset();
            // $('#modal-form form').attr('action', url);
            $('#modal-paket [name=_method]').val('post');
        }

        function pasien() {
            $('#modal-pasien').modal('show');
            $('#modal-pasien .modal-title').text('Daftar Pasien');

            // $('#modal-paket form')[0].reset();
            // $('#modal-form form').attr('action', url);
            // $('#modal-paket [name=_method]').val('post');
        }

        function pilihPasien(id) { 
           let id_order = "{{$transaksi_lab->id}}";
            $.get(`{{ url('/order_paket/pilih_pasien') }}/${id}/${id_order}`)
            .done((response) => {
                $('#modal-pasien').modal('hide');
                iziToast.success({
                    position: 'topRight',
                    title: 'Success!',
                    message: 'Behsail pilih pasien!'
                });
                $('#kode_rm').val(response.kode_rm);
                $('#nik').val(response.nik);
                $('#nama').val(response.nama);
                $('#tgl_lahir').val(response.tgl_lahir);
                $('#gender').val(response.jenis_kelamin);
                $('#usia').val(response.usia);
            })
            .fail((errors) => {
                // alert('Tidak dapat menyimpan data');
                iziToast.error({
                    position: 'topRight',
                    title: 'Gagal!',
                    message: 'Tidak dapat menampilkan data!'
                });
                return;
            });
        }

        function pilihPaket(id) { 
           let id_order = "{{$transaksi_lab->id}}";
            $.get(`{{ url('/order_paket/pilih_paket') }}/${id}/${id_order}`)
            .done((response) => {
                $('#modal-paket').modal('hide');
                iziToast.success({
                    position: 'topRight',
                    title: 'Success!',
                    message: 'Behsail pilih paket!'
                });
                table.ajax.reload();
            })
            .fail((errors) => {
                // alert('Tidak dapat menyimpan data');
                iziToast.error({
                    position: 'topRight',
                    title: 'Gagal!',
                    message: 'Tidak dapat menampilkan data!'
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