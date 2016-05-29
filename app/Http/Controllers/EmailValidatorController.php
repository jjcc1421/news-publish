<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 29/05/2016
 * Time: 3:47 AM
 */

namespace App\Http\Controllers;

use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Support\Facades\Input;
use User;
use Flash;

class EmailValidatorController extends Controller
{
    public function validateEmail($token)
    {
        $email = Input::get('email');
        $user = User::where('email', $email)->get();
        if ($user)
            if ($user->verified == 0) {
                UserVerification::process($email, $token, 'users');
                F
                return null; //TODO redirect when user is verified
            } else
                return null; //TODO redirect when user is already verified
        else
            return null; //TODO redirect when user not exist already verified
    }
}