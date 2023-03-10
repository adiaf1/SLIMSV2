<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokterPerujuk;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dokter.index', ['type_menu' => 'master']);
    }

    public function data()
    {
        $dokter = DokterPerujuk::orderBy('nama', 'asc')->get();

        return datatables()
            ->of($dokter)
            ->addIndexColumn()
            ->addColumn('check', function ($dokter) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox"
                            data-checkboxes="dokter"
                            class="custom-control-input dokter"
                            data-id="'.$dokter->id.'"
                            id="'.$dokter->id.'">
                        <label for="'.$dokter->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('nama', function ($dokter) {
                return '
                    <span class="badge badge-info">'.$dokter->nama.'</span>
                ';
            })
            ->addColumn('aksi', function ($dokter) {
                return '
                <div class="btn-group">
                    <a href="#" onclick="editForm('.$dokter->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="#" onclick="deleteData('.$dokter->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></a>
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
        
        $dokter = new DokterPerujuk();
        $dokter->nama = $request->nama;
        $dokter->asal = $request->asal;
        $dokter->kode_his = $request->kode_his;
        $dokter->save();

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
        
        $dokter = DokterPerujuk::find($id);
        if($dokter){
            $dokter->delete();
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
        $dokter = DokterPerujuk::find($id);

        return response()->json($dokter);
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
        $dokter = DokterPerujuk::find($id);
        $dokter->nama = $request->nama;
        $dokter->asal = $request->asal;
        $dokter->kode_his = $request->kode_his;
        $dokter->update();

        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function detail($id){
        session(['id_dokter' => $id]);

        return redirect()->route('dokter.index');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_dokter as $id) {
            $dokter = DokterPerujuk::find($id);
            if($dokter){
                $dokter->delete();
            }
        }

        return response(null, 204);
    }
}
