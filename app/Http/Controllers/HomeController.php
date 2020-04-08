<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\Handler;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Routing\Redirector;
use App\Repositories\GetAllDevicesRepository;
use App\Repositories\GetMasterRepository;
use App\Repositories\UserRepository;
use App\ConfigGuzzle\ConfigGuzzle;
class HomeController extends Controller
{
    protected $serviceURL;
    protected $repo;
    protected $master;
    protected $user;
    public function __construct(GetAllDevicesRepository $deviceRepo, GetMasterRepository $masterRepo, UserRepository $userRepo)
    {
        $this->serviceURL = config('api.url');
        $this->repo = $deviceRepo;
        $this->master = $masterRepo;
        $this->user = $userRepo;
    }
    public function index(){
        try{
            $countDevice=0;
            // Get User Info
            $data = $this->user->getAll();
            // Get Enroll
            $getEnroll = $this->repo->getDetail('Enroll');
            foreach($getEnroll as $key => $value){
                $getEnroll[$key]['created_at'] = \Carbon\Carbon::parse($getEnroll[$key]['created_at'])->format('d/m/y');
                $getEnroll[$key]['updated_at'] = \Carbon\Carbon::parse($getEnroll[$key]['updated_at'])->format('d/m/y');
            }
            // Get Locations
            $locations = $this->repo->getDetail('Location');
            $locationsJson = json_encode($locations);
            // Get Devices
            $getDevice = $this->repo->getDetail('Device');
            // Get Master - Location type
            $getMaster = $this->master->getDetail('success');
            $locationType = $getMaster['locations'];
            $deviceType = $getMaster['devices'];
            $locationTypeJson = json_encode($locationType);
            foreach($locations as $key_L => $location){
                // Pass Location Detail Info to locations
                foreach($locationType as $key_T => $type){
                    if($location['type'] == $type['id_master']){
                        $locations[$key_L]['type'] = $type;
                    }
                }
                // Count Device in a location
                foreach($getEnroll as $key_en => $value_en){
                    if($getEnroll[$key_en]['location_id'] == $locations[$key_L]['id'] ){
                        $countDevice++;
                    }
                }
                $locations[$key_L]['count'] = strval($countDevice);
                $countDevice =0;
            }
            // Pass Device Detail Info to Devices
            foreach($getDevice as $key_D => $device){
                foreach($deviceType as $key_T => $type){
                    if($device['type'] == $type['id_master']){
                        $getDevice[$key_D]['type'] = $type;
                    }
                }
            }
            // // Pass Devices into Enroll
            foreach($getEnroll as $key => $er){
                foreach($getDevice as $dv_k => $dv_v){
                    if($getEnroll[$key]['device_id'] == $getDevice[$dv_k]['id']){
                        $countDevice++;
                        $getEnroll[$key]['device_id'] = $getDevice[$dv_k];
                    }
                }
            }
            $Enroll_location = json_encode($getEnroll);
            foreach ($getEnroll as $key => $value) {
                if($value['location_id'] == $locations[0]['id']){
                    $displayDeviceFirst = $getEnroll[$key];
                }
            }
            return view('home', compact('getEnroll','Enroll_location', 'locations','data','locationType','displayDeviceFirst','locationTypeJson', 'locationsJson'));
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }

    public function getDeviceByLocationId(Request $request, $locationId){
        $getEnroll = $this->repo->getDetail('Enroll');
        $getDevice = $this->repo->getDetail('Device');
        // Get Devices
        $getMaster = $this->master->getDetail('success');
        $deviceType = $getMaster['devices'];
        $locations =[];
        // Filter location with locationId
        foreach($getEnroll as $key => $er){
            if($getEnroll[$key]['location_id'] == $locationId){
                $locations[] = $getEnroll[$key];
            }
        }
        // Pass devide detail info to getDevice
        foreach($getDevice as $key_D => $device){
            foreach($deviceType as $key_T => $type){
                if($device['type'] == $type['id_master']){
                    $getDevice[$key_D]['type'] = $type;
                }
            }
        }
        // Pass Devices into Location
        foreach($locations as $key => $er){
            foreach($getDevice as $dv_k => $dv_v){
                if($locations[$key]['device_id'] == $getDevice[$dv_k]['id']){
                    $locations[$key]['device_id'] = $getDevice[$dv_k];
                }
            }
        }
       // dd($locations);
        return $locations;
    }
}
