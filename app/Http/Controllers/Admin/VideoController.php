<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoGallery;
use DataTables;
use Str;

class VideoController extends Controller
{

    public function list(Request $req)
    {
        $list = videoGallery::orderBy('id', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('status', function($row) {
                    if($row->status){
                        $status = '<a href="'.route('admin.gallery.status',$row->id).'"><span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Active</span></a>';
                    }
                    else {
                        $status = '<a href="'.route('admin.gallery.status',$row->id).'"><span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Disabled</span></a>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.gallery.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="'.route('admin.gallery.edit', $row->id).'" class="border-0 bg-transparent"><i class="fas fa-edit text-success font-16"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        } else {
            return view('admin.gallery.list', get_defined_vars());
        }
    }

    public function add()
    {
        return view('admin.gallery.add', get_defined_vars());
    }
    public function edit($id = null)
    {
        $list = videoGallery::find($id);
        return view('admin.gallery.edit', get_defined_vars());
    }
    public function delete($id = null)
    {
        $list = videoGallery::find($id);
        $list->delete();
        return view('admin.gallery.list', get_defined_vars());
    }

    public function save(Request $req, $id = null)
    {
        if(is_null($id)){
            $list = new videoGallery;
            $msg = 'Video saved successfully';
        }
        else{
            $list = videoGallery::find($id);
            $msg = 'Video updated successfully';
        }
        $list->name = $req->name;
        $list->slug = Str::slug($req->name);
        if($req->video){
            $list->video = uploadFile($req->video,'uploads/gallery');
        }
        $list->save();
        return redirect()->route('admin.gallery.list')->with('success',$msg);
    }

    public function status($id = null)
    {
        $list = videoGallery::find($id);
        if($list->status){
            $list->status = 0;
        }else{
            $list->status = 1;
        }
        $list->save();
        return redirect()->back()->with('success','Status is successfully changed!');
    }
}
