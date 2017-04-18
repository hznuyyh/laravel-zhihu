@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">控制面板</div>

                    <div class="panel-body">
                        <form  class="form-horizontal" role="form" action="/laravel-zhihu/laravel/public/password/update" method="post">
                            {{ csrf_field() }}
                            <div class="form-group {{$errors->has('old_password')? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">原始密码:</label>
                                <div class="col-md-6">
                                <input class="form-control col-md-6" id="old_password" type="password" name="old_password" required>
                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                                    </div>
                            </div>
                            <div class="form-group {{$errors->has('password')? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">新密码:</label>
                                <div class="col-md-6">
                                <input class="form-control" id="password" type="password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                    </div>
                            </div>
                            <div class="form-group {{$errors->has('password_confirm')? ' has-error' : '' }}">
                                <label for="password_confirm" class="col-md-4 control-label">确认密码:</label>
                                <div class="col-md-6">
                                <input class="form-control" id="password_confirm" type="password" name="password_confirmation" required>
                                @if ($errors->has('password_confirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirm') }}</strong>
                                    </span>
                                @endif
                                    </div>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                            <button class="btn btn-block form-control btn-primary" type="submit">重置密码</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#flash-overlay-modal').modal();
    </script>
@endsection
