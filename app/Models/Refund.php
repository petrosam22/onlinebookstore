<?php

namespace App\Models;
use App\Models\User;
use App\Models\OrderProduct;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'order_product_id',
        'amount',
        'refund_number' ,
        'quantity' ,
        'status'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}
