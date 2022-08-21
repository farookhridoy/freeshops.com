<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use DB,Session;

class VerifyOtpController extends Controller
{
    public function index()
    {
        if(auth()->user()->otp_verify_code ==null){
            if (auth()->user()->role == "1") {
                   
                   return $this->redirectBackWithSuccess('OTP has been successfully verified.','home');
               }elseif (auth()->user()->role == "2") {
                   return $this->redirectBackWithSuccess('OTP has been successfully verified.','admin.dashboard');
                   
            }
        }else{
            return view('front.verify_otp');
        }
    }

    public function verify($otp_verify_code)
    {
        
        $user = User::where('otp_verify_code',$otp_verify_code)->first();
        
        if (!isset($user->otp_verify_code)) {
            $this->redirectBackWithWarning('Please provide a valid code','home');
        }else{
             DB::beginTransaction();
            try {
                $user->otp_verify_code = null;
                $user->save();
                DB::commit();

                if (auth()->user()->role == "1") {
                   return $this->redirectBackWithSuccess('OTP has been successfully verified.','home');
               }elseif (auth()->user()->role == "2") {
                   return $this->redirectBackWithSuccess('OTP has been successfully verified.','admin.dashboard');
               }

            }catch (\Exception $e) {
                DB::rollback();
                $this->backWithError($e->getMessage());
            }
        }

        return back();
        
    }
}
