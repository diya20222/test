<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['video_link','category_id','user_id','video_title', 'description', 'tag', 'video', 'slug','thumbnail' ,'published_at'];
    
    protected $guarded = [];
    
    // set slug between - 
    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->video_title, "-");
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    //get video path
    public function getVideoAttribute($value)
    {
        if ($value) {
            return asset('storage/video/' . $value);
        } else {
            return NULL;
        }
    }
    public function getThumbnailAttribute($value)
    {
        if ($value) {
            return asset('storage/thumbs/' . $value);
        } else {
            return NULL;
        }
    }
    // get category from category table
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    //insert like 
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    
    //count how many like in video
    public function videoLike()
    {
        return $this->hasMany(Like::class, 'video_id','id');  
    }
    //insert comment
    public function comments()
    {
        return $this->belongsToMany(User::class, 'comments');
    }
    //count how many comments in video
    public function videoComment()
    {
        return $this->hasMany(Comment::class, 'video_id', 'id');
    }
}
