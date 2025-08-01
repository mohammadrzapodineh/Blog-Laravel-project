<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug;
    // If Your Table Name And Not Equal to Your Model Class Name
    protected $table = 'posts';
    protected $fillable = ['title', 'text', 'category', 'image_url', 'user_id'];
    protected $appends = ['snipted_text'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }



    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function comments(): HasMany
    {
        // Return Comments For Each Post
        
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getSniptedTextAttribute()
    {
        // This Function Retrun 100 Char Of Text 
        $data = substr($this->text, 0, 100) . "...";
        return $data;
    }




}
