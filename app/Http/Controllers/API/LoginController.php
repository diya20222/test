<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function userLogin(Request $request)
    {
        // dd(123);
        dd(123);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user['password'])) {
            return response([
                'message' => ['These Password and Email does not match.']
            ]);
        }

        return response([
            'token' => $user->createToken('MyApp')->accessToken,
            'user' => $user
        ]);
    }
}