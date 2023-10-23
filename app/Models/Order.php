<?php

namespace App\Models;
use App\Models\Book;
use App\Models\User;
use App\Models\Refund;

use App\Models\OrderDeliver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =
    [
        'user_id',
        'number',
        'book_ids',
        'quantities',
        'payment',
        'discounts',
        'total_products',
        'total',
        'order_status_id',
        'is_refund'
    ];
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_orders')
        ->withPivot('book_id')
        ->withTimestamps();
    }

    public function OrderDeliver(){
        return $this->hasMany(OrderDeliver::class);

    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Retrieve the maximum number value from the database
            $maxNumber = static::max('number');

            // Increment the maximum number by 1 and assign it to the new order
            $order->number = $maxNumber + 1;
        });
    }
}
