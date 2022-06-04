<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ICS;
use App\Models\Meeting;
use App\Models\project;
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

        $carbonDate = Carbon::createFromFormat('Y-m-d' , $date);
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

    public function generateQrCode(Request $request){

        $meeting = Meeting::find($request->id);
        $project = project::find($meeting->projectId);
        $icsCalendar = new ICS();

        $start = $meeting->date ;
        $end = $meeting->date ;
        $name = $project->projectName;
        $description = $meeting->object ;
        $location = $project->addresse ;


        $icsCalendar->ICS($start,$end,$name,$description,$location);

        $pdf = new \TCPDF2DBarcode((string)$icsCalendar->getData() , 'QRCODE,L');

        $fileName = $meeting->id.'.png';
        $path = resource_path()."/photos/meetings/".$fileName;

        //transforming qrcode into png image and putting it into /Images directory

        if ( ! \Illuminate\Support\Facades\File::exists(resource_path()."/photos/meetings/")){
            \Illuminate\Support\Facades\File::makeDirectory(resource_path()."/photos/meetings/");
        }

        file_put_contents($path, $pdf->getBarcodePngData(6, 6, array(0,0,0)));
        $extencion = 'png';


        $image = file_get_contents($path);
        $img_base_64 = base64_encode($image);
        $qrCode = 'data:image/' . $extencion . ';base64,' . $img_base_64;

        $data['qrcode'] = $qrCode;
        return response()->json($data);


    }

}
