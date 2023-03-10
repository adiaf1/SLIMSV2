<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grub;
use App\Models\GrubDetail;

class GrubParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('grub_parameter.index', ['type_menu' => 'parameter']);
    }

    public function data()
    {
        $grub = Grub::orderBy('grub1', 'asc')->get();

        return datatables()
            ->of($grub)
            ->addIndexColumn()
            ->addColumn('check', function ($grub) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox"
                            data-checkboxes="grub"
                            class="custom-control-input grub"
                            data-id="'.$grub->id.'"
                            id="'.$grub->id.'">
                        <label for="'.$grub->id.'"
                            class="custom-control-label">&nbsp;</label>
                    </div>
                ';
            })
            ->addColumn('grub1', function ($grub) {
                return '
                    <a href="'. route('grub_parameter.detail', $grub->id) .'" class="badge badge-info">'.$grub->grub1.'</a>
                ';
            })
            ->addColumn('aksi', function ($grub) {
                return '
                <div class="btn-group">
                    <a href="#" onclick="editForm('.$grub->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="#" onclick="deleteData('.$grub->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'grub1', 'check'])
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
        
        $grub = new Grub();
        $grub->grub1 = $request->grub1;
        $grub->grub2 = $request->grub2;
        $grub->grub3 = $request->grub3;
        $grub->save();

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
        
        $grub = Grub::find($id);
        if($grub){
            $detail = GrubDetail::where('id_grub', $id)->get();
            foreach ($detail as $item) {
                $item->delete();
            }
            $grub->delete();
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
        $grub = Grub::find($id);

        return response()->json($grub);
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
        $grub = Grub::find($id);
        $grub->grub1 = $request->grub1;
        $grub->grub2 = $request->grub2;
        $grub->grub3 = $request->grub3;
        $grub->update();

        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function detail($id){
        session(['id_grub' => $id]);

        return redirect()->route('grub_parameter_detail.index');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_grub as $id) {
            $grub = Grub::find($id);
            if($grub){
                $detail = GrubDetail::where('id_grub', $id)->get();
                foreach ($detail as $item) {
                    $item->delete();
                }
                $grub->delete();
            }
        }

        return response(null, 204);
    }
}
