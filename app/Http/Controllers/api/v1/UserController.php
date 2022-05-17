<?php

namespace App\Http\Controllers\api\v1;

use App\Models\user;

class UserController
{

    public function index(){

        $users = user::all();

        return response()->json(
            [
                "success" => true ,
                "users" => $users
            ]
        );
    }

}
