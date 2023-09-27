<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Rate;
use App\Models\Review;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
