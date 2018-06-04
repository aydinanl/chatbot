<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DashboardCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            return view('admin.dashboard', [
                'user' => $request->user
            ]);
        }else{
            return redirect("/login" );
        }
    }
}
