<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Dictionary;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function build(){
        $type = Dictionary::where('code', 'type')->first();
        $dists = Dictionary::where('parent_id', $type->id)->get();
        $blogs = Blog::orderBy('created_at', 'desc')
            ->where('statu',1)
            ->paginate(15);
        $contents =  view('welcome')
            ->with("blogs", $blogs)
            ->with('dists', $dists)
            ->__toString();
        //要创建的两个文件
        $TxtFileName = "index.html";
        //以读写方式打写指定文件，如果文件不存则创建
        if( ($TxtRes=fopen($TxtFileName,"w")) === FALSE){
            return view("blog.success")
                ->with('msg',["type"=>"error","content"=>"创建index.html失败!",'uri'=>"/home"]);
        }
        if(!fwrite ($TxtRes,$contents)){ //将信息写入文件
            fclose($TxtRes);
            return view("blog.success")
                ->with('msg',["type"=>"error","content"=>"写入index.html失败!",'uri'=>"/home"]);
        }
        fclose ($TxtRes); //关闭指针
        return view("blog.success")
            ->with('msg',["type"=>"success","content"=>"index.html生成成功!",'uri'=>"/home"]);
    }
}
