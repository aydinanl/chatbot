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
        foreach ($intents as $intent) {
            $intent_root_count = \count($intent['define_words']);
            $has_count = $intent_root_count - 3;

            foreach ($processed_message as $messages) {
                if (\in_array($messages, $intent['define_words'], true)) {
                    $count++;

                    if ($count >= $has_count) {
                        return $this->response($intent);
                    }
                }
            }
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
