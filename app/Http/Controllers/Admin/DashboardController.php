<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Listing;
use App\Models\Order;
use App\Models\User;
use Image;
use Hash;
use Str;
use DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $total_revenue = Transaction::sum('amount');
        $yearly_report = Transaction::select(
                DB::raw('sum(amount) as sums'),
                DB::raw("DATE_FORMAT(created_at,'%m') as monthKey")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthKey')
            ->orderBy('created_at', 'ASC')
            ->get();

        $yearly_report = yearlyRevenueReport($yearly_report);
        $total_users = User::whereRole('1')->count();
        $total_orders = Order::whereStatus('1')->count();
        $total_listings = Listing::count();

        $recent_orders = Order::orderBy('created_at', 'DESC')->limit(5)->get();


        return view('admin.dashboard', get_defined_vars());
    }

    public function profile()
    {
        $user = auth()->user();

        return view('admin.profile', get_defined_vars());
    }

    public function profileUpdate(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->bio = $req->bio;
        $user->phone = $req->phone;
        $user->website = $req->website;
        $user->location = $req->location;
        $user->location_lat = $req->location_lat;
        $user->location_long = $req->location_long;
        if ($req->avatar) {
            $image = $req->avatar;
            $path = "profile_images/".$user->id."-".Str::slug($user->name).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(180,180)->save(public_path($path));

            $user->avatar = $path;
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

    public function security()
    {
        $user = auth()->user();

        return view('admin.security', get_defined_vars());
    }

    public function securityUpdate(Request $req)
    {
        $req->validate([
            'old_password' => 'required|password',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($req->password);
        $user->save();

        return redirect()->back()->with('success', 'Security Settings Updated Successfully!');
    }
}
