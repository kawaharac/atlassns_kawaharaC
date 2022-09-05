@extends('layouts.login')

@section('content')
  <div class="follow-container">
    <div class="follow-list">
      <h2>Follower List</h2>
      <div class="follow_icon">
        @foreach($follow as $follow)
          <div class="icon">
            <a href="follows/users/profile/{{$follow->id}}">
              @if($follow->image == "/storage/images/icon1.png" )
                    <img class="icon" src="{{ $follow->image }}">
                    @else
                    <img class="icon" src="{{ asset('/storage/images/' . $follow->image) }}">
                    @endif
            </a>
          </div>
        @endforeach
      </div>
    </div>
      <div class="follow_comment">
          @foreach($timelines as $timelines)
        <ul class="post">
          <li>
            <a class="icon" href="users/profile/{{$timelines->user->id}}">
              @if($timelines->user->image == "/storage/images/icon1.png" )
                <img src="{{ $timelines->user->image }}">
                  @else
                    <img class="icon" src="{{ asset('/storage/images/' . $timelines->user->image) }}">
                  @endif</a></li>
          <li>{{ $timelines->user->username }}</li>
          <li>{{ $timelines->post }}</li>
          <li>{{ $timelines->created_at }}</li>
        </ul>
      @endforeach
    </div>
  </div>
@endsection
