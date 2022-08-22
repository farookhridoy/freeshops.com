<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\VerifyOtpNotification;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return redirect('admin/login');
        //return view('auth.login');
    }

    public function adminLogin()
    {
        return view('auth.admin_login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = User::where('id',auth()->user()->id)->first();
        $user->otp_verify_code = $this->generateUniqueCode();
        $user->save();
        $user->notify(new VerifyOtpNotification($user));

        if ($request->ajax()) {
            if ($user->role == "1") {
                return response()->json([
                    'statusCode' => 200,
                    'reload' => true,
                    'message' => 'Please check your email to complete the verification process.',
                    'redirectTo' => RouteServiceProvider::USER,
                ]);
            }elseif ($user->role == "2") {
                return response()->json([
                    'statusCode' => 200,
                    'reload' => true,
                    'message' => 'Please check your email to complete the verification process.',
                    'redirectTo' => RouteServiceProvider::ADMIN,
                ]);
            }
        } else {
            if ($user->role == "2") {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }
        }

    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (User::where("otp_verify_code", "=", $code)->first());
  
        return $code;
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
