<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public $timestamps = false;
}
