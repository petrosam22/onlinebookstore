<?php

namespace App\Models;
use App\Models\User;
use App\Models\Book;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'body',
        'user_id',
        'book_id',
        'rate_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function rate(){
        return $this->belongsTo(Rate::class);
    }


}
