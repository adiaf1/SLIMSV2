<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\ParameterDetail;
use App\Models\Grub;
use App\Models\GrubDetail;
use App\Models\PaketParameter;
use App\Models\PaketParameterDetail;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parameter.index', ['type_menu' => 'parameter']);
    }

    public function data()
    {
        $parameter = Parameter::orderBy('kode_tes', 'asc')->get();

        return datatables()
            ->of($parameter)
            ->addIndexColumn()
            ->addColumn('kode_tes', function ($parameter) {
                return '<a href="'. route('parameter.rule', $parameter->id) .'" class="badge badge-info">'.$parameter->kode_tes.'</a>';
            })
            ->addColumn('grub1', function ($parameter) {
                $grub1='';
                $data='';
                $grub_detail = GrubDetail::where('id_parameter', $parameter->id)->get();
                foreach ($grub_detail as $item) {
                    $grub = Grub::find($item->id_grub);
                    if($data!=$grub->grub1){
                        if($data==''){
                            $grub1 = $grub->grub1;
                            $data = $grub->grub1;
                        }else{
                            $grub1 = $grub1.', '.$grub->grub1;
                            $data = $grub->grub1;
                        }
                    }
                }
                return $grub1;
            })
            ->addColumn('grub2', function ($parameter) {
                $grub2='';
                $data='';
                $grub_detail = GrubDetail::where('id_parameter', $parameter->id)->get();
                foreach ($grub_detail as $item) {
                    $grub = Grub::find($item->id_grub);
                    if($data!=$grub->grub2){
                        if($data==''){
                            $grub2 = $grub->grub2;
                            $data = $grub->grub2;
                        }else{
                            $grub2 = $grub2.', '.$grub->grub2;
                            $data = $grub->grub2;
                        }
                    }
                }
                return $grub2;
            })
            ->addColumn('grub3', function ($parameter) {
                $grub3='';
                $data='';
                $grub_detail = GrubDetail::where('id_parameter', $parameter->id)->get();
                foreach ($grub_detail as $item) {
                    $grub = Grub::find($item->id_grub);
                    if($data!=$grub->grub3){
                        if($data==''){
                            $grub3 = $grub->grub3;
                            $data = $grub->grub3;
                        }else{
                            $grub3 = $grub3.', '.$grub->grub3;
                            $data = $grub->grub3;
                        }
                    }
                }
                return $grub3;
            })
            ->addColumn('case', function ($parameter) {
                $case = array();
                $case[0] = 'General';
                $case[1] = 'Gender';
                $case[2] = 'Age';
                $case[3] = 'Gender & Age';
                return $case[$parameter->case] ?? '';
            })
            ->addColumn('aksi', function ($parameter) {
                return '
                <div class="btn-group">
                    <a href="#" onclick="editForm('.$parameter->id.')" class="btn btn-icon  btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="#" onclick="deleteData('.$parameter->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            // ->addColumn('aksi', function ($pasien) {
            //     return '
            //     ';
            // })
            ->rawColumns(['aksi', 'kode_tes'])
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
        
        $parameter = new Parameter();
        $parameter->nama = $request->nama;
        $parameter->kode_tes = $request->kode_tes;
        $parameter->kode_lis = $request->kode_lis;
        $parameter->satuan = $request->satuan;
        $parameter->rujukan = $request->rujukan;
        $parameter->metoda = $request->metoda;
        $parameter->kode_his = $request->kode_his;
        $parameter->case = $request->case;
        $parameter->koma = $request->koma;
        $parameter->keterangan = $request->keterangan;
        $parameter->save();

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
        
        $parameter = Parameter::find($id);
        if($parameter){
            $detail = ParameterDetail::where('id_parameter', $parameter->id)->get();
            foreach ($detail as $item) {
                $item->delete();
            }
            $detail_grub = GrubDetail::where('id_parameter', $parameter->id)->get();
            foreach ($detail_grub as $item) {
                $item->delete();
            }
            $detail_paket = PaketParameterDetail::where('id_parameter', $parameter->id)->get();
            foreach ($detail_paket as $item) {
                $item->delete();
            }
            $parameter->delete();
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
        $parameter = Parameter::find($id);

        return response()->json($parameter);
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
        $parameter = Parameter::find($id);
        $parameter->nama = $request->nama;
        $parameter->kode_tes = $request->kode_tes;
        $parameter->kode_lis = $request->kode_lis;
        $parameter->satuan = $request->satuan;
        $parameter->rujukan = $request->rujukan;
        $parameter->metoda = $request->metoda;
        $parameter->kode_his = $request->kode_his;
        $parameter->case = $request->case;
        $parameter->koma = $request->koma;
        $parameter->keterangan = $request->keterangan;
        $parameter->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function rule($id){
        session(['id_parameter' => $id]);

        return redirect()->route('parameter_detail.index');
    }
}
