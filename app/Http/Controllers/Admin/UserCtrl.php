<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utility;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $usersL = (new User)->where('type','user')->get();
            $sub_cats = (new ExamSubCategories)->all();
            return view('admin.userIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'usersL' => $usersL,
                'sub_cats' => $sub_cats
            ]);
        }else{
            return redirect("/login" );
        }
    }
}
