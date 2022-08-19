<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Str;

class StoreController extends Controller
{
    public function all(Request $req)
    {
        $list = Store::with('user', 'store_schedules')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('logo', function($row) {
                    if (is_null($row->logo)) {
                        return '<img src="'.asset('logo.png').'" class="img-fluid" width="60px" alt="">';
                    } else {
                        return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                    }
                })
                ->addColumn('name', function($row) {
                    return '<a target="_blank" href="'.route('store', $row->slug).'">'.Str::limit($row->name, 20, '...').'</a>';
                })
                ->addColumn('owner', function($row) {
                    return $row->user->name;
                })
                ->addColumn('status', function($row) {
                    if ($row->status == "1") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Active</span>';
                    } else {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Disabled</span>';
                    }
                    return $statusCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('store', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.store.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.store.status.change', [$row->id, 'active']).'\', \'You want to mark this store as Active\')">Mark as Active</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.store.status.change', [$row->id, 'disabled']).'\', \'You want to mark this store as Disabled\')">Mark as Disabled</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','name','logo','status','action'])
                ->make(true);
        } else {
            return view('admin.store.all', get_defined_vars());
        }
    }

    public function active(Request $req)
    {
        $list = Store::whereStatus(true)->with('user', 'store_schedules')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('logo', function($row) {
                    if (is_null($row->logo)) {
                        return '<img src="'.asset('logo.png').'" class="img-fluid" width="60px" alt="">';
                    } else {
                        return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                    }
                })
                ->addColumn('name', function($row) {
                    return '<a target="_blank" href="'.route('store', $row->slug).'">'.Str::limit($row->name, 20, '...').'</a>';
                })
                ->addColumn('owner', function($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('store', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.store.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.store.status.change', [$row->id, 'disabled']).'\', \'You want to mark this store as Disabled\')">Mark as Disabled</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','name','logo','action'])
                ->make(true);
        } else {
            return view('admin.store.active', get_defined_vars());
        }
    }

    public function disabled(Request $req)
    {
        $list = Store::whereStatus(false)->with('user', 'store_schedules')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('logo', function($row) {
                    if (is_null($row->logo)) {
                        return '<img src="'.asset('logo.png').'" class="img-fluid" width="60px" alt="">';
                    } else {
                        return '<img src="'.asset($row->featured_image).'" class="img-fluid" width="60px" alt="">';
                    }
                })
                ->addColumn('name', function($row) {
                    return '<a target="_blank" href="'.route('store', $row->slug).'">'.Str::limit($row->name, 20, '...').'</a>';
                })
                ->addColumn('owner', function($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a target="_blank" href="'.route('store', $row->slug).'"><i class="fas fa-eye text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.store.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.store.status.change', [$row->id, 'active']).'\', \'You want to mark this store as Active\')">Mark as Active</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','name','logo','action'])
                ->make(true);
        } else {
            return view('admin.store.disabled', get_defined_vars());
        }
    }

    public function delete($id = null)
    {
        $store = Store::find($id)->delete();

        return redirect()->back()->with('success', 'Store Successfully Deleted!');
    }

    public function statusChange($id = null, $status = null)
    {
        $store = Store::find($id);

        if ($status == "active") {
            $store->status = 1;

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'Good News!',
                'body' => 'Your store is marked as Active. Click to see',
                'action' => route('user.store'),
            ]);
            $notif = User::find($store->user_id);
            $notif->notify(new UserNotification($data));

            $msg = "Store successfully sent into Active";

        } else if ($status == "disabled") {
            $store->status = 0;

            $data = collect([
                'icon' => asset('bell-icon.jpg'),
                'title' => 'News about Store!',
                'body' => 'Your store is marked as disabled by FreeShopps. Click to see',
                'action' => route('user.store'),
            ]);
            $notif = User::find($store->user_id);
            $notif->notify(new UserNotification($data));

            $msg = "Store successfully sent into disabled";

        }

        $store->save();

        return redirect()->back()->with('success', $msg);
    }
}
