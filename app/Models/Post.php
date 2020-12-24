<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
