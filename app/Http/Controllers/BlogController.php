<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Dustbin;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;

class BlogController extends Controller
{
    /**
     * 新增博客界面
     * @param Request $request
     * @return $this
     */
    public function toAdd(Request $request){
        //生成一串随机字符rtoken,防止表单重复提交
        $request->session()->put('rtoken',str_random(40));
        return view("blog.add")->with('rtoken',$request->session()->get('rtoken'));
    }

    /**
     * 新增博客
     * @param Request $request
     * @return $this
     */
    public function add(Request $request){
        //校验rtoken,防止表单重复提交
        if($request->input('rtoken') != $request->session()->get('rtoken')){
            return view("blog.success")
                -> with('msg',["type"=>"danger","content"=>"新增失败,表单已经过期!",'uri'=>"blog/add"]);
        }
        $data = $request->all();
        //表单数据校验
        $validator = Validator::make($data,[
            'title' => 'required|max:64',
            'keywords' => 'required|max:64',
            'type' => 'required|max:12',
            'content' => 'required',
            'introduction' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            //校验失败,返回
            return redirect("blog/add")->withErrors($validator)
                ->withInput();
        }
        $user = Auth::user();
        Blog::create([
            'title' => $data['title'],
            'keywords' => $data['keywords'],
            'introduction' => $data['introduction'],
            'content' =>  $data['content'],
            'mdcontent' =>  $data['mdcontent'],
            'type' => $data['type'],
            'amount' => 0 ,
            'statu' =>$data['statu'],
            'author' =>$user->name,
        ]);
        //重新生成rtoken,防止表单重复提交
        $request->session()->put('rtoken',str_random(40));
        return view("blog.success")->with('msg',["type"=>"success","content"=>"文章《".$data['title']."》,新增成功!",'uri'=>"blog/add"]);
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toList(Request $request){

        if(!$request->has('title')){
            $blogs = Blog::orderBy('created_at', 'desc')
                ->paginate(15);
            return view('blog.list')->with("blogs",$blogs);
        }
        $blogs = Blog::where('title','like','%'.$request->input('title').'%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('blog.list')->with("blogs",$blogs)->with('title',$request->input('title'));
    }

    /**
     * 根据id删除
     * @param $id
     * @return $this
     */
    public function deteleById($id)
    {   $blog = Blog::find($id);
        Dustbin::create(["content"=>$blog->content]);
        $blog->delete();
        return view("blog.success")->with('msg',["type"=>"success","content"=>"文章".$id.",删除成功!",'uri'=>"blog/list"]);
    }

    /**
     * 跳转修改文章视图
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function toEdit($id,Request $request)
    {
        $blog = Blog::find($id);
        $request->session()->put('rtoken',str_random(40));
        return view("blog.edit") -> with('blog',$blog) -> with('rtoken',$request->session()->get('rtoken'));
    }

    /**
     * 修改文章
     * @param $id
     * @param Request $request
     * @return $this
     */
    public function edit($id,Request $request){
        //校验rtoken,防止表单重复提交
        if($request->input('rtoken') != $request->session()->get('rtoken')){
            return view("blog.success")
                -> with('msg',["type"=>"danger","content"=>"修改失败,表单已经过期!",'uri'=>"blog/add"]);
        }
        $data = $request->all();
        //表单数据校验
        $validator = Validator::make($data,[
            'title' => 'required|max:64',
            'keywords' => 'required|max:64',
            'type' => 'required|max:12',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            //校验失败,返回
            return view("blog.edit")
                ->withErrors($validator);
        }
        $blog = Blog::find($id);
        $blog -> title = $data['title'];
        $blog -> keywords = $data['keywords'];
        $blog -> content = $data['content'];
        $blog -> type = $data['type'];
        $blog -> title = $data['title'];
        $blog -> introduction = $data['introduction'];
        $blog -> statu = $data['statu'];
        $blog -> save();
        //重新生成rtoken,防止表单重复提交
        $request->session()->put('rtoken',str_random(40));
        return view("blog.success")
            ->with('msg',["type"=>"success","content"=>"文章《".$data['title']."》,修改成功!",'uri'=>"blog/list"]);


    }}
