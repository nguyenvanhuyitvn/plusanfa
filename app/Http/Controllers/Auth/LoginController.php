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
use Illuminate\Routing\Redirector;
use App\Repositories\UserRepository;
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
    protected $serviceURL;
    protected $user;
    public function __construct(UserRepository $userRepo)
    {
        $this->serviceURL = config('api.url');
        $this->user = $userRepo;
    }
    public function login(Request $request){
        $data = $this->user->login($request);
        if($data){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login');
        }
    }
    public function logout(){
        if ($this->user->logout()) {
            session()->flush();	
            return redirect()->route('login');
        } else {
            return "Oops!";
        }
    }
}
