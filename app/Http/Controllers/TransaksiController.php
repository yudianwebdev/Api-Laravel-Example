<?php

namespace App\Http\Controllers;

use App\Models\DetailTansaksi;
use App\Models\newList;
use App\Models\Transaksi;
use Hamcrest\Core\HasToString;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransaksiController extends Controller
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
        //

        try {
            $post = Transaksi::create([
                'IdTransaksi' => 'Trn-2021-' . rand(0, 9999),
                'TotalHarga' => $request->TotalHarga,
                'UangCash' => $request->UangCash,
                'UangKembalian' => $request->UangKembalian,
            ]);
            foreach ($request->Taransaksi as $value) {
                // dd($value);
                $response = DetailTansaksi::create([
                    'IdTransaksi' => $post->IdTransaksi,
                    'Barcode' => $value['BarCode'],
                    'NamaBarang' => $value['NamaBarang'],
                    'QTY' => $value['QTY'],
                    'Harga' => $value['Harga']
                ]);
            }
            // $Taransaksi = newList::deleted('IdNewList', 'NewList');
            // $Taransaksi::D
            try {
                $response = [
                    'massage' => "Success",
                    "data" => [
                        $post, $request->Taransaksi
                    ]
                ];
                return response()->json($response, Response::HTTP_CREATED);
            } catch (QueryException $e) {
                return response()->json([
                    // 'massege' => "Failed" . $e->errorInfo
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'massege' => "Failed" . $e->errorInfo
            ]);
        }
        // dd($post->IdTransaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($NewList)
    {
        $NewList = "NewList";
        $DeletNewList = newList::all()->delete($NewList);
        //
    }
}
