<?php

namespace App\Http\Controllers\api\v1;

use App\Models\observation;
use Illuminate\Http\Request;

class test
{

    public function  test(Request $request){

        try {
            $observation = observation::find($request->id);
            $observation->projectId = $request->projectId;
            $observation->meetingId = $request->meetingId;
            $observation->localisation = $request->localisation;
            $observation->description = $request->description;
            $observation->created = $request->created;
            $observation->limite = $request->limite;
            $observation->lever = $request->lever;
            $observation->status = $request->status;
            $observation->lot = $request->lot;

            $observation->save();

            return response()->json([
                "success" => true,

            ]);
        }catch(\Exception $exception){
            echo $exception->getMessage();
        }
    }

}
