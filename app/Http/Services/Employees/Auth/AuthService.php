<?php

namespace App\Http\Services\Employees\Auth;

use App\Http\Requests\Mutual\Auth\LoginRequest;

class AuthService
{
    public function login(LoginRequest $request, $guard)
    {
        $inputs = $request->validated();
        $loginType = filter_var($inputs['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [
            $loginType => $inputs['email'],
            'password' => $inputs['password']
        ];

        $rememberMe = $request->has('remember_me') && $request->remember_me === 'on';

        if (auth($guard)->attempt($credentials, $rememberMe)) {
            session()->put('guard', $guard);
            return redirect()->route($guard . './');
        }

        return redirect()->route($guard . '.auth.login')
            ->with(['error' => __('messages.Incorrect email or password')]);
    }

    public function logout($guard){
        session()->forget('guard');
        auth($guard)->logout();
        return redirect()->route($guard.'.auth.login');
    }
}
