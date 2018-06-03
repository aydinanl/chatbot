<?php

namespace App\Http\Controllers;

use App\Handlers\ErrorHandler;
use App\Helpers\Utility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCtrl extends Controller
{
    public $createValidate = [
        'type' => 'bail|required',
        'username' => 'bail|required|unique:users,username',
        'password' => 'bail|required|max:128',
        'email' => 'bail|required|max:255|unique:users,email',
    ];


    //CRUD
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),$this->createValidate);
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return response()->json($error);
        }

        $user = new User();
        $user->type = trim($request->type);
        $user->username = trim($request->username);
        $user->password = Hash::make($request->password);
        $user->email = trim($request->email);

        $user->save();
        $user->id = $user->_id;
        $user->save();
        return response()->json($user);
    }

    public function read($id)
    {
        $user = (new User)->find($id);
        if(!$id){
            return (new ErrorHandler('UNKNOWN_ERROR'))->response();
        }
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = (new User)->find($id);
        $user->delete();

        return response()->json($user);
    }
}
