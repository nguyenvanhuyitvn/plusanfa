<?php

namespace App\Repositories;
use App\ConfigGuzzle\ConfigGuzzle;
use Illuminate\Http\Request;
class DeviceRepository implements RepositoryInterface {
    public $guzzle;
	public function __construct(ConfigGuzzle $configGuzzle)
    {
        $this->guzzle = $configGuzzle;
    }
	public function getAll()
	{
		try{
            $client= $this->guzzle->initialGuzzle(3,'application/json, multipart/form-data');
            $url = $this->guzzle->getUrlApi('alldevice');
            $request = $client->get($url);
            if ($request->getStatusCode() == 200) {
                $response = $request->getBody()->getContents();
                $responseToArray = (\json_decode($response, true));
                return $data;
            } else {
                return false;;
            }
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function getDetail(string $string){
    }
    
    public function edit($request, $id){
    }
	public function update($request, $id){
        $guzzle = new ConfigGuzzle();
        $client= $guzzle->initialGuzzle(3,'application/json, multipart/form-data');
        $url = $guzzle->getUrlApi('editdevice').'/'.$id;
        $request = $client->post($url,[
            'multipart' => $this->getFormField($request, $data=[])
        ]);
        if ($request->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
    public function destroy($request, $id){
        $guzzle = new ConfigGuzzle();
        $client= $guzzle->initialGuzzle(3,'multipart/form-data');
        $url = $guzzle->getUrlApi('deletelocation')."/".$id;
        $request = $client->get($url);
        if ($request->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
     protected function getFormField(Request $request, $data){
        $request->location_id != null ? ( $location_id= ['name' => 'location_id', 'contents' => $request->location_id]) : ($location_id = []);
        $request->nickname_device != null ? ( $nickname_device= ['name' => 'nickname_device', 'contents' => $request->nickname_device]) : ($nickname_device = []);
        $data = [
                $location_id,
                $nickname_device
        ];
        $data = array_filter($data);
        return $data;
    }

}