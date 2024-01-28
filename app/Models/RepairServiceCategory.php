<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Service;
use App\Models\Post;


class RepairServiceCategory extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug',
                'onUpdate'=>true
            ]
        ];
    }
    
    public function latest_service()
    {
        return $this->belongsTo(Post::class, 'service_id','id');
    }

    public function new_sub_service()
    {
        return $this->belongsTo(Service::class, 'sub_service_id','id');
    }
}
