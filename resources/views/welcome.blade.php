@extends('layouts.index')

@section('content')

    @if(count($blogs) < 1)
        <article  class="article">
            <header class="">
                <h2 style="text-align: center;">
                    （*+﹏+*）!! <br/>暂时没有啥可看的!<br/><br/>
                </h2>
            </header>
        </article>
    @endif
    @foreach($blogs as $blog)
        <article  class="article">
            @if(isset($blog['imgurl']) && $blog['imgurl'] != "")
                <div class="blog-img">
                    <img  src="{{$blog['imgurl']}}">
                </div>
            @endif
            <header class="">
                <h2 class="">
                    <a href="{{url('/view/'.$blog['id'])}}" rel="bookmark">{{$blog['title']}}</a>
                </h2>
            </header><!-- .entry-header -->

            <div class="article-content">
                <p style="padding:10px 5px;">{!! $blog['introduction'] !!}</p>
                <p>
                    <a href="{{url('/view/'.$blog['id'])}}" class="">继续阅读</a>
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
                    <span><?php $user = \App\User::find($blog['author']); echo $user->name?></span>
                </span>
            </span>
                <span class="">
                <span class="genericon genericon-tag"></span>
                <a href="/type/<?php $type = \App\Dictionary::find($blog['type']); echo $type->id; ?>" rel="category tag"><?php echo $type->word; ?></a>
            </span>
                <span class="">
                <span class="genericon genericon-star"></span>
                <span>{{$blog['amount']}}</span>
            </span>
            </footer><!-- .entry-footer -->

        </article>
    @endforeach
    <div class="page-switch clearfloat">
        @if($blogs->nextPageUrl() != "")
            <div class="nextpage"><a href="{{$blogs->nextPageUrl()}}">下一页<span class="genericon genericon-rightarrow"></span></a></div>
        @else
            @if($blogs->previousPageUrl() != "")
            <div class="nextpage">(‧_‧？) </div>
            @endif
        @endif
        @if($blogs->previousPageUrl() != "")
            <div class="prepage"><a href="{{$blogs->previousPageUrl()}}"><span class="genericon genericon-leftarrow"></span>上一页</a></div>
        @else
            @if($blogs->nextPageUrl() != "")
                <div class="prepage">(‧_‧？) </div>
            @endif
        @endif
    </div>

<script type="application/javascript">
    $(function(){
        // 将所有md文本转化为body
        var converter = new showdown.Converter();
        // 设置为github解析方式
        converter.setFlavor('github');
        $('.markdown-body').each(function(i, block) {
            $(this).html(converter.makeHtml($(this).html()));
        });
    });
</script>
@endsection