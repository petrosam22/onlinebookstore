<?php

namespace App\Models;
use App\Models\Cart;
use App\Models\Rate;
use App\Models\User;
use App\Models\Order;
use App\Models\Author;
use App\Models\Review;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable  =
    [
        'name',
        'author_id',
        'user_id',
        'publisher_id',
        'image',
        'description',
        'quantity',
        'category_id',
        'price',

    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }



    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }




    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'book_cart');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'book_orders')
        ->withTimestamps();
    }

}
