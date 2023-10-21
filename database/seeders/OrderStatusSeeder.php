<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        OrderStatus::create([
            'status' => 'pending',
        ]);
        OrderStatus::create([
            'status' => 'processing',
        ]);

        OrderStatus::create([
            'status' => 'shipped',
        ]);
        OrderStatus::create([
            'status' => 'delivered',
        ]);
    }
}

