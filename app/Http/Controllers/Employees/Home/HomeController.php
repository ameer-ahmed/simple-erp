<?php

namespace App\Http\Controllers\Employees\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth:employee'
        ];
    }

    public function index(){
        return view('dashboard.employee.home.index');
    }
}
