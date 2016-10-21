@extends('layouts.app')

@section('content')
<form class="form-horizontal" role="form" method="get" action="{{ url('/blog/list') }}">
    <div class="row">
        <label for="title" class="col-md-2 control-label">标题</label>
        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ isset($title)?$title:"" }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">
                查询
            </button>
        </div>
    </div>
</form>
<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">文章列表</div>
    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tr>
                <th >id</th>
                <th >标题</th>
                <th >时间</th>
                <th >发布</th>
                <th >浏览量</th>
                <th >操作</th>
            </tr>
            @foreach($blogs as $blog)
            <tr>
                <td width="5%">{{$blog->id}}</td>
                <td width="40%">{{$blog->title}}</td>
                <td width="20%">{{$blog->created_at}}</td>
                <td width="5%">{{$blog->statu}}</td>
                <td width="10%">{{$blog->amount}}</td>
                <td width="25%">
                    <div class="btn-group btn-group-sm">
                    <a href="{{url("blog/view/".$blog->id)}}" class="btn btn-primary" style=""><span class="genericon genericon-search"></span></a>
                    <a href="{{url("blog/edit/".$blog->id)}}" class="btn btn-primary"><span class="genericon genericon-edit"></span></a>
                    <a href="{{url("blog/delete/".$blog->id)}}" class="btn btn-primary"><span class="genericon genericon-close"></span></a>
                    </div>
                </td>
            </tr>
            @endforeach

        </table>
        {{$blogs->fragment('foo')->links()}}
    </div>
</div>
@endsection
