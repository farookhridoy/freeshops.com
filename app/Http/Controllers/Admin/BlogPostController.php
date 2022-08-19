<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Carbon\Carbon;
use DataTables;
use User;
use Str;

class BlogPostController extends Controller
{
    public function all(Request $req)
    {
        $list = BlogPost::with('blog_category', 'user')->orderBy('created_at', 'DESC')->get();
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
                    return '<a href="">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('category', function($row) {
                    return $row->blog_category->name;
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('status', function($row) {
                    if ($row->status == "1") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-primary cursor-pointer">In review</span>';
                    } else if ($row->status == "2") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-dark cursor-pointer">Draft</span>';
                    } else if ($row->status == "3") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer">Published</span>';
                    } else if ($row->status == "4") {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer">Rejected</span>';
                    }
                    return $statusCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="'.route('admin.post.edit', $row->id).'"><i class="fas fa-edit text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.post.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'review']).'\', \'You want to mark this post as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'draft']).'\', \'You want to mark this post as in Review\')">Mark as In Draft</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'published']).'\', \'You want to mark this post as Published\')">Mark as Published</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'rejected']).'\', \'You want to mark this post as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','image','title','status','action'])
                ->make(true);
        } else {
            return view('admin.posts.all', get_defined_vars());
        }
    }

    public function inReview(Request $req)
    {
        $list = BlogPost::where('status', '1')->with('blog_category', 'user')->orderBy('created_at', 'DESC')->get();
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
                    return '<a href="">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('category', function($row) {
                    return $row->blog_category->name;
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="'.route('admin.post.edit', $row->id).'"><i class="fas fa-edit text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.post.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'draft']).'\', \'You want to mark this post as in Review\')">Mark as In Draft</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'published']).'\', \'You want to mark this post as Published\')">Mark as Published</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'rejected']).'\', \'You want to mark this post as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','image','title','action'])
                ->make(true);
        } else {
            return view('admin.posts.in_review', get_defined_vars());
        }
    }

    public function draft(Request $req)
    {
        $list = BlogPost::where('status', '2')->with('blog_category', 'user')->orderBy('created_at', 'DESC')->get();
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
                    return '<a href="">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('category', function($row) {
                    return $row->blog_category->name;
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="'.route('admin.post.edit', $row->id).'"><i class="fas fa-edit text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.post.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'review']).'\', \'You want to mark this post as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'published']).'\', \'You want to mark this post as Published\')">Mark as Published</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'rejected']).'\', \'You want to mark this post as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','image','title','action'])
                ->make(true);
        } else {
            return view('admin.posts.draft', get_defined_vars());
        }
    }

    public function published(Request $req)
    {
        $list = BlogPost::where('status', '3')->with('blog_category', 'user')->orderBy('created_at', 'DESC')->get();
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
                    return '<a href="">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('category', function($row) {
                    return $row->blog_category->name;
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="'.route('admin.post.edit', $row->id).'"><i class="fas fa-edit text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.post.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'review']).'\', \'You want to mark this post as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'draft']).'\', \'You want to mark this post as in Review\')">Mark as In Draft</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'rejected']).'\', \'You want to mark this post as in Rejected\')">Mark as Rejected</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','image','title','action'])
                ->make(true);
        } else {
            return view('admin.posts.published', get_defined_vars());
        }
    }

    public function rejected(Request $req)
    {
        $list = BlogPost::where('status', '4')->with('blog_category', 'user')->orderBy('created_at', 'DESC')->get();
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
                    return '<a href="">'.Str::limit($row->title, 20, '...').'</a>';
                })
                ->addColumn('category', function($row) {
                    return $row->blog_category->name;
                })
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="'.route('admin.post.edit', $row->id).'"><i class="fas fa-edit text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.post.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                        <a href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-info font-16"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'review']).'\', \'You want to mark this post as in Review\')">Mark as In Review</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'draft']).'\', \'You want to mark this post as in Review\')">Mark as In Draft</a>
                            <a class="dropdown-item" href="#!" onclick="alertMessage(\''.route('admin.post.status.change', [$row->id, 'published']).'\', \'You want to mark this post as Published\')">Mark as Published</a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','image','title','action'])
                ->make(true);
        } else {
            return view('admin.posts.rejected', get_defined_vars());
        }
    }

    public function add()
    {
        $categories = BlogCategory::whereStatus(true)->orderBy('name', 'asc')->get();

        return view('admin.posts.add', get_defined_vars());
    }

    public function edit($id = null)
    {
        $post = BlogPost::find($id);
        $categories = BlogCategory::whereStatus(true)->orderBy('name', 'asc')->get();

        return view('admin.posts.edit', get_defined_vars());
    }

    public function save(Request $req, $id = null)
    {
        $req->validate([
            'title' => 'required',
            'slug' => 'required',
            'blog_category_id' => 'required',
            'body' => 'required',
            'tags' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        $user = auth()->user();

        if (is_null($id)) {
            $req->validate([
                'featured_image' => 'required',
            ]);

            $post = new BlogPost();

            $msg = "Blog Post added successfully!";
        } else {
            $post = BlogPost::find($id);

            $msg = "Blog Post update successfully!";
        }
        $post->blog_category_id = $req->blog_category_id;
        $post->user_id = $user->id;
        if ($req->featured_image) {
            $image = $req->featured_image;
            $path = "blogs/".Str::slug($req->title);
            $filename = 'featured-'.Str::random(8).'.'.$image->getClientOriginalExtension();

            $image->move($path, $filename);

            $post->featured_image = $path.'/'.$filename;
        }
        $post->title = $req->title;
        $post->slug = $req->slug;
        $post->body = $req->body;
        if ($req->action == "publish") {
            $post->status = "3";
        }
        if ($req->action == "draft") {
            $post->status = "2";
        }
        $post->meta_title = $req->meta_title;
        $post->meta_keywords = $req->meta_keywords;
        $post->meta_description = $req->meta_description;
        $post->save();

        if ($post) {
            $post->blog_tags()->delete();

            $tags = explode(',' , $req->tags);

            foreach ($tags as $value) {
                $tag = new BlogTag();
                $tag->blog_post_id = $post->id;
                $tag->name = $value;
                $tag->save();
            }
        }

        return redirect()->route('admin.post.all')->with('success', $msg);
    }

    public function delete($id = null)
    {
        $blog_post = BlogPost::find($id)->delete();

        return redirect()->route('admin.post.list')->with('success', 'Blog Post Successfully Deleted!');
    }

    public function statusChange($id = null, $status = null)
    {
        $blog_post = BlogPost::find($id);

        if ($status == "review") {
            $blog_post->status = "1";

            // $data = collect([
            //     'icon' => asset('bell-icon.jpg'),
            //     'title' => 'News about Listing!',
            //     'body' => 'Your listing is in under review. Click to see',
            //     'action' => route('user.listings'),
            // ]);
            // $notif = User::find($listing->user->id);
            // $notif->notify(new UserNotification($data));

            $msg = "Blog Post successfully sent into review";

        } else if ($status == "draft") {
            $blog_post->status = "2";

            // $data = collect([
            //     'icon' => asset('bell-icon.jpg'),
            //     'title' => 'News about Listing!',
            //     'body' => 'CONGRATULATIONS! Your listing is published now. Click to see',
            //     'action' => route('user.listings'),
            // ]);
            // $notif = User::find($listing->user->id);
            // $notif->notify(new UserNotification($data));

            $msg = "Blog Post successfully sent into published";

        } else if ($status == "published") {
            $blog_post->status = "3";

            // $data = collect([
            //     'icon' => asset('bell-icon.jpg'),
            //     'title' => 'News about Listing!',
            //     'body' => 'CONGRATULATIONS! Your listing is published now. Click to see',
            //     'action' => route('user.listings'),
            // ]);
            // $notif = User::find($listing->user->id);
            // $notif->notify(new UserNotification($data));

            $msg = "Blog Post successfully sent into published";

        } else if ($status == "rejected") {
            $blog_post->status = "4";

            // $data = collect([
            //     'icon' => asset('bell-icon.jpg'),
            //     'title' => 'News about Listing!',
            //     'body' => 'OOPS! Your listing is rejected by our system. Please review again',
            //     'action' => route('user.listings'),
            // ]);
            // $notif = User::find($listing->user->id);
            // $notif->notify(new UserNotification($data));

            $msg = "Blog Post successfully sent into rejected";

        }

        $blog_post->save();

        return redirect()->back()->with('success', $msg);
    }
}
