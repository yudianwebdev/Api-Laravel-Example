<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function autenticete(Request $request){
        $vallidator = Validator::make($request->all(), [
            'email' => ['required','email:dns',], 
            'password' => ['required',"min:6"], 
        ]);
        if ($vallidator->fails()) {
            $res =[
                'code'=>422,
                'massage'=>"error validation",
                'data'=>$vallidator->errors(),
            ];
            return response()->json($res, Response::HTTP_UNPROCESSABLE_ENTITY);
            # code...
        }
        try {
            //code...
            $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
        
            return response()->json([           'code'=>Response::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $res =[
            'code'=>Response::HTTP_OK,            
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ];
        return response()->json($res, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'massege' => "Failed" . $e->errorInfo
            ]);
        }
        
     }

    public function store(Request $request)
    {
        //
        $vallidator = Validator::make($request->all(), [
            'name' => ['required'], 
            'email' => ['required','unique:users','email:dns',], 
            'password' => ['required',"min:6"], 
        ]);
        if ($vallidator->fails()) {
            $res =[
                'code'=>422,
                'massage'=>"error validation",
                'data'=>$vallidator->errors(),
            ];
            return response()->json($res, Response::HTTP_UNPROCESSABLE_ENTITY);
            # code...
        }
         try {
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
            $response = [
                'code'=>Response::HTTP_CREATED,
                'massage' => "Success",
                "data" => $user
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
