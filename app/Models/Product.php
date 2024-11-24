<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $fillable = [
        'name',
        'regular_price',
        'sale_price',
        // Other attributes
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

}
