<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Order;
use App\Models\User;
use DataTables;
use Str;

class OrderController extends Controller
{
    public function all(Request $req)
    {
        $list = Order::with('listing', 'transaction')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('order_no', function($row) {
                    return "#".$row->order_no;
                })
                ->addColumn('buyer', function($row) {
                    return $row->transaction->user->name;
                })
                ->addColumn('product', function($row) {
                    return '<a href="'.route('listing', $row->listing->slug).'" target="_blank">'.Str::limit($row->listing->title, 20, '...').'</a>';
                })
                ->addColumn('status', function($row) {
                    if ($row->status == "1") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-warning cursor-pointer">Active</span>';
                    } else if ($row->status == "2") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Completed</span>';
                    } else if ($row->status == "3") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Cancelled</span>';
                    } else if ($row->status == "4") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-primary cursor-pointer">In Review</span>';
                    }
                    return $statusCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.order.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'active']).'\', \'You want to mark this order as Active\')">Mark as Active</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'completed']).'\', \'You want to mark this order as Completed\')">Mark as Completed</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'cancelled']).'\', \'You want to mark this order as Cancelled\')">Mark as Cancelled</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'review']).'\', \'You want to mark this order as In review\')">Mark as In Review</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['product','status','action'])
                ->make(true);
        } else {
            return view('admin.orders.all', get_defined_vars());
        }
    }

    public function active(Request $req)
    {
        $list = Order::where('status', '1')
            ->with('listing', 'transaction')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('order_no', function($row) {
                    return "#".$row->order_no;
                })
                ->addColumn('buyer', function($row) {
                    return $row->transaction->user->name;
                })
                ->addColumn('product', function($row) {
                    return '<a href="'.route('listing', $row->listing->slug).'" target="_blank">'.Str::limit($row->listing->title, 20, '...').'</a>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.order.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'completed']).'\', \'You want to mark this order as Completed\')">Mark as Completed</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'cancelled']).'\', \'You want to mark this order as Cancelled\')">Mark as Cancelled</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'review']).'\', \'You want to mark this order as In review\')">Mark as In review</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['product','status','action'])
                ->make(true);
        } else {
            return view('admin.orders.active', get_defined_vars());
        }
    }

    public function completed(Request $req)
    {
        $list = Order::where('status', '2')
            ->with('listing', 'transaction')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('order_no', function($row) {
                    return "#".$row->order_no;
                })
                ->addColumn('buyer', function($row) {
                    return $row->transaction->user->name;
                })
                ->addColumn('product', function($row) {
                    return '<a href="'.route('listing', $row->listing->slug).'" target="_blank">'.Str::limit($row->listing->title, 20, '...').'</a>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.order.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'active']).'\', \'You want to mark this order as Active\')">Mark as Active</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'cancelled']).'\', \'You want to mark this order as Cancelled\')">Mark as Cancelled</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'review']).'\', \'You want to mark this order as In review\')">Mark as In review</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['product','status','action'])
                ->make(true);
        } else {
            return view('admin.orders.completed', get_defined_vars());
        }
    }

    public function cancelled(Request $req)
    {
        $list = Order::where('status', '1')
            ->with('listing', 'transaction')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('order_no', function($row) {
                    return "#".$row->order_no;
                })
                ->addColumn('buyer', function($row) {
                    return $row->transaction->user->name;
                })
                ->addColumn('product', function($row) {
                    return '<a href="'.route('listing', $row->listing->slug).'" target="_blank">'.Str::limit($row->listing->title, 20, '...').'</a>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.order.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'active']).'\', \'You want to mark this order as Active\')">Mark as Active</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'completed']).'\', \'You want to mark this order as Completed\')">Mark as Completed</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'review']).'\', \'You want to mark this order as In review\')">Mark as In review</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['product','status','action'])
                ->make(true);
        } else {
            return view('admin.orders.cancelled', get_defined_vars());
        }
    }
    public function review(Request $req)
    {
        $list = Order::where('status', '4')
            ->with('listing', 'transaction')
            ->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('order_no', function($row) {
                    return "#".$row->order_no;
                })
                ->addColumn('buyer', function($row) {
                    return $row->transaction->user->name;
                })
                ->addColumn('product', function($row) {
                    return '<a href="'.route('listing', $row->listing->slug).'" target="_blank">'.Str::limit($row->listing->title, 20, '...').'</a>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.order.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'active']).'\', \'You want to mark this order as Active\')">Mark as Active</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'completed']).'\', \'You want to mark this order as Completed\')">Mark as Completed</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.order.status.change', [$row->id, 'cancelled']).'\', \'You want to mark this order as Cancelled\')">Mark as Cancelled</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['product','status','action'])
                ->make(true);
        } else {
            return view('admin.orders.review', get_defined_vars());
        }
    }

    public function delete($id = null)
    {
        $order = Order::find($id)->delete();

        return redirect()->back()->with('success', 'Order Successfully Deleted!');
    }

    public function statusChange($id = null, $status = null)
    {
        $order = Order::find($id);

        if ($status == "active") {
            $order->status = "1";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Order Update!',
                'body' => 'Your order has been marked as Active by FreeShopps. Click to see',
                'action' => route('user.order', $order->order_no),
            ]);
            $notif_one = User::find($order->listing->user->id);
            $notif_two = User::find($order->transaction->user->id);

            $notif_one->notify(new UserNotification($data));
            $notif_two->notify(new UserNotification($data));

            $msg = "Order successfully sent into review";

        } else if ($status == "completed") {
            $order->status = "2";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Order Update!',
                'body' => 'Your order has been marked as Completed by FreeShopps. Click to see',
                'action' => route('user.order', $order->order_no),
            ]);
            $notif_one = User::find($order->listing->user->id);
            $notif_two = User::find($order->transaction->user->id);

            $notif_one->notify(new UserNotification($data));
            $notif_two->notify(new UserNotification($data));

            $msg = "Order successfully sent into published";

        } else if ($status == "cancelled") {
            $order->status = "3";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Order Update!',
                'body' => 'Your order has been marked as Cancelled by FreeShopps. Click to see',
                'action' => route('user.order', $order->order_no),
            ]);
            $notif_one = User::find($order->listing->user->id);
            $notif_two = User::find($order->transaction->user->id);

            $notif_one->notify(new UserNotification($data));
            $notif_two->notify(new UserNotification($data));

            $msg = "Order successfully sent into rejected";

        } else if ($status == "review") {
            $order->status = "4";

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Order Update!',
                'body' => 'Your order has been marked as Cancelled by FreeShopps. Click to see',
                'action' => route('user.order', $order->order_no),
            ]);
            $notif_one = User::find($order->listing->user->id);
            $notif_two = User::find($order->transaction->user->id);

            $notif_one->notify(new UserNotification($data));
            $notif_two->notify(new UserNotification($data));

            $msg = "Order successfully sent into rejected";

        }

        $order->save();

        return redirect()->back()->with('success', $msg);
    }
}
