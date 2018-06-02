<?php
namespace App\Api\NLP;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;

class APIRequest
{
    protected $http_cli;
    protected $request;
    protected $request_options = [];
    protected $api_url;
    protected $method = HTTP::GET;
    protected $uri = '';
    protected $headers = [];
    protected $multipart = [];

    public function __construct(String $method, array $uri)
    {
        $this->headers['APP_KEY'] =
            env('APP_KEY', 'tjx8u0F+DFntYLseMG8wJCFFYwFGPeeHR7oW9rILf3k=');

        $this->method = $method;
        $this->uri = $this->build_path($uri);

        $this->http_cli = new Guzzle([
            'base_uri' => env('API_BASE_URL', 'http://178.62.250.245:8080/mygradproject-1.0/')
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

    private function build_path(array $parts): string
    {

        $uri = '';
        foreach ($parts as $part){

            $uri .= trim($part) . '';
        }
        return $uri;
    }
}