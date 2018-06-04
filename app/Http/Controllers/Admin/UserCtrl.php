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
    public $createValidate = [
        'username' => 'bail|required|unique:users,username',
        'password' => 'bail|required|max:128',
        'email' => 'bail|required|max:255|unique:users,email',
        'name' => 'bail|required|max:64',
        'surname' => 'bail|required|max:55',
    ];

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

    //CRUD
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),$this->createValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $usersL = (new User)->where('type','user')->get();
            $sub_cats = (new ExamSubCategories)->all();
            return view('admin.userIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'usersL' => $usersL,
                'sub_cats' => $sub_cats,
                'exam_add_error' => 'Tüm alanları doldurunuz.'
            ]);
        }

        $user = new User();
        $user->type = 'user';
        $user->username = trim($request->username);
        $user->password = Hash::make($request->password);
        $user->email = trim($request->email);
        $user->name = trim($request->name);
        $user->surname = trim($request->surname);
        $user->exam_cat_id = null;
        $user->exam_sub_cat_id = $request->sub_cat_id;

        //Create information about exam.
        $sub_cat = (new ExamSubCategories)->find($request->sub_cat_id);

        $user->exam_info = [
            'cat_name' => null,
            'sub_cat_name' => $sub_cat['sub_cat_name']
        ];

        $user->save();
        $user->id = $user->_id;
        $user->save();
        return redirect()->back();
    }

    //Report
    public function reportIndex(Request $request,$user_id)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $userS = (new User)->find($user_id);
            $questinons = (new ExamQuestions)->where('sub_cat_id', $userS['exam_sub_cat_id'])->get();
            return view('admin.reportIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'userS' => $userS,
                'questions' => $questinons
            ]);
        }else{
            return redirect("/login" );
        }
    }
}
