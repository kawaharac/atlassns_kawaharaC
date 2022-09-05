@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="login-new">
    <h2>{{ session('username') }}さん</h2> <!-- ここの名前部分が表示エラー出てしまう👉直したsessionはformの時よく使う -->
    <h2>ようこそ！AtlasSNSへ！</h2>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>

    <p class="btn"><a class="login-btn" href="/login">ログイン画面へ</a></p>
  </div>
</div>

@endsection
