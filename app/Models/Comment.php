<?php

namespace App\Models;

use App\Models\User;
use App\Models\Replay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['commentable_id','commentable_type','body','user_id'];
    public function commentable()
    {
        return $this->morphTo();
    }

    public function replays(){
        return $this->hasMany(Replay::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
