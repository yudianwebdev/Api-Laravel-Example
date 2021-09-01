<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class stokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vallidator = Validator::make($request->all(), [
            'BarCode' => ['required', 'unique:stok_barangs'], 'NamaBarang' => ['required'], 'StokBarang' => ['required'], 'HargaSatuan' => ['required'],
        ]);
        if ($vallidator->fails()) {
            return response()->json($vallidator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            # code...
        }
        try {
            $qrcode = StokBarang::create([
                "BarCode" => $request->BarCode,
                "NamaBarang" => $request->NamaBarang,
                "StokBarang" => $request->StokBarang,
                "HargaSatuan" => $request->HargaSatuan,
                "Cobacoba" => Str::slug($request->NamaBarang, "-") . $request->StokBarang . '/' . Str::slug($request->BarCode, "-"),
            ]);
            $response = [
                'massage' => "Success",
                "data" => $qrcode
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'massege' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($BarCode)
    {
        //
        $Taransaksi = StokBarang::where('BarCode', $BarCode)->first();
        $res = [
            'massage' => 'Data Ditemukan',
            'Data' => $Taransaksi
        ];
        return response()->json($res, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
