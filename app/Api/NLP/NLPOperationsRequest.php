<?php
namespace App\Api\NLP;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;

class NLPOperationsRequest
{
    protected $http_cli;
    protected $request;
    protected $request_options = [];
    protected $api_url;
    protected $method = HTTP::GET;
    protected $op_uri;
    protected $uri = '';
    protected $headers = [];
    protected $multipart = [];

    public function __construct(String $method, String $OP_URL)
    {
        $this->headers['PK-SECRET'] =
            env('PK_SECRET', '1bfff34738555dc770d0a174618721b6728a4da0a7dda89ab56676fd68d678df');

        $this->method = $method;
        $this->op_uri = $this->build_base_uri($OP_URL);
        $this->uri = $this->build_path($OP_URL);

        //dd('http://' . $this->op_uri . '/' . $this->uri);
        $this->http_cli = new Guzzle([
            'base_uri' => 'http://' . $this->op_uri
        ]);
    }

    public function call(): APIResponse
    {
        $this->request_options['headers'] = $this->headers;
        $this->request = new Request($this->method, $this->uri);
        try{

            return new APIResponse($this->http_cli->send($this->request, $this->request_options));
        }catch (ClientException $exception){
            return new APIResponse($exception->getResponse());
        }catch (ServerException $exception){
            return new APIResponse($exception->getResponse());
        }
    }

    public function auth($token)
    {
        $this->addHeader('Authorization', 'Bearer ' . $token);
        return $this;
    }

    public function queryString(array $query_params)
    {
        $this->request_options['query'] = $query_params;
        return $this;
    }

    public function addHeader($key, $val)
    {
        $this->headers[trim($key)] = trim($val);

        return $this;
    }

    public function plainBody(String $body)
    {
        $this->request_options['body'] = $body ;
        return $this;
    }

    public function JSONBody(array $body)
    {
        $this->request_options['json'] = $body;
        return $this;
    }

    public function URLEncodedFormBody(array $form_params)
    {
        $this->request_options['form_params'] = $form_params;
        return $this;
    }

    public function multipartFormBody(array $multipart_params)
    {
        $this->request_options['multipart'] = $multipart_params;
        return $this;
    }
    private function build_base_uri($OP_URL){
        //Find and assign base uri.
        $base_uri = explode('/',$OP_URL);
        return $base_uri[2];
    }

    private function build_path(String $OP_URI): string
    {

        $base_uri = explode('/',$OP_URI);
        $c = count($base_uri);
        $parts = [];

        for($i = 3; $i<$c;$i++){
            $parts[] = $base_uri[$i];
        }

        $uri = '';

        foreach ($parts as $part){

            $uri .= trim($part) . '/';
        }

        return $uri;
    }
}