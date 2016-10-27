@extends('layouts.index')

@section('content')
<div class="content">
    <footer class="footer clearfloat">
        <div class="fieldcontainer">
            <form action="{{url('/')}}" method="get">
                <input type="text" name="str" id="str" class="searchfield" placeholder="Keywords..." value="{{ isset($str)?$str:"" }}" tabindex="1">
                <button class="searchbtn" type="submit"><span class="genericon genericon-search"></span></button>
            </form>
        </div>
    </footer>
    @if(isset($preBlog))
        <div class="page-switch">
            <a href="{{url('/view/'.$preBlog->id)}}">上一篇:{{ $preBlog->title}}</a>
        </div>
    @endif
    <div class="artical-body" >
        <div class="markdown-preview" >
            {!! $blog->blogContent->content !!}
        </div>
        <footer class="">
            <span class="">
                <span class="genericon genericon-day"></span>

                <time class="entry-date published" datetime="{{$blog['created_at']}}">{{substr($blog['created_at'],0,10)}}</time>

            </span>
            <span class="">
                <span class="author vcard">
                    <span class="genericon genericon-user"></span>
                    <a class="url fn n" href="/author"><?php $user = \App\User::find($blog['author']); echo $user->name?></a>
                </span>
            </span>
            <span class="">
                <span class="genericon genericon-tag"></span>
                <a href="type/<?php $type = \App\Dictionary::find($blog['type']); echo $type->id; ?>" rel="category tag"><?php echo $type->word; ?></a>
            </span>
            <span class="">
                <span class="genericon genericon-star"></span>
                <span>{{$blog['amount']}}</span>
            </span>
        </footer>
    </div>
    @if(isset($nextBlog))
        <div class="page-switch">
            <a href="{{url('/view/'.$nextBlog->id)}}">下一篇:{{$nextBlog->title}}</a>
        </div>
    @endif

    <footer class="footer">
        <span>
            <a href="http://www.miitbeian.gov.cn/" rel="nofollow" title="工业和信息化部ICP/IP地址/域名信息备案管理系统">粤ICP备16055652-2</a>
        </span>

        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/">&nbsp;<span style="line-height:16px;">蠢羊小站</span></a>
        </span>
    </footer> <!-- .entry-footer -->
</div>
@endsection