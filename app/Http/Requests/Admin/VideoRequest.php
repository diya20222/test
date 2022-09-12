<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'video_title' => 'required | unique:videos,video_title,NULL,id,deleted_at,NULL',
            'video' => 'required | mimes:mp4,mov,ogg',
            'tag' => 'required |regex:/^(#[a-z]+ *)+$/',
            'description' => 'required',
            'published_at' => 'required',
        ];
    }
}
