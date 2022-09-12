<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['logo', 'website', 'service_time', 'linkedln', 'twitter', 'facebook'];
    public function getLogoAttribute($value)
    {
        return $value ? asset('storage/image' . '/' . $value) : NULL;
    }
}
