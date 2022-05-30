<?php

namespace App\Http\Controllers\api\v1;

use App\Mail\pfeMail;
use App\Models\project;
use App\Models\project_user_pivot;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Crypt\Hash;
use PHPUnit\Exception;

class ProjectController
{

    public function addProject(Request $request)
    {

        // GET USER

        $user = Auth::user();

        $validator = $request->validate([
            'projectName' => 'required|string'
        ]);

        $project = new project();
        $project->projectName = $request->projectName;
        $project->save();

        // add project and user to project user pivot

        $projectUser = new project_user_pivot();
        $projectUser->user_id = $user->id;
        $projectUser->project_id = $project->id;
        $projectUser->role = 1;
        $projectUser->save();

        return response()->json([
            'success' => true,
            'project' => $project
        ]);

    }

    public function updateProject(Request $request)
    {

        $user = Auth::user();

        $validator = $request->validate([

            'id' => 'required|integer'

        ]);

        $projectName = $request->projectName;
        $constructionType = $request->exists('constructionType') ? $request->constructionType : "";
        $addresse = $request->exists('addresse') ? $request->addresse : "";
        $description = $request->exists('addresse') ? $request->description : "";



        // get project

        $project = project::find($request->id);
        $project->projectName = $projectName;
        $project->constructionType = $constructionType;
        $project->addresse = $addresse;
        $project->description = $description;
        $project->image_url =  $request->image_url;
        $project->save();

        return response()->json([
            "success" => true,
            "project" => $project
        ]);
    }

    public function deleteProject(Request $request)
    {

        $validator = $request->validate([

            'id' => 'required|integer'

        ]);

        project::where('id', $request->id)->delete();

        return response()->json([
            "success" => true
        ]);

    }

    public function getProjectById(Request $request){

        $validator = $request->validate([

            'project_id' => 'required|integer'
        ]);

        $project = project::where('id' ,$request->project_id)->first();



        return response()->json([
            "success" => true ,
            "project" => $project
        ]);
    }

    public function getProjectByUser(Request  $request , $id){



        $projectIds = project_user_pivot::where('user_id' , $id)->pluck('project_id')->toArray();

        $projectIds = array_values($projectIds);
        $projectIds = array_unique($projectIds);

        $projects = project::find($projectIds);

        $projects->transform(function ($project){
            $project->image_url = json_decode($project->image_url);
            return $project;

        });

        return response()->json([
            "success" => true ,
            "projects" => $projects
        ]);
    }


    public function addCollaborateur(Request $request){


        try {


            $password = "something";
            $user = new user();
            $user->email = $request->email;
            $user->preName = $request->preName;
            $user->lastName = $request->lastName;

            $user->password = \Illuminate\Support\Facades\Hash::make($password);
            $user->save();

            $mailData = [
                'title' => 'Mail from MTS Group',
                'body' => 'Thank you for registering !! .'
            ];

            Mail::to($user->email)->send(new pfeMail($mailData));
            return response()->json([
                "success" => true ,
                "user" => $request
            ]);


        }catch (Exception $exception){

            echo $exception->getMessage();
        }



    }



    public function test (Request $request) {

        try {



            return response()->json([
                "data" => [],
                "success" => true ,

            ]);


        }catch (Exception $exception){

            echo $exception->getMessage();
        }


    }

}
