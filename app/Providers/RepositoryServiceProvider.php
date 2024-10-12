<?php

namespace App\Providers;

use App\Repository\DepartmentRepositoryInterface;
use App\Repository\Eloquent\DepartmentRepository;
use App\Repository\Eloquent\EmployeeRepository;
use App\Repository\Eloquent\ManagerRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\TaskRepository;
use App\Repository\EmployeeRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(ManagerRepositoryInterface::class, ManagerRepository::class);
        $this->app->singleton(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->singleton(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
