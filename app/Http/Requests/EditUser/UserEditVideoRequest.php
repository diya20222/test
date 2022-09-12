<?php

namespace App\Http\Requests\EditUser;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Video;

use Illuminate\Http\Request;

class UserEditVideoRequest extends FormRequest
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
            'video_title' => 'required | unique:videos,video_title,'.$video->id.',id,deleted_at,NULL',
            'video' => 'mimes:mp4',
            'description' => 'required',
            'tag' => 'required |regex:/^(#[a-z]+ *)+$/',
            'published_at' => 'required',
        ];
    }
}

#regex:/^\S*$/u space not allow