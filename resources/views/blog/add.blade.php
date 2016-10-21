@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">写文章</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/blog/add') }}">
                {{ csrf_field() }}
                <input type="hidden" name="rtoken" value="{{$rtoken}}">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-3 control-label">标题</label>

                    <div class="col-md-7">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    <label for="type" class="col-md-3 control-label">博客类型</label>

                    <div class="col-md-7">
                        <select class="form-control" id="type" name="type" value="{{ old('type') }}" required autofocus>
                            <option value="文章">文章</option>
                            <option value="分享">分享</option>
                            <option value="视频">视频</option>
                            <option value="小说">小说</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                    <label for="keywords" class="col-md-3 control-label">关键词</label>

                    <div class="col-md-7">
                        <input id="keywords" type="text" class="form-control" name="keywords" value="{{ old('keywords') }}" required autofocus>

                        @if ($errors->has('keywords'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('keywords') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                    <label for="introduction" class="col-md-3 control-label">简介</label>

                    <div class="col-md-7">
                        <textarea id="introduction" class="form-control" name="introduction" required autofocus>{{ old('introduction') }}</textarea>

                        @if ($errors->has('introduction'))
                            <span class="help-block">
                                <strong>{{ $errors->first('introduction') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content" class="col-md-3 control-label">内容</label>

                    <div class="col-md-7">
                        <textarea id="content" class="form-control" rows="10" name="content" required autofocus>{{ old('content') }}</textarea>

                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('mdcontent') ? ' has-error' : '' }}">
                    <label for="mdcontent" class="col-md-3 control-label">MD内容</label>

                    <div class="col-md-7">
                        <textarea id="mdcontent" class="form-control" rows="10" name="mdcontent" required autofocus>{{ old('mdcontent') }}</textarea>

                        @if ($errors->has('mdcontent'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mdcontent') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            添加
                        </button>
                    </div>
                    <div class="col-md-4">
                        <label class="radio-inline">
                            <input type="radio" name="statu" value="0" checked> 存草稿
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="statu" value="1"> 发布
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
