<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function elements()
    {
        return $this->hasMany('App\Models\Element');
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
