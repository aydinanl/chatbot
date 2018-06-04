<?php

namespace App\Http\Controllers\Admin;

use App\Models\Intents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntentsCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $intents = Intents::all();
            return view('admin.intentsIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'intents' => $intents
            ]);
        }else{
            return redirect("/login" );
        }
    }

    //Add Index
    public function addIndex(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            return view('admin.intentAddIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
            ]);
        }else{
            return redirect("/login" );
        }
    }

    //Edit Index
    public function editIndex(Request $request,$id)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $intent =  (new Intents)->find($id);
            return view('admin.intentEditIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'intent' => $intent
            ]);
        }else{
            return redirect("/login" );
        }
    }
}
