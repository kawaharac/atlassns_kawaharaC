@extends('layouts.login')

@section('content')
  <div class="edit-area">
    <div class="edit-icon">
      @if($user->image == "/storage/images/icon1.png" )
      <img class="icon" src="{{ $user->image }}">
      @else
      <img class="icon" src="{{ asset('/storage/images/' . $user->image) }}">
      @endif
    </div>

    <div class="form-edit">
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach

    {!! Form::open(['url' => 'users/update', 'files' => true]) !!}
    <!--'enctype' => 'multipart/form-data'-->
    <div class="form">
    {{ Form::label('user name') }}
    {{ Form::text('username',$user->username,['class' => 'input','id' => 'input']) }}
    </div>
    <!--Auth::user()->username-->
    <div class="form">
    {{ Form::label('mail address') }}
    {{ Form::text('mail',$user->mail,['class' => 'input','id' => 'input']) }}
    </div>
    <div class="form">
    {{ Form::label('password') }}
    {{ Form::password('password',['class' => 'input','id' => 'input']) }}
    </div>
    <div class="form">
    {{ Form::label('password confirm') }}
    {{ Form::password('password-confirm',['class' => 'input','id' => 'input']) }}
    </div>
    <div class="form">
    {{ Form::label('bio') }}
    {{ Form::text('bio',$user->bio,['class' => 'input','id' => 'input']) }}
    </div>
    <div class="form">
    {{ Form::label('icon image') }}
    {{ Form::file('image',['class' => 'input','id' => 'input']) }}
    </div>
    {{ Form::submit('更新',['class' => 'btn-edit']) }}


    {!! Form::close() !!}
    </div>
  </div>
@endsection
