<?php

namespace App\Http\Controllers\Managers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mutual\Auth\LoginRequest;
use App\Http\Services\Managers\Auth\AuthService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public function __construct(
        private readonly AuthService $auth,
    )
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth:manager', only: ['logout']),
            new Middleware('guest:manager', except: ['logout']),
        ];
    }

    public function _login() {
        return view('dashboard.site.auth.login');
    }

    public function login(LoginRequest $request) {
        return $this->auth->login($request, 'manager');
    }

    public function logout() {
        return $this->auth->logout('manager');
    }
}
