@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
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
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading followers_count">
                        <h2>{{$question->followers_count}}</h2>
                        <span>关注者</span>
                    </div>
                    @if(Auth::check())
                        <div class="panel-body ">
                            <a href="http://localhost/laravel-zhihu/laravel/public/questions/{{$question->id}}/follow"
                               class="btn col-xs-6 {{Auth::user()->followed($question->id)? 'btn-followed':'btn-warning' }}" >
                                {{Auth::user()->followed($question->id)?'取消关注':'关注问题'}}</a>
                            <a href="#editor" class="btn btn-primary col-xs-6">编辑答案</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->answers_count}}个回答
                    </div>
                    <div class="panel-body content">
                        @foreach($question->answers as $answer)
                            <div class="media">
                                @if(Auth::check())
                                <div class="media-left">
                                    <a href="http://localhost/laravel-zhihu/laravel/public/answer/{{$answer->id}}/votes/users"
                                       class="btn {{Auth::user()->hasVotedFor($answer->id)? 'btn-default':'btn-primary' }}"
                                    >
                                        {{$answer->votes_count}}
                                    </a>
                                </div>
                                @endif
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="http://localhost/laravel-zhihu/laravel/public/questions/{{ $answer->user->name }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                </div>
                            </div>
                        @endforeach
                        @if(Auth::check())
                                <form action="http://localhost/laravel-zhihu/laravel/public/questions/{{$question->id}}/answer" method="post" >
                            {{csrf_field()}}

                            <div class="form-group {{$errors->has('body')?'has-error':''}}">
                                <label for="body">答案</label>
                                <script id="container"  name="body" type="text/plain" >
                                    {!! (old(('body')))!!}
                                </script>
                                @if($errors->has('body'))
                                    <span class="help-block"></span>
                                    <strong>{{$errors->first('body')}}</strong>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right" type="submit">提交答案</button>
                        </form>
                         @else
                            <a href="http://localhost/laravel-zhihu/laravel/public/login" class=" btn btn-success btn-block">登录后提供答案</a>
                            @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading followers_count">
                        <span>关于作者</span>
                    </div>
                        <div class="panel-body ">
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{$question->user->avatar}}" alt="name">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$question->user->name}}</h4>
                                </div>
                                <div class="user-statics" style=" margin-top: 20px;display: flex;">
                                <div class="static-item text-center" style="padding: 2px 20px;">
                                    <div class="class-text">问题</div>
                                    <div class="class-count">{{$question->user->questions_count}}</div>
                                </div>
                                <div class="static-item text-center" style="padding: 2px 20px;">
                                    <div class="class-text">回答</div>
                                    <div class="class-count">{{$question->user->answers_count}}</div>
                                </div>
                                <div class="static-item text-center"style="padding: 2px 20px;">
                                    <div class="class-text">关注者</div>
                                    <div class="class-count">{{$question->user->followers_count}}</div>
                                </div>
                            </div>
                                <div>
                            @if(Auth::check())
                            <a href="http://localhost/laravel-zhihu/laravel/public/user/{{$question->user_id}}/follow"
                               class="btn col-xs-6 {{Auth::user()->followedUser($question->user_id)? 'btn-followed':'btn-warning' }}"  >
                                {{Auth::user()->followedUser($question->user_id)?'取消关注':'关注作者'}}</a>
                                        <button type="button" class="btn btn-primary col-xs-6" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">发送私信</button>
                                @endif
                            </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel">发送私信</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="message-text" class="control-label">内容:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-body hidden">
                                                <div class="alert alert-success"  >
                                                    <strong>私信发送成功</strong>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                <button type="button" class="btn btn-primary">发送</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo','horizontal','fontsize','fontfamily',
                    'bold','italic', 'justifycenter','underline', 'fontborder',
                    'strikethrough', 'time','date', 'spechars', 'forecolor', 'backcolor','attachment']
            ],
            elementPathEnabled:false,
            enableContextMenu:false,
            autoClearEmptyNode:true,
            wordCount:true,
            imagePopup:false,
            initialFrameHeight:200,
            autotypeset:{indent:true,imageBlockLine:'center'}

        });
        ue.ready(function () {
            ue.execCommand('serverparam','_token',Laravel.csrfToken);
        });
        $('#exampleModal').on('show.bs.modal', function (event) {

        });

    </script>



@endsection