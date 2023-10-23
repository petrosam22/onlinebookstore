<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','quantity'];



    public function user(){
        return $this->belongsTo(User::class);
    }


    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_cart');
    }

}
