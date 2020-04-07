<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Routing\Redirector;
use App\Repositories\UserRepository;
use App\ConfigGuzzle\ConfigGuzzle;
class UsersController extends Controller
{
     /**
     * Class constructor.
     */
    protected $serviceURL;
    protected $user;
    public function __construct(UserRepository $userRepo)
    {
        $this->serviceURL = config('api.url');
        $this->user = $userRepo;
    }
    public function index(){
        try{
            $data = $this->user->getAll();
            return view('users.list', compact('data'));
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
       
    }
    public function edit(){
        try{
            $data = $this->user->getAll();
            return view('users.edit', compact('data'));
        }catch (\Exception $exception) {
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function update(Request $request){
        try{
            $data = $this->user->update($request);
            return redirect()->route('users.index');
            
        }catch (\Exception $exception) {
            logger($exception);
            return 'Caught exception: '. $exception->getMessage();
        }
    }
    public function resetPassword(){
        return view('users.reset-password');
    }
    public function saveResetPassword(Request $request){
        try{
            $data = $this->user->resetPassword($request);
            return redirect()->route('users.index');
        }catch (\Exception $exception) {
            logger($exception);
            return 'Caught exception: '. $exception->getMessage();
        }
    }
}