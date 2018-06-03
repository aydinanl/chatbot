<?php
namespace App\Handlers;


class MessageHandler
{
    protected $message;

    public function __construct($name)
    {
        $this->message = config('messages.' . strtoupper($name), []);

        if(empty($this->message)){
            $this->message = config('messages.' . 'UNKNOWN_ERROR');
        }

    }
    public function response(){
        return response()->json(['success' => $this->message],$this->message['status']);
    }
    public function asArray(){
        return ['success' => $this->message];
    }
}