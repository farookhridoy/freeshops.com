<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Auth;
use Hash;

class SocialController extends Controller
{
    public function socialLogin($provider = null)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function socialLoginCallback($provider = null)
    {
        if ($provider == "facebook") {
            $userSocial = Socialite::driver($provider)->fields(['first_name', 'last_name', 'email',])->user();

            $first = $userSocial->user['first_name'];
            $last = $userSocial->user['last_name'];
            
            $id = $userSocial->getId();
            $avatar = $userSocial->getAvatar();
            $email = $userSocial->user['email'];

        } else if ($provider == "google") {
            $userSocial =   Socialite::driver($provider)->stateless()->user();

            $first = $userSocial->name;
            $last = !empty($userSocial->nickname) ? $userSocial->nickname : '';
            
            $email = $userSocial->email;
            $id = $userSocial->getId();
            $avatar = $userSocial->getAvatar();
            // $first = $userSocial->user['given_name'];
            // $last = $userSocial->user['family_name'];
            
        } else {
            abort(403);
        }

        

        $user = User::where(['email' => $email])->first();

        if (!is_null($user)) {
            Auth::login($user);
            return redirect()->route('home');
        } else {
            $user = User::create([
                'name' => $first,
                'email' => $email,
                'password' => Hash::make("12345678"),
                'role' => '1',
                'provider' => $provider,
                'provider_id' => $id,
            ]);

            event(new Registered($user));

            Auth::login($user);
            return redirect()->route('home');
        }

    }
}
