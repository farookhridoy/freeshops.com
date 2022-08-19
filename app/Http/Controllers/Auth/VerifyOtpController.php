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
                 return redirect()->intended(RouteServiceProvider::USER);
            }elseif (auth()->user()->role == "2") {
                 return redirect()->intended(RouteServiceProvider::ADMIN);
            }
        }else{
            return view('front.verify_otp');
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp_verify_code' => 'required|string|max:6',
        ]);
        
        $user = User::where('otp_verify_code',$request->otp_verify_code)->first();

        DB::beginTransaction();
        if ($user->id) {
             try {
                $user->otp_verify_code = null;
                $user->save();
                DB::commit();

                if (auth()->user()->role == "1") {
                   
                   return $this->redirectBackWithSuccess('OTP has been successfully verified.','user.dashboard');
               }elseif (auth()->user()->role == "2") {
                   return $this->redirectBackWithSuccess('OTP has been successfully verified.','admin.dashboard');
                   
               }

            }catch (\Exception $e) {
                DB::rollback();
                $this->backWithError($e->getMessage());
            }
        }else{
            $this->backWithError('Please provide a valid code');
        }

        return back;
        
    }
}
