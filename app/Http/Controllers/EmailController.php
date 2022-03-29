<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailClient;
use App\Mail\SendEmailOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function sendEmail(Request $request){

        $data = $request->all();

        $validator = Validator::make($data, [
            'address' => 'required|email',
            'subject' => 'required',
            'body' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors(),
                                'message'=> 'Incorrect data']);
        }


        Mail::to($data['address'])->send(new SendEmailClient($data));
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SendEmailOwner($data));

        return response()->json(['success', 'Emails sended']);
    }
}
