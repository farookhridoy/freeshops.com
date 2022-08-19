<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactController extends Controller
{
    public function list()
    {
        $list = ContactUs::orderBy('id','DESC')->paginate(30);
         
        return view('admin.contact_queries.list', compact('list'));
    }
    public function delete($id = null)
    {
        $list = ContactUs::find($id);
        $list->delete();
        return redirect()->back();
    }

    public function view(Request $req, $id = null)
    {
        $contact = ContactUs::find($id);
        //dd($contact);
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('admin.contact_queries.view', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }
}
