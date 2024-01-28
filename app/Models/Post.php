<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'image',
        'description',
        'status',
        'type',
        
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug',
                'onUpdate'=>true
            ]
        ];
    }

    public function service()
    {
        return $this->belongsTo(Post::class, 'service_id');
    }

    public function sub_service()
    {
        return $this->belongsTo(Post::class, 'sub_service_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class, 'post_id');
    }

}
