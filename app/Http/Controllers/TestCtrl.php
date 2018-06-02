<?php

namespace App\Http\Controllers;

use App\Api\NLP\NLPAPI;
use App\Handlers\ConservationHandler;
use App\Models\Feedback;
use App\Models\Intents;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TestCtrl extends Controller
{
    public function giveFeedback(Request $request)
    {
        $test = new Feedback;
        $test->name = $request->name;
        $test->feedback = $request->feedback;
        $test->success = 'Teşekkürler '. $request->name . ' geri bildiriminiz iletilmiştir.';
        $test->save();
        return response()->json($test);
    }

    public function testGet(Request $request)
    {
        /*
        $intent = Intents::find('5b106b6062bed0017c32cfaa');

        $OP_TYPE = $intent['operation_type'];
        $OP_URL = $intent['operation_url'];
        $OP_HEADERS = $intent['operation_headers'];

        $response = (new NLPAPI)->doOperation($OP_TYPE,$OP_URL,$OP_HEADERS)->json_response;
        $out = ConservationHandler::changeOutputWithResponseVariable($intent,$response);

        dd($out);
        */

        $intent = Intents::find('5b10989762bed0017d7334f9');
        $build_b = $intent['variable_names'];

        $b_b_arr = [];
        $c_index=0;
        if ($build_b){
            foreach ($build_b as $b){
                $b_b_arr[$b] = $intent['variable_values'][$c_index];
                $c_index++;
            }
        }

        $OP_TYPE = 'POST';
        $OP_URL = 'http://localhost:8020/api/feedback';
        $OP_HEADERS = $b_b_arr;

        $response = (new NLPAPI)->doOperation($OP_TYPE,$OP_URL,$OP_HEADERS)->json_response;
        dd($response);

        //$test = new Feedback;
        //$test->name = "Get operasyon çalıştırıldı.";
        //$test->save();
    }

    public function getTime()
    {
        return response()->json(Carbon::now());
    }
}
