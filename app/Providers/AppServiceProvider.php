<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use App\Policies\TodoPolicy;
use App\Policies\UserPolicy;
use App\Repositories\Contracts\TodoRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Gate::policy(Todo::class, TodoPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
