<?php

namespace App\Http\Services\Managers\Auth;

use App\Http\Requests\Mutual\Auth\LoginRequest;

class AuthService
{
    public function login(LoginRequest $request, $guard){
        $credentials = $request->validated();
        $rememberMe = $request->remember_me == 'on';
        if (auth($guard)->attempt($credentials, $rememberMe)) {
            return redirect()->route('/');
        } else {
            return redirect()->route('auth.login')->with(['error' => __('messages.Incorrect email or password')]);
        }
    }

    public function logout($guard){
        auth($guard)->logout();
        return redirect()->route('auth.login');
    }
}
