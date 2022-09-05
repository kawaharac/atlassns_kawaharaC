@extends('layouts.login')

@section('content')
  <div class="container">

        {!! Form::open(['url' => 'posts/create']) !!}
          @csrf
          <div class="form-group">

              @if($user->image == "/storage/images/icon1.png" )
              <img class="icon" src="{{ $user->image }}">
              @else
              <img class="icon" src="{{ asset('/storage/images/' . $user->image) }}">
              @endif

              {!! Form::textarea('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください' ,'cols' => '10' ,'rows' => '10']) !!}
              <button type="submit" class="btn btn-success pull-right"><a class="btn btn-success"><img src="images/post.png" alt=""></a></button><!-- 投稿ボタン -->
            </div>
        {!! Form::close() !!}

    <div class="table">

      @foreach ($list as $list)<!-- postテーブルを引っ張っている -->
          <ul class="post-data">
            <li>
              @if($list->user->image == "/storage/images/icon1.png" )
                <img class="icon" src="{{ $list->user->image }}">
              @else
                <img class="icon" src="{{ asset('/storage/images/' . $list->user->image) }}">
              @endif
            </li>
            <div class="list-data">
              <div class="list">
                <li>{{ $list->user->username }}</li>
                <li>{{ $list->post }}</li>
              </div>
              <div class="create-data">
                <li class="created-time">{{ $list->created_at }}</li>
                @if(Auth::id() == $list->user_id)
                    <div class="btn-group">
                      <li>
                        <button type="submit" value="編集" class="btn btn-primary js-modal-open" post="{{ $list->post }}" post_id="{{ $list->id }}"><img src="images/edit.png" alt=""></button>
                      </li>
                      <form action="posts/delete/{{ $list->id }}" method="post">
                        @csrf
                          <li>
                            <button class="btn btn-trash" type="submit" value="削除" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash-h.png" alt=""></button>
                          </li>
                      </form>
                  </div>
                @endif
              </div>
            </div>
          </ul>

            <form action="posts/update/{{ $list->id }}" method="post">
              @csrf
              <div class="modal js-modal">
                <!-- 編集ボタンをクリックするとフェードインする -->
                <div class="modal__bg js-modal-close"></div>
                <div class="modal__content">
                  <textarea class="test" name="post" id="post" cols="30" rows="10"></textarea>
                  <!-- textareaに編集する文の内容が入る name属性で送る -->
                  <input type="hidden" class="halt" name="id" value="{{ $list->id }}">
                  <input type="hidden" class="halt" name="user_id" value="{{ $list->user_id }}">
                  <!-- 隠し送信：リスト（post）のid -->
                  <div class="btn-group">
                    <button type="submit" class="btn btn-primary" value="編集"><img src="images/edit.png" alt=""></button>
                  </div>
                </div><!--modal__content-->
              </div><!--modal js-modal-->
            </form>
      @endforeach
  </div>
</div>
@endsection
