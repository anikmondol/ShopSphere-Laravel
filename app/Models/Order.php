<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    function user(){
        return $this->belongsTo(User::class);
    }

    function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    function transaction(){
        return $this->hasOne(Transaction::class);
    }
}
