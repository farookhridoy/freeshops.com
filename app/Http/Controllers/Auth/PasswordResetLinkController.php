<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.


        $user  = User::where('email','=',$request->email)->first();
        if(!empty($user))
        {
            $user->remember_token = Str::random(50);
            $user->save();
            
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return response()->json([
                'statusCode' => 200,
                'reload' => false,
                'message' => "We have emailed your password reset link!",
            ]);
        }
        else
        {
            return response()->json([
                'statusCode' => 400,
                'reload' => false,
                'message' => "We can't find a user with that email address.",
            ]);
        }


        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // We have emailed your password reset link!

        // if ($status == Password::RESET_LINK_SENT) {
        //     return response()->json([
        //         'statusCode' => 200,
        //         'reload' => false,
        //         'message' => __($status),
        //     ]);
        // } else {
        //     return response()->json([
        //         'statusCode' => 400,
        //         'reload' => false,
        //         'message' => __($status),
        //     ]);
        // }


        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
    }
}
