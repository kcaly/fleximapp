<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function elements()
    {
        return $this->belongsToMany(Element::class,
        'articles_elements',
        'article_id',
        'element_id',)->withPivot('amount');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,
        'products_articles',
        'product_id',
        'article_id',)->withPivot('amount');
    }
}
