<?php

namespace App\Providers;



// use App\interfaces\PasswordRepositoryInterface;
use App\Repositories\UserRepositories;
use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthorRepositories;
use App\Repositories\CategoryRepositories;
use App\Repositories\PublisherRepository;
use App\interfaces\UserRepositoryInterface;
use App\interfaces\AuthorRepositoryInterface;
use App\interfaces\CategoryRepositoryInterface;
use App\Repositories\ResetPasswordRepositories;
use App\Repositories\ForgetPasswordRepositories;
use App\interfaces\ForgetPasswordRepositoryInterface;
use App\interfaces\ResetPasswordRepositoriesInterface;
use App\interfaces\PublisherRepositoryInterface;

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
        $this->app->bind(CategoryRepositoryInterface::class , CategoryRepositories::class);
        $this->app->bind(AuthorRepositoryInterface::class , AuthorRepositories::class);
        $this->app->bind(PublisherRepositoryInterface::class , PublisherRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
