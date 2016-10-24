<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title','type','introduction',
        'amount','author','cid','iszz',
        'statu','imgurl'
    ];

    protected $table = "blogs";

    public function blogContent()
    {
        return $this->hasOne('App\BlogContent','id');
    }

    public function user(){
        return $this->hasOne('App\User','id');
    }

    public function type(){
        return $this->hasOne('App\Dictionary','id');
    }
}
