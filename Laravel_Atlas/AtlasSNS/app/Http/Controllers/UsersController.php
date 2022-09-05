<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use App\Follow;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function profile($id){
        $user = User::find($id);
        $post = Post::where('user_id',$id)->get();
        return view('users.profile',['user'=>$user,'post'=>$post]);
    }

    protected function validator(array $data){
       return Validator::make($data,[
            'username'      =>'required|string|min:2|max:12',
            'bio'           =>'max:150',
            'mail'          =>['required','string','email','min:5','max:40',Rule::unique('users')->ignore(Auth::id())],
            'password'      =>'required|min:8|max:20|alpha_dash',
            'password_confirmation' => 'min:8|max:20|alpha_dash',
            'image'         =>'alpha_dash|mimes:jpeg,png,jpg,bmp,svg,gif',
        ]);//'alpha_dash'＝英数字許可　min＝最小文字数　max＝最大文字数 required＝必須項目
    }

    public function update(Request $request, User $user){//更新のためのメソッド
        $user = Auth::user();
        if($request->isMethod('post')){
        $data = $request->input();
        $validator = $this->validator($data);
        unset($data['\token']);
        if($validator->fails()){
            return redirect('/edit')
            ->withErrors($validator)
            ->withInput();
        }else{
        if ($request->hasFile('image')){
        $image = $request->image->store('public/images');
        $user->image = basename($image);
        $user->update();
        }

        User::where('id',$user->id)->update([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'bio' => $data['bio'],
            'mail' => $data['mail']
        ]);

        }
        }
        return redirect('/top');
    }

    public function edit(User $user){//表示させるメソッド
        $user = Auth::user();
        return view('users.edit',['user'=>$user]);
    }

    public function search(Request $request){

        $keyword = $request->input('keyword');

        $user = new User;
        $all_user = $user->getAllUsers(auth()->user()->id)->get();

        if($request->has('keyword') && $keyword != ''){
            $all_user = User::where('username', 'LIKE', '%'.$keyword.'%')->get();}
        return view('users.search',compact('keyword','all_user'));

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

   public function follow($id){
        Follow::create([
            'followed_id' => $id,
            'following_id' => Auth::id()
                ]);

        return redirect()->back();
    }

    public function unfollow($id){
        //$follow = Follow::where('followed_id',$id)->where('following_id',Auth::id())->first();
     //$follow->delete();
     $follower = auth()->user();
     //フォローしているか
     $is_following = $follower->isFollowing($id);
     if($is_following){
         //フォローしていればフォローを解除する
         $follower->unfollow($id);
         return back();
     }

        return redirect()->back();
    }

    public function show(Follow $follow, User $user){

        $login_user = Auth::user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        //$timelines = $tweet->getUserTimeLine($user->id);
        $follow_count =$follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);
        return view('layouts.login',
        [
            'user' => $user,
            'is_following' => $is_following,
            'is_followed' => $is_followed,
            //'timelines' => $timelines,
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

}
