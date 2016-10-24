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

    @foreach($blogs as $blog)
        <article  class="article">
            <header class="">
                <h2 class="">
                    <a href="{{url('/'+$blog['id'])}}" rel="bookmark">{{$blog['title']}}</a>
                </h2>
            </header><!-- .entry-header -->

            <div class="article-content">
                <p>{{$blog['introduction']}}</p>
                <p>
                    <a href="#" class="">继续阅读</a>
                </p>
            </div><!-- .entry-content -->

            <footer class="">
            <span class="">
                <span class="genericon genericon-day"></span>

                <time class="entry-date published" datetime="{{$blog['created_at']}}">{{substr($blog['created_at'],0,10)}}</time>

            </span>
                <span class="">
                <span class="author vcard">
                    <span class="genericon genericon-user"></span>
                    <a class="url fn n" href="http://foolishgoat.com/author">{{$blog['author']}}</a>
                </span>
            </span>
                <span class="">
                <span class="genericon genericon-tag"></span>
                <a href="http://foolishgoat.com/category/technology/" rel="category tag">{{$blog['keywords']}}</a>
            </span>
                <span class="">
                <span class="genericon genericon-star"></span>
                <span>{{$blog['amount']}}</span>
            </span>
            </footer><!-- .entry-footer -->

        </article>
    @endforeach
    <div class="page-switch clearfloat">
        <div class="nextpage"><a href="{{$blogs->nextPageUrl()}}">下一页<span class="genericon genericon-rightarrow"></span></a></div>
        <div class="prepage"><a href="{{$blogs->previousPageUrl()}}"><span class="genericon genericon-leftarrow"></span>上一页</a></div>
    </div>
    <footer class="footer" style="background:#fff;padding:2.5454% 9.0909%;">
        <span>
            <a href="http://www.miitbeian.gov.cn/" rel="nofollow" title="工业和信息化部ICP/IP地址/域名信息备案管理系统">粤ICP备16055652-2</a>
        </span>

        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/">&nbsp;<span style="line-height:16px;">蠢羊小站</span></a>
        </span>
    </footer><!-- .entry-footer -->
</div>
@endsection