<?php

namespace App\Models;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =
    [
        'user_id',
        'book_id',
        'rate'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
