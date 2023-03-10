<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiLabDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi_lab_detail.index', ['type_menu' => 'layout']);
    }
}
