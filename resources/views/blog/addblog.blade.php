@extends('layouts.app')

@section('content')
        <div class="panel-heading">写文章</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/blog/add') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">标题</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                    <label for="keywords" class="col-md-4 control-label">关键词</label>

                    <div class="col-md-6">
                        <input id="keywords" type="text" class="form-control" name="keywords" value="{{ old('keywords') }}" required autofocus>

                        @if ($errors->has('keywords'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('keywords') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content" class="col-md-4 control-label">内容</label>

                    <div class="col-md-6">
                        <textarea id="content" class="form-control" rows="20" name="content" required autofocus>{{ old('content') }}</textarea>

                        @if ($errors->has('keywords'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            添加
                        </button>
                    </div>
                </div>
            </form>
        </div>
@endsection
