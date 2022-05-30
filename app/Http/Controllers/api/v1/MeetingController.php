<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Meeting;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;

class MeetingController
{

    public function store(Request $request){


        $validator = $request->validate([


       'date' => 'required|string',
            'projectId' => 'required|integer'
        ]);





        $meeting = new Meeting();
        $meeting->object = $request->object;
        $meeting->date = $request->date;
        $meeting->note = $request->note ?? null;
        $meeting->zoneId = $request->zoneId ?? null;
        $meeting->phase = $request->phase ?? null;
        $meeting->projectId = $request->projectId ?? null;
        $meeting->save();

        $meetings = Meeting::where('projectId' , $meeting->projectId)->get();

        return response()->json([
            "success" => true ,
            "data" => $meeting
        ]);
    }

    public function getMeetingsByProject(Request $request){

        $validator = $request->validate([
            'projectId' => 'required|integer'
        ]);

        $meetings = Meeting::where('projectId' , $request->projectId)->get();

        return response()->json([
            "success"=> true ,
            "data" => $meetings
        ]);

    }

    public function updateMeeting(Request $request){

        $validator = $request->validate([
            'id' => 'required|integer'
        ]);

        $meeting = Meeting::find($request->id);

        $date = substr($request->date , 0  , 10);

        $carbonDate = Carbon::createFromFormat('Y/m/d' , $date);
        $carbonDate->subDay(1);
        $date = $carbonDate->format("Y/m/d");



        $meeting->date = $date ;
        $meeting->object = $request->object;
        $meeting->note = $request->note;
        $meeting->zoneId = $request->zoneId;
        $meeting->phase = $request->phase;
        $meeting->save();

        return response()->json([
            "success" => true ,
            "data" => $meeting
        ]);
    }

    public function deleteMeeting(Request $request){

        $meeting = Meeting::find($request->id);

        $projectId = $meeting->projectId;
        $meeting->delete();

        $meetings = Meeting::where('projectId' , $projectId)->get();

        return response()->json([
            "success" => true ,
            "data" => $meetings
        ]);


    }

}
