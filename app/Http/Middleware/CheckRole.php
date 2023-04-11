<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckRole
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null){
            auth()->shouldUse($guard); //shoud you user guard / table
            $token = $request->header('auth-token');
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            try {
                //  $user = $this->auth->authenticate($request);  //check authenticted user
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                return  $this -> returnError('401','Unauthenticated user');
            } catch (JWTException $e) {

                return  $this -> returnError('', 'token_invalid '.$e->getMessage());
            }
            if($guard=='admin-api')
            {
                if($user->role==1) {
                    return $next($request);
                }
                else
                {
                    return  $this -> returnError(403,'Not Allowed');
                }
            }
          
            elseif ($guard=='factoryManager-api')
            {
                if($user->role==2) {
                    return $next($request);
                }
                else
                {
                    return  $this -> returnError(403,'Not Allowed');
                }
            }
            elseif ($guard=='marketManager-api')
            {
                if($user->role==3) {
                    return $next($request);
                }
                else
                {
                    return  $this -> returnError(403,'Not Allowed');
                }
            }
            elseif ($guard=='factoryEmployee-api')
            {
                if($user->role==4) {
                    return $next($request);
                }
                else
                {
                    return  $this -> returnError(403,'Not Allowed');
                }
            }
            else 
            {
                if($user->role==5) {
                    return $next($request);
                }
                else
                {
                    return  $this -> returnError(403,'Not Allowed');
                }
            }

        }
        return $next($request);
    }
   
}
