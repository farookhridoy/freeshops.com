<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Carbon\Carbon;
use DataTables;
use User;
use Str;

class BlogCommentController extends Controller
{
    public function all(Request $req)
    {
        $list = BlogComment::with('blog_post')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('comment', function($row) {
                    return $row->comment;
                })
                ->addColumn('blog', function($row) {
                    return '<a href="">'.Str::limit($row->blog_post->title, 20, '...').'</a>';
                })
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('email', function($row) {
                    return $row->email;
                })
                ->addColumn('status', function($row) {
                    if ($row->status == 1) {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Active</span>';
                    } else {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Hidden</span>';
                    }
                    return $statusCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.comment.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.comment.status.change', [$row->id, 'active']).'\', \'You want to mark this post as Active\')">Mark as Active</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.comment.status.change', [$row->id, 'hidden']).'\', \'You want to mark this post as Hidden\')">Mark as Hidden</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['blog','status','action'])
                ->make(true);
        } else {
            return view('admin.comments.all', get_defined_vars());
        }
    }

    public function active(Request $req)
    {
        $list = BlogComment::whereStatus(true)->with('blog_post')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('comment', function($row) {
                    return $row->comment;
                })
                ->addColumn('blog', function($row) {
                    return '<a href="">'.Str::limit($row->blog_post->title, 20, '...').'</a>';
                })
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('email', function($row) {
                    return $row->email;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.comment.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.comment.status.change', [$row->id, 'hidden']).'\', \'You want to mark this post as Hidden\')">Mark as Hidden</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['blog','action'])
                ->make(true);
        } else {
            return view('admin.comments.active', get_defined_vars());
        }
    }

    public function hidden(Request $req)
    {
        $list = BlogComment::whereStatus(false)->with('blog_post')->orderBy('created_at', 'DESC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('comment', function($row) {
                    return $row->comment;
                })
                ->addColumn('blog', function($row) {
                    return '<a href="">'.Str::limit($row->blog_post->title, 20, '...').'</a>';
                })
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('email', function($row) {
                    return $row->email;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.comment.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.comment.status.change', [$row->id, 'hidden']).'\', \'You want to mark this post as Hidden\')">Mark as Hidden</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['blog','action'])
                ->make(true);
        } else {
            return view('admin.comments.hidden', get_defined_vars());
        }
    }

    public function delete($id = null)
    {
        $blog_comment = BlogComment::find($id)->delete();

        return redirect()->route('admin.comment.list')->with('success', 'Blog Comment Successfully Deleted!');
    }

    public function statusChange($id = null, $status = null)
    {
        $blog_comment = BlogComment::find($id);

        if ($status == "active") {
            $blog_comment->status = 1;

            // $data = collect([
            //     'icon' => asset('bell-icon.jpg'),
            //     'title' => 'News about Listing!',
            //     'body' => 'Your listing is in under review. Click to see',
            //     'action' => route('user.listings'),
            // ]);
            // $notif = User::find($listing->user->id);
            // $notif->notify(new UserNotification($data));

            $msg = "Blog Comment successfully sent into active";

        } else if ($status == "hidden") {
            $blog_comment->status = 2;

            // $data = collect([
            //     'icon' => asset('bell-icon.jpg'),
            //     'title' => 'News about Listing!',
            //     'body' => 'CONGRATULATIONS! Your listing is published now. Click to see',
            //     'action' => route('user.listings'),
            // ]);
            // $notif = User::find($listing->user->id);
            // $notif->notify(new UserNotification($data));

            $msg = "Blog Comment successfully sent into hidden";

        }

        $blog_comment->save();

        return redirect()->back()->with('success', $msg);
    }
}
