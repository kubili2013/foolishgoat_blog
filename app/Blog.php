<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'type', 'keywords','amount','author','content', 'mdcontent','statu','introduction'
    ];
}
