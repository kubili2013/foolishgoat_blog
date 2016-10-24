<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Dictionary;
use App\User;
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
        if (!$request->has('str')) {
            $blogs = Blog::orderBy('created_at', 'desc')
                ->where('statu',1)
                ->paginate(10);
            return view('welcome')
                ->with("blogs", $blogs);
        }
        $blogs = Blog::where('title', 'like', '%' . $request->input('str') . '%')
            ->where('statu',1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('welcome')
            ->with("blogs", $blogs)
            ->with('str', $request->input('str'));
    }

    /**
     * 跳转页面  type = 1
     * @param Request $request
     * @return $this
     */
    public function type($id, Request $request)
    {
        if (!$request->has('str')) {
            $blogs = Blog::orderBy('created_at', 'desc')
                ->where('statu',1)
                ->where('type', $id)
                ->paginate(10);
            return view('welcome')
                ->with("blogs", $blogs);
        }
        $blogs = Blog::where('title', 'like', '%' . $request->input('str') . '%')
            ->where('statu',1)
            ->where('type', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('welcome')
            ->with("blogs", $blogs)
            ->with('str', $request->input('str'));
    }

    public function getAuthor($id, Request $request){
        $user = User::find($id);
        return ['username' => $user->name];

    }
}