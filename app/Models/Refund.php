<?php

namespace App\Models;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'order_id',
        'book_order_id',
        'amount' ,
        'refund_number' ,
        'quantity',
        'book_id',
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
    public function books()
    {
        return $this->belongsTo(Book::class);
    }


}
