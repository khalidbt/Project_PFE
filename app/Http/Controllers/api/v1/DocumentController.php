<?php

namespace App\Http\Controllers\api\v1;

use App\Models\document;
use App\Models\project_document_pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController
{

    public function store(Request $request){

        // get logged user

        $user =  Auth::user();

        // VALIDATE FILE TYPE
        $validator = $request->validate([

            'project_id' => 'required|integer'
        ]);
/*
        if ($files = $request->file('file')) {

            //store file into document folder

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileExt = $file->getClientOriginalExtension();
            $newFileName = uniqid().$fileName.$fileExt;
            $filePath =  Storage::disk('pfe')->put('/files' , $file);

            // CREATING NEW DOCUMENT IN DB

            $document = new document();
            $document->documentUrl = $filePath ;
            $document->type = $file->getClientOriginalExtension() ;
            $document->save();

            // CREATING PROJECT PIVOT ENTRY

            $documentProjectPivot = new project_document_pivot();
            $documentProjectPivot->project_id = $request->project_id;
            $documentProjectPivot->document_id = $document->id;
            $documentProjectPivot->user_id = $user->id;
            $documentProjectPivot->save();



            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded"

            ]);

*/

        $document = new document();
        $document->documentUrl = $request->fileName ;
        $document->type = "pdf" ;
        $document->save();

        // CREATING PROJECT PIVOT ENTRY

        $documentProjectPivot = new project_document_pivot();
        $documentProjectPivot->project_id = $request->project_id;
        $documentProjectPivot->document_id = $document->id;
        $documentProjectPivot->user_id = $user->id;
        $documentProjectPivot->save();



        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded"  ]);


    }

    public function getDocumentsByUser(){

        $user = Auth::user();

        /// GET INDEXES OF DOCUMENTS MADE BY THE USER

        $documentIds = project_document_pivot::Where('user_id' , $user->id)->pluck('document_id')->toArray();

        // GET DOCUMENTS

        $documents = array_map( function ($documentId){

            return $doc = document::find($documentId);

        } , $documentIds);

        return response()->json(
            [
                "success" => true ,
                "documents" => $documents
            ]
        );


    }

    public function getDocumentByProject(Request $request ){

        // VALIDATE PAYLOAD

        $validator = $request->validate([

            'project_id' => 'required|integer'
        ]);


        /// GET INDEXES OF PROJECT DOCUMENTS

        $documentIds = project_document_pivot::Where('project_id' , $request->project_id)->pluck('document_id')->toArray();

        // GET DOCUMENTS

        $documents = array_map( function ($documentId){

            return $doc = document::find($documentId);

        } , $documentIds);

        return response()->json(
            [
                "success" => true ,
                "documents" => $documents
            ]
        );


    }

    public function deleteDocument(Request $request){

        // VALIDATE PAYLOAD

        $validator = $request->validate([

            'document_id' => 'required|integer'
        ]);

        document::where('id' , $request->document_id)->delete();
        project_document_pivot::where('document_id' ,$request->document_id )->delete();

        return response()->json([
            "success" => true ,

        ]);


    }

    public function deleteDocuments(Request $request){

        // VALIDATE PAYLOAD

        $validator = $request->validate([

            'document_ids' => 'required|array'
        ]);

        $documentIds = array_values($request->document_ids);
        $documentIds = array_unique($documentIds);



        foreach ($documentIds as $documentId) {
           document::where('id' , $documentId)->delete();
           project_document_pivot::where('document_id', $documentId)->delete();
        }


        return response()->json([
            "success" => true ,

        ]);


    }

}
