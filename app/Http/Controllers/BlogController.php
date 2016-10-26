<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogContent;
use App\BlogRead;
use App\Dictionary;
use App\Dustbin;
use App\Keywords;
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
        // 查找数据字典数据
        $type = Dictionary::where('code', 'type')->first();
        $tag = Dictionary::where('code', 'tag')->first();
        $dists = Dictionary::where('parent_id', $type->id)->get();
        $tags = Dictionary::where('parent_id', $tag->id)->get();
        return view("blog.add")
            ->with('rtoken',$request->session()->get('rtoken'))
            // 前端页面需要数据字典中type类型数据
            ->with('dists',$dists)
            // 前端页面需要数据字典中所有标签数据
            ->with('keywords',$tags);
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
                -> with('msg',["type"=>"danger","content"=>"新增失败,表单已经过期!",'uri'=>"/blog/add"]);
        }
        $data = $request->all();
        //表单数据校验
        $validator = Validator::make($data,[
            'title' => 'required|max:64',
            'keywords' => 'required',
            'type' => 'required|numeric|max:10',
            'content' => 'required',
            'introduction' => 'required|max:255',
            'imgurl' => 'url'
        ]);
        if ($validator->fails()) {
            //校验失败,返回
            return redirect("/blog/add")->withErrors($validator)
                ->withInput();
        }
        $user = Auth::user();
        // 先存储内容
        $blogc = BlogContent::create([
            'content' => $data['content']
        ]);
        $blog = Blog::create([
            'title' => $data['title'],
            'introduction' => $data['introduction'],
            // 外键关联内容
            'cid' => $blogc->id,
            // 类型
            'type' => $data['type'],
            // 阅读量 初始化为0
            'amount' => 0,
            // 状态 0 草稿 1 发布  9 垃圾箱
            'statu' =>$data['statu'],
            // 大图地址 可空
            'imgurl' =>$data['imgurl'],
            'iszz' =>$data['iszz'],
            // 外键关联用户
            'author' =>$user->id,
        ]);
        // 关键词 多对多存储
        foreach($data['keywords'] as $value){
            Keywords::create([
                'bid' => $blog->id,
                'did' => $value,
                'type' => 0,
            ]);
        }
        //重新生成rtoken,防止表单重复提交
        $request->session()->put('rtoken',str_random(40));
        return view("blog.success")->with('msg',["type"=>"success","content"=>"文章《".$data['title']."》,新增成功!",'uri'=>"/blog/add"]);
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
        $blog ->statu = 9;
        $blog->save();
        return view("blog.success")->with('msg',["type"=>"success","content"=>"文章".$id.",移入垃圾箱!",'uri'=>"/blog/list"]);
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
        $blogc = $blog->blogContent;
        // 查找数据字典数据
        $type = Dictionary::where('code', 'type')->first();
        $tag = Dictionary::where('code', 'tag')->first();
        $dists = Dictionary::where('parent_id', $type->id)->get();
        $tags = Dictionary::where('parent_id', $tag->id)->get();
        $keywords = Keywords::where('bid',$blog->id)->get();
        $words = [];
        foreach ($keywords as $word){
            array_push($words,$word->did);
        }
        return view("blog.edit")
            -> with('blog',$blog)
            -> with('content',$blogc->content)
            -> with('rtoken',$request->session()->get('rtoken'))
            -> with('words',$words)
            // 前端页面需要数据字典中type类型数据
            -> with('dists',$dists)
            // 前端页面需要数据字典中所有标签数据
            -> with('keywords',$tags);
    }

    /**
     * 修改文章
     * @param $id
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request){
        //校验rtoken,防止表单重复提交
        if($request->input('rtoken') != $request->session()->get('rtoken')){
            return view("blog.success")
                -> with('msg',["type"=>"danger","content"=>"修改失败,表单已经过期!",'uri'=>"/blog/add"]);
        }
        $data = $request->all();
        //表单数据校验
        $validator = Validator::make($data,[
            'id' => 'required|numeric',
            'title' => 'required|max:64',
            'keywords' => 'required',
            'type' => 'required|numeric|max:10',
            'content' => 'required',
            'introduction' => 'required|max:255',
            'imgurl' => 'url'
        ]);
        if ($validator->fails()) {
            //校验失败,返回
            return redirect("/blog/edit/".$data['id'])
                ->withErrors($validator)
                ->withInput();
        }
        $blog = Blog::find($data['id']);
        // 根据一对一规则查询$blog内容
        $blogc =  $blog->blogContent;
        $blogc->content = $data['content'];
        // 存储修改后的blog内容;
        $blogc->save();
        $blog -> title = $data['title'];
        $blog -> type = $data['type'];
        $blog -> title = $data['title'];
        $blog -> introduction = $data['introduction'];
        $blog -> statu = $data['statu'];
        $blog -> imgurl = $data['imgurl'];
        $blog -> iszz = $data['iszz'];
        $blog -> save();
        // 先删除之前存储的 keywords 然后重新新增
        Keywords::where('bid',$blog->id)->delete();
        // 关键词 多对多存储
        foreach($data['keywords'] as $value){
            Keywords::create([
                'bid' => $blog->id,
                'did' => $value,
                'type' => 0,
            ]);
        }
        //重新生成rtoken,防止表单重复提交
        $request->session()->put('rtoken',str_random(40));
        return view("blog.success")
            ->with('msg',["type"=>"success","content"=>"文章《".$data['title']."》,修改成功!",'uri'=>"/blog/list"]);


    }

    public function view($id,Request $request)
    {
        $blog = Blog::find($id);
        $br = BlogRead::where('ip',$request->ip())->where('blogid',$id)->get();
        if(count($br) <= 0){
            BlogRead::create([
                'ip'=>$request->ip(),
                'blogid'=>$id,
            ]);
            $blog->amount = $blog->amount + 1;
            $blog->save();
        }
        $preBlog = Blog::where("id","<",$blog->id)
            ->where('statu',1)
            ->where('type',$blog->type)
            ->orderBy('id', 'desc')->first();
        $nextBlog = Blog::where("id",">",$blog->id)
            ->where('statu',1)
            ->where('type',$blog->type)
            ->orderBy('id', 'asc')->first();
        return view('view')
            -> with('blog',$blog)
            -> with('preBlog',$preBlog)
            -> with('nextBlog',$nextBlog);
    }
}
