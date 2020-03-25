<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Routing\Redirector;
class UsersController extends Controller
{
     /**
     * Class constructor.
     */
    protected $serviceURL;
    public function __construct()
    {
        $this->serviceURL = config('api.url');
    }
    public function index(){
        try{
           
            $headers = [
                'Content-Type' => 'application/json, multipart/form-data',
                'Authorization' => 'Bearer ' . session('token'),
            ];
            $cookieJar = new CookieJar();
            $client = new \GuzzleHttp\Client([
                'headers'=> $headers,
                'timeout' => 3
            ]);
            $url = $this->serviceURL."/details";
            $myBody['token_push'] = session('token');
            $request = $client->post($url,  [
                'form_params'=>$myBody,     
                'cookies' => $cookieJar
            ]);
           
            if ($request->getStatusCode() == 200) {
                $response = $request->getBody()->getContents();
                $responseToArray = (\json_decode($response, true));
                $data = $responseToArray['success']['user'];
                // dd($data);
                return view('users.list', compact('data'));
            } else {
                return "Oops!";
            }
            
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
       
    }
    public function edit(){
        try{
            $headers = [
                'Content-Type' => 'application/json, multipart/form-data',
                'Authorization' => 'Bearer ' . session('token'),
            ];
            $cookieJar = new CookieJar();
            $client = new \GuzzleHttp\Client([
                'headers'=> $headers,
                'timeout' => 3
            ]);
            $url = $this->serviceURL."/details";
            $myBody['token_push'] = session('token');
            $request = $client->post($url,  [
                'form_params'=>$myBody,     
                'cookies' => $cookieJar
            ]);
           
            if ($request->getStatusCode() == 200) {
                $response = $request->getBody()->getContents();
                $responseToArray = (\json_decode($response, true));
                $data = $responseToArray['success']['user'];
                return view('users.edit', compact('data'));
            } else {
                return "Oops!";
            }
            
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function update(Request $request){
        try{
           
            $headers = [
                'Content-Type' => 'application/json, multipart/form-data',
                'Authorization' => 'Bearer ' . session('token'),
            ];
            $cookieJar = new CookieJar();
            $client = new \GuzzleHttp\Client([
                'headers'=> $headers,
                'timeout' => 3
            ]);
            $url = $this->serviceURL."/edituser";
            $myBody['user_name'] = $data['user_name'];
            $myBody['full_name'] = $data['full_name'];
            $myBody['address'] = $data['address'];
            $myBody['email'] = $data['email'];
            $myBody['oldPassword'] = $data['oldPassword'];
            $myBody['newPassword'] = $data['new_password'];
            $request = $client->post($url,  [
                'form_params'=>$myBody,     
                'cookies' => $cookieJar
            ]);
           
            if ($request->getStatusCode() == 200) {
                $response = $request->getBody()->getContents();
                $responseToArray = (\json_decode($response, true));
                $data = $responseToArray['success']['user'];
                return view('users.edit', compact('data'));
            } else {
                return "Oops!";
            }
            
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
}
