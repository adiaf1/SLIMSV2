<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiLab;
use App\Models\Pasien;
use App\Models\PaketParameter;
use App\Models\PaketParameterDetail;

use Carbon\Carbon;
use DateTime;

class OrderPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_transaksi_lab = '0';
        $id_transaksi_lab = session('id_transaksi_lab');

        if($id_transaksi_lab!=null){
            $transaksi_lab = TransaksiLab::find($id_transaksi_lab);
            $pasien = Pasien::find($transaksi_lab->id_pasien ?? 0);

            return view('order_paket.index', ['type_menu' => 'order_paket'], compact('transaksi_lab', 'pasien'));
        }
        else{
            // return view('transaksi_lab.index', ['type_menu' => 'worklist']);
            return redirect()->route('transaksi_lab.index', ['type_menu' => 'worklist']);
        }
    }

    public function pasien(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Pasien::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Pasien::select('count(*) as allcount')->where('nama', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Pasien::orderBy('created_at', 'desc')
            ->where('pasien.kode_rm', 'like', '%' . $searchValue . '%')
            ->orWhere('pasien.nik', 'like', '%' . $searchValue . '%')
            ->orWhere('pasien.nama', 'like', '%' . $searchValue . '%')
            ->select('pasien.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $data = array();
        $jk = array();
        $jk[0]="Laki-Laki";
        $jk[1]="Perempuan";
        // $no=1;

        foreach ($records as $item) {
            $row = array();
            $row['kode_rm'] = $item->kode_rm;
            $row['kode_his'] = $item->kode_his;
            $row['nik'] = $item->nik;
            $row['nama'] = $item->nama; 
            $row['tempat_lahir'] = $item->tempat_lahir; 
            $row['tgl_lahir'] = $item->tgl_lahir; 
            $row['jenis_kelamin'] = $jk[(int)$item->jenis_kelamin]; 
            $row['no_hp'] = $item->no_hp; 
            $row['alamat'] = $item->alamat; 
            $row['aksi'] = $item->id;
            $data[] = $row;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data,
        );

        echo json_encode($response);
    }

    public function paket()
    {
        $paket = PaketParameter::all();

        return datatables()
            ->of($paket)
            ->addIndexColumn()
            ->addColumn('check', function ($paket) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox"
                            data-checkboxes="paket"
                            class="custom-control-input paket"
                            id="'.$paket->id.'"
                            data-id="'.$paket->id.'">
                        <label for="'.$paket->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('aksi', function ($paket) {
                return '
                <div class="btn-group">
                    <button onclick="pilihPaket('.$paket->id.')" class="btn btn-icon btn-sm btn-success"><i class="fas fa-check"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'check'])
            ->make(true);
    }

    public function pilihPasien($id, $id_order)
    {   
        $pasien = Pasien::find($id);
        $tgl_lahir = new DateTime($pasien->tgl_lahir);
        $today = new DateTime('today');

        $transaksi_lab = TransaksiLab::find($id_order);
        $transaksi_lab->id_pasien = $id;
        $transaksi_lab->usia_tahun = $today->diff($tgl_lahir)->y;
        $transaksi_lab->usia_bulan = $today->diff($tgl_lahir)->m;
        $transaksi_lab->usia_hari = $today->diff($tgl_lahir)->d;
        $transaksi_lab->update();

        $pasien['usia']=$today->diff($tgl_lahir)->y.' Tahun, '.$today->diff($tgl_lahir)->m.' Bulan, '.$today->diff($tgl_lahir)->d.' Hari.';
        return response()->json($pasien);
    }

    public function pilihPaket($id, $id_order)
    {   
        $paket = PaketParameter::find($id);

        $transaksi_lab = TransaksiLab::find($id_order);
        $transaksi_lab->save();

        return response()->json($pasien);
    }
}
