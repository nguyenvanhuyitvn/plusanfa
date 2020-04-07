<?php

namespace App\Repositories;
use App\ConfigGuzzle\ConfigGuzzle;
 
class GetAllDevicesRepository implements RepositoryInterface {
    public $guzzle;
	public function __construct(ConfigGuzzle $configGuzzle)
    {
        $this->guzzle = $configGuzzle;
    }
	public function getAll()
	{
		try{
            $client= $this->guzzle->initialGuzzle(3,'application/json, multipart/form-data');
            $urlGetUser = $this->guzzle->getUrlApi('alldevice');
            $myBody['token_push'] = session('token');
            $request = $client->get($urlGetUser);   
            $response = $request->getBody()->getContents();
            $data = (\json_decode($response, true));
            return $data;
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function getDetail(string $string){
        $data = $this->getAll() ? $this->getAll() : array();
        return $data[$string];
    }
	
}