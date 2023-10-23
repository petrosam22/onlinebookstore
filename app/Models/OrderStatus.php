<?php

namespace App\Models;
use App\Models\Order;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['status'];

public function orders()
{
    return $this->hasMany(Order::class);
}



}
