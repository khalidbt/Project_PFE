<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Meeting;
use App\Models\observation;
use App\Models\plan;
use App\Models\planning;
use App\Models\project_user_pivot;
use App\Models\user;
use Illuminate\Http\Request;


class PdfController
{

    public function generateRapport(Request $request)
    {


        $Observations = observation::where('projectId', $request->project_id)->get();
        $meetings = Meeting::where('projectId', $request->project_id)->get();
        //$plans = plan::where('projectId', $request->project_id)->get();
       // $plannings = planning::where('projectId', $request->project_id)->get();

        /// HERE WE GET THE NUMBER OF EACH MODULE (MEETINGS - PLANNINGS - PLANS - OBSERVATIONS)

        $obsCounter = 0;
        $planCounter = 0;
        $planningCounter = 0;
        $meetingCounter = 0;
        foreach ($Observations as $observation) {
            $obsCounter++;
        }
     /*   foreach ($plannings as $planning) {
            $planningCounter++;
        }
        foreach ($plans as $plan) {
            $planCounter++;
        }*/
       /* foreach ($plannings as $planning) {
            $planningCounter++;
        }*/

        /// HERE WE GET THE COLLABORATOES OF THE PROJECT
        ///

        $collab_project_pivot = project_user_pivot::where('project_id' , $request->project_id)->get()->toArray();

        $users = array_map( function ($collab) {
                echo "1";
            return $user = user::where('id' , $collab->user_id)->first();

        } , $collab_project_pivot);



        return response()->json([

            "data" => $users
        ]);




    }

}
