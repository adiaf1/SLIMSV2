<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketParameter;
use App\Models\PaketParameterDetail;

class PaketParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paket_parameter.index', ['type_menu' => 'paket_parameter']);
    }

    public function data()
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
                            data-id="'.$paket->id.'"
                            id="'.$paket->id.'">
                        <label for="'.$paket->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('nama', function ($paket) {
                return '
                    <a href="'. route('paket_parameter.detail', $paket->id) .'" class="badge badge-info">'.$paket->nama.'</a>
                ';
            })
            ->addColumn('aksi', function ($paket) {
                return '
                <div class="btn-group">
                    <a href="#" onclick="editForm('.$paket->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="#" onclick="deleteData('.$paket->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'check', 'nama'])
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
        
        $paket = new PaketParameter();
        $paket->nama = $request->nama;
        $paket->kode_his = $request->kode_his;
        $paket->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paket = PaketParameter::find($id);

        return response()->json($paket);
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
        $paket = PaketParameter::find($id);
        $paket->nama = $request->nama;
        $paket->kode_his = $request->kode_his;
        $paket->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function detail($id){
        session(['id_paket' => $id]);

        return redirect()->route('paket_parameter_detail.index');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $paket = PaketParameter::find($id);
        if($paket){
            $detail = PaketParameterDetail::where('id_paket', $id)->get();
            foreach ($detail as $item) {
                $item->delete();
            }
            $paket->delete();
        }
        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_paket as $id) {
            $paket = PaketParameter::find($id);
            if($paket){
                $detail = PaketParameterDetail::where('id_paket', $id)->get();
                foreach ($detail as $item) {
                    $item->delete();
                }
                $paket->delete();
            }
        }

        return response(null, 204);
    }

}
