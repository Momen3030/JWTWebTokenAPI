<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function  login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['errorr'=>$validator->errors()]);
        }
        $credentials=$request->only(['email','password']);
        $token = auth('user')->attempt($credentials);
        $user=auth('user')->userOrFail()->id;
        if(!$token){
       return response()->json(['error'=>'ivaild email or password'], 401);
        }
       return response()->json(['userToken'=>$token,'user_id'=>$user], 200);
   }

   public function logout(Request $request){
    $token= $request->header('Authorization');
    if(!$token)
    return response()->json(['msg'=>'some thing went wrong'],'404'); 
      try{ 
          
        auth('user')->userOrfail();
        auth('user')->logout();
      }catch (JWTException $e) {
        return response()->json(['msg'=>$e->getMessage()]);
    }
  return response()->json(['msg'=>'Logout Done'],'200');

 }

public function profile(){
    try{ 
      $user=auth('user')->userOrfail();
      }catch (JWTException $e) {
        return response()->json(['msg'=>$e->getMessage()]);
    }
  return response()->json(['user'=>$user],'200');
}

}