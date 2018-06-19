<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utility;
use App\Models\Stats;
use App\Models\Intents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DashboardCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $total_intent = count(Intents::all());
            $stats = (new Stats())->first();
            $total_C = ['intent' => $total_intent, 'message' => $stats['message_c'],'seen' => $stats['seen_c'], 'unsuccess_c' =>$stats['unsuccess_c']];

            return view('admin.dashboard', [
                'user' => $request->user,
                'total_C' => $total_C
            ]);
        }else{
            return redirect("/login" );
        }
    }
}
