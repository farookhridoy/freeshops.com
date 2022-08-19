<?php

namespace App\Http\Controllers\User;

use App\Notifications\UserNotification;
use App\Notifications\EmailNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function order($order_no = null)
    {
        if (!is_null($order_no)) {
            $order = Order::where('order_no', $order_no)->first();

            return view('user.order_detail', get_defined_vars());
        }
    }

    public function status($order_no = null, $status = null)
    {
        $order = Order::where('order_no', $order_no)->first();

        if ($status == "accept") {
            $order->status = '2';

            $listing = $order->listing;
            $listing->availablity = "2";
            $listing->save();

            $msg = "Order Marked as Completed";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Order Update!',
                'body' => 'Your order has been successfully accepted by the advertiser.',
                'action' => route('user.order', $order_no),
            ]);
            $notif = User::find($order->transaction->user->id);
            $notif->notify(new UserNotification($data));

            $email_data = [
                "subject" => "Congratulations! We hope you are happy to have your gift",
                "view" => "user.order_received",
                "order" => $order,
                "user" => $notif,
            ];
            $notif->notify(new EmailNotification($email_data));


        } else if ($status == "decline") {
            $order->status = '3';

            $listing = $order->listing;
            $listing->availablity = "1";
            $listing->save();

            $msg = "Order Cancelled";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Order Update!',
                'body' => 'Your order has been rejected by the advertiser.',
                'action' => route('user.order', $order_no),
            ]);
            $notif = User::find($order->transaction->user->id);
            $notif->notify(new UserNotification($data));
        }

        $order->save();

        return redirect()->back()->with('success', $msg);
    }
}
