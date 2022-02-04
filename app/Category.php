<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){

        // creo la relazione one to many, l'oggetto category ha molti posts
        return $this->hasMany('App\Post');
    }
}
