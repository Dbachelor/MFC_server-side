<?php
namespace App\Services;

use App\Mail\RegistrationCompleted;
use Illuminate\Support\Facades\Mail;

class EmailService{

    public static function sendCustomerEmail($user){

        Mail::to($user->email)->send(new RegistrationCompleted($user));

    }

}
?>