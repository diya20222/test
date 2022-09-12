<?php

namespace App\Http\Requests\Admin;
use App\Models\Video;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EditVideoRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $video = Video::find($request['id']);
        return [
            'category_id' => 'required',
            'video_title' => 'required | unique:videos,video_title,'.$video->id.',id,deleted_at,NULL',
            'tag' => 'required |regex:/^(#[a-z]+ *)+$/',
            'description' => 'required',
            'published_at' => 'required',
        ];
    }
}
