<?php

namespace App\Http\Controllers\api\v1;
use App\Models\observation;
use App\Models\zone;
use http\Client\Response;
use Illuminate\Http\Request;
class observationController

{

    public function addObservation(Request $request){

        $validator = $request->validate(
            [

                'projectId' => 'required|integer',


            ]
        );

        $observation = new observation();
        $observation->projectId = $request->projectId;

        $observation->save();

        $observations = observation::where('projectId' ,  $request->projectId)->orderBy('id', 'DESC')->get();

        return response()->json([
            "success" => true ,
            "data" => $observations
        ]);
    }

    public function getObservationByProjectId (Request $request){

        $validator = $request->validate([

           'projectId' => 'required|integer'
        ]);

        $observations = observation::where('projectId' ,  $request->projectId)->orderBy('id', 'DESC')->get();

        return response()->json([
            "success" => true ,
            "data" => $observations
        ]);
    }

    public function  update(Request $request){

        $observation = new observation();
        $observation->projectId = $request->projectId;
        $observation->meetingId = $request->meetingId;
        $observation->localisation = $request->localisation;
        $observation->description = $request->description;
        $observation->created = $request->created;
        $observation->limite = $request->limite;
        $observation->lever = $request->lever;
        $observation->lot = $request->lot;

        $observation->save();
    }

    public function delete(Request $request){

        $obervastion = observation::find($request->id);


        $observations = observation::where('projectId' ,  $obervastion->projectId)->orderBy('id', 'DESC')->get();
        $obervastion->delete();
        return response()->json([
            "success" => true ,
            "data" => $observations
        ]);
    }

}
