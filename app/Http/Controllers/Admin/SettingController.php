<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function save(Request $req)
    {
        // dd($req->all());
        foreach ($req->except('_token') as $key => $value) {
            $setting = Setting::whereName($key)->first() ?? new Setting();
            if ($req->hasFile($key)) {
                $image_path =  uploadFile($req->$key, 'uploads/cms',);
                $setting->name = $key;
                $setting->value = $image_path;
                $setting->save();
            } else{
                $setting->name = $key;
                $setting->value = $value;
                $setting->save();
            }
        }
        $msg = 'Settings Updated Successfully';
        return redirect()->back()->with('success', $msg);
    }

    public function general()
    {

        // dd($list);
        return view('admin.setting.general', get_defined_vars());
    }
    public function home()
    {
        // dd($list);
        return view('admin.setting.home', get_defined_vars());
    }
    public function social()
    {
        // dd($list);
        return view('admin.setting.social', get_defined_vars());
    }
    public function about_us()
    {
        // dd($list);
        return view('admin.setting.about_us', get_defined_vars());
    }
    public function terms()
    {
        return view('admin.setting.terms', get_defined_vars());
    }
    public function privacy()
    {
        return view('admin.setting.privacy', get_defined_vars());
    }

    public function somethingNew()
    {
        return view('admin.setting.something_new', get_defined_vars());
    }
    public function whatWeAreUpto()
    {
        return view('admin.setting.what_we_are_upto', get_defined_vars());
    }
    public function joinWithUs()
    {
        return view('admin.setting.join_with_us', get_defined_vars());
    }
    public function whyShoppsFree()
    {
        return view('admin.setting.why_shopps_free', get_defined_vars());
    }
    public function ourGoal()
    {
        return view('admin.setting.our_goal', get_defined_vars());
    }
    public function faq()
    {
        return view('admin.setting.faq', get_defined_vars());
    }
    public function termAndTermination()
    {
        return view('admin.setting.term_and_termination', get_defined_vars());
    }
    public function community()
    {
        return view('admin.setting.community', get_defined_vars());
    }
    public function communityGuideline()
    {
        return view('admin.setting.community_guidline', get_defined_vars());
    }
}
