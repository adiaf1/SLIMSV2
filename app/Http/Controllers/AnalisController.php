<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analis;

class AnalisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('analis.index', ['type_menu' => 'master']);
    }

    public function data()
    {
        $analis = Analis::orderBy('nama', 'asc')->get();

        return datatables()
            ->of($analis)
            ->addIndexColumn()
            ->addColumn('check', function ($analis) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox"
                            data-checkboxes="analis"
                            class="custom-control-input analis"
                            data-id="'.$analis->id.'"
                            id="'.$analis->id.'">
                        <label for="'.$analis->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('nama', function ($analis) {
                return '
                    <span class="badge badge-info">'.$analis->nama.'</span>
                ';
            })
            ->addColumn('aksi', function ($analis) {
                return '
                <div class="btn-group">
                    <button onclick="editForm('.$analis->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData('.$analis->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></button>
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
        
        $analis = new Analis();
        $analis->nama = $request->nama;
        $analis->kode_his = $request->kode_his;
        $analis->save();

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
        
        $analis = Analis::find($id);
        if($analis){
            $analis->delete();
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
        $analis = Analis::find($id);

        return response()->json($analis);
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
        $analis = Analis::find($id);
        $analis->nama = $request->nama;
        $analis->kode_his = $request->kode_his;
        $analis->update();

        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function detail($id){
        session(['id_analis' => $id]);

        return redirect()->route('analis.index');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_analis as $id) {
            $analis = Analis::find($id);
            if($analis){
                $analis->delete();
            }
        }

        return response(null, 204);
    }
}
