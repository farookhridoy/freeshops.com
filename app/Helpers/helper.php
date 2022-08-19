<?php

use App\Models\BlogComment;
use App\Models\Favourite;
use App\Models\Category;
use App\Models\BlogPost;
use App\Models\Listing;
use App\Models\Thread;
use App\Models\Store;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;

function getNavCat() {
    $cat = Category::where('status', true)->limit(7)->get();

    return $cat;
}

function getOtherNavCat() {
    $cat = Category::where('status', true)->skip(7)->take(10)->get();

    return $cat;
}

function getCart() {
    $user = auth()->user();
    return $user->cart;
}

function checkFav($id) {
    $user = auth()->user();
    $fav = Favourite::where('user_id', $user->id)->where('listing_id', $id)->first();

    if ($fav) {
        return true;
    } else {
        return false;
    }
}

function checkCart($id) {
    $user = auth()->user();
    $cart = Cart::where('user_id', $user->id)->where('listing_id', $id)->first();

    if ($cart) {
        return true;
    } else {
        return false;
    }
}

function generateOrderNo() {
    $no = "FS".substr(str_shuffle("A0B1C2D3E4F5G6HI7J8K9L"), 0, 10);

    if (orderNoExists($no)) {
        return generateOrderNo();
    } else {
        return $no;
    }
}

function orderNoExists($number) {
    return Order::whereOrderNo($number)->exists();
}

function getOtherParticipant($id) {
    $thread = Thread::find($id);
    $user = auth()->user();

    return $thread->participants->where('user_id', '!=', $user->id)->first();
}

function yearlyRevenueReport($collection) {
    $data = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach($collection as $c){
        $data[$c->monthKey-1] = $c->sums;
    }

    return $data;
}

function newUsersToday() {
    $today_users = User::whereRole('1')->whereDate('created_at', Carbon::today())->count();
    $prev_users = User::whereRole('1')->whereDate('created_at', '<' , Carbon::today())->count();

    if ($prev_users < $today_users ) {
        if($prev_users > 0) {
            $percent_from = $today_users - $prev_users;
            $percent = array(
                'dir' => 'up',
                'fig' => $percent_from / $prev_users * 100,
            );
        } else {
            $percent = array(
                'dir' => 'up',
                'fig' => 100,
            );
        }
    } else {
        $percent_from = $prev_users - $today_users;
        $percent = array(
            'dir' => 'down',
            'fig' => $percent_from / $prev_users * 100,
        );
    }

    return $percent;
}

function newOrdersToday() {
    $today_orders = Order::whereStatus('1')->whereDate('created_at', Carbon::today())->count();
    $prev_orders = Order::whereStatus('1')->whereDate('created_at', '<' , Carbon::today())->count();

    if ($prev_orders < $today_orders ) {
        if($prev_orders > 0) {
            $percent_from = $today_orders - $prev_orders;
            $percent = array(
                'dir' => 'up',
                'fig' => $percent_from / $prev_orders * 100,
            );
        } else {
            $percent = array(
                'dir' => 'up',
                'fig' => 100,
            );
        }
    } else {
        $percent_from = $prev_orders - $today_orders;
        $percent = array(
            'dir' => 'down',
            'fig' => $percent_from / $prev_orders * 100,
        );
    }

    return $percent;
}

function newListingToday() {
    $today_listings = Listing::whereDate('created_at', Carbon::today())->count();
    $prev_listings = Listing::whereDate('created_at', '<' , Carbon::today())->count();

    if ($prev_listings < $today_listings ) {
        if($prev_listings > 0) {
            $percent_from = $today_listings - $prev_listings;
            $percent = array(
                'dir' => 'up',
                'fig' => $percent_from / $prev_listings * 100,
            );
        } else {
            $percent = array(
                'dir' => 'up',
                'fig' => 100,
            );
        }
    } else {
        $percent_from = $prev_listings - $today_listings;
        $percent = array(
            'dir' => 'down',
            'fig' => $percent_from / $prev_listings * 100,
        );
    }

    return $percent;
}


function countAllListings() {
    return Listing::count();
}

function countReviewListings() {
    return Listing::where('status', '1')->count();
}

function countPublishedListings() {
    return Listing::where('status', '2')->count();
}

function countRejectedListings() {
    return Listing::where('status', '3')->count();
}

function countAllPosts() {
    return BlogPost::count();
}

function countReviewPosts() {
    return BlogPost::where('status', '1')->count();
}

function countDraftPosts() {
    return BlogPost::where('status', '2')->count();
}

function countPublishedPosts() {
    return BlogPost::where('status', '3')->count();
}

function countRejectedPosts() {
    return BlogPost::where('status', '4')->count();
}

function countAllBlogComments() {
    return BlogComment::count();
}

function countActiveBlogComments() {
    return BlogComment::whereStatus(true)->count();
}

function countHiddenBlogComments() {
    return BlogComment::whereStatus(false)->count();
}

function countAllOrders() {
    return Order::count();
}
function countReviewOrders() {
    return Order::where('status', '4')->count();
}

function countActiveOrders() {
    return Order::where('status', '1')->count();
}

function countCompletedOrders() {
    return Order::where('status', '2')->count();
}

function countCancelledOrders() {
    return Order::where('status', '3')->count();
}

function countAllStores() {
    return Store::count();
}

function countActiveStores() {
    return Store::whereStatus(true)->count();
}

function countDisabledStores() {
    return Order::whereStatus(false)->count();
}
function uploadFile($file, $path){
    $name = time().'-'.str_replace(' ', '-', $file->getClientOriginalName());
    $file->move($path,$name);
    return $path.'/'.$name;
}
function setting($key){
    $setting = Setting::pluck('value', 'name');
    //dd($setting);
    return $setting[$key] ?? '';
}
