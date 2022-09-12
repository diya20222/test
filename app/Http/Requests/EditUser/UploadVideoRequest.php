<?php

namespace App\Http\Requests\EditUser;

use Illuminate\Foundation\Http\FormRequest;

class UploadVideoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'video_title' => 'required |unique:videos',
            'video' => 'required | mimes:mp4',
            'description' => 'required',
            'category_id' => 'required',
            'tag' => 'required |regex:/^(#[a-z]+ *)+$/',
            'published_at' => 'required',
        ];
    }
}
