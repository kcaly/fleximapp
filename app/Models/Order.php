<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class,
        'orders_products',
        'order_id',
        'product_id',)->withPivot('amount');
    }

    public function element_productions()
    {
        return $this->hasMany('App\Models\ElementProduction');
    }

    
}
