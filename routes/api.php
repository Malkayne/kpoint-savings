<?php

use Illuminate\Http\Request;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('checkUser',function(Request $req){
   $user = User::where('accNum',$req->accNum)->first();
   if(!empty($user)){
       return "here";
   }else{
       return "not here";
   }
});


Route::post('submit_form',function(Request $req){
   
   if($req->has('name')){
        return response()->json(["status"=>"success","message" => "form submitted successfull","data"=>$req->name],200);
   }else{
        return response()->json(["status"=>"error","message"=>"invalid details"],202);
   }
   
 
});