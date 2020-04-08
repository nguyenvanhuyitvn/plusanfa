<?php

namespace App\Http\Controllers\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Routing\Redirector;
use App\Repositories\GetAllDevicesRepository;
use App\Repositories\GetMasterRepository;
use App\Repositories\UserRepository;
use App\Repositories\LocationRepository;
use App\Repositories\DeviceRepository;
use App\ConfigGuzzle\ConfigGuzzle;
class DeviceController extends Controller
{
    protected $serviceURL;
    protected $repo;
    protected $master;
    protected $user;
    protected $locationRepo;
    protected $deviceItemRepo;
    public function __construct(GetAllDevicesRepository $deviceRepo, GetMasterRepository $masterRepo, UserRepository $userRepo, LocationRepository $locationRepo,DeviceRepository $deviceItemRepo )
    {
        $this->serviceURL = config('api.url');
        $this->repo = $deviceRepo;
        $this->master = $masterRepo;
        $this->user = $userRepo;
        $this->locationRepo = $locationRepo;
        $this->deviceItemRepo = $deviceItemRepo;
    }

    public function edit(Request $request, $id){
       try{
            $devicesItem=[];
            // Get Locations
            $devices = $this->repo->getDetail('Device');
            $enrolls = $this->repo->getDetail('Enroll');
            foreach($devices as $key => $value){
                if($value['id'] == $id){
                    $devicesItem = $value;
                }
            }
            foreach ($enrolls as $key_en => $enroll) {
            	if($enroll['device_id'] == $devicesItem['id']){
            		$devicesItem['location_id'] = $enroll['location_id'];
            		$devicesItem['nickname_device'] = $enroll['nickname_device'];
            	}
            }
            return $devicesItem;
        }
        catch(\Exception $exception){

        }
    }
    public function update(Request $request, $id){
        try{
            if ($this->deviceItemRepo->update($request, $id)) {
                return redirect()->route('dashboard')->with('notify', 'Sửa thiết bị thành công');
            } else {
                return redirect()->back()->with('notify', 'Lỗi!');
            }
        }catch(\Exception $exception){
            return redirect()->back()->with('notify', 'Lỗi sửa thiết bị!' . $exception->getMessage());
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
<<<<<<< HEAD
        try{
            $guzzle = new ConfigGuzzle();
            $client= $guzzle->initialGuzzle(3,'multipart/form-data');
            $url = $guzzle->getUrlApi('deletedevice')."/".$id;
            $request = $client->get($url);
            if ($request->getStatusCode() == 200) {
                return redirect()->route('dashboard')->with('notify', 'Bạn đã xóa thiết bị thành công!');
=======
        dd(1); exit();
        try{
            $guzzle = new ConfigGuzzle();
            $client= $guzzle->initialGuzzle(3,'multipart/form-data');
            $url = $guzzle->getUrlApi('deletelocation')."/".$id;
            $request = $client->get($url);
            if ($request->getStatusCode() == 200) {
                return redirect()->route('location.index');
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
            } else {
                return "Oops!";
            }
            
        }catch (\Exception $exception) {
<<<<<<< HEAD
        	return redirect()->route('dashboard')->with('notify', 'Thiết bị chưa được xóa!');
            // return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function updateHistory($id){
    	try{
            if ($this->deviceItemRepo->updateHistory($id)) {
            	return $this->deviceItemRepo->updateHistory($id);
                return redirect()->route('dashboard')->with('notify', 'Cập nhật lịch sử thiết bị thành công');
            } else {
                return redirect()->back()->with('notify', 'Lỗi!');
            }
        }catch(\Exception $exception){
            return redirect()->back()->with('notify', 'Lỗi cập nhật lịch sử thiết bị!' . $exception->getMessage());
        }
    }
    public function getSchedule($id){
    	try{
            $schedules = $this->deviceItemRepo->getSchedule($id);
            return $schedules;
        }catch(\Exception $exception){
            return redirect()->back()->with('notify', 'Lỗi cập nhật lịch hẹn thiết bị!' . $exception->getMessage());
=======
            logger($exception);
            return 'Caught exception: '. $exception->getMessage();
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
        }
    }
}
