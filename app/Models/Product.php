<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->belongsToMany(Article::class,
        'products_articles',
        'product_id',
        'article_id',)->withPivot('amount');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,
        'orders_products',
        'order_id',
        'product_id',)->withPivot('amount');
    }

}