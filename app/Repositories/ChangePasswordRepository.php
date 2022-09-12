<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Models\User;
use App\Contracts\ChangePasswordContract;

class ChangePasswordRepository implements ChangePasswordContract
{
    public function updatePassword($dataa)
    {
      
        $data = User::find($dataa['user_id']);
        if (Hash::check($dataa['password'], $data->password)) {
            $data->fill([
                'password' => Hash::make($dataa['new_password'])
                ])->save(); 
            
            return $data->session()->flash('success', 'Password changed');
        } else {
            return redirect()->back()->with('error', 'Password does not match');
        }
    }

    
}