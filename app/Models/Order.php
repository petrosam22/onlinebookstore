<?php

namespace App\Models;
use App\Models\User;
use App\Models\Refund;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'number',
        'payment',
        'discounts',
        'total_products',
        'total'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}
