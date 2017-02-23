<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php
    $type = \App\Dictionary::where('code', 'type')->first();
    $dists = \App\Dictionary::where('parent_id', $type->id)->get();
    ?>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <meta name="Keywords" content="个人博客 匠心 匠心博客 FoolishGoat foolishgoat 蠢羊博客 技术博客 laravel java ionic">
    <meta name="description" content="匠心的博客是独自开发的个人技术博客,分享视频,分享技术!">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/genericons.css">
    <link rel="stylesheet" href="/css/logo.css">
    {{--<link rel="stylesheet" href="/css/code.css">--}}
    <!-- markdown-css -->
    <link rel="stylesheet" href="/css/github-markdown.css">
    <!-- 百度站长平台  -->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?1caafb83252da8c140105744d6863ee3";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
        <!-- highlight-code-theme -->
    {{--<link rel="alternate stylesheet" title="-Default" href="css/highlight/default.css">--}}
    {{--<link rel="alternate stylesheet" title="Default" href="css/highlight/dark.css">--}}
    {{--<link rel="alternate stylesheet" title="FAR" href="css/highlight/far.css">--}}
    {{--<link rel="alternate stylesheet" title="IDEA" href="css/highlight/idea.css">--}}
    {{--<link rel="alternate stylesheet" title="Sunburst" href="css/highlight/sunburst.css">--}}
    {{--<link rel="alternate stylesheet" title="Zenburn" href="css/highlight/zenburn.css">--}}
    {{--<link rel="alternate stylesheet" title="Visual Studio" href="css/highlight/vs.css">--}}
    {{--<link rel="alternate stylesheet" title="Ascetic" href="css/highlight/ascetic.css">--}}
    {{--<link rel="alternate stylesheet" title="Magula" href="css/highlight/magula.css">--}}
    <link rel="stylesheet" title="Default" href="/css/highlight/github.css">
    {{--<link rel="alternate stylesheet" title="Brown Paper" href="css/highlight/brown_paper.css">--}}
    {{--<link rel="alternate stylesheet" title="School Book" href="css/highlight/school_book.css">--}}
    {{--<link rel="alternate stylesheet" title="IR Black" href="css/highlight/ir_black.css">--}}
    <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- markdown-to-html js (showdown.js)-->
    <script src="/js/showdown.min.js"></script>
    <!-- highlight.js -->
    <script src="/js/highlight.pack.js"></script>
    <script src="/js/index.js"></script>
    <title>蠢羊小站_匠心的博客</title>
</head>
<body onmousemove="removeLogoEyes(event);">
<div class="sidebar clearfloat">
    <header class="header">
        <div id="logo" class="logo morph">
            <div id="left_horn" class="left-horn"></div>
            <div id="right_horn" class="right-horn"></div>
            <div id="head" class="head"></div>
            <div id="face" class="face"></div>
            <div id="left_glass" class="left-glass"></div>
            <div id="right_glass" class="right-glass"></div>
            <div id="left_eye" class="left-eye"></div>
            <div id="right_eye" class="right-eye"></div>
            <div id="left_nostril" class="left-nostril"></div>
            <div id="right_nostril" class="right-nostril"></div>
            <div style="clear:both"></div>
        </div>
        <div CLASS="site-name"><h2>蠢羊小站</h2><h4>匠心的博客</h4></div>
        <button class="nav-btn" onclick="menuCollspan();"><span class="genericon genericon-menu"></span></button>
    </header>
    <nav class="menu" id="menu">
        <ul>
            <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="/">主页</a></li>
            @foreach($dists as $dist)
                <li class="{{ Request::path() == 'type/'.$dist->id ? 'active' : '' }}"><a
                            href="{{url('/type/'.$dist->id)}}">{{$dist->word}}</a></li>
            @endforeach
        </ul>
    </nav>
</div>
<div class="container">
    <div class="content">
        <footer class="footer footer-bg clearfloat" style="height: 4rem;">
            <div class="fieldcontainer">
                <form action="{{url('/')}}" method="get">
                    <input type="text" name="str" id="str" class="searchfield" placeholder="Keywords..."
                           value="{{ isset($str)?$str:"" }}" tabindex="1" style="max-width:100%;">
                    <button class="searchbtn" type="submit" style="width:4.0rem;height:4.0rem;border-left:2px solid #dddddd;font-size:1.0rem;color:#eee;float:right;z-index:99;position: relative;bottom:4.0rem;right:0rem;"><span class="genericon genericon-search"></span></button>
                </form>
            </div>
        </footer>
        @yield('content')
        <footer class="footer" style="padding:2.5454% 9.0909%">
            <span>
                <a href="http://www.miitbeian.gov.cn/" rel="nofollow" title="工业和信息化部ICP/IP地址/域名信息备案管理系统">粤ICP备16055652-2</a>
            </span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/">&nbsp;<span style="line-height:16px;">蠢羊小站</span></a>
            </span>
        </footer> <!-- .entry-footer -->
    </div>
</div>
</body>
</html>
