<?php

namespace App\Http\Controllers;

use App\Handlers\LoginHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\JsonResponse;

class LoginCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            return redirect('/admin/dashboard');
        }

        if(Cookie::get('ctoken' ) && Cookie::get('cid')){
            $request->session()->put('token',Cookie::get('ctoken' ));
            $request->session()->put('id',Cookie::get('cid'));

            return redirect('/admin/dashboard');
        }
        return view('login');
    }

    public function login(Request $request){
        $login = new LoginHandler();
        $login_make = $login->login($request);
        $login_res = JsonResponse::create($login_make)->getData(true);
        $login_response = $login_res['original'];

        return response()->json($login_response);
    }

    public function loginWeb(Request $request){
        $login = new LoginHandler();
        $login_make = $login->login($request);
        $login_res = JsonResponse::create($login_make)->getData(true);
        $login_response = $login_res['original'];
        if(array_key_exists('error', $login_response)){
            return view('login', [
                'error' => $login_response['error']
            ]);
        } else{
            $request->session()->put('token',$login_response['token']);
            $request->session()->put('id',$login_response['id']);

            if($request->remember == 1){
                $c1 = cookie('ctoken', $login_response['token']);
                $c2 = cookie('cid', $login_response['id']);

                return redirect('/admin/dashboard')->withCookies([$c1, $c2]);
            }
            //dd(cookie('ctoken'));
            return redirect('/admin/dashboard');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('token','id');

        \Cookie::queue(\Cookie::forget('ctoken'));
        \Cookie::queue(\Cookie::forget('cid'));

        return redirect('/login');
    }
}
