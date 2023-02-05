<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationService{

    public static function registerUser($request){   
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()){
            $user->status = 1;
            return $user;
        }
            
        return ['status'=>0, 'message'=>'unsuccessful registration'];
    }

}

?>