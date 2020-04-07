<?php

namespace App\Repositories;
use App\ConfigGuzzle\ConfigGuzzle;
use Illuminate\Http\Request;
class UserRepository implements RepositoryInterface {
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
    public function login(Request $request){
        try{
            $client= $this->guzzle->initialGuzzle(3,'multipart/form-data');
                $url = $this->guzzle->getUrlApi('login');
                // dd($this->getFormField($request, $data=[]));
                $request = $client->post($url,[
                    'multipart' => $this->getFormField($request, $data=[])
                ]);
                if ($request->getStatusCode() == 200) {
                    $response = $request->getBody()->getContents();
                    $data = collect(\json_decode($response))->toArray();
                    $session = session()->put('token',  $data['success']->token);
                    return true;
                } else {
                    return false;
                }
            
        }catch (\Exception $exception) {
            return redirect('login')->withInput();
            // abort(401, 'Unauthorized action.');
            // return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function logout(){
        $client= $this->guzzle->initialGuzzle(3,'multipart/form-data');
        $url = $this->guzzle->getUrlApi('logout');
        $myBody['token_push'] = session('token');
        $request = $client->post($url,  [
            'form_params'=>$myBody
        ]);
        if ($request->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
	public function update($request){
        try{
            $client= $this->guzzle->initialGuzzle(3,'multipart/form-data');
            $url = $this->guzzle->getUrlApi('edituser');
            $request = $client->post($url,[
                'multipart' => $this->getFormField($request, $data=[])
            ]);
            if ($request->getStatusCode() == 200) {
                return true;
            } else {
                return false;
            }
        }catch (\Exception $exception) {
            logger($exception);
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function resetPassword($request){
        $client= $this->guzzle->initialGuzzle(3,'multipart/form-data');
        $url = $this->guzzle->getUrlApi('resetpassword');
        $request = $client->post($url,[
            'multipart' => $this->getFormField($request, $data=[])
        ]);
        if ($request->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
    protected function getFormField(Request $request, $data){
        $request->user_name != null ? ( $user_name= ['name' => 'user_name', 'contents' => $request->user_name]) : ($user_name = []);
        $request->full_name != null ? ( $full_name= ['name' => 'full_name', 'contents' => $request->full_name]) : ($full_name = []);
        $request->email != null ? ( $email= ['name' => 'email', 'contents' => $request->email]) : ($email = []);
        $request->address != null ? ( $address= ['name' => 'address', 'contents' => $request->address]) : ($address = []);
        $request->password != null ? ( $password= ['name' => 'password', 'contents' => $request->password]) : ($password = []);
        $request->oldPassword != null ? ( $oldPassword= ['name' => 'oldPassword', 'contents' => $request->oldPassword]) : ($oldPassword = []);
        $request->newPassword != null ? ( $newPassword= ['name' => 'newPassword', 'contents' => $request->newPassword]) : ($newPassword = []);
        $avatar = $this->getAvatarInfo($request, $data=[]);
        $data = [
                $user_name,
                $full_name,
                $email,
                $address,
                $password,
                $oldPassword,
                $newPassword,
                $avatar
        ];
        $data = array_filter($data);
        return $data;
    }
    protected function getAvatarInfo(Request $request, $data=[]){
        if($request->file('avatar'))
            {
                $image_path = $request['avatar']->getPathname();
                $image_mime = $request['avatar']->getmimeType();
                $image_org  = $request['avatar']->getClientOriginalName();
                $data = [
                    'name'     => 'avatar',
                    'filename' => $image_org,
                    'Mime-Type'=> $image_mime,
                    'contents' => fopen( $image_path, 'r' ),
                ];
            }
        else
            { 
                $data = [];
            }
        return $data;
    }
}