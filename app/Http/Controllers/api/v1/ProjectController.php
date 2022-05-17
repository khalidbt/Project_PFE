<?php

namespace App\Http\Controllers\api\v1;

use App\Models\project;
use App\Models\project_user_pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'projectName' => 'required|string',
            'id' => 'required|integer'

        ]);

        $projectName = $request->projectName;
        $constructionType = $request->exists('constructionType') ? $request->constructionType : "";
        $addresse = $request->exists('addresse') ? $request->addresse : "";
        $description = $request->exists('addresse') ? $request->description : "";
        if ($files = $request->file('file')) {
            $file = $request->file('file');

            $filePath = Storage::disk('pfe')->put('/images', $file);
        } else {
            $filePath = "";
        }

        // get project

        $project = project::find($request->id);
        $project->projectName = $projectName;
        $project->constructionType = $constructionType;
        $project->addresse = $addresse;
        $project->description = $description;
        $project->image_url = $filePath;
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

        return response()->json([
            "success" => true ,
            "projects" => $projects
        ]);
    }

}
