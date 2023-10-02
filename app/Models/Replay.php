<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Replay extends Model
{
    use HasFactory;

    protected $fillable = ['content','comment_id'];


    public function comments(){
        return $this->belongsTo(Comment::class);

    }
}
