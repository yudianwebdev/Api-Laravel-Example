<?php

namespace App\Http\Controllers;

use App\Models\InputQRcode;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $qrcode = InputQRcode::orderBy('time', "DESC")->get();
        $res = [
            "massage" => "List Data",
            'data' => $qrcode
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
        try {
            $qrcode = InputQRcode::create($request->all());
            $response = [
                'massage' => "Success",
                "data" => $qrcode
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                // 'massege' => "Failed" . $e->errorInfo
            ]);
        }
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
    public function destroy($id)
    {
        //
    }
}
