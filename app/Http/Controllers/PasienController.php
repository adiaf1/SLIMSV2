<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pasien.index', ['type_menu' => 'master']);
    }
    
    public function data(Request $request)
    {
        // $pasien = Pasien::orderBy('id', 'desc')->get();

        // return datatables()
        //     ->of($pasien)
        //     ->addIndexColumn()
        //     ->addColumn('jk', function ($pasien) {
        //         $jk[0]="Laki-Laki";
        //         $jk[1]="Perempuan";
        //         return $jk[$pasien->jenis_kelamin];
        //     })
        //     ->addColumn('aksi', function ($pasien) {
        //         return '
        //         ';
        //     })
        //     // ->rawColumns(['aksi', 'kode_rm'])
        //     ->make(true);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasien = Pasien::orderBy('id', 'desc')->first() ?? new pasien();
        $request['kode_rm'] = 'P'. tambah_nol_didepan((int)substr($pasien->kode_rm, 1) +1, 6);
        
        $pasien = new Pasien();
        $pasien->kode_rm = $request->kode_rm;
        $pasien->nik = $request->nik;
        $pasien->nama = $request->nama;
        $pasien->tempat_lahir = $request->tempat_lahir;
        $pasien->tgl_lahir = $request->tgl_lahir;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->alamat = $request->alamat;
        $pasien->no_hp = $request->no_hp;
        // $pasien->kode_his = $request->kode_his;
        $pasien->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $pasien = Pasien::find($id);
        if($pasien){
            $pasien->delete();
        }

        return response(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien = Pasien::find($id);

        return response()->json($pasien);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);
        // $pasien->kode_rm = $request->kode_rm;
        $pasien->nik = $request->nik;
        $pasien->nama = $request->nama;
        $pasien->tempat_lahir = $request->tempat_lahir;
        $pasien->tgl_lahir = $request->tgl_lahir;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->alamat = $request->alamat;
        $pasien->no_hp = $request->no_hp;
        // $pasien->kode_his = $request->kode_his;
        $pasien->update();

        return response()->json('Data berhasil disimpan', 200);
    }
}

