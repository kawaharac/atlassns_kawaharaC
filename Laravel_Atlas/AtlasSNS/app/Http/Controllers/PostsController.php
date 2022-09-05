<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Postcontroller;
use App\Post;
use App\Follow;
use App\User;

class PostsController extends Controller
{
    //
    //public function index(){
      //  $list = \DB::table('posts')->join(); SQL文　JOIN文でくっつける
        //return view('posts.index',['list'=>$list]);
    //}


    public function index(Post $post, Follow $follow, User $user){
        $user = Auth::user();
        $follow_ids = $follow->followingIds($user->id);
        //変数$follow_ids＝followモデルのfollowingIdsクラスへ、ログインしているユーザー（$user）のidを引数に渡す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();
        //変数$following_ids＝$follow_ids($follow->followingIds($user->id)のこと)からpluckメソッドを使って、フォローされた人（followed_id）のカラムを配列にして抜き出す

        //pluckメソッド（配列から指定した値だけのデータを出してくれる）
        //(引数を二つ設定することで、バリューだけでなくキーも取得することが可能）

        $list = $post->getTimeLinesIndex($user->id, $following_ids);
        $follow = $user->follows()->get();
        return view('posts.index',['list'=>$list, 'user' =>$user]);
    }

    public function create(Request $request)
    {
        $user_id = Auth::id();
       // $posts = Post::with('user')->get();
        $post = $request->input('newPost');
        \DB::table('posts')->insert(['post' => $post ,'user_id' => $user_id]);

        return redirect('/top');
    }


    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();
        return redirect('top');
    }

    public function update(Request $request, Post $post)
    {
        $validator = $request->validate([
            'post' => 'required|string|min:1|max:200',
        ]);

        //$validator->validate();
        $user = Auth::user();
        $post_id = $request->input('id');
        $edit = $request->input('post');
        $post->updateTweet($post_id, $edit);

        return redirect('top');
    }
}
