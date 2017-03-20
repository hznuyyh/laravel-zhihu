@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>
                    <div class="panel-body">
                        <form action="http://localhost/laravel-zhihu/laravel/public/questions" method="post" >
                            {{csrf_field()}}
                            <div class="form-group {{$errors->has('title')?'has-error':''}}">
                                <label for="title">标题</label>
                                <input type="text" value="{{old('title')}}"  name="title" class="form-control" placeholder="标题" id="title">
                                @if($errors->has('title'))
                                    <span class="help-block"></span>
                                    <strong>{{$errors->first('title')}}</strong>
                                    @endif
                            </div>
                            <div class="form-group">
                                <select class="js-example-basic-multiple" multiple="multiple">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                            <div class="form-group {{$errors->has('body')?'has-error':''}}">
                                <label for="body">内容</label>
                                <script id="container"  name="body" type="text/plain" >
                                    {{(old(('body')))}}
                                </script>
                                @if($errors->has('body'))
                                    <span class="help-block"></span>
                                    <strong>{{$errors->first('body')}}</strong>
                                @endif
                            </div>

                            <button class="btn btn-success pull-right" type="submit">发布问题</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
           ue.execCommand('serverparam','_token',Laravel.csrfToken);
        });
    </script>
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
        @endsection
@endsection