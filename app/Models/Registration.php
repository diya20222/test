<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getimageAttribute($value)
    {
        if ($value) {
            return asset('storage' .$value);
        }
         else {
            return asset('public/dist/img/face10.jpg');
        }
    }
}
