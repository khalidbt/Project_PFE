<?php

namespace App\Http\Controllers\api\v1;

use App\Mail\pfeMail;
use App\Models\project_user_pivot;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class CollaborateurController
{


    public function addCollaborateur(Request $request){





        $password = uniqid("pass");
        $user = new user();
        $user->email = $request->email;
        $user->preName = $request->preName;
        $user->lastName = $request->lastName;
        $user->abr = $request->abr;
        $user->addresse = $request->addresse;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->society = $request->society;


        $user->password = \Illuminate\Support\Facades\Hash::make($password);
        $user->save();


        $projectUser = new project_user_pivot();
        $projectUser->user_id = $user->id;
        $projectUser->project_id = $request->project_id;
        $projectUser->role = 0;
        $projectUser->save();

        $mailData = [
            'title' => 'Mail from Architex',
            'body' => 'you have been added as a project collaborator , this is your password :  '.$password
        ];

        Mail::to($user->email)->send(new pfeMail($mailData));
        return response()->json([
            "success" => true ,
            "user" => $user
        ]);





    }

    public function collaborators (Request $request){

        $projectId = $request->project_id;
        $projectUsers = project_user_pivot::where('project_id' , $projectId)->get();

        $users = [];

        foreach ($projectUsers as $projectUser){

            $user = user::where('id' , $projectUser->user_id)->first();
            $users[] = $user;
        }

        return response()->json([
            "success" => true ,
            "data" => $users
        ]);
    }


}
