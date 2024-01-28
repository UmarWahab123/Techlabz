<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    use HasFactory;
    
    public function messages()
    {
        return $this->hasMany(ContactMessage::class,'contact_id')->orderBy('id','desc')->take(5);
    }

}
