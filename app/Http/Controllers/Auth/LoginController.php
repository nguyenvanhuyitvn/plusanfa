<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
        try{
            $headers = [
                'Content-Type' => 'application/json, multipart/form-data',
                'AccessToken' => 'key',
                'Authorization' => 'Bearer token',
            ];
            $cookieJar = new CookieJar();
            $client = new \GuzzleHttp\Client([
                'headers'=> $headers,
                'timeout' => 3
            ]);
            $url = "http://fuji.akb.vn:2102/api/login";
        
            $myBody['email'] = $request->email;
            $myBody['password'] = $request->password;
            $request = $client->post($url,  [
                'form_params'=>$myBody,     
                'cookies' => $cookieJar
            ]);
           
            if ($request->getStatusCode() == 200) {
                $response = $request->getBody()->getContents();
                $data = collect(\json_decode($response))->toArray();
                $session = session()->put('token',  $data['success']->token);
            } else {
                return "Oops!";
            }
            
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
}
