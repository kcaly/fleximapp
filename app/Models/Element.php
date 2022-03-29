<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;


    public function articles()
    {
        return $this->belongsToMany(Article::class,
        'articles_elements',
        'article_id',
        'element_id',)->withPivot('amount');

    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function elementfiles()
    {
        return $this->hasMany('App\Models\ElementFile');
    }

    public function element_productions()
    {
        return $this->hasMany('App\Models\ElementProduction');
    }

    public function element_jobs()
    {
        return $this->hasMany('App\Models\ElementJob');
    }
}
