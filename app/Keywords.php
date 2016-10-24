<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keywords extends Model
{
    //
    protected $table='keywords';
    protected $fillable = [
        'bid','did','type'
    ];
}
