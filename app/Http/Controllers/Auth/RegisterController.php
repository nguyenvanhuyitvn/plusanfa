<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return \redirect()->route('register-success');
    }
    protected function create(array $data)
    {
        // dd($data);
        try{
            $headers = [
                'Content-Type' => 'application/json, multipart/form-data',
                'AccessToken' => 'key',
                'Authorization' => 'Bearer token',
            ];
            
            $client = new \GuzzleHttp\Client([
                'headers'=> $headers
            ]);
            $url = "http://fuji.akb.vn:2102/api/register";
            $myBody['user_name'] = $data['user_name'];
            $myBody['email'] = $data['email'];
            $myBody['password'] = $data['password'];
            $myBody['c_password'] = $data['password_confirmation'];
            $request = $client->post($url,  ['form_params'=>$myBody]);
            $response = $request->getBody()->getContents();
            if($request->getStatusCode()){
                return \redirect()->route('register-success');
            }
            dd($request->getStatusCode());
        }catch(Exception $e){
            report($e);
            return false;
        }
    }
    public function registerSuccess(){
        return view('auth.register-success');
    }
}
