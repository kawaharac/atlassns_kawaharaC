@extends('layouts.logout')

@section('content')
{!! Form::open() !!}
<div class="login-new">
  <div class="login-input">
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach <!-- エラー文（定型） -->
    <h2>新規ユーザー登録</h2>
    <div class="login">
    {{ Form::label('user name') }}
    {{ Form::text('username',null,['class' => 'input']) }}
    </div>
    <div class="login">
    {{ Form::label('mail adress') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
    </div>
    <div class="login">
    {{ Form::label('password') }}
    {{ Form::password('password',['class' => 'input']) }}
    </div>
    <div class="login">
    {{ Form::label('password confirm') }}
    {{ Form::password('password_confirmation',['class' => 'input']) }}
    </div>
    <div class="login">
    {{ Form::submit('REGISTER',['class' => 'login-submit']) }}
    </div>
    <p><a href="/login">ログイン画面へ戻る</a></p>
  </div>
</div>
{!! Form::close() !!}

@endsection
