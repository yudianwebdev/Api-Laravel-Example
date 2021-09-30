<?php

namespace App\Http\Controllers;

use App\Models\InputQRcode;
use App\Models\newList;
use App\Models\StokBarang;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use Symfony\Component\HttpFoundation\Response;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TotalHarga = DB::table('new_lists')->select(DB::raw(' sum(Harga) as Total_Harga'))
            ->get();
        $Taransaksi = DB::table('new_lists')->join('stok_barangs', 'stok_barangs.BarCode', '=', 'new_lists.Barcode')->select('stok_barangs.BarCode', 'stok_barangs.NamaBarang', 'stok_barangs.HargaSatuan', DB::raw('count(new_lists.Barcode) as QTY, sum(new_lists.Harga) as Harga'))->groupBy('new_lists.Barcode')
            ->get();
        // dd($qrcode);
        $tesaray = [
            "TotalHarga" =>  $TotalHarga[0]->Total_Harga,
            "Taransaksi" => $Taransaksi,
        ];
        $res = [
            "massage" => "List Data",
            'data' => $tesaray
        ];

        return response()->json($res, Response::HTTP_OK);
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
        // dd($request->all());
        // foreach ($request->QRCODE as $value) {
        //     // dd($value);
        //     $QR = array("qrcode" => $value['qrcode']);
        //     $qrcode = InputQRcode::create($QR);
        //     //throw $th;
        // }

        $vallidator = Validator::make($request->all(), [
            'qrcode.*' => ['required'],
        ]);
        if ($vallidator->fails()) {
            return response()->json($vallidator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            # code...
        }

        
        $qr = StokBarang::where('BarCode', $request->qrcode)->first();
        $qrcode = $qr;
        // dd($qr->BarCode);
        if ($request->qrcode == $qr->BarCode){

            $qrcode = InputQRcode::firstOrCreate([
                'qrcode' => $request->qrcode
            ]);
            $qrcode->decrement('qty',5);
            $qrcode->save();
            $response = [
                'massage' => "Success",
                "data" => $qrcode
            ];
            return response()->json($response, Response::HTTP_CREATED);
        }
        else {
            # code...
            dd("tidak terbaca");
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
