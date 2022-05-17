<?php

namespace App\Http\Controllers\api\v1;

use App\Mail\pfeMail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class MailController
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('khalidboutlih@gmail.com')->send(new pfeMail($mailData));

       return response()->json([
           "success" => true
       ]);
    }

}
