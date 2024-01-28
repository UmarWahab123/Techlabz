<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{
    use HasFactory;
    
    public function product()
    {
        return $this->belongsTo(Post::class, 'product_id');
    }

    public function harddisk()
    {
        return $this->belongsTo(PostExtra::class, 'disk_id');
    }

    public function ram()
    {
        return $this->belongsTo(PostExtra::class, 'ram_id');
    }

    public function warrenty()
    {
        return $this->belongsTo(PostExtra::class, 'warrenty_id');
    }

    public function os()
    {
        return $this->belongsTo(PostExtra::class, 'os_id');
    }

}
