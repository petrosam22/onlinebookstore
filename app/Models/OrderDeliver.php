<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDeliver extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['order_id','delivered_at'];



    public function order(){
        return $this->belongsTo(Order::class);
    }
}
