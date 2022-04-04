<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailServiceJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EmailServiceController extends Controller
{
    public function sendEmailService(Request $request)
    {

        $data = $request->all();

        $hash = hash('sha256', env('ACCESS_TOKEN'));

        if(($data['token'] === $hash)){

            $validator = Validator::make($data, [
                'address' => 'required|email',
                'recipient' => 'required|email',
                'subject' => 'required',
                'body' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                    'message' => 'Incorrect data'
                ]);
            }

            SendEmailServiceJob::dispatch($data)->delay(Carbon::now()->addSecond(1));
            return response()->json(['success', 'Email sended']);
        }
        else{
            return response()->json(['failure', 'Incorrect Token! Permission Denied!']);
        }
    }
}
