<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
protected $fillable = ['book_id','order_id','quantity'];



    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with the Book model
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
