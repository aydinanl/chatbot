<?php
namespace App\Api\NLP;

use stdClass;

class APIError
{

    public $name = '';

    public $message = '';

    public $code = 0;

    public $status = 400;

    /**
     * APIError constructor.
     */
    public function __construct(stdClass $json) {
        if (isset($json->error)){
            foreach ($json->error as $property => $value){

                $this->$property = $value;
            }
        }
        foreach ($json as $property => $value){

            $this->$property = $value;
        }
        dd($this->$property);
    }
}