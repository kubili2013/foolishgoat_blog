<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <?php
        $type = \App\Dictionary::where('code', 'type')->first();
        $dists = \App\Dictionary::where('parent_id', $type->id)->get();
        ?>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="/favicon.ico" />
        <meta name="Keywords" content="个人博客 匠心 匠心博客 FoolishGoat foolishgoat 蠢羊博客 技术博客 laravel java ionic">
        <meta name="description" content="匠心的博客是独自开发的个人技术博客,分享视频,分享技术!">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/genericons.css">
        <link rel="stylesheet" href="/css/logo.css">
            <link rel="stylesheet" href="/css/code.css">
        {{-- cdn引入jquery --}}
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
            <script src="/js/index.js"></script>
        <title>蠢羊小站 - 匠心的博客</title>
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
            @yield('content')
        </div>
    </body>
</html>
