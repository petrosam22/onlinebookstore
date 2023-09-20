<?php

namespace App\Providers;

use App\Repositories\UserRepositories;
use Illuminate\Support\ServiceProvider;
use App\interfaces\UserRepositoryInterface;
// use App\interfaces\PasswordRepositoryInterface;
use App\Repositories\ResetPasswordRepositories;
use App\Repositories\ForgetPasswordRepositories;
use App\interfaces\ForgetPasswordRepositoryInterface;
use App\interfaces\ResetPasswordRepositoriesInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class , UserRepositories::class);
        $this->app->bind(ForgetPasswordRepositoryInterface::class , ForgetPasswordRepositories::class);
        $this->app->bind(ResetPasswordRepositoriesInterface::class , ResetPasswordRepositories::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
