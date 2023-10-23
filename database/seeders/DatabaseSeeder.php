<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BookTableSeeder;
use Database\Seeders\CartTableSeeder;
use Database\Seeders\PostTableSeeder;
use Database\Seeders\RateTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\OrderTableSeeder;
use Database\Seeders\AuthorTableSeeder;
use Database\Seeders\RefundTableSeeder;
use Database\Seeders\ReviewTableSeeder;
use Database\Seeders\CommentTableSeeder;
use Database\Seeders\CategoryTableSeeder;
use Database\Seeders\publisherTableSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrderStatusSeeder::class,
            UserTableSeeder::class,
            AuthorTableSeeder::class,
            publisherTableSeeder::class,
            CategoryTableSeeder::class,
            BookTableSeeder::class,
            CartTableSeeder::class,
            PostTableSeeder::class,
            OrderTableSeeder::class,
            RateTableSeeder::class,
            RefundTableSeeder::class,
            ReviewTableSeeder::class,
            CommentTableSeeder::class,

        ]);
    }
}
