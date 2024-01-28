<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RepairContact extends Model
{
    use HasFactory;
   

    public function messages()
    {
        return $this->hasMany(RepairContactMessage::class,'contact_id','id')->orderBy('id','desc')->take(5);
    }

}
