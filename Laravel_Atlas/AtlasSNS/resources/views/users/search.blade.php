@extends('layouts.login')

@section('content')
<div class="search-action">
  <form method="GET" action="{{ url('/search') }}">
    <p><input type="text" name="keyword" value="{{$keyword}}"></p>
    <!-- fontawesome -->
    <button type="submit" class="search-fontawesome btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    @if(!empty($keyword))
    <div class="keyword-name"><p>検索ワード: {{ $keyword }}</p></div>
    @endif
  </form>
</div>

@if(!empty($all_user->count()))
<!--最初は全選択されている状態なので、USERNAMEが全部表示される（今回の場合）-->
@foreach($all_user as $search)
<tr>
  <div class="search-post">
    <div class="search-user">
      <td>
        @if($search->image == "/storage/images/icon1.png" )
          <img class="icon" src="{{ $search->image }}">
          @else
          <img class="icon" src="{{ asset('/storage/images/' . $search->image) }}">
        @endif
      </td>
      <td>{{ $search->username }}</button></form></td>
    </div>
      @if(auth()->user()->isFollowing($search->id))
      <a href="{{ route('follows.unfollow', ['id' => $search->id]) }}" class="btn btn-danger">フォロー解除</a>
      @else
      <a href="{{ route('follows.follow', ['id' => $search->id]) }}" class="btn btn-follow">フォローする</a>
      @endif
  </div>
</tr>
@endforeach

@else
<p>見つかりませんでした。</p>
@endif
@endsection
