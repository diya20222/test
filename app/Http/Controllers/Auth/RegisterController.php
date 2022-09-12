<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::WEB;

   
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required','alpha'],
            'email' => ['required', 'email', 'unique:users'],
            'mobile' => ['required','digits:10','unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg']
        ]);
    }

    protected function create(array $data)
    {
        $image = uploadFile($data['image'],'image');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'image' =>$image,
        ]);
       
    }
}
