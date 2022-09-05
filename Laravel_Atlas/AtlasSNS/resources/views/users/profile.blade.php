@extends('layouts.login')

@section('content')
<div class="follow-top">
  <div class="follow-bio">
    <div class="follow-icon">
      <p>@if($user->image == "/storage/images/icon1.png" )
      <img class="icon" src="{{ $user->image }}">
      @else
        <img class="icon" src="{{ asset('/storage/images/' . $user->image) }}">
      @endif
    </div>
    <div class="follow-introduction">
      <p><span>name</span>{{ $user->username }}</p>
      <p><span>bio</span>{{ $user->bio }}</p>
    </div>

    @if(auth()->user()->isFollowing($user->id))
    <a href="{{ route('follows.unfollow', ['id' => $user->id]) }}" class="btn btn-danger">フォロー解除</a>
    @else
    <a href="{{ route('follows.follow', ['id' => $user->id]) }}" class="btn btn-follow">フォローする</a>
    @endif
  </div>
</div>

@foreach( $post as $post )
<div class="post">
  <p>@if($user->image == "/storage/images/icon1.png" )
      <img class="icon" src="{{ $user->image }}">
      @else
      <img class="icon" src="{{ asset('/storage/images/' . $user->image) }}">
      @endif</p>
  <p>{{ $post->post }}</p>
  <p>{{ $post->user->username }}</p>
  <p>{{ $post->created_at }}</p>
</div>
@endforeach

@endsection
