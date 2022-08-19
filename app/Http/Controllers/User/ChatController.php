<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Message;
use App\Models\Thread;
use App\Models\Order;
use App\Models\User;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function chat(Request $req)
    {
        $user = auth()->user();

        $threads = Thread::whereHas('participants', function($q) use($user) {
            $q->where('user_id', $user->id);
        })->get();

        return view('user.chat', get_defined_vars());
    }

    public function get(Request $req)
    {
        $user = auth()->user();
        $thread = Thread::find($req->id);

        $active_orders = Order::whereHas('listing', function($q) use($user) {
            $q->where('user_id', $user->id);
        })->whereHas('transaction', function($u) use($req) {
            $u->where('user_id', $req->active_user);
        })->where('status', '1')->get();

        return response()->json([
            'statusCode' => 200,
            'activeOrdersCount' => count($active_orders),
            'activeOrders' => view('ajax.active_orders', get_defined_vars())->render(),
            'messages' => view('ajax.messages', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req)
    {
       //dd($req->all());
        $user = auth()->user();

        $message = new Message();
        $message->thread_id = $req->thread_id;
        $message->user_id = $user->id;
        if($req->file ){

            $message->body = uploadFile($req->file, 'uploads/chats');
        }else{

            $message->body = $req->message;
        }
        $message->type = 1;
        $message->save();

        // Pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            'bc962cb6c438e5c885c2',
            '9254881c1cddcb09e959',
            '1244187',
            $options
        );

        $data = ['thread_id' => $message->thread_id];
        $pusher->trigger('my-channel', 'my-event', $data);

        return response()->json([
            'status' => true,
            'message' => 'Added',
        ]);
    }
}
