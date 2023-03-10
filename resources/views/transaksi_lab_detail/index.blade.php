@extends('layouts.app')

@section('title', 'Transaksi Lab Detail')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/ionicons/css/ionicons.min.css')}}">

    <style>
        #form_pasien{
            margin-bottom :6px;
        }
        .lable-master{
            padding-right:0px;
            padding-left:0px;
        }
    </style>
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Transaksi Lab Detail</h1>
            </div>

            <div class="section-body">
                <div class="card card-primary">
                    <form action="">
                    @csrf
                    <div class="card-header ">
                        <h4>Data Pasien</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group row" id="form_pasien" >
                                    <label for="kode_rm"
                                        class="col-sm-2 col-form-label text-right lable-master">Nomor RM</label>
                                    <div class="col-sm-4">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="kode_rm"
                                            placeholder="Nomr RM">
                                    </div>
                                    
                                    <label for="kode_lab"
                                        class="col-sm-2 col-form-label text-right lable-master">Nomor Lab</label>
                                    <div class="col-sm-4">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="kode_lab"
                                            placeholder="Nomor Lab">
                                    </div>
                                </div>

                                <div class="form-group row" id="form_pasien" >
                                    <label for="nik"
                                        class="col-sm-2 col-form-label text-right lable-master">NIK</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="nik"
                                            placeholder="nik">
                                    </div>
                                </div>

                                <div class="form-group row" id="form_pasien" >
                                    <label for="nama"
                                        class="col-sm-2 col-form-label text-right lable-master">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="nama"
                                            placeholder="Nama">
                                    </div>
                                </div>
                                
                                <div class="form-group row" id="form_pasien" >
                                    <label for="tgl_lahir"
                                        class="col-sm-2 col-form-label text-right lable-master">Tanggal Lahir</label>
                                    <div class="col-sm-4">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="tgl_lahir"
                                            placeholder="Tanggal Lahir">
                                    </div>
                                    
                                    <label for="sex"
                                        class="col-sm-2 col-form-label text-right lable-master">Gender</label>
                                    <div class="col-sm-4">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="sex"
                                            placeholder="Gender">
                                    </div>
                                </div>
                                
                                <div class="form-group row" id="form_pasien" >
                                    <label for="usia"
                                        class="col-sm-2 col-form-label text-right lable-master">Usia</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="usia"
                                            placeholder="Usia">
                                    </div>
                                </div>
                                
                                <div class="form-group row" id="form_pasien" >
                                    <label for="ruangan"
                                        class="col-sm-2 col-form-label text-right lable-master">Ruangan</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="ruangan"
                                            placeholder="Ruangan">
                                    </div>
                                </div>
                                
                                <div class="form-group row" id="form_pasien" >
                                    <label for="asuransi"
                                        class="col-sm-2 col-form-label text-right lable-master">Asuransi</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="asuransi"
                                            placeholder="Asuransi">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group row" id="form_pasien" >
                                    <label for="doketer_perujuk"
                                        class="col-sm-2 col-form-label text-right lable-master">Dokter Perujuk</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="doketer_perujuk"
                                            placeholder="Dokter Perujuk">
                                    </div>
                                </div>

                                <div class="form-group row" id="form_pasien" >
                                    <label for="doketer_acc"
                                        class="col-sm-2 col-form-label text-right lable-master">Dokter ACC</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="doketer_acc"
                                            placeholder="Dokter ACC">
                                    </div>
                                </div>

                                <div class="form-group row" id="form_pasien" >
                                    <label for="analis"
                                        class="col-sm-2 col-form-label text-right lable-master">Analis</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            id="analis"
                                            placeholder="Analis">
                                    </div>
                                </div>

                                <div class="form-group row" id="form_pasien" >              
                                    <label for="catatan"
                                        class="col-sm-2 col-form-label text-right lable-master">Catatan</label>
                                    <div class="col-sm-10">
                                        <textarea type="text"
                                            class="form-control form-control-sm"
                                            id="catatan"
                                            rows="4"
                                            placeholder="Catatan"></textarea>
                                    </div>
                                </div>
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
                                    <th>Acc</th>
                                    <th>Pemeriksaan</th>
                                    <th>Hasil</th>
                                    <th>Print Hasil</th>
                                    <th>Flag</th>
                                    <th>Rujukan</th>
                                    <th>Satuan</th>
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
@endsection

@push('scripts')
<script>
    $(function () {
        $("body").addClass("sidebar-mini");
    })
</script>
    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
@endpush
