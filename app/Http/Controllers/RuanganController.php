<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ruangan.index', ['type_menu' => 'master']);
    }

    public function data()
    {
        $ruangan = Ruangan::orderBy('nama', 'asc')->get();

        return datatables()
            ->of($ruangan)
            ->addIndexColumn()
            ->addColumn('check', function ($ruangan) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox"
                            data-checkboxes="ruangan"
                            class="custom-control-input ruangan"
                            data-id="'.$ruangan->id.'"
                            id="'.$ruangan->id.'">
                        <label for="'.$ruangan->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('nama', function ($ruangan) {
                return '
                    <span class="badge badge-info">'.$ruangan->nama.'</span>
                ';
            })
            ->addColumn('aksi', function ($ruangan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm('.$ruangan->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData('.$ruangan->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></button>
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
        
        $ruangan = new ruangan();
        $ruangan->nama = $request->nama;
        $ruangan->kode_his = $request->kode_his;
        $ruangan->save();

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
        
        $ruangan = Ruangan::find($id);
        if($ruangan){
            $ruangan->delete();
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
        $ruangan = Ruangan::find($id);

        return response()->json($ruangan);
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
        $ruangan = Ruangan::find($id);
        $ruangan->nama = $request->nama;
        $ruangan->kode_his = $request->kode_his;
        $ruangan->update();

        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function detail($id){
        session(['id_ruangan' => $id]);

        return redirect()->route('ruangan.index');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_ruangan as $id) {
            $ruangan = Ruangan::find($id);
            if($ruangan){
                $ruangan->delete();
            }
        }

        return response(null, 204);
    }
}
