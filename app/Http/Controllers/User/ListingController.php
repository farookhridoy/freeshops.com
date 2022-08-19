<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingImage;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Store;
use File;

class ListingController extends Controller
{
    public function listings()
    {
        $user = auth()->user();
        $listings = $user->listings;

        return view('user.listing', get_defined_vars());
    }

    public function edit($id = null)
    {
        $categories = Category::where('status', true)->orderBy('name', 'ASC')->get();
        $listing = Listing::find($id);

        $arr = array();
        $images = $listing->listing_images;
        foreach ($images as $key => $value) {
            $arr[] = array(
                "check" => $value->id,
                "name" => File::name($value->path),
                "size" => File::size($value->path),
                "type" => File::mimeType($value->path),
                "file" => asset($value->path),
            );
        }

        return view('user.listing_edit', get_defined_vars());
    }

    public function delete($id = null)
    {
        Listing::find($id)->delete();

        return redirect()->back()->with('success', 'Listing Deleted Successfully!');
    }
}
