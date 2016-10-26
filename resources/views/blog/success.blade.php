@extends('layouts.app')

@section('content')
    @if(isset($msg))
        <div class="alert alert-{{$msg['type']}}" role="alert">
            {{$msg['content']}}
            <a href="{{url("".$msg['uri'])}}">返回</a>
        </div>
    @endif
@endsection
