<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
     /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('logout');
    }
    public function index(){
        return view('home');
    }
}
