<?php

namespace App\Http\Controllers\Locations;
// namespace App\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Routing\Redirector;
use App\Repositories\GetAllDevicesRepository;
use App\Repositories\GetMasterRepository;
use App\Repositories\UserRepository;
use App\Repositories\LocationRepository;
use App\ConfigGuzzle\ConfigGuzzle;
class LocationController extends Controller
{
    protected $serviceURL;
    protected $repo;
    protected $master;
    protected $user;
    protected $locationRepo;
    public function __construct(GetAllDevicesRepository $deviceRepo, GetMasterRepository $masterRepo, UserRepository $userRepo, LocationRepository $locationRepo)
    {
        $this->serviceURL = config('api.url');
        $this->repo = $deviceRepo;
        $this->master = $masterRepo;
        $this->user = $userRepo;
        $this->locationRepo = $locationRepo;
    }
    public function index(){
        try{
            $countDevice=0;
            // Get User Info
            $data = $this->user->getAll();
            // Get Locations
            $locations = $this->repo->getDetail('Location');
            // Get Master - Location type
            $getMaster = $this->master->getDetail('success');
            $locationType = $getMaster['locations'];
            $locationJson = json_encode($locationType);
           
            // Get Locations
            $getEnroll = $this->repo->getDetail('Enroll');
            foreach($locations as $key_L => $location){
                foreach($locationType as $key_T => $type){
                    if($location['type'] == $type['id_master']){
                        $locations[$key_L]['type'] = $type;
                    }
                }
                foreach($getEnroll as $key_en => $value_en){
                    if($getEnroll[$key_en]['location_id'] == $locations[$key_L]['id'] ){
                        $countDevice++;
                    }
                }
                $locations[$key_L]['count'] = strval($countDevice);
                $countDevice =0;
            }
            $Enroll_location='';
            // convert date
            foreach($getEnroll as $key => $value){
                $getEnroll[$key]['created_at'] = \Carbon\Carbon::parse($getEnroll[$key]['created_at'])->format('d/m/y');
                $getEnroll[$key]['updated_at'] = \Carbon\Carbon::parse($getEnroll[$key]['updated_at'])->format('d/m/y');
            }
            // dd($getEnroll);
            $Enroll_location = json_encode($getEnroll);
            // dd($Enroll_location);
            return view('locations.list', compact('locations','data','locationType','locationJson','Enroll_location'));
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function create(){
        try{
            // Get User Info
            $data = $this->user->getAll();
            // Get Master - Location type
            $getMaster = $this->master->getDetail('success');
            $locationType = $getMaster['locations'];
            // Transfer to view
            return view('locations.add', compact('locationType','data'));
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function store(Request $request){
        try{
            $newLocation = $this->locationRepo->store($request);
            if ($newLocation) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('notify', 'Không thể thêm khu vực mới!');
            }
            
        }catch (\Exception $exception) {
            return redirect()->back()->with('notify', 'Không thể thêm khu vực mới!' . $exception->getMessage());
        }
    }
    public function edit(Request $request, $id){
        try{
            // $data = $this->user->getAll();
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
        catch(\Exception $exception){

        }
    }
    public function update(Request $request, $id){
        try{
            $updateLocation = $this->locationRepo->update($request, $id);
            if ($updateLocation) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('notify', 'Lỗi!');
            }
        }catch(\Exception $exception){
            return redirect()->back()->with('notify', 'Lỗi sửa khu vực!' . $exception->getMessage());
        }
       
    }
    public function checkDelete(Request $request, $id) {
         // $data = $this->user->getAll();
         $Enroll_location=[];
         // Get Locations
         $getEnroll = $this->repo->getDetail('Enroll');
         foreach($getEnroll as $key => $value){
             if($value['id'] == $id){
                 $Enroll_location[] = $value;
             }
         }
        //  $Enroll_location = json_encode($Enroll_location);
         return $Enroll_location;
    }
    public function destroy(Request $request, $id){
        dd(1); exit();
        try{
            $guzzle = new ConfigGuzzle();
            $client= $guzzle->initialGuzzle(3,'multipart/form-data');
            $url = $guzzle->getUrlApi('deletelocation')."/".$id;
            $request = $client->get($url);
            if ($request->getStatusCode() == 200) {
                return redirect()->route('location.index');
            } else {
                return "Oops!";
            }
            
        }catch (\Exception $exception) {
            logger($exception);
            return 'Caught exception: '. $exception->getMessage();
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
