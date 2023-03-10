@extends('layouts.app')

@section('title', 'Daftar Pemeriksaan')

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
                <h1>Daftar Pemeriksaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master</a></div>
                    <div class="breadcrumb-item">Parameter</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Daftar Pemeriksaan</h2>
                <div class="buttons">
                    <button class="btn btn-icon icon-left btn-primary" onclick="addForm()" ><i class="fas fa-calendar-alt"></i> Ubah Periode</button>
                    <button class="btn btn-icon icon-left btn-info" onclick="addForm()" ><i class="fas fa-user-plus"></i> Registrasi Pasien</button>
                    <a href="{{ route('transaksi_lab.order') }}" class="btn btn-icon icon-left btn-success" ><i class="fa fa-list-alt"></i> Order Pemeriksaan</a>
                    <!-- <button onclick="deleteSelected()" class="btn btn-icon icon-left btn-danger"><i class="fa fa-trash"></i> Delete Selected</button> -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card  card-primary">
                        <div class="card-header">
                            <h4>Daftar Pemeriksaan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table_order" id="table-3">
                                <thead>                                 
                                <tr>
                                    <th class="text-center">
                                    #
                                    </th>
                                    <th>Progress</th>
                                    <th>No Lab</th>
                                    <th>No RM</th>
                                    <th>Nama</th>
                                    <th>Status Sampel</th>
                                    <th>Critical</th>
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
@includeIf('paket_parameter.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function () {    
            table = $('.table_order').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('transaksi_lab.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'progress'},
                {data: 'no_lab'},
                {data: 'no_rm'},
                {data: 'nama'},
                {data: 'status_sample'},
                {data: 'critical'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
        });
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
