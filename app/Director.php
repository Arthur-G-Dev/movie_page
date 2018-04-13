<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public $timestamps = false;
    protected $fillable = ['director'];
}
