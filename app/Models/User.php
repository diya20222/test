<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    //get image path attribute 
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/image' . '/' . $value) : NULL;
    }
    // set name of 1st letter Uppercase
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    // count user how many likes in video
    public function like()
    {
        return $this->hasMany(Like::class, 'user_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
    // count user how many video upload
    public function video()
    {
        return $this->hasMany(Video::class, 'user_id', 'id');
    }
    // insert like 
    public function likes()
    {
        return $this->belongsToMany('Video', 'likes', 'user_id', 'video_id');
    }
    public function comments()
    {
        return $this->belongsToMany('Video', 'comments', 'user_id', 'video_id');
    }
 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
