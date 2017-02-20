<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php
    $type = \App\Dictionary::where('code', 'type')->first();
    $dists = \App\Dictionary::where('parent_id', $type->id)->get();
    ?>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.ico" />
    <title>{{$blog['title']}}</title>
    <meta name="Keywords" content="{{$blog['keywords']}}"><meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/genericons.css">
    <link rel="stylesheet" href="/css/logo.css">
    {{--<link rel="stylesheet" href="/css/code.css">--}}
<!-- markdown-css -->
    <link rel="stylesheet" href="/css/github-markdown.css">
    <!-- highlight-code-theme -->
    {{--<link rel="alternate stylesheet" title="-Default" href="css/highlight/default.css">--}}
    {{--<link rel="stylesheet" title="Default" href="/css/highlight/dark.css">--}}
    {{--<link rel="alternate stylesheet" title="FAR" href="/css/highlight/far.css">--}}
    {{--<link rel="alternate stylesheet" title="IDEA" href="/css/highlight/idea.css">--}}
    {{--<link rel="alternate stylesheet" title="Sunburst" href="/css/highlight/sunburst.css">--}}
    <link rel="stylesheet" title="Default" href="/css/highlight/zenburn.css">
    {{--<link rel="alternate stylesheet" title="Visual Studio" href="/css/highlight/vs.css">--}}
    {{--<link rel="alternate stylesheet" title="Ascetic" href="/css/highlight/ascetic.css">--}}
    {{--<link rel="stylesheet" title="Default" href="/css/highlight/magula.css">--}}
    {{--<link rel="stylesheet" title="Default" href="/css/highlight/github.css">--}}
    {{--<link rel="stylesheet" title="Default" href="/css/highlight/brown_paper.css">--}}
    {{--<link rel="stylesheet" title="Default" href="/css/highlight/school_book.css">--}}
    {{--<link rel="stylesheet" title="Default" href="/css/highlight/ir_black.css">--}}
    <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- markdown-to-html js (showdown.js)-->
    <script src="/js/showdown.min.js"></script>
    <!-- highlight.js -->
    <script src="/js/highlight.pack.js"></script>
    <script src="/js/index.js"></script>
</head>
<body onmousemove="removeLogoEyes(event);">
<div class="sidebar clearfloat">
    <header class="header"><div id="logo"  class="logo morph">
            <div id="left_horn" class="left-horn" ></div>
            <div id="right_horn" class="right-horn" ></div>
            <div id="head" class="head" ></div>
            <div id="face" class="face" ></div>
            <div id="left_glass" class="left-glass" ></div>
            <div id="right_glass" class="right-glass" ></div>
            <div id="left_eye" class="left-eye" ></div>
            <div id="right_eye" class="right-eye" ></div>
            <div id="left_nostril" class="left-nostril" ></div>
            <div id="right_nostril" class="right-nostril" ></div>
            <div style="clear:both"></div>
        </div>
        <div CLASS="site-name"><h2>蠢羊小站</h2><h4>匠心的博客</h4></div>
        <button class="nav-btn" onclick="menuCollspan();"><span class="genericon genericon-menu"></span></button>
    </header>
    <nav class="menu" id="menu">
        <ul>
            <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="/" >主页</a></li>
            @foreach($dists as $dist)
                <li class="{{ Request::path() == 'type/'.$dist->id ? 'active' : '' }}"><a href="{{url('/type/'.$dist->id)}}" >{{$dist->word}}</a></li>
            @endforeach
        </ul>
    </nav>
