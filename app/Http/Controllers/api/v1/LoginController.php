<?php

namespace App\Http\Controllers\api\v1;

use App\Mail\pfeMail;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController
{

    public function login (Request $request){

        $login =  $request->validate([

            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ( !Auth::attempt( $login )){
            return response()->json(
                [
                    "success" => false ,
                    "msg" => "login attemp failed"
                ] , 403
            );
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;


        return response(["success" => true ,'user' => Auth::user() , "acces_token" => $accessToken]);

    }

    public function recoverPassword(Request $request){
        $recover =  $request->validate([

            'email' => 'required|string'

        ]);

        $user = user::where('email' , $request->email)->first();

        if (!empty($user)){

            $password = uniqid("pass") ;

            $user->password = \Illuminate\Support\Facades\Hash::make($password);

            $mailData = [
                'title' => 'Your new password',
                'body' => "here's the new password : " . $password
            ];
            $user->save();

            Mail::to($user->email)->send(new pfeMail($mailData));

            return response()->json([
                "success" => true

            ]);

        }

    }



}
