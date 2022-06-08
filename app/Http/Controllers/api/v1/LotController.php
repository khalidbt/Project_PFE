<?php

namespace App\Http\Controllers\api\v1;

use App\Models\lot;
use App\Models\lot_description;
use App\Models\user;
use Illuminate\Http\Request;


class LotController
{

    public function lotDescription (){

        $descs = lot_description::all();

        return response()->json([

            "data" => $descs
        ]);
    }

    public function addLot (Request $request) {

        $lot = new lot();
        $lot->collaborateur_id = $request->collab_id ;
        $lot->project_id = $request->project_id ;
        $lot->desc_id = $request->desc_id ;
        $lot->save();

    }

    public function getLots (Request $request){

        $lots = lot::where('project_id' , $request->project_id)->get();
        $data = [];

        foreach($lots as $lot){

            $user = user::where('id' , $lot->collaborateur_id)->first();
            $desc = lot_description::where('id' , $lot->desc_id)->first();

            $data[] = array(
                "id" => $lot->id,
                "desc_id" => $lot->desc_id ,
                "collaborateur_id" => $lot->collaborateur_id ,
                "preName" => $user->preName ,
                "lastName" => $user->lastName ,
                "name" => $desc->name
            );
        }

        return response()->json([

            "data" => $data
        ]);
    }

}
