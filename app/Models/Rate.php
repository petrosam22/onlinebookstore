<?php

namespace App\Models;
use App\Models\User;
use App\Models\Book;
use App\Models\Review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

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
    public function review(){
        return $this->belongsTo(Review::class);
    }
}
