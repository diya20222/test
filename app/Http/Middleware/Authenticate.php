<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->routeIs('admin.*')) {
                return route('admin.login');
            } else {
                return route('home');
            }
        }
    }
}
