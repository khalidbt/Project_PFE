<?php

namespace App\Http\Controllers\api\v1;

use App\Models\plan;
use App\Models\project_plan_pivot;
use Illuminate\Http\Request;

class PlanController
{




    public function addPlan (Request $request){

                $plan = new plan();
                $plan->name = $request->name ;
                $plan->type = $request->type ;
                $plan->zone = $request->zone ;
                $plan->save();

                $planProject = new project_plan_pivot();
                $planProject->project_id = $request->project_id;
                $planProject->plan_id = $plan->id;
                $planProject->save();


    }

    public function getZonePlans (Request $request){

        $plans = plan::where('zone' , $request->id)->where('type'  , 0)->get();

        return response()->json([
            "success" => true ,
            "data" => $plans
        ]);
    }

    public function getZoneDocuments (Request $request){

        $plans = plan::where('zone' , $request->id)->where('type' , '=' , 1)->get();

        return response()->json([
            "success" => true ,
            "data" => $plans
        ]);
    }

}
