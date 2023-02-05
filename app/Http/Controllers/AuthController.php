<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use App\Services\LoginService;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function registerUser(Request $request){
        $user =  RegistrationService::registerUser($request);
        if($user->status) return EmailService::sendCustomerEmail($user);
        return $user;
    }

    public function loginUser(Request $request){

        $login = new LoginService();
        return $login->checkUser($request)->generateToken();
    }
}
