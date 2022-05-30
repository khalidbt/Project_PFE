<?php

namespace App\Http\Controllers\api\v1;
use App\Models\zone;
use http\Client\Response;
use Illuminate\Http\Request;
class zoneController
{

    public function addZone(Request $request){

        $validator = $request->validate(
            [

                'projectId' => 'required|integer',
                'zoneName' => 'required|string'

            ]
        );

        $zone = new zone();
        $zone->projectId = $request->projectId;
        $zone->zoneName = $request->zoneName;
        $zone->save();

        return response()->json([
            "success" => true ,
            "data" => $zone
        ]);
    }

    public function getZoneByProjectId (Request $request){

        $validator = $request->validate([

           'projectId' => 'required|integer'
        ]);

        $zones = zone::where('projectId' , $request->projectId)->get();

        return response()->json([
            "success" => true ,
            "data" => $zones
        ]);
    }

    public function  update(Request $request){

        $zone = zone::where('id' , $request->id)->first();
        $zone->zoneName = $request->zoneName;
        $zone->save();
    }

}
