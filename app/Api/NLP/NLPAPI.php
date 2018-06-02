<?php

namespace App\Api\NLP;

class NLPAPI
{

    public function getNlpWords($message): APIResponse
    {
        return ( new APIRequest(HTTP::GET, ['index.jsp?mesaj=', $message] ))
            ->call();
    }

    public function doOperation($OP_TYPE,$OP_URL,$OP_HEADERS)
    {
        $opt = 'doOperation' . ucfirst(strtolower($OP_TYPE));
        return $this->$opt($OP_URL,$OP_HEADERS);
    }

    public function doOperationGet($OP_URL,$OP_HEADERS): APIResponse
    {
        return ( new NLPOperationsRequest(HTTP::GET, $OP_URL))
            ->call();
    }

    public function doOperationPost($OP_URL,$OP_HEADERS): APIResponse
    {
        return ( new NLPOperationsRequest(HTTP::POST, $OP_URL))
            ->JSONBody($OP_HEADERS)
            ->call();
    }
}