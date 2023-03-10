<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asuransi;

class AsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('asuransi.index', ['type_menu' => 'master']);
    }

    public function data()
    {
        $asuransi = Asuransi::orderBy('nama', 'asc')->get();

        return datatables()
            ->of($asuransi)
            ->addIndexColumn()
            ->addColumn('check', function ($asuransi) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox"
                            data-checkboxes="asuransi"
                            class="custom-control-input asuransi"
                            data-id="'.$asuransi->id.'"
                            id="'.$asuransi->id.'">
                        <label for="'.$asuransi->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('nama', function ($asuransi) {
                return '
                    <span class="badge badge-info">'.$asuransi->nama.'</span>
                ';
            })
            ->addColumn('aksi', function ($asuransi) {
                return '
                <div class="btn-group">
                    <button onclick="editForm('.$asuransi->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData('.$asuransi->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'nama', 'check'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $asuransi = new asuransi();
        $asuransi->nama = $request->nama;
        $asuransi->kode_his = $request->kode_his;
        $asuransi->save();

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
        
        $asuransi = Asuransi::find($id);
        if($asuransi){
            $asuransi->delete();
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
        $asuransi = Asuransi::find($id);

        return response()->json($asuransi);
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
        $asuransi = Asuransi::find($id);
        $asuransi->nama = $request->nama;
        $asuransi->kode_his = $request->kode_his;
        $asuransi->update();

        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function detail($id){
        session(['id_asuransi' => $id]);

        return redirect()->route('asuransi.index');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_asuransi as $id) {
            $asuransi = Asuransi::find($id);
            if($asuransi){
                $asuransi->delete();
            }
        }

        return response(null, 204);
    }
}
