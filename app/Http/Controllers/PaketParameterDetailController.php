<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketParameter;
use App\Models\PaketParameterDetail;
use App\Models\Parameter;

class PaketParameterDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_paket = session('id_paket');
        $paket = PaketParameter::find($id_paket);

        return view('paket_parameter_detail.index', ['type_menu' => 'paket_parameter'], compact('paket'));
    }

    public function data($id)
    {
        $detail = PaketParameterDetail::where('id_paket', $id)->get();
        $data = array();

        $a=1;
        foreach ($detail as $item) {
            $parameter = Parameter::find($item->id_parameter);
            $row = array();

            $row['check'] = '
                <div class="custom-checkbox custom-control">
                    <input type="checkbox"
                        data-checkboxes="detail"
                        class="custom-control-input detail"
                        id="'.$item->id.'"
                        data-id="'.$item->id.'">
                    <label for="'.$item->id.'"
                        class="custom-control-label">&nbsp;</label>
                </div>
            ';
            $row['kode_tes'] = $parameter->kode_tes;
            $row['nama'] = $parameter->nama;
            $row['kode_lis'] = $parameter->kode_lis;
            $row['satuan'] = $parameter->satuan;
            $row['kode_his'] = $parameter->kode_his;
            $row['aksi'] = '
                <div class="btn-group">
                    <button onclick="deleteData('.$item->id.')" class="btn btn-icon btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </div>
            ';
            $data[] = $row;
            $a++;
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'check'])
            ->make(true);
    }

    public function dataParameter()
    {
        $parameter = Parameter::orderBy('kode_tes', 'asc')->get();
        $data = array();

        $r=1;
        foreach ($parameter as $item) {
            $row = array();
            $row['check'] = '
                <div class="custom-checkbox custom-control">
                    <input type="checkbox"
                        data-checkboxes="parameter"
                        class="custom-control-input parameter"
                        data-id="'.$item->id.'"
                        id="'.$item->id.'">
                    <label for="'.$item->id.'"
                        class="custom-control-label">&nbsp;</label>
                </div>
            ';
            $row['kode_tes'] = $item->kode_tes;
            $row['nama'] = $item->nama;
            $row['kode_lis'] = $item->kode_lis;
            $row['satuan'] = $item->satuan;
            $row['kode_his'] = $item->kode_his;
            $row['aksi'] = '
                <div class="btn-group">
                    <button onclick="addParameter('.$item->id.')" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-check"></i></button>
                </div>
            ';
            $data[] = $row;
            $r++;
        }

        return datatables()
        ->of($data)
        ->addIndexColumn()
            ->rawColumns(['aksi', 'check'])
            ->make(true);
    }

    
    public function addParameter($id_paket, $id_parameter)
    {
        $detail = PaketParameterDetail::where('id_paket', $id_paket)->where('id_parameter', $id_parameter)->first();
        if(!$detail){
            $detail = new PaketParameterDetail();
            $detail->id_paket = $id_paket;
            $detail->id_parameter = $id_parameter;
            $detail->save();
        }

        return response(null, 204);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $detail = PaketParameterDetail::find($id);
        if($detail){
            $detail->delete();
        }
        return response(null, 204);
    }

    public function selected(Request $request)
    {
        foreach ($request->id_parameter as $id) {
            $detail = PaketParameterDetail::where('id_paket', $request->id_paket)->where('id_parameter', $id)->first();
            if(!$detail){
                $detail = new PaketParameterDetail();
                $detail->id_paket = (int)$request->id_paket;
                $detail->id_parameter = (int)$id;
                $detail->save();
            }
        }
        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_detail as $id) {
            $detail = PaketParameterDetail::find($id);
            $detail->delete();
        }

        return response(null, 204);
    }
}
