<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    // If Your Table Name And Not Equal to Your Model Class Name
    protected $table = 'posts';
    protected $fillable = ['title', 'text', 'category', 'image_url', 'user_id'];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
