<?php

namespace App\Repositories;
use App\ConfigGuzzle\ConfigGuzzle;
use Illuminate\Http\Request;
class LocationRepository implements RepositoryInterface {
    public $guzzle;
	public function __construct(ConfigGuzzle $configGuzzle)
    {
        $this->guzzle = $configGuzzle;
    }
	public function getAll()
	{
		try{
            $client= $this->guzzle->initialGuzzle(3,'application/json, multipart/form-data');
            $url = $this->guzzle->getUrlApi('details');
            $myBody['token_push'] = session('token');
            $request = $client->post($url,  [
                'form_params'=>$myBody
            ]);
            if ($request->getStatusCode() == 200) {
                $response = $request->getBody()->getContents();
                $responseToArray = (\json_decode($response, true));
                $data = $responseToArray['success']['user'];
                return $data;
            } else {
                return false;;
            }
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function getDetail($string){
    }
    public function store($request){
        $client= $this->guzzle->initialGuzzle(3,'multipart/form-data');
        $url = $this->guzzle->getUrlApi('newlocation');
        $request = $client->post($url,[
            'multipart' => $this->getFormField($request, $data=[])
        ]);
        if ($request->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
    public function edit($request, $id){
            $locationItem=[];
            // Get Locations
            $locations = $this->repo->getDetail('Location');
            // Get Master - Location type
            $getMaster = $this->master->getDetail('success');
            foreach($locations as $key => $value){
                if($value['id'] == $id){
                    $locationItem = $value;
                }
            }
            $locationType = $getMaster['locations'];
            foreach($locationType as $key_T => $type){
                if($locationItem['type'] == $type['id_master']){
                    $locationItem['type'] = $type;
                }
            }
        return $locationItem;
    }
	public function update($request, $id){
        $guzzle = new ConfigGuzzle();
        $client= $guzzle->initialGuzzle(3,'application/json, multipart/form-data');
        $url = $guzzle->getUrlApi('editlocation').'/'.$id;
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
        $request->location_name != null ? ( $location_name= ['name' => 'location_name', 'contents' => $request->location_name]) : ($location_name = []);
        $request->type != null ? ( $type= ['name' => 'type', 'contents' => $request->type]) : ($type = []);
        $request->detail != null ? ( $detail= ['name' => 'detail', 'contents' => $request->detail]) : ($detail = []);
        $data = [
                $location_name,
                $type,
                $detail
        ];
        $data = array_filter($data);
        return $data;
    }

}