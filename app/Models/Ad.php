<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    /** @use HasFactory<\Database\Factories\AdFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'phone',
        'status',
        'user_id',
        'category_id',
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
