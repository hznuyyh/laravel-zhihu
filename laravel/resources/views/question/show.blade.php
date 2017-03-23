@extends('layouts.app')

@section('content')
    <link href="http://localhost/laravel-zhihu/laravel/resources/assets/css/topic.css" rel="stylesheet" type="text/css">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$question->title}}
                        @foreach($question->topics as $topic)
                            <a href="#" class="topic pull-right">{{$topic->name}}</a>
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!!$question->body!!}
                    </div>
                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="http://localhost/laravel-zhihu/laravel/public/questions/{{$question->id}}/edit">编辑</a></span>

                            <form action="http://localhost/laravel-zhihu/laravel/public/questions/{{$question->id}}" method="post" class="delete-form">
                                {{method_field('delete')}}
                                {{csrf_field ()}}
                                <button class="button is-naked delete-button">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->answers_count}}个回答
                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection