<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Dictionary;
use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{
    /**
     * 主页,接收str并进行筛选
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $type = Dictionary::where('code', 'type')->first();
        $dists = Dictionary::where('parent_id', $type->id)->get();
        if (!$request->has('str')) {
            $blogs = Blog::orderBy('created_at', 'desc')
                ->paginate(15);
            return view('welcome')
                ->with("blogs", $blogs)
                ->with('dists', $dists);
        }
        $blogs = Blog::where('title', 'like', '%' . $request->input('str') . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('welcome')
            ->with("blogs", $blogs)
            ->with('str', $request->input('str'))
            ->with('dists', $dists);
    }

    /**
     * 跳转页面  type = 1
     * @param Request $request
     * @return $this
     */
    public function type($id, Request $request)
    {
        $type = Dictionary::where('code', 'type')->first();
        $dists = Dictionary::where('parent_id', $type->id)->get();
        if (!$request->has('str')) {
            $blogs = Blog::orderBy('created_at', 'desc')
                ->where('type', $id)
                ->paginate(15);
            return view('welcome')
                ->with("blogs", $blogs)
                ->with('dists', $dists);
        }
        $blogs = Blog::where('title', 'like', '%' . $request->input('str') . '%')
            ->where('type', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('welcome')
            ->with("blogs", $blogs)
            ->with('str', $request->input('str'))
            ->with('dists', $dists);
    }
}