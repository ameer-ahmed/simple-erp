<?php

use App\Http\Helpers\Http;
use App\Http\Helpers\Response;
use App\Http\Middleware\LocalizeApi;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
                Route::middleware('web')
                    ->group(base_path('routes/web.php'));

                Route::middleware('web')
                    ->as('manager.')
                    ->prefix('manager')
                    ->group(base_path('routes/manager.php'));

                Route::middleware('web')
                    ->as('employee.')
                    ->prefix('employee')
                    ->group(base_path('routes/employee.php'));
        },
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectUsersTo(function (Request $request) {
            if (auth('manager')->check()) {
                return route('manager./');
            }
            if (auth('employee')->check()) {
                return route('employee./');
            }
        });

        $middleware->redirectGuestsTo(function (Request $request) {
//            if ($request->is('manager/*')) {
//                return route('manager.auth._login');
//            }
//            if ($request->is(   'employee/*')) {
//                return route('employee.auth._login');
//            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return Response::fail(status: $e->getStatusCode(), message: __('messages.No data found'));
            }
        });
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($e instanceof TokenExpiredException) {
                return Response::fail(status: Http::UNAUTHORIZED, message: 'Token expired');
            }

            if ($e instanceof TokenBlacklistedException) {
                return Response::fail(status: Http::UNAUTHORIZED, message: 'Token blacklisted');
            }

            if ($e instanceof TokenInvalidException) {
                return Response::fail(status: Http::UNAUTHORIZED, message: 'Token invalid');
            }

            if ($e instanceof JWTException) {
                return Response::fail(status: Http::UNAUTHORIZED, message: 'JWT error');
            }

            if ($e instanceof AuthenticationException) {
                if ($request->expectsJson()) {
                    return Response::fail(status: Http::UNAUTHORIZED, message: 'Unauthenticated');
                } else {
                    if ($request->is('manager', 'manager/*')) {
                        return redirect()->route('manager.auth._login');
                    }
                    if ($request->is(   'employee', 'employee/*')) {
                        return redirect()->route('employee.auth._login');
                    }
                }
            }

            if ($e instanceof ValidationException) {
                $errors = $e->validator->errors()->all();
                if ($request->acceptsHtml() && collect($request->route()->middleware())->contains('web')) {
                    return $request->ajax() ? response()->json($errors, Http::UNPROCESSABLE_ENTITY) : redirect()->back()->withInput($request->validated())->withErrors($errors);
                }

                return Response::fail(message: 'Validation error', data: $errors);
            }
        });
    })->create();
