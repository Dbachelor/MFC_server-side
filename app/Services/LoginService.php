<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public $user, $response;

    public function checkUser($request)
    {
        $this->user = User::where('email', $request->email)->first();
        if (!$this->user || !Hash::check($request->password, $this->user->password)) {
            $this->user = [
                'message' => 'Account not found',
                'status'=> 404,
            ];
            
        }

        return $this;

    }

    public function generateToken(){
        if ($this->user['status'] == 404){
            $response = [
                'message' => $this->user,
                'status' => 404,
            ];
        } else {
            $token = $this->user->createToken('my-fuel-credit')->plainTextToken;
            $response = [
                'user' => $this->user,
                'token' => $token,
            ];
        }
        return response($response, 201);
    }

}
?>