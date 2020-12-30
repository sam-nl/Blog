<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'tag_id',
        'image',
    ];

    public function image(){
        return $this->morphOne('App\Models\Image', "imageable");
    }

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
