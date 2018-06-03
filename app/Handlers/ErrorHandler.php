<?php

namespace App\Handlers;


class ErrorHandler
{
    protected $error;

    public function __construct($name)
    {
        $this->error = config('errors.' . strtoupper($name), []);

        if(empty($this->error)){
            $this->error = config('errors.' . 'UNKNOWN_ERROR');
        }

    }
    public function response(){
        return response()->json(['error' => $this->error],$this->error['status']);
    }
    public function asArray(){
        return ['error' => $this->error];
    }
}