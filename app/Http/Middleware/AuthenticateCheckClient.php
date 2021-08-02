<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateCheckClient extends Middleware
{

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login.client');
        }
    }
}