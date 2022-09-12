<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    // public function video()
    // {
    //     return $this->hasMany(Video::class, 'user_id', 'id');
    // }
}
