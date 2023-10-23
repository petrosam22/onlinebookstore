<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Replay extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['content','comment_id','user_id'];


    public function comments(){
        return $this->belongsTo(Comment::class);

    }
    public function user(){
        return $this->belongsTo(User::class);

    }
}
