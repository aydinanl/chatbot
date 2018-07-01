<?php

namespace App\Http\Controllers;

use App\Api\NLP\NLPAPI;
use App\Handlers\ChatHandler;
use App\Handlers\ConservationHandler;
use App\Handlers\StatsHandler;
use App\Models\Feedback;
use App\Models\Intents;
use Illuminate\Http\Request;

class ChatCtrl extends Controller
{

    public function receive(Request $request)
    {
        //Get message of user.
        $message = trim($request->message);
        if (!$message) {
            return response()->json('Size nasıl yardımcı olabilirim?');
        }

        //Stats
        (new StatsHandler)->increaseMessageCount();

        //Process message with NLP API.
        $api = collect((new NLPAPI)->getNlpWords($message)->json_response);

        //Get roots of words that user entered from NLP API.
        $processed_message = [];
        foreach ($api['Keywords'] as $word) {
            $processed_message[] = strtolower($word->KeywordRoot);
        }

        //Get all intents for matching.
        $intents = Intents::all();


        $count = 0;
        //Match intent due to receive message.
        $matched_root_count = [];
        foreach ($intents as $intent) {
            //Find every root's of intent that has been matched with message.
            foreach ($processed_message as $messages) {
                if (\in_array($messages, $intent['define_words'], true)) {
                    $count++;
                }
            }
            $matched_root_count[] = [$intent['id'] => $count];
            //array_push($matched_root_count,$p);
            $count = 0;
        }
        
        $min = 0;
        $max = 0;
        $intent_id = '';

        foreach ($matched_root_count as $index => $val) {

            foreach ($val as $i => $dval) {
                $max = $dval;
                if ($max > $min) {
                    $min = $max;
                    $intent_id = $i;
                }
            }
        }
        //Get matched intent.
        $found_intent = Intents::find($intent_id);

        if(isset($found_intent)){
            return $this->response($found_intent);
        }

        (new StatsHandler)->increaseUnsuccessConservationCount();

        //No intent could matched.
        return response()->json('Bu konu hakkında bilgi veremiyorum.');
    }

    public function response(Intents $intent)
    {
        //Intents with variables.
        if ($intent['has_variable'] === true) {
            return ChatHandler::intentHasVariable($intent);
        }
        //Intents with operations.
        if ($intent['has_operation'] === true) {
            return ChatHandler::intentHasOperation($intent);
        }

        //Intents with forward.
        if ($intent['forward'] === true) {
            return ChatHandler::intentHasForward($intent);
        }

        //None of them activated, send default intent message.
        return response()->json($intent['output']);
    }
}
