<?php

use App\Http\Controllers\{
    PasienController,
    DokterController,
    AnalisController,
    RuanganController,
    AsuransiController,
    OrderPaketController,
    ParameterController,
    ParameterDetailController,
    GrubParameterController,
    GrubParameterDetailController,
    PaketParameterController,
    PaketParameterDetailController,
    TransaksiLabController,
    TransaksiLabDetailController,
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('walcome');
    return view('index', ['type_menu' => 'dashboard']);
})->name('dashboard');;

Route::get('/pasien/data', [PasienController::class, 'data'])->name('pasien.data');
Route::resource('/pasien', PasienController::class);

Route::get('/dokter/data', [DokterController::class, 'data'])->name('dokter.data');
Route::post('/dokter/delete_selected', [DokterController::class, 'deleteSelected'])->name('dokter.delete_selected');
Route::resource('/dokter', DokterController::class);

Route::get('/analis/data', [AnalisController::class, 'data'])->name('analis.data');
Route::post('/analis/delete_selected', [AnalisController::class, 'deleteSelected'])->name('analis.delete_selected');
Route::resource('/analis', AnalisController::class);

Route::get('/ruangan/data', [RuanganController::class, 'data'])->name('ruangan.data');
Route::post('/ruangan/delete_selected', [RuanganController::class, 'deleteSelected'])->name('ruangan.delete_selected');
Route::resource('/ruangan', RuanganController::class);

Route::get('/asuransi/data', [AsuransiController::class, 'data'])->name('asuransi.data');
Route::post('/asuransi/delete_selected', [AsuransiController::class, 'deleteSelected'])->name('asuransi.delete_selected');
Route::resource('/asuransi', AsuransiController::class);

Route::get('/parameter/data', [ParameterController::class, 'data'])->name('parameter.data');
Route::get('/parameter/{id}/rule', [ParameterController::class, 'rule'])->name('parameter.rule');
Route::resource('/parameter', ParameterController::class);

Route::get('/parameter_detail/{id}/data', [ParameterDetailController::class, 'data'])->name('parameter_detail.data');
Route::get('/parameter_detail/{id}/create', [ParameterDetailController::class, 'create'])->name('parameter_detail.create');
Route::resource('/parameter_detail', ParameterDetailController::class)
        ->except('create');

Route::get('/grub_parameter/data', [GrubParameterController::class, 'data'])->name('grub_parameter.data');
Route::get('/grub_parameter/{id}/detail', [GrubParameterController::class, 'detail'])->name('grub_parameter.detail');
Route::post('/grub_parameter/delete_selected', [GrubParameterController::class, 'deleteSelected'])->name('grub_parameter.delete_selected');
Route::resource('/grub_parameter', GrubParameterController::class);

Route::get('/grub_parameter_detail/{id}/data', [GrubParameterDetailController::class, 'data'])->name('grub_parameter_detail.data');
Route::get('/grub_parameter_detail/add_parameter/{kode}/{id}', [GrubParameterDetailController::class, 'addParameter'])->name('grub_parameter_detail.add_parameter');
Route::get('/grub_parameter_detail/data_parameter', [GrubParameterDetailController::class, 'dataParameter'])->name('grub_parameter_detail.data_parameter');
Route::post('/grub_parameter_detail/selected', [GrubParameterDetailController::class, 'selected'])->name('grub_parameter_detail.selected');
Route::post('/grub_parameter_detail/delete_selected', [GrubParameterDetailController::class, 'deleteSelected'])->name('grub_parameter_detail.delete_selected');
Route::resource('/grub_parameter_detail', GrubParameterDetailController::class);

Route::get('/paket_parameter/data', [PaketParameterController::class, 'data'])->name('paket_parameter.data');
Route::get('/paket_parameter/{id}/detail', [PaketParameterController::class, 'detail'])->name('paket_parameter.detail');
Route::post('/paket_parameter/delete_selected', [PaketParameterController::class, 'deleteSelected'])->name('paket_parameter.delete_selected');
Route::resource('/paket_parameter', PaketParameterController::class);

Route::get('/paket_parameter_detail/{id}/data', [PaketParameterDetailController::class, 'data'])->name('paket_parameter_detail.data');
Route::get('/paket_parameter_detail/add_parameter/{kode}/{id}', [PaketParameterDetailController::class, 'addParameter'])->name('paket_parameter_detail.add_parameter');
Route::get('/paket_parameter_detail/data_parameter', [PaketParameterDetailController::class, 'dataParameter'])->name('paket_parameter_detail.data_parameter');
Route::post('/paket_parameter_detail/selected', [PaketParameterDetailController::class, 'selected'])->name('paket_parameter_detail.selected');
Route::post('/paket_parameter_detail/delete_selected', [PaketParameterDetailController::class, 'deleteSelected'])->name('paket_parameter_detail.delete_selected');
Route::resource('/paket_parameter_detail', PaketParameterDetailController::class);

Route::get('/transaksi_lab/order', [TransaksiLabController::class, 'order'])->name('transaksi_lab.order');
Route::get('/transaksi_lab/data', [TransaksiLabController::class, 'data'])->name('transaksi_lab.data');
Route::resource('/transaksi_lab', TransaksiLabController::class);

Route::get('/order_paket/{id}/data', [OrderPaketController::class, 'data'])->name('order_paket.data');
Route::get('/order_paket/paket', [OrderPaketController::class, 'paket'])->name('order_paket.paket');
Route::get('/order_paket/pasien', [OrderPaketController::class, 'pasien'])->name('order_paket.pasien');
Route::get('/order_paket/pilih_pasien/{id}/{id_order}', [OrderPaketController::class, 'pilihPasien'])->name('order_paket.pilih_pasien');
Route::get('/order_paket/pilih_paket/{id}/{id_order}', [OrderPaketController::class, 'pilihPaket'])->name('order_paket.pilih_paket');
Route::resource('/order_paket', OrderPaketController::class);

Route::resource('/transaksi_lab_detail', TransaksiLabDetailController::class);