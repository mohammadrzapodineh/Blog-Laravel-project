<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 'comments';
    protected $fillable = ['text', 'post_id', 'user_name'];


    
    public function post():BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    
}
