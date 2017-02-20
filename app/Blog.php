<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title','type','introduction',
        'amount','author','cid','iszz',
        'statu','imgurl','keywords'
    ];

    protected $table = "blogs";

    public function blogContent()
    {
        return $this->hasOne('App\BlogContent','id','cid');
    }

    public function user(){
        return $this->hasOne('App\User','id','author');
    }

    public function dictionary(){
        return $this->hasOne('App\Dictionary','id','type');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','bid');
    }
}