</div>
<div class="container">

    <div class="content">
        <footer class="footer clearfloat" style="height:4.0rem;">
            <div class="fieldcontainer">
                <form action="{{url('/')}}" method="get">
                    <input type="text" name="str" id="str" class="searchfield" placeholder="Keywords..." value="{{ isset($str)?$str:"" }}" tabindex="1" style="max-width:100%;">
                    <button class="searchbtn" type="submit" style="width:4.0rem;height:4.0rem;border-left:2px solid #dddddd;font-size:1.0rem;color:#eee;float:right;z-index:99;position: relative;bottom:4.0rem;right:0rem;"
                    ><span class="genericon genericon-search"></span></button>
                </form>
            </div>
        </footer>
        @if(isset($preBlog))
            <div class="page-switch">
                <a href="{{url('/view/'.$preBlog->id)}}">上一篇:{{ $preBlog->title}}</a>
            </div>
        @endif
        <div class="artical-body">
            <div class="markdown-body" id="blog_content" >
            </div>
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
            </footer>
        </div>
        @if(isset($nextBlog))
            <div class="page-switch">
                <a href="{{url('/view/'.$nextBlog->id)}}">下一篇:{{$nextBlog->title}}</a>
            </div>
        @endif

        <footer class="footer" style="padding:2.5454% 9.0909%;">
            <p style="font-size: 1.5rem;">评论列表</p>
            <div class="comment-list" id="comment_list">
                <hr/>
                <h4>无</h4>
                <div class="comment-item">
                    <div class="avatar"></div>
                    <div class="item-detail">
                        <div><p>李洪彬</p></div>
                        <div><p>1楼  &middot;  2010-07-01</p></div>
                        <div class="comment-line"></div>
                    </div>
                    <div class="item-content"><p>嘿嘿,不错吆</p></div>
                </div>
                <hr/>

            </div>
            <div>
                <form action="{{url('/add/comment/'.$blog['id'])}}" method="get"  style="height:16.0rem;" id="comment_form">
                    <div id="msg" style="display: none"></div>
                    <input type="text" name="name" class="searchfield"  placeholder="怎么称呼" style="max-width:100%;"><br/>
                    <input type="text" name="email" class="searchfield"  placeholder="您的邮箱,方便联系,不会对外显示。" style="border-top:2px solid #dddddd;max-width:100%;"><br/>
                    <textarea name="content" class="searchfield" placeholder="评论内容" style="border-top:2px solid #dddddd;max-width:100%;height:8.0rem;"></textarea>
                    <button type="submit" class="searchbtn" style="width:6.0rem;height:16.0rem;border-left:2px solid #dddddd;font-size:1.0rem;color:#eee;float:right;z-index:99;position: relative;bottom:16.0rem;right:0rem;">评论</button>
                </form>
            </div>
        </footer>

        <footer class="footer">
        <span>
            <a href="http://www.miitbeian.gov.cn/" rel="nofollow" title="工业和信息化部ICP/IP地址/域名信息备案管理系统">粤ICP备16055652-2</a>
        </span>

            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/">&nbsp;<span style="line-height:16px;">蠢羊小站</span></a>
        </span>
        </footer> <!-- .entry-footer -->
    </div>
    <script type="application/javascript">
        // 生成随机六位数
        function MathRand6()
        {
            var Num="";
            for(var i=0;i<6;i++)
            {
                Num+=Math.floor(Math.random()*10);
            }
            return Num;
        }
        $(function(){
            hljs.tabReplace = '    ';
            hljs.initHighlightingOnLoad();
            var converter = new showdown.Converter();
            $.get("/blog/{{$blog['id']}}/content",function(data){
                $('#blog_content').html(converter.makeHtml(data['content']));
                //
                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });
            });
            $.get("/blog/{{$blog['id']}}/comments",function(data){
                debugger;
                var html="<hr/>";
                var comments = data.comments;
                for(var i in comments){
                    html += '<div class="comment-item" > ' +
                            '<div class="avatar" style="background:\#'+MathRand6()+';">'+(parseInt(i)+1)+'</div>' +
                            '<div class="item-detail">' +
                            '<div><p>'+comments[i].name+'</p></div>' +
                            '<div><p>'+comments[i].created_at+'</p></div>' +
                            '<div class="comment-line"></div>' +
                            '</div>' +
                            '<div class="item-content"><p>'+comments[i].content+'</p></div>' +
                            '</div>' +
                            '<hr/>';
                }
                $('#comment_list').html(html);

            });
            $('#comment_form').submit(function() {
                debugger;
                $.ajax({
                    url:'{{url('/add/comment/'.$blog['id'])}}',
                    data:$('#comment_form').serialize(),
                    type:"GET",
                    beforeSend:function()
                    {
                    },
                    success:function(data)
                    {
                        if(data.success){
                            $("#msg").html('评论成功!');
                            $("#msg").show(500);
                            setTimeout("$('#msg').hide(500);",10000);
                        }else{
                            $("#msg").html(data.msg);
                            $("#msg").show(500);
                            setTimeout("$('#msg').hide(500);",10000);
                        }
                    }
                });
                return false;
            });
        });
    </script>
</div>
</body>
</html>