<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
// namespace App\Http\Controllers\Auth;
// use JWTAuth;
class CheckAuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$gaurd=null)
    {
        
       if($gaurd){  
        try {
            auth($gaurd)->parseToken();
            auth($gaurd)->userOrfail();
         }
         catch(TokenInvalidException  $e)
         {
             return response(['Some thing went wrong please try again'], 401);
         }
         catch (TokenExpiredException $e) {
             return response()->json(['msg'=>'Unauthenticated user']);
         }
          catch (JWTException $e) {
             return response()->json(['msg'=>$e->getMessage()]);
         }
         return $next($request);
   
        }
        else{
            return response(['Some thing went wrong'], 401);
        }




    }



}