<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\Debug\ErrorHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class CheckTokenWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('token')) {
            return redirect('/login');
        }

        try {
            if (!$user = JWTAuth::setToken(session('token'))->authenticate()) {
                $this->removeTokenSession();

                return (new ErrorHandler('USER_NOT_FOUND'))->response();
            }
            if($user->type !== 'admin'){
                $this->removeTokenSession();
                return redirect()
                    ->route('login-index');
            }

        } catch (TokenExpiredException $e) {
            $this->removeTokenSession();
            return (new ErrorHandler('TOKEN_EXPIRED'))->response();
            //return view('admin.login', PKError::make(PKError::PKERR_TOKEN_EXPIRED)->get());

        } catch (TokenInvalidException $e) {
            $this->removeTokenSession();
            return (new ErrorHandler('TOKEN_INVALID'))->response();
            //return view('admin.login', PKError::make(PKError::PKERR_TOKEN_INVALID)->get());

        } catch (JWTException $e) {
            $this->removeTokenSession();
            //return view('admin.login', PKError::make(PKError::PKERR_TOKEN_ABSENT)->get());
            return (new ErrorHandler('TOKEN_ABSENT'))->response();
        }
        $request->user = Auth::user();
        return $next($request);
    }
    private function removeTokenSession()
    {
        session()->forget('token');
        return true;
    }
}
