<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //

      protected $fillable = ['following_id','followed_id'];

      public $timestamps = false;

    public function user(){

    return $this->belongsTo('App\User');

    }

    public function is_followed_by_auth_user(){
        $id = Auth::id();

        $followers = array();

        foreach($this->follow as $follow){
            array_push($followers, $follow->following_id);
            //array_push =
        }
        if(in_array($id,$followers)){
            return true;
        }else{
            return false;
        }
    }

    public function getFollowCount($user_id){
        return $this->where('following_id', $user_id)->count();
    }

    public function getFollowerCount($user_id){
        return $this->where('followed_id', $user_id)->count();
    }

    public function getAllusers(Int $user_id)
    {
        return $this->where('id', '<>', $user_id);
    }

    public function followingIds(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get();
    }

    public function followedIds(Int $user_id)
    {
        return $this->where('followed_id', $user_id)->get();
    }

}
