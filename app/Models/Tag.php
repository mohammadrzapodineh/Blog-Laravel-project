<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title'];
    protected $table = 'tags';


    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getAbsoluteUrl()
    {
        return route("tag.articles", $this);        
    }
}
