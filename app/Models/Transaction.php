<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    function order(){
        return $this->belongsTo(Order::class);
    }
}
