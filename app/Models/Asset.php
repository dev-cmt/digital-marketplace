<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'category_id', 'user_id', 'title', 'slug', 'description', 'type', 'resolution', 'license',
        'thumbnail', 'preview_url', 'file_path', 'price', 'is_free', 
        'likes_count', 'downloads_count', 'is_trending', 'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    public function wishlistedBy()
    {
        return $this->hasMany(Wishlist::class);
    }
}
