<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\ParameterDetail;

class ParameterDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_parameter = session('id_parameter');
        $parameter = Parameter::find($id_parameter);

        //view('kode_lab_detail.index', compact('kode_lab', 'id_kode_lab'));
        return view('parameter_detail.index', ['type_menu' => 'parameter'],  compact('parameter'));
    }

    public function data($id)
    {
        $rule = ParameterDetail::where('id_parameter',$id)->get();

        return datatables()
            ->of($rule)
            ->addIndexColumn()
            ->addColumn('ket', function ($rule) {
                return '<input type="text" name="ket'.$rule->id.'" class="form-control rule" name="kode_his" value="'.$rule->ket.'" data-id="'. $rule->id .'">';
            })
            ->addColumn('case', function ($rule) {
                $parameter = Parameter::find($rule->id_parameter);
                $case = array();
                $case[0] = 'General';
                $case[1] = 'Gender';
                $case[2] = 'Age';
                $case[3] = 'Gander & Age';

                return $case[$parameter->case] ?? '';
            })
            ->addColumn('gender', function ($rule) {
                $gender = array();
                $gender[0] = 'General';
                $gender[1] = 'Laki-laki';
                $gender[2] = 'Perempuan';
                return '
                    <select name="gender'.$rule->id.'" id="gender'.$rule->id.'" class="form-control rule selectric " data-id="'. $rule->id .'">
                        <option value="'.$rule->gender.'" selected disabled>'.$gender[$rule->gender].'</option>
                        <option value="0">General</option>
                        <option value="1">Laki-Laki</option>
                        <option value="2">Perempuan</option>
                    </select>
                ';
            })
            ->addColumn('usia1', function ($rule) {
                return '<input type="number" name="usia1'.$rule->id.'" class="form-control rule" name="kode_his" value="'.$rule->usia1.'" data-id="'. $rule->id .'">';
            })
            ->addColumn('usia2', function ($rule) {
                return '<input type="number" name="usia2'.$rule->id.'" class="form-control rule" name="kode_his" value="'.$rule->usia2.'" data-id="'. $rule->id .'">';
            })
            ->addColumn('waktu', function ($rule) {
                $hari = array();
                $hari[0] = 'Hari';
                $hari[1] = 'Tahun';

                return '
                    <select id="waktu'.$rule->id.'" class="form-control rule selectric" data-id="'. $rule->id .'">
                        <option value="'.$rule->waktu.'" selected disabled>'.$hari[$rule->waktu].'</option>
                        <option value="0">Hari</option>
                        <option value="1">Tahun</option>
                    </select>
                ';
            })
            ->addColumn('nr1', function ($rule) {
                $parameter = Parameter::find($rule->id_parameter);
                return '<input type="number" name="nr1'.$rule->id.'" class="form-control rule" name="kode_his" value="'.sprintf('%0.'.$parameter->koma.'f', $rule->nr1).'" data-id="'. $rule->id .'">';
            })
            ->addColumn('rangen', function ($rule) {
                $rangen = array();
                $rangen[0] = '≤ n ≤';
                $rangen[1] = ' >n ';
                $rangen[2] = ' <.n ';
                $rangen[3] = ' ≥n ';                
                $rangen[4] = ' ≤n ';
                return '
                    <select id="rangen'.$rule->id.'" class="form-control rule selectric" data-id="'. $rule->id .'">
                        <option value="'.$rule->rangen.'" selected disabled>'.$rangen[$rule->rangen].'</option>
                        <option value="0">≤ n ≤</option>
                        <option value="1"> >n </option>
                        <option value="2"> <.n </option>
                        <option value="3"> ≥n </option>                
                        <option value="4"> ≤n </option>
                    </select>
                ';
            })
            ->addColumn('nr2', function ($rule) {
                $parameter = Parameter::find($rule->id_parameter);
                return '<input type="number" name="nr2'.$rule->id.'" class="form-control rule" name="kode_his" value="'.sprintf('%0.'.$parameter->koma.'f', $rule->nr2).'" data-id="'. $rule->id .'">';
            })
            ->addColumn('aksi', function ($rule) {
                return '
                <div class="btn-group">
                    <button onclick="deleteData('.$rule->id.')" class="btn btn-icon  btn-danger"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['ket', 'gender', 'usia1', 'usia2', 'nr1', 'rangen', 'nr2', 'waktu', 'aksi', 'kode_tes'])
            ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *href="#"
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $detail = new ParameterDetail();
        $detail->id_parameter = $id;
        $detail->gender = 0;
        $detail->usia1 = 0;
        $detail->usia2 = 0;
        $detail->waktu = 0;
        $detail->nr1 = 0;
        $detail->rangen = 0;
        $detail->nr2 = 0;
        $detail->save();

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
        
        $detail = ParameterDetail::find($id);
        if($detail){
            $detail->delete();
        }

        return response(null, 204);
    }

    public function update(Request $request, $id)
    {
        $rujukan = array();
        $rujukan[0] = $request->nr1.'-'.$request->nr2;
        $rujukan[1] = '>'.$request->nr1;
        $rujukan[2] = '<'.$request->nr2;
        $rujukan[3] = '≥'.$request->nr1;                
        $rujukan[4] = '≤'.$request->nr2;

        $detail = ParameterDetail::find($id);

        $detail->ket = $request->ket;
        $detail->gender = $request->gender;
        $detail->usia1 = $request->usia1;
        $detail->usia2 = $request->usia2;
        $detail->waktu = $request->waktu;
        $detail->nr1 = (float)$request->nr1;
        $detail->rangen = $request->rangen;
        $detail->nr2 = (float)$request->nr2;
        $detail->rujukan=$rujukan[ $request->rangen];
        $detail->update();

        
        // return response()->json($data);
        return response()->json('Data berhasil rubah', 200);
    }
}
