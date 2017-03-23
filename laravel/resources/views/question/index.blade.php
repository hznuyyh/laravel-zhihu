@extends('layouts.app')

@section('content')
    <link href="http://localhost/laravel-zhihu/laravel/resources/assets/css/topic.css" rel="stylesheet" type="text/css">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($questions as $question)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img width="60px" src=" http://localhost/laravel-zhihu/laravel/public/{{$question->user->avatar}}" alt="{{ $question->user->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="http://localhost/laravel-zhihu/laravel/public/questions/{{ $question->id }}">
                                    {{ $question->title }}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection