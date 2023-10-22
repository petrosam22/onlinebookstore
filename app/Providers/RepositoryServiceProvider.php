<?php

namespace App\Providers;



// use App\interfaces\PasswordRepositoryInterface;
use App\Repositories\BookRepositories;
use App\Repositories\CartRepositories;
use App\Repositories\PostRepositories;
use App\Repositories\RateRepositories;
use App\Repositories\UserRepositories;
use App\Repositories\OrderRepositories;
use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthorRepositories;
use App\Repositories\RefundRepositories;
use App\Repositories\ReplayRepositories;
use App\Repositories\ReviewRepositories;
use App\Repositories\CommentRepositories;
use App\Repositories\PublisherRepository;


use App\Repositories\CategoryRepositories;
use App\interfaces\BookRepositoryInterface;
use App\interfaces\CartRepositoryInterface;
use App\interfaces\PostRepositoryInterface;
use App\interfaces\RateRepositoryInterface;
use App\interfaces\UserRepositoryInterface;
use App\interfaces\OrderRepositoryInterface;
use App\interfaces\AuthorRepositoryInterface;
use App\interfaces\RefundRepositoryInterface;
use App\interfaces\ReplayRepositoryInterface;
use App\interfaces\ReviewRepositoryInterface;
use App\Repositories\OrderStatusRepositories;
use App\interfaces\CommentRepositoryInterface;
use App\Repositories\OrderDeliverRepositories;
use App\interfaces\CategoryRepositoryInterface;
use App\Repositories\ResetPasswordRepositories;
use App\interfaces\PublisherRepositoryInterface;
use App\Repositories\ForgetPasswordRepositories;
use App\interfaces\OrderStatusRepositoryInterface;
use App\interfaces\OrderDeliverRepositoryInterface;
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
        $this->app->bind(CategoryRepositoryInterface::class , CategoryRepositories::class);
        $this->app->bind(AuthorRepositoryInterface::class , AuthorRepositories::class);
        $this->app->bind(PublisherRepositoryInterface::class , PublisherRepository::class);
        $this->app->bind(BookRepositoryInterface::class , BookRepositories::class);
        $this->app->bind(CartRepositoryInterface::class , CartRepositories::class);
        $this->app->bind(PostRepositoryInterface::class , PostRepositories::class);
        $this->app->bind(CommentRepositoryInterface::class , CommentRepositories::class);
        $this->app->bind(ReplayRepositoryInterface::class , ReplayRepositories::class);
        $this->app->bind(RateRepositoryInterface::class , RateRepositories::class);

        $this->app->bind(ReviewRepositoryInterface::class , ReviewRepositories::class);
        $this->app->bind(OrderRepositoryInterface::class , OrderRepositories::class);


        $this->app->bind(OrderStatusRepositoryInterface::class , OrderStatusRepositories::class);


        $this->app->bind(OrderDeliverRepositoryInterface::class , OrderDeliverRepositories::class);


        $this->app->bind(RefundRepositoryInterface::class , RefundRepositories::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
