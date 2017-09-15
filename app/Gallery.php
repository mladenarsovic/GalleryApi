<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'       
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function images() 
    {
        return $this->hasMany(Image::class);
    }
    
    public function comments()
    {
         return $this->hasMany(Comment::class, 'galleries_id');
    }
   
}
