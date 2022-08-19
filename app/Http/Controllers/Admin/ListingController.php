<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use DataTables;
use Str;
use App\Notifications\EmailNotification;


class ListingController extends Controller
{
    public function all(Request $req)
    {
        $list = Listing::with('user', 'category')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('image', function($row) {
                    return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                })
                ->addColumn('title', function($row) {
                    return '<a target="_blank" href="'.route('listing', $row->slug).'">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('category', function($row) {
                    return $row->category->name;
                })
                ->addColumn('availablity', function($row) {
                    if ($row->availablity == "1") {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Available</span>';
                    } elseif($row->availablity == "3"){
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-warning cursor-pointer">Booked</span>';
                    }
                    else {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Sold</span>';
                    }
                    return $availablityCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('listing', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.listing.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'review']).'\', \'You want to mark this listing as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'published']).'\', \'You want to mark this listing as Published\')">Mark as Published</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'rejected']).'\', \'You want to mark this listing as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','title','image','availablity','action'])
                ->make(true);
        } else {
            return view('admin.listings.all', get_defined_vars());
        }

    }

    public function inReview(Request $req)
    {
        $list = Listing::where('status', '1')
            ->with('user', 'category')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('image', function($row) {
                    return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                })
                ->addColumn('title', function($row) {
                    return '<a target="_blank" href="'.route('listing', $row->slug).'">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('category', function($row) {
                    return $row->category->name;
                })
                ->addColumn('availablity', function($row) {
                    if ($row->availablity == "1") {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Available</span>';
                    } else {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Sold</span>';
                    }
                    return $availablityCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('listing', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.listing.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'published']).'\', \'You want to mark this listing as Published\')">Mark as Published</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'rejected']).'\', \'You want to mark this listing as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','title','image','availablity','action'])
                ->make(true);
        } else {
            return view('admin.listings.in_review', get_defined_vars());
        }
    }

    public function published(Request $req)
    {
        $list = Listing::where('status', '2')
            ->with('user', 'category')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('image', function($row) {
                    return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                })
                ->addColumn('title', function($row) {
                    return '<a target="_blank" href="'.route('listing', $row->slug).'">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('category', function($row) {
                    return $row->category->name;
                })
                ->addColumn('availablity', function($row) {
                    if ($row->availablity == "1") {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Available</span>';
                    } else {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Sold</span>';
                    }
                    return $availablityCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('listing', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.listing.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'review']).'\', \'You want to mark this listing as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'rejected']).'\', \'You want to mark this listing as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','title','image','availablity','action'])
                ->make(true);
        } else {
            return view('admin.listings.published', get_defined_vars());
        }
    }

    public function rejected(Request $req)
    {
        $list = Listing::where('status', '3')
            ->with('user', 'category')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('image', function($row) {
                    return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                })
                ->addColumn('title', function($row) {
                    return '<a target="_blank" href="'.route('listing', $row->slug).'">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('category', function($row) {
                    return $row->category->name;
                })
                ->addColumn('availablity', function($row) {
                    if ($row->availablity == "1") {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Available</span>';
                    } else {
                        $availablityCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Sold</span>';
                    }
                    return $availablityCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('listing', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.listing.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'review']).'\', \'You want to mark this listing as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.listing.status.change', [$row->id, 'published']).'\', \'You want to mark this listing as Published\')">Mark as Published</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','title','image','availablity','action'])
                ->make(true);
        } else {
            return view('admin.listings.rejected', get_defined_vars());
        }
    }

    public function delete($id = null)
    {
        $listing = Listing::find($id)->delete();

        return redirect()->back()->with('success', 'Listing Successfully Deleted!');
    }

    public function statusChange($id = null, $status = null)
    {
        $listing = Listing::find($id);

        if ($status == "review") {
            $listing->status = "1";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'News about Listing!',
                'body' => 'Your listing is in under review. Click to see',
                'action' => route('user.listings'),
            ]);
            $notif = User::find($listing->user->id);
            $notif->notify(new UserNotification($data));
            $email_data = [
                "subject" => "Your listing is in under review.",
                "msg" => "FreeShopps will review your listing, thank you.",
                "view" => "user.status_listing",
                "listing" => $listing,
                "user" => $notif,
            ];
            $notif->notify(new EmailNotification($email_data));

            $msg = "Listing successfully sent into review";

        } else if ($status == "published") {
            $listing->status = "2";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'News about Listing!',
                'body' => 'CONGRATULATIONS! Your listing is published now. Click to see',
                'action' => route('user.listings'),
            ]);
            $notif = User::find($listing->user->id);
            $notif->notify(new UserNotification($data));
             $email_data = [
                "subject" => "CONGRATULATIONS! Your listing is published now.",
                "msg" => "Your listing is published now. thank you.",
                "view" => "user.status_listing",
                "listing" => $listing,
                "user" => $notif,
            ];
            $notif->notify(new EmailNotification($email_data));

            $msg = "Listing successfully sent into published";

        } else if ($status == "rejected") {
            $listing->status = "3";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'News about Listing!',
                'body' => 'OOPS! Your listing is rejected by our system. Please review again',
                'action' => route('user.listings'),
            ]);
            
            $notif = User::find($listing->user->id);
            $notif->notify(new UserNotification($data));
             $email_data = [
                "subject" => " Your listing is rejected .",
                "msg" => "OOPS! Your listing is rejected by our system. Please review again",
                "view" => "user.status_listing",
                "listing" => $listing,
                "user" => $notif,
            ];
            $notif->notify(new EmailNotification($email_data));

            $msg = "Listing successfully sent into rejected";

        }

        $listing->save();

        return redirect()->back()->with('success', $msg);
    }
}
