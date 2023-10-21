<?php

namespace App\Models;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Rate;
use App\Models\Order;
use App\Models\Refund;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Replay;
use App\Models\Review;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function routeNotificationForMail()
{
    return $this->email;
}

    public function books(){
        return $this->hasMany(Book::class);
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function refunds(){
        return $this->hasMany(Refund::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }


    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function replays(){
        return $this->hasMany(Replay::class);
    }

}
