<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // If Your Table Name And Not Equal to Your Model Class Name
    protected $table = 'posts';
    protected $fillable = ['title', 'text', 'category', 'image_url'];
}
