<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin['password'])) {
            return response([
                'message' => ['These Password and Email does not match.']
            ]);
        }

        return response([
            'token' => $admin->createToken('MyApp')->accessToken,
            'user' => $admin
        ]);
    }
}