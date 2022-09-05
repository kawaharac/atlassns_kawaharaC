<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function followers(){
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }
    //belongsToMany('関係するモデル', '中間テーブルのテーブル名', '中間テーブル内で対応しているID名', '関係するモデルで対応しているID名');USERテーブルとFOLLOWテーブルとを繋げる。

    public function follows(){
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }
    // self＝　このクラス　follows= このクラスのテーブル名(リレーション先のテーブル名)　followingid,followedid... = カラム名

    public function isFollowing(Int $user_id){//followed=フォローされている=フォロワー
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['follows.id']);
    }

    public function isFollowed(Int $user_id){//following=フォローしている
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['follows.id']);
    }

    public function is_followed_by_auth_user(){
        $id = Auth::id();

        $followers = array();
        foreach($this->follows as $follow){
            array_push($followers, $follow->user_id);
        }

        if(in_array($id, $followers)){
            return true;
        } else{
            return false;
        }

    }

    public function getAllUsers(Int $user_id){
        return $this->where('id', '<>', $user_id);
    //＜＞は右辺と左辺を比較。（等しくない、という意味(つまり、今回はログインユーザーを除くユーザーを返す)11／27）$user_id = 自分のIDのこと
    }

    public function unfollow(Int $user_id){
        return $this->follows()->detach($user_id);
    }

}
