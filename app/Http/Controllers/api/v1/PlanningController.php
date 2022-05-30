<?php

namespace App\Http\Controllers\api\v1;
use App\Models\planning;
use Illuminate\Http\Request;
class PlanningController
{

    public function addPlanning(Request $request){

        $planning = new planning();
        $planning->name = $request->name ;

        $planning->project_id = $request->project_id ;
        $planning->save();


        return response()->json([
            "success" => true ,
            "data" => $planning

        ]);


    }

    public function updatePlanning(Request $request){

        $planning = planning::where('id' , $request->id)->first();
        $planning->description = $request->description ;
        $planning->category = $request->category ;
        $planning->concerne = $request->concerne ;
        $planning->startDate = $request->startDate ;
        $planning->endDate = $request->endDate ;
        $planning->name = $request->name ;
        $planning->save();



        return response()->json([
            "success" => true ,
            "data" => $planning

        ]);


    }

    public function getPlannings(Request $request){

        $plannings = planning::where('project_id' , $request->project_id)->orderBy('id', 'DESC')->get();

        return response()->json([
            "success" => true ,
            "data" => $plannings

        ]);
    }

    public function deletePlanning(Request $request){

        $planning = planning::find($request->id);
        $planning->delete();
        $plannings = planning::all();
        return response()->json([
            "success" => true ,
            "data" => $plannings

        ]);
    }

}
