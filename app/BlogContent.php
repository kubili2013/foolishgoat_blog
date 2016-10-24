<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogContent extends Model
{
    protected $fillable = ['content'];
    protected $table = "blog_content";

    public function blog()
    {
        return $this->hasOne('App\Blog');
    }
}
