<?php

namespace App\Models;
use App\Models\Book;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory,SoftDeletes;
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
