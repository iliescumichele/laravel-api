<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //relazione ManyToMany tra Tags e Post
    public function post(){
        return $this->belongsToMany('App\Post');
    }
}
