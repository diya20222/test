<?php

namespace App\Http\Requests\EditUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

   
    public function rules(Request $request)
    {
        $data = User::find($request['id']);
        return [
            'name' => 'required | alpha | unique:users,name,'.$data->id.',id,deleted_at,NULL',
            'email' => 'required | email| unique:users,email,'.$data->id.',id,deleted_at,NULL',
            'mobile' => 'required | between:9,11 | unique:users,mobile,'.$data->id.',id,deleted_at,NULL',
         'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }
}
