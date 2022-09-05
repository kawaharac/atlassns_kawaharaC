@extends('layouts.logout')
@section('content')

{!! Form::open() !!}
    <div class="login-block">
          <div class="top">
            <h2 class="top-comment">AtlasSNSへようこそ</h2>

            <div class="login">
            {{ Form::label('mail address') }}
            {{ Form::text('mail',null,['class' => 'input']) }}
            </div>
            <div class="login">
            {{ Form::label('password') }}
            {{ Form::password('password',['class' => 'input']) }}
            </div>
            {{ Form::submit('LOGIN',['class' => 'login-submit']) }}

            <p><a href="/register">新規ユーザーの方はこちら</a></p>
          </div>
     </div>
{!! Form::close() !!}
@endsection
