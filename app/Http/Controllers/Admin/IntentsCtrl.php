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
}
