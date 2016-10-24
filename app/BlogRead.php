<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogRead extends Model
{
    protected $fillable = [
        'ip','blogid','userid'
    ];
    protected  $table="blog_read";
}
