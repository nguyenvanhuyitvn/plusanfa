<?php
 namespace App\ConfigGuzzle;

 class ConfigGuzzle{
    protected $serviceURL;
    public function __construct()
    {
        $this->serviceURL = config('api.url');
    }
    public function setHeader(string $contentType){
        $headers = [
            'Content-Type' => $contentType,
            'Authorization' => 'Bearer ' . session('token'),
            'Access-Control-Allow-Origin' => "*"
        ];
        return $headers;
    }
    public function initialGuzzle(int $timeout, string $contentType){
        $client = new \GuzzleHttp\Client([
            'headers'=> $this->setHeader($contentType),
            'timeout' => $timeout
        ]);
        return $client;
    }
    public function getUrlApi(string $endpoint, int $param=null){
        return $this->serviceURL.'/'.$endpoint;
    }
  }
