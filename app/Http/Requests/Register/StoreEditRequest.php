<?php

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreEditRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    
    public function rules(Request $request)
    {
        $video = Video::find($request['id']);
        return [
            'video_link' => 'required | unique:videos,video_link,'.$video->id.',id,deleted_at,NULL',
            'video_title' => 'required|unique:videos,video_title,'.$video->id.',id,deleted_at,NULL',
 
            'publish_date' => 'required',
            'description' => 'required',
            'tag' => 'required',
        ];
    }
}