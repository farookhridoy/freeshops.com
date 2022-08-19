<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StoreSchedule;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Image;
use Hash;
use Str;

class StoreController extends Controller
{
    public function store()
    {
        abort(404);
        $user = auth()->user();
        if (is_null($user->store)) {
            $store = Store::create([
                'user_id' => $user->id,
            ]);
        } else {
            $store = $user->store;
        }


        $is_closed = [];
        $is_24h = [];
        $opening_time = [];
        $closing_time = [];

        if (count($store->store_schedules) > 0) {
            foreach ($store->store_schedules as $sc) {
                $is_closed[] = $sc->is_closed;
                $is_24h[] = $sc->is_24;
                $opening_time[] = $sc->opening_time;
                $closing_time[] = $sc->closing_time;
            }
        }

        return view('user.store', get_defined_vars());
    }

    public function storeLogo(Request $req)
    {
        abort(404);
        $req->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();
        $store = $user->store;

        $image = $req->logo;
        $path = "stores/".$user->id."-".Str::slug($user->name).'-logo.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(180,180)->save(public_path($path));

        $store->logo = $path;
        $store->save();

        return response()->json([
            'statusCode' => 200,
            'message' => "Successfully Uploaded",
        ]);
    }

    public function storeBanner(Request $req)
    {
        abort(404);
        $req->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();
        $store = $user->store;

        $image = $req->banner;
        $path = "stores/".$user->id."-".Str::slug($user->name).'-banner.'.$image->getClientOriginalExtension();

        Image::make($image)->save(public_path($path));

        $store->banner = $path;
        $store->save();

        return response()->json([
            'statusCode' => 200,
            'message' => "Successfully Uploaded",
        ]);
    }

    public function storeInformation(Request $req)
    {
        abort(404);
        $req->validate([
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'website' => 'required',
            'description' => 'required',
        ]);

        $user = auth()->user();
        $store = $user->store;

        $store->name = $req->name;
        $store->slug = $req->slug;
        $store->tagline = $req->tagline;
        $store->email = $req->email;
        $store->phone = $req->phone;
        $store->website = $req->website;
        $store->description = $req->description;
        $store->save();

        return redirect()->back()->with('success', 'Store Information Updated Successfully!');
    }

    public function storeSchedule(Request $req)
    {
        abort(404);
        $user = auth()->user();
        $store = $user->store;

        if(count($store->store_schedules) > 0)
            $store->store_schedules()->delete();

        $days = [
            'Monday', 'Tuesday', 'Wednesday',
            'Thursday', 'Friday', 'Saturday', 'Sunday'
        ];

        for($d=0;$d<7;$d++)
    	{
    		$sc = new StoreSchedule();
            $sc->store_id = $store->id;
    		$sc->day = $days[$d];
    		$sc->is_closed = $req->is_closed[$d] ?? 0;
    		$sc->is_24 = $req->is_24[$d] ?? 0;
    		$sc->opening_time = $req->opening_time[$d] ?: '00:00';
    		$sc->closing_time = $req->closing_time[$d] ?: '23:59';
    		$sc->save();
    	}

        return redirect()->back()->with('success', 'Store Schedule Updated Successfully!');
    }

    public function storeSocial(Request $req)
    {
        abort(404);
        $user = auth()->user();
        $store = $user->store;

        $store->facebook = $req->facebook;
        $store->instagram = $req->instagram;
        $store->linkedin = $req->linkedin;
        $store->youtube = $req->youtube;
        $store->twitter = $req->twitter;
        $store->save();

        return redirect()->back()->with('success', 'Store Social Updated Successfully!');
    }

    public function storeLocation(Request $req)
    {
        abort(404);
        $req->validate([
            'location' => 'required',
        ]);

        $user = auth()->user();
        $store = $user->store;

        $store->location = $req->location;
        $store->location_lat = $req->location_lat;
        $store->location_long = $req->location_long;
        $store->save();

        return redirect()->back()->with('success', 'Store Location Updated Successfully!');
    }
}
