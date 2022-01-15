<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function getVarify(){
        return view('opt-varify');
    }


    public function otpStore(Request $request){

        $code = rand(1000, 9999);

        $data = new Contact();
        $data->phone_number = $request->phone_number;
        $data->code =  $code;
        $data->save();


        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to'   => '+880'. (int) $request->phone_number,
            'from' => 'Hannan Bhuiyan',
            'text' => 'Verify Code '.$code
        ]);

        return redirect()->route('verifyPage');



    }

    public function getVarifyPage(Request $request)
    {
        return view('verifyPage');
    }

    public function postVerifyOtp(Request $request)
    {
        $check = Contact::where('code', $request->code)->first();
        if($check){
            $check->code = "";
            $check->save();
            return redirect()->route('home');
        }else {
            return back()->withMessage('Code is not currect ! Please try agien');
        }
    }




}
