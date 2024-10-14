<?php

namespace App\Http\Controllers\Employees\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mutual\Auth\LoginRequest;
use App\Http\Services\Employees\Auth\AuthService;
use App\Models\Department;
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
            new Middleware('auth:employee', only: ['logout']),
            new Middleware('guest:employee', except: ['logout']),
        ];
    }

    public function _login() {
        return view('dashboard.site.auth.login', ['guard' => 'employee']);
    }

    public function login(LoginRequest $request) {
        return $this->auth->login($request, 'employee');
    }

    public function logout() {
        return $this->auth->logout('employee');
    }
}
