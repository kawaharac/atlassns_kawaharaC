<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUserTimeLine(Int $user_id){
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getTimeLinesFollowing(Int $user_id, Array $follow_ids)
    {
        return $this->WhereIn('user_id',$follow_ids)->orderBy('created_at', 'DESC')->paginate();
    }

    public function getTimeLinesFollowed(Int $user_id, Array $follow_ids)
    {
        return $this->WhereIn('user_id',$follow_ids)->orderBy('created_at', 'DESC')->paginate();
    }

    public function getTimeLinesIndex(Int $user_id, Array $follow_ids)
    {
        $follow_ids[] = $user_id;
        //$follow_ids(followControllerのクラスから渡ってきた引数（ログインユーザーのid）)を、$user_idとする
       return $this->whereIn('user_id',$follow_ids)->orderBy('created_at', 'DESC')->paginate();
       //返し値をこの$follow_idsから、whereInでuser_idカラム（キー）と対応するモノを抜き出し、created_at（作成日）のdesc（降順）で並べ、1ページにデフォルトで15?並ぶ
    }


    //public function getEditTweet(Int $user_id, Int $id){
      //  return $this->where('user_id', $user_id)->where('id', $id)->first();
      //引数でuser_idとidを出し、
    //}

    public function updateTweet($post_id, $edit)
    {
        //引数->$user_id, 配列にした$data, $id
        //擬似変数を用いて、引数user_id（整数型）にアクセスする= $user_id 以下同文
        $this->id = $post_id;
        $this->edit = $edit;

        Post::where('id',$post_id)->update([
        'post' => $edit
    ]);
        return redirect('top');
    }
    }
