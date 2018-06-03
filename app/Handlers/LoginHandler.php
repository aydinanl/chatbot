<?php

namespace App\Handlers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginHandler
{
    public function login(Request $request){

        $username = trim($request->username);
        $password = trim($request->password);

        if(empty($username) || empty($password)){
            return (new ErrorHandler('USER_LOGIN_EMPTY'))->response();
        }

        $getUser = User::where(['username' => $username])->first();
        if(!$getUser){
            return (new ErrorHandler('USER_NOT_FOUND'))->response();
        }

        if(! Hash::check($password, $getUser->makeVisible('password')->password )){
            return (new ErrorHandler('USER_LOGIN_WRONG'))->response();
        }else{
            //Request'den kimlikleri al.
            $credentials = $request->only('username', 'password');

            try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = JWTAuth::attempt($credentials)) {

                    return (new ErrorHandler('INVALID_CREDENTIALS'))->response();
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return (new ErrorHandler('COULD_NOT_CREATE_TOKEN'))->response();
            }
            $user['token'] = $token;
            $user['id'] = $getUser['id'];

            return response()->json($user);
        }
    }
}