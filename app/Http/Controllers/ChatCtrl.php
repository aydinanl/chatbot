<?php

namespace App\Http\Controllers;

use App\Api\NLP\NLPAPI;
use App\Handlers\ConservationHandler;
use App\Models\Feedback;
use App\Models\Intents;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChatCtrl extends Controller
{

    public function receive(Request $request)
    {
        //Get message of user.
        $message = trim($request->message);
        if (!$message) {
            return response()->json('Mesaj giriniz.');
        }
        //Process message with NLP API.
        $api = collect((new NLPAPI)->getNlpWords($message)->json_response);

        //Get roots of words that user entered from NLP API.
        $processed_message = [];
        foreach ($api['Keywords'] as $word) {
            $processed_message[] = strtolower($word->KeywordRoot);
        }

        $intents = Intents::all();

        $count = 0;
        foreach ($intents as $intent) {
            $intent_root_count = count($intent['define_words']);
            $has_count = $intent_root_count - 3;

            foreach ($processed_message as $messages) {
                if (\in_array($messages, $intent['define_words'], true)) {
                    $count++;
                    if ($count >= $has_count) {
                        if ($intent['has_variable'] == true) {
                            $null_order = 0;
                            foreach ($intent['variable_values'] as $intent_value) {
                                if ($intent_value === null) {
                                    $answer = [
                                        'answer' => $intent['variable_questions'][$null_order],
                                        'has_value' => true,
                                        'intent_id' => $intent['id'],
                                        'value_order' => $null_order,
                                        'question_count' => \count($intent['variable_values'])
                                    ];
                                    return response()->json($answer);
                                }
                                $null_order++;
                            }

                            if($intent['has_operation'] == true){
                                $OP_TYPE = $intent['operation_type'];
                                $OP_URL = $intent['operation_url'];
                                //IF Type POST
                                $build_b = $intent['variable_names'];

                                $b_b_arr = [];
                                $c_index=0;
                                foreach ($build_b as $b){
                                    $b_b_arr[$b] = $intent['variable_values'][$c_index];
                                    $c_index++;
                                }
                                $OP_HEADERS = $build_b;

                                $response = (new NLPAPI)->doOperation($OP_TYPE,$OP_URL,$OP_HEADERS)->json_response;
                                $out_S = ConservationHandler::changeOutputWithResponseVariable($intent,$response);

                                return response()->json($out_S['answer']);
                            }

                            $out = ConservationHandler::changeOutputWithVariable($intent);
                            return response()->json($out['answer']);
                        }

                        // TODO correct flow.
                        //Intents with operations.
                        if($intent['has_operation'] == true){
                            $OP_TYPE = $intent['operation_type'];
                            $OP_URL = $intent['operation_url'];
                            //IF Type POST
                            $build_b = $intent['variable_names'];

                            $b_b_arr = [];
                            $c_index=0;
                            foreach ($build_b as $b){
                                $b_b_arr[$b] = $intent['variable_values'][$c_index];
                                $c_index++;
                            }
                            $OP_HEADERS = $build_b;

                            $response = (new NLPAPI)->doOperation($OP_TYPE,$OP_URL,$OP_HEADERS)->json_response;
                            $out_S = ConservationHandler::changeOutputWithResponseVariable($intent,$response);

                            return response()->json($out_S['answer']);
                        }

                        if ($intent['forward'] == true) {
                            // TODO çoklu forwardID olarak düzenle.
                            $forward = Intents::find($intent['forwardID']);
                            $answer = [];
                            array_push($answer, $intent['output'], $forward['output']);

                            return response()->json($answer);
                        }

                        return response()->json($intent['output']);
                    }

                }
            }
        }

        return response()->json('Bu konu hakkında bilgi veremiyorum.');
    }

    public function intenHasVariable(Intents $intents)
    {

    }
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
/*        $intent = Intents::find('5b106b6062bed0017c32cfaa');

        $OP_TYPE = $intent['operation_type'];
        $OP_URL = $intent['operation_url'];
        $OP_HEADERS = $intent['operation_headers'];
        // TODO !lats of todo. first priority to development.

        $response = (new NLPAPI)->doOperation($OP_TYPE,$OP_URL,$OP_HEADERS)->json_response;
        $out = ConservationHandler::changeOutputWithResponseVariable($intent,$response);

        dd($out);*/

        $intent = Intents::find('5b10989762bed0017d7334f9');
        $build_b = $intent['variable_names'];

        $b_b_arr = [];
        $c_index=0;
        foreach ($build_b as $b){
            $b_b_arr[$b] = $intent['variable_values'][$c_index];
            $c_index++;
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
