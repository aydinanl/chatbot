<?php
namespace App\Api\NLP;

use Psr\Http\Message\ResponseInterface;

class APIResponse
{

    /**
     * @var ResponseInterface $response_object
     */
    public $response_object;

    /**
     * @var int $status_code
     */
    public $status_code;

    /**
     * @var bool $is_successful
     */
    public $is_successful;

    /**
     * @var bool $is_valid_json
     */
    public $is_valid_json;

    /**
     * @var bool $has_error
     */
    public $has_error;

    /**
     * @var APIError $error
     */
    public $error;

    public $body;
    public $contents;
    public $headers;

    /**
     * @var \stdClass $json_response
     */
    public $json_response;

    /**
     * APIResponse constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response) {



        $this->response_object = $response;

        $this->status_code = $this->response_object->getStatusCode();
        $this->is_successful = $this->status_code === HTTP::SUCCESS_CODE;

        $this->headers = $this->response_object->getHeaders();
        $this->body = $this->response_object->getBody();

        try{

            $this->contents = $this->response_object->getBody()->getContents();
        }catch (\RuntimeException $exception){

            $this->has_error = true;

            $this->error = new APIError(json_decode(json_encode([
                'error' => [
                    'message' => 'Çalışma zamanı hatası, tekrar deneyiniz.',
                    'code' => '',
                    'name' => '',
                    'status' => $this->status_code
                ]
            ])));

            $this->contents = null;
            $this->is_valid_json = false;
            return;
        }

        try{

            \GuzzleHttp\json_decode($this->contents);
            $this->is_valid_json = true;
            $this->json_response = \GuzzleHttp\json_decode($this->contents);

        }catch (\InvalidArgumentException $exception){

            $this->is_valid_json = false;
        }

        if(!$this->is_successful && $this->is_valid_json){

            $this->has_error = true;
            $this->error = new APIError($this->json_response);
            return;
        }

        if(isset($this->json_response->error)){

            $this->has_error = true;
            $this->error = new APIError($this->json_response);
        }
    }

    public function getErrorAsArray()
    {

        if($this->has_error){

            return [
                'error' => [
                    'name' => $this->error->name,
                    'message' => $this->error->message,
                    'code' => $this->error->code,
                    'status' => $this->error->status
                ]
            ];
        }else return [];
    }
}