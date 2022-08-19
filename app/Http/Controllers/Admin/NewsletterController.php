<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetter;

class NewsletterController extends Controller
{
    public function list()
    {
        $list = NewsLetter::orderBy('id','DESC')->get();
        return view('admin.newsletter.list', get_defined_vars());
    }
    public function delete($id = null)
    {
        $list = NewsLetter::find($id);
        $list->delete();
        return redirect()->back();
    }
}
