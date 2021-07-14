<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;
class AdminController extends Controller
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
      $token = auth('admin')->attempt($credentials);
      $admin=auth('admin')->userOrFail()->id;
      if(!$token){
     return response()->json(['error'=>'ivaild email or password'], 401);
          
      }
     return response()->json(['adminToken'=>$token,'admin_id'=>$admin], 200);
 }

 public function logout(Request $request){
    $token= $request->header('Authorization');
    if(!$token)
    return response()->json(['msg'=>'some thing went wrong'],'404'); 
      try{ 
        auth('admin')->userOrfail();
        auth('admin')->logout();
      }catch (JWTException $e) {
        return response()->json(['msg'=>$e->getMessage()]);
    }
  return response()->json(['msg'=>'Logout Done'],'200');
 
 }

 public function profile(){
  try{ 
    $admin=auth('admin')->userOrfail();
    }catch (JWTException $e) {
      return response()->json(['msg'=>$e->getMessage()]);
  }
        return response()->json(['admin'=>$admin],'200');
  }

}