<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use\Carbon\Carbon;
use App\Models\Order;
use App\Notifications\UserNotification;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('status', '1')->get();
        foreach($orders as $order){
            $time = $order->created_at->addHours(72);
            if( $time <= Carbon::now() ){
                $order->status = '3';
                $order->save();

                $listing = $order->listing;
                $listing->availablity = '1';
                $listing->save();

                $notif = $order->transaction->user;
                $data = collect([
                    'icon' => asset('bell-icon.jpg'),
                    'title' => 'Order Cancelled!',
                    'body' => 'Sorry : Your Order has been cancelled !. Click to see',
                    'action' => route('user.order', $order->order_no),
                ]);
                $notif->notify(new UserNotification($data));
            }
        }
    }
}
