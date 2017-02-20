<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class CommentController extends Controller
{
    //
    public function getCommentByBlog($id)
    {
        $comments = Blog::find($id)->comments()->take(10)->get();
        return ['comments'=>$comments];
    }

    public function create(Request $request,$id)
    {
        $data = $request->all();
        //表单数据校验
        $validator = Validator::make($data,[
            'name' => 'required|string|max:32',
            'email' => 'required|email|max:64',
            'content' => 'required|string|max:255'
        ],[],[
            'name' => '称呼',
            'email' => '邮箱',
            'content' => '评论内容'
        ]);
        if ($validator->fails()) {
            //校验失败,返回
            return ['success' => false,'msg' => $validator->errors()->first()];
        }
        Comment::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'content' => $data['content'],
            'bid' => $id,
            'ip' => $request->ip(),
        ]);
        return ['success' => true,'msg' => '评论成功!'];
    }


}
