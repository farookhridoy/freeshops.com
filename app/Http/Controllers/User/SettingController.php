<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Image;
use Hash;
use Str;

class SettingController extends Controller
{
    public function settings()
    {
        $user = auth()->user();

        return view('user.setting', get_defined_vars());
    }

    public function uploadAvatar(Request $req)
    {
        $req->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        $image = $req->avatar;
        $path = "profile_images/".$user->id."-".Str::slug($user->name).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(180,180)->save(public_path($path));

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'statusCode' => 200,
            'message' => "Successfully Uploaded",
        ]);
    }

    public function personal(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->bio = $req->bio;
        $user->save();

        return redirect()->back()->with('success', 'Personal Information Updated Successfully!');
    }

    public function contact(Request $req)
    {
        $req->validate([
            'phone' => 'numeric',
        ]);

        $user = auth()->user();
        $user->phone = $req->phone;
        $user->website = $req->website;
        $user->save();

        return redirect()->back()->with('success', 'Contact Information Updated Successfully!');
    }

    public function password(Request $req)
    {
        $req->validate([
            'old_password' => 'required|password',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($req->password);
        $user->save();

        return redirect()->back()->with('success', 'Password Updated Successfully!');
    }

    public function location(Request $req)
    {
        $req->validate([
            'location' => 'required',
        ]);

        $user = auth()->user();
        $user->location = $req->location;
        $user->location_lat = $req->location_lat;
        $user->location_long = $req->location_long;
        $user->save();

        return redirect()->back()->with('success', 'Location Updated Successfully!');
    }
}
