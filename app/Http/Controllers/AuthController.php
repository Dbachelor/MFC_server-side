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
        //return $request->all()['email'];
        $register =  RegistrationService::registerUser($request);
        if ($register['status']){
            EmailService::sendCustomerEmail($request);
            return $register;
        }
            
        return $register;
    }

    public function loginUser(Request $request){

        $login = new LoginService();
        return $login->checkUser($request)->generateToken();
    }
}
