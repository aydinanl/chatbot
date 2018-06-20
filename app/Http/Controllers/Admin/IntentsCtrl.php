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
            $intents = Intents::all();
            return view('admin.intentAddIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'intents' => $intents
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
            //dd($intent);
            $define_words = '';
            foreach ($intent['define_words'] as $word){
                $define_words .= $word . ' ';
            }
            $intents = Intents::all();
            return view('admin.intentEditIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'intent' => $intent,
                'intents' => $intents,
                'define_words' => trim($define_words)
            ]);
        }else{
            return redirect("/login" );
        }
    }

    //Delete Intent
    public function intentDelete($id,Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $q = (new Intents)->find($id);
            try {
                $q->delete();
            } catch (\Exception $e) {
                dd($e);
            }

            return redirect()
                ->back()
                ->with('success-message', 'Soru Silinmiştir.');
        }else{
            return redirect("/login" );
        }
    }
}
