<?php

namespace App\Repositories;
use App\ConfigGuzzle\ConfigGuzzle;
class GetMasterRepository implements RepositoryInterface {
    public $guzzle;
	public function __construct(ConfigGuzzle $configGuzzle)
    {
        $this->guzzle = $configGuzzle;
    }
	public function getAll()
	{
		try{
            $client= $this->guzzle->initialGuzzle(3,'application/json, multipart/form-data');
            $url = $this->guzzle->getUrlApi('masterdata');
            $myBody['token_push'] = session('token');
            $request = $client->get($url);   
            $response = $request->getBody()->getContents();
            $data = (\json_decode($response, true));
            return $data;
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function getDetail(string $string){
        $data = $this->getAll();
        return $data[$string];
    }
	
}