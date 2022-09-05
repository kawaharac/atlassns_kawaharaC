<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\followList;
use Auth;
use App\Post;
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //

    public function __construct()
    {
        //確認済みのユーザーのみがこのルートにアクセス可能
        $this->middleware(['auth', 'verified'])->only(['follow','unfollow']);
    }

    public function followList(Follow $follow, User $user, Post $post){
        $user = Auth::user();
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('followed_id')->toArray();
        $timelines = $post->getTimeLinesFollowing($user->id, $following_ids);
        //$timelines=フォローしている人の「投稿の」情報
        $follow = $user->follows()->get();
        return view('follows.followList',['timelines' => $timelines ,'follow' => $follow]);
        //$follow=フォローしている人の情報

        //$all_users = $follow->getAllUsers(Auth::user()->id);
        //return view('follows.followList',['all_users' => $all_users]);
    }
    public function followerList(Follow $follow, User $user, Post $post){
        $user = Auth::user();
        $follow_ids = $follow->followedIds($user->id);
        $followed_ids = $follow_ids->pluck('following_id')->toArray();
        $timelines = $post->getTimeLinesFollowed($user->id, $followed_ids);
        //$timelines=フォローされている人の「投稿の」情報
        $follow = $user->followers()->get();
        return view('follows.followerList',['timelines' => $timelines ,'follow' => $follow]);
    }


}
