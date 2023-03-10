<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiLab;
use App\Models\Pasien;

use Carbon\Carbon;

class TransaksiLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi_lab.index', ['type_menu' => 'worklist']);
    }

    public function data()
    {
        $transaksi_lab = TransaksiLab::all();

        return datatables()
            ->of($transaksi_lab)
            ->addIndexColumn()
            ->addColumn('progress', function ($transaksi_lab) {
                return '';
            })
            ->addColumn('no_lab', function ($transaksi_lab) {
                return '
                    <a href="" class="badge badge-info">'.$transaksi_lab->no_lab.'</a>
                ';
            })
            ->addColumn('no_rm', function ($transaksi_lab) {
                $no_rm='';
                $pasien = Pasien::find($transaksi_lab->id_pasien);
                if($pasien)
                    $no_rm=$pasien->kode_rm;
                return $no_rm;
            })
            ->addColumn('nama', function ($transaksi_lab) {
                $nama='';
                $pasien = Pasien::find($transaksi_lab->id_pasien);
                if($pasien)
                    $nama=$pasien->nama;
                return $nama;
            })
            ->addColumn('status_sample', function ($transaksi_lab) {
                return '';
            })
            ->addColumn('critical', function ($transaksi_lab) {
                return '';
            })
            ->addColumn('aksi', function ($transaksi_lab) {
                return '
                <div class="btn-group">
                    <a href="#" onclick="editForm('.$transaksi_lab->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="#" onclick="deleteData('.$transaksi_lab->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'no_lab'])
            ->make(true);
    }

    public function order()
    {
        $ldate = Carbon::now()->format('ymd');
        $detail = TransaksiLab::where('no_lab', 'LIKE', "%$ldate%")->count();
        if($detail!=0){
            $detail = TransaksiLab::where('no_lab', 'LIKE', "%$ldate%")->orderBy('no_lab', 'desc')->first();
            $row = (int)substr($detail->no_lab, 7);
            $row +=1;
            $no_lab = 'M'.$ldate.tambah_nol_didepan($row, 3);
        }else{
            $no_lab = 'M'.$ldate.tambah_nol_didepan(1, 3);
        }

        $transaksi_lab = new TransaksiLab();
        $transaksi_lab->no_lab = $no_lab;
        $transaksi_lab->id_pasien = 0;
        $transaksi_lab->usia_tahun = 0;
        $transaksi_lab->usia_bulan = 0;
        $transaksi_lab->usia_hari = 0;
        $transaksi_lab->status = 0;
        $transaksi_lab->save();

        session(['id_transaksi_lab' => $transaksi_lab->id]);
        return redirect()->route('order_paket.index');
    }
}
