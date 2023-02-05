<?php

namespace App\Services;
//MFC202302
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationService{

    public static function registerUser($request){  
        if (!self::checkUserExists($request->email)){
            return ['status' => 0, 'message' => 'Email address already exists'];
        } 
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()){
            return ['status' => 1, 'message' => 'Successful registration'];
            //return $user;
        }
            
        return ['status'=>0, 'message'=>'unsuccessful registration'];
    }

    private static function checkUserExists($email){
        $check = User::where('email', $email);
        if ($check->count() > 0){
            return 0;
        }
        return 1;
    }

}

?>