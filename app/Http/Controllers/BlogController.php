<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    //
    public function toAdd(Request $request){
        return view("blog.addblog");
    }

    public function add(Request $request){
        return view("blog.addblog");
    }
}
