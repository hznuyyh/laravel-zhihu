@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">对话列表
                        <p class="text-center" style="font-size: large;margin-top: -20px;margin-bottom: auto">
                        @if(Auth::id() == $messages->last()->to_user_id)
                                {{$messages->last()->fromUser->name}}
                            @else
                                {{$messages->last()->toUser->name}}
                            @endif
                        </p>
                    </div>

                    <div class="panel-body">

                        @foreach($messages as $message)
                            <div class="media">
                                @if($message->from_user_id == Auth::id())
                                    <div class="pull-right">
                                        <p href="#"  class="pull-right">
                                            <span>{{$message->body}}</span>
                                            <img  width="40px" src="/laravel-zhihu/laravel/public/{{$message->fromUser->avatar}}" alt="">

                                        </p>
                                    </div>
                                @else
                                <div class="media-left">
                                    <p href="#" >
                                       <img   width="40px" src="/laravel-zhihu/laravel/public/{{$message->fromUser->avatar}}" alt="">
                                        {{$message->body}}
                                    </p>
                                </div>
                            @endif
                            </div>
                        @endforeach
                        <br>
                        <form action='/laravel-zhihu/laravel/public/inbox/{{$dialogId}}/store' method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea name="body" class="form-control" required>
                                </textarea>
                            </div>
                            <div class="form-group pull-right" >
                                <button class="btn btn-success">点击发送</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
