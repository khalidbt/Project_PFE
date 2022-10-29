<?php

namespace App\Http\Controllers\api\v1;

use App\Mail\pfeMail;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpseclib3\Crypt\Hash;

class RegisterController
{

    public function register(Request $request){

        $registerUser =  $request->validate([

            'email' => 'required|string',
            'password' => 'required|string',
            'preName' => 'required|string',
            'lastName' => 'required|string'

        ]);

        /****
        create new user
        **/

        $user = new user();
        $user->email = $registerUser['email'];
        $user->password = \Illuminate\Support\Facades\Hash::make($registerUser['password']);
        $user->preName = $registerUser['preName'];
        $user->lastName = $registerUser['lastName'];
        $user->save();

        $mailData = [
            'title' => 'Mail from MTS Group',
            'body' => 'Thank you for registering !! .'
        ];

       // Mail::to($registerUser['email'])->send(new pfeMail($mailData));

        return response()->json([
            "success" => true ,
            "user" => $user
        ]);



    }

}
