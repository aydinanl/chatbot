<?php

namespace App\Handlers;

use App\Api\NLP\NLPAPI;
use App\Models\Intents;

class ChatHandler
{
    public static function intentHasVariable(Intents $intent)
    {
        $null_order = 0;
        $c = \count($intent['variable_values']);
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

        if ($intent['has_operation'] == true) {
            return self::intentHasOperation($intent);
        }

        $out = ConservationHandler::changeOutputWithVariable($intent);
        return response()->json($out['answer']);
    }

    public static function intentHasOperation(Intents $intent)
    {
        $OP_TYPE = $intent['operation_type'];
        $OP_URL = $intent['operation_url'];
        //IF Type POST
        $build_b = $intent['variable_names'];

        $b_b_arr = [];
        $c_index = 0;

        if ($build_b !== null) {
            foreach ($build_b as $b) {
                $b_b_arr[$b] = $intent['variable_values'][$c_index];
                $c_index++;
            }
        }

        $OP_HEADERS = $b_b_arr;

        $response = (new NLPAPI)->doOperation($OP_TYPE, $OP_URL, $OP_HEADERS)->json_response;
        $out_S = ConservationHandler::changeOutputWithResponseVariable($intent, $response);

        return response()->json($out_S['answer']);
    }

    public static function intentHasForward(Intents $intent)
    {
        // TODO correct flow. check forwarded intent has variable => has opreration.
        $forward = Intents::find($intent['forwardID']);

        if($forward['has_variable'] === true){
            return self::intentHasVariable($forward);
        }

        if($forward['has_variable'] === true) {
            return self::intentHasOperation($forward);
        }

        $answer = [];
        array_push($answer, $intent['output'], $forward['output']);

        return response()->json($answer);
    }
}