<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;
Use App\Handlers\ErrorHandler;

class AllowedUserTypes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowed = array_slice(func_get_args(), 2);
        $allow = false;
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return (new ErrorHandler('USER_NOT_FOUND'))->response();
            }
        } catch (TokenExpiredException $e) {
            return (new ErrorHandler('TOKEN_EXPIRED'))->response();
        } catch (TokenInvalidException $e) {
            return (new ErrorHandler('TOKEN_INVALID'))->response();
        } catch (JWTException $e) {
            return (new ErrorHandler('TOKEN_ABSENT'))->response();
        }
        foreach ($allowed as $allows) {
            if($allows === $user->type){
                $allow = true;
            }
        }
        if($allow == true){
            return $next($request);
        }
        else{
            return (new ErrorHandler('USER_UNAUTHORIZED'))->response();
        }
    }
}
